<?
$sub_menu = "800100";
$g4_path  = "../..";
include_once("$g4_path/common.php");
include_once("$g4[admin_path]/admin.lib.php");
include_once("$g4[path]/lib/talk.lib.php"); 
include_once("$g4[path]/gnutalk.config.php");

$talk_config_file = $g4['path'].'/extend/gnutalk.extend.php';

/*

if(!file_exists($gb4_config_file)&&!strstr($PHP_SELF,'config'))
    alert('블로그 기본환경 설정을 먼저 해주세요.','./config.php');

*/
?>