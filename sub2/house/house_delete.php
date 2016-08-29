<?
$g4_path='../../board';
include_once("$g4_path/common.php");
$g4['title'] = "";
include_once("$g4_path/_head.php");
include_once("./house_config.php");
$data_path ="../../imageData";//라이브러리 파일 참조
$thumb_path = $data_path . '/thumbOpen';
$thumb_path2 = $data_path . '/thumbOpen2';

$search_str=urlencode($search_str);

$qstr = "search_str=$search_str&house_ym_type=$house_ym_type&room_type=$room_type&fit_type=$fit_type&room_size=$room_size&price_1=$price_1&price_2=$price_2&page=$page";

if($h_cd)
{
	$sql_s = " select * from room_imageinfo where I_classify_id='$h_cd' ";
	$result_s = sql_query($sql_s);

	for($hc=0;$row_s = sql_fetch_array($result_s);$hc++)
	{
		$filename=$row_s[I_filename];
		$thumb = $thumb_path.'/'.$filename; //썸네일
		$thumb2 = $thumb_path2.'/'.$filename; //썸네일
		if (file_exists("$thumb") && $filename) 
		{
			
			unlink($thumb);
		}
		if (file_exists("$thumb2") && $filename) 
		{
			
			unlink($thumb2);
		}
		$view_one = $data_path."/".$row_s['I_filename'];
		if (file_exists("$view_one"))
		{
		
			unlink($view_one);
		}
	
	}

	$sql_d = " delete from room_house where h_cd='$h_cd' ";
	$result_d = sql_query($sql_d);

	$sql_r = " delete from room_room where h_cd='$h_cd' ";
	$result_r = sql_query($sql_r);
}
?>
<script>
	alert('삭제 되었습니다.');
	location.href='<?=$g4[home_file]?>?mode=house_list&<?=$qstr?>'
</script>
