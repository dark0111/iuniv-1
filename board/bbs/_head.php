<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
$browser=browser_check();
if($browser[0]==1 && $browser[1]=='6.0')
{
	include_once("$g4[path]/head.php");
}
else
{
	include_once("$g4[path]/head_v2.php");

}

?>