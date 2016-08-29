<?
include('./_common.php');

if ($is_admin != "super")
    alert("최고관리자만 접근 가능합니다.");

include_once("../admin.head.php");

$qry = sql_query("select * from {$g4['talk_info_table']} order by id");
while ($res = sql_fetch_array($qry)) {
    $r1 = sql_fetch("select count(*) as cnt from {$g4['talk_table']} where t_id='{$res['id']}'");
    $r2 = sql_fetch("select count(*) as cnt from {$g4['talk_comment_table']} where t_id='{$res['id']}'");
    $r3 = sql_fetch("select count(*) as cnt from {$g4['talk_friends_table']} where t_id='{$res['id']}'");
    $r4 = sql_fetch("select count(*) as cnt from {$g4['talk_friends_table']} where friends_t_id='{$res['id']}'");

    sql_query("update {$g4['talk_info_table']} set post_count='{$r1['cnt']}', comment_count='{$r2['cnt']}', friends_count='{$r3['cnt']}', friends_to_me_count='{$r4['cnt']}' where id='{$res['id']}'");
}

$qry = sql_query("select * from {$g4['talk_comment_table']} group by id order by id");
while ($res = sql_fetch_array($qry)) {
    $r1 = sql_fetch("select t_id from {$g4['talk_table']} where id='{$res['id']}'");
    $qy = sql_query("update {$g4['talk_comment_table']} set t_id='{$r1['t_id']}' where id='{$res['id']}'");
}

echo "SYNC 완료.";

include_once("../admin.tail.php");

?>