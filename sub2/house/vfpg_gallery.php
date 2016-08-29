<?
$h_cd = $_REQUEST["h_cd"];
if($h_cd == ""||$h_cd==null){
	$h_cd ="32";
}

include_once("../../board/dbconfig.php");

$connect=mysql_connect($mysql_host,$mysql_user,$mysql_password) or die ("No connection available to mysql."); 
mysql_select_db($mysql_db,$connect);
//mysql_set_charset('latin1',$connect); 

$img_sql = " select I_id, I_classify, I_classify_id, I_filename, I_title,  I_comment, priority  from room_imageinfo where I_classify_id='$h_cd' and I_classify ='H' ";
$img_sql = $img_sql." union ";
$img_sql = $img_sql." select I_id, I_classify, I_classify_id, I_filename, I_title,  I_comment, priority  from room_imageinfo where I_classify_id='$h_cd' and I_classify ='R'  order by priority Desc";

$ds_img_sql = mysql_query($img_sql);
$result_img_ck_sql_count = mysql_num_rows($ds_img_sql);
//echo "result_img_ck_sql_count===>".$result_img_ck_sql_count."<Br>";
	
	//썸네일 코드 시작
		$img_path="/imageData/thumbOpen2/";
		$tmb_path="/imageData/thumbOpen/";
	for($i=0; $row = mysql_fetch_array($ds_img_sql); $i++){		
		$pic_etc = $row[I_title]."-".$row[I_comment];
		$arr_imgs=$arr_imgs.$row[I_filename].",".$row[I_filename].",".$pic_etc.";";
	}
	$configdata = "&img_path=".$img_path."&tmb_path=".$tmb_path."&arr_imgs=".$arr_imgs;
	$configdata = str_replace("gif","jpg",$configdata);
	echo $configdata;
?>