<?

$g4_path = "."; // common.php 의 상대 경로
if(substr($mode,0,4)=='mall')
{
	include_once ("../sub/mall/dark_include/lib.php");
	include_once ("$g4_path/common2.php");
	include_once ("../sub/mall/dark_include/dbcon.php");	

}
else
{
	include_once("$g4_path/common.php");
}




?>