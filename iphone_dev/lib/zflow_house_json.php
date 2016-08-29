<?
include_once("../../common/dbcon.php");	//db 커넥션
include_once("../lib/common.function.php");	//공통 함수
include_once("../lib/common.vars.php");	//공통 변수

$h_cd = str_replace("\'","",$_REQUEST['h_cd']);

		$house_img_sql = " select I_id, I_classify, I_classify_id, I_filename from room_imageinfo where I_filename not like '%.gif%'
and I_classify_id='$h_cd' order by priority desc ";
		$ds_house_img = mysql_Query($house_img_sql, $connection) or die('zflow_house_img_sql error');
		
$xml = '{"photo":[';
for ($i=0; $row = mysql_fetch_array($ds_house_img); $i++) {
	if($i>=1){$xml .= ',';}
	//$xml .= '{"'.$img_path_house_iphone.str_replace("gif","jpg",$row[I_filename]).'"}';
	$xml .= '{"img_url":"/imageData/'.$row[I_filename].'"}';
}
$xml .= ']}';
echo $xml;