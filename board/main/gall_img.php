<?
$g4_path='..';
include_once("../common.php");

$g4['title'] = "";
include_once("$g4[path]/main.sub.php");
include_once("$g4[path]/lib/connect.lib.php");


$img_cnt = $_REQUEST["img_cnt"];
if($img_cnt==""||img_cnt==NULL){
 $img_cnt = 5;
}

$gi_sql = " SELECT wr_id, wr_subject, wr_content FROM `g4_write_gallery` where wr_1 = 'main_gall' order by wr_id desc LIMIT 0 , ".$img_cnt;
$ds_gi_list = sql_query($gi_sql);

	$gi_num = $img_cnt;
	$gi_arry = array();
	$img_string="";
	
	for ($i=0; $row = sql_fetch_array($ds_gi_list); $i++) {  
		if($i==0){$img_string=$img_string."imgAdd=";}
		  $buff = Array(); // 결과 저장 배열 
			$input = $row[wr_content]; 
			preg_match_all("/<img [^<>]*>/is",$input,$output); 
			foreach($output[0] as $value) { 
					$content = $value; 
					if(eregi("[:space:]*(src)[:space:]*=[:space:]*([^ >;]+)",$content,$regs)) { 
						$regs[2] = str_replace(Array("'",'"'),"",$regs[2]); 
						$buff[] = $regs[2]; 
					} 
			} 

			if(count($gi_arry)==0){
				if(count($buff)>=$gi_num){
					for($i=0;$i<$gi_num;$i++){
						$gi_arry[$i] = $buff[$i];
					}
				}else{
					for($i=0;$i<count($buff);$i++){
						$gi_arry[$i] = $buff[$i];
					}
				}
			}else{
				$ga_cnt = count($gi_arry);
				//echo $ga_cnt;
				if(count($buff)>=$gi_num){
					for($i=0;$i<$gi_num;$i++){
						$gi_arry[$ga_cnt+$i] = $buff[$i];
					}
				}else{
					for($i=0;$i<count($buff);$i++){
						$gi_arry[$ga_cnt+$i] = $buff[$i];
					}
				}
			}
		
			//echo count($gi_arry);
			//echo "<xmp>"; 
			//print_r($buff); 
			//echo "</xmp>"; 
			//echo count($buff);
			//print_r($gi_arry)
		?>
		<!--<img src="<?echo 'http://www.iuniv.kr/board/data/file/restaurant/img/'.$row[wr_id].'.thumb';?>" width=140 height=115 title="">-->
		<?
		for($j=0;$j<count($gi_arry);$j++){
			$img_string=$img_string.$gi_arry[$j];		
		$img_string=$img_string.",";
		}
	}
	echo $img_string;
	?>