<?
//include_once("../../common/dbcon.php");	//db 커넥션
	//SELECT a.wr_id, a.ca_name, a.wr_subject, a.wr_content, a.wr_hit, a.wr_good, a.wr_nogood, a.wr_2, a.wr_4, a.wr_5, a.wr_7, a.wr_8, a.wr_9, a.wr_10, b.bf_file
	$nowdate = date("Y-m-d, H:m:s");
$phone_connect_sql = " INSERT INTO `dark0111`.`iphone_connect` (
						`cd` ,`phone_info` ,`ip` ,`date` )
						VALUES (NULL , '".$_SERVER['HTTP_USER_AGENT']."', '".$_SERVER['REMOTE_ADDR']."', '".$nowdate."')";

$ds_phone_connect = mysql_Query($phone_connect_sql);


?>