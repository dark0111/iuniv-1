<?
include('./_common.php');
include('./config.php');

if ($g4['talk_limit_level']>$member['mb_level']) alert('회원등급이 낮아 토크를 개설할 수 없습니다.');

$res = sql_fetch("select * from {$g4['talk_info_table']} where mb_id='{$member['mb_id']}'");
if (!empty($res))
    goto_url('mytalk.php?t_id='.$res['id']);

$qry = sql_query("insert into {$g4['talk_info_table']} set mb_id='{$member['mb_id']}', talk_about='{$member['mb_nick']}', regdate='{$g4['time_ymdhis']}'");
if ($qry) {
    $current = sql_fetch("select * from {$g4['talk_info_table']} where mb_id='{$member['mb_id']}'");
    $talk_content = str_replace("[name]","{$member['mb_nick']}", $g4['talk_open_message']);
    //$qry = sql_query("insert into {$g4['talk_table']} set t_id='{$current['id']}', name='{$member['mb_nick']}', content='{$talk_content}', regdate='{$g4['time_ymd']}', regtime='{$g4['time_his']}'");
    goto_url('mytalk.php?t_id='.$current['id']);
} else {
    alert('회원-토크 등록에 실패하였습니다.');
}
?>