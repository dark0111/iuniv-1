<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

$browser=browser_check();
if($browser[0]==1 && $browser[1]=='6.0')
{
	include_once("$g4[path]/tail.php");
}
else
{
	include_once("$g4[path]/tail_v2.php");
}
?>