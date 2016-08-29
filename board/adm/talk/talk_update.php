<?
include_once("./_common.php");

auth_check($auth[$sub_menu], "w");

if ($is_admin != "super")
    alert("최고관리자만 접근 가능합니다.");

switch( $mode ) 
{
    case("delete"):

        sql_query("delete from {$g4['talk_info_table']}     where id='{$t_id}'");
        sql_query("delete from {$g4['talk_table']}          where t_id='{$t_id}'");
        sql_query("delete from {$g4['talk_comment_table']}  where t_id='{$t_id}'");
        break;
}

goto_url('talk.php');
?>