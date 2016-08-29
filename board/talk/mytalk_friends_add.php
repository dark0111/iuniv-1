<?
include('./_common.php');
include('./mytalk_config.php');

if (!$friends_t_id)
    err_xml('친구로 등록하는 도중 에러가 발생하였습니다.');

// 나의 토크 id 
$res = sql_fetch("select id, last_update from {$g4['talk_info_table']} where mb_id='{$member['mb_id']}'");
if (empty($res)) 
    err_xml('나의 토크가 존재하지 않기 때문에 친구로 추가할 수 없습니다.');

$my_t_id = $res['id'];
$last_update = $res['last_update'];

if ($my_t_id==$friends_t_id)
    err_xml('자기 자신은 친구로 등록할 수 없습니다.');

$res = sql_fetch("select * from {$g4['talk_friends_table']} where t_id='{$my_t_id}' and friends_t_id='{$friends_t_id}'");
if (!empty($res))
    err_xml('이미 친구로 등록되어 있습니다.');

$qry = sql_query("insert into {$g4['talk_friends_table']} set t_id='{$my_t_id}', friends_t_id='{$friends_t_id}', last_update='{$last_update}', regdate='{$g4['time_ymdhis']}'");
if (!$qry)
    err_xml('친구로 등록하는 도중 에러가 발생하였습니다.');

$qry = sql_query("update {$g4['talk_info_table']} set friends_count = friends_count + 1 where id='{$my_t_id}'");
if (!$qry)
    err_xml('친구로 등록하는 도중 에러가 발생하였습니다.');

$qry = sql_query("update {$g4['talk_info_table']} set friends_to_me_count = friends_to_me_count + 1 where id='{$friends_t_id}'");
if (!$qry)
    err_xml('친구로 등록하는 도중 에러가 발생하였습니다.');

err_xml('친구 등록 완료',0);

?>