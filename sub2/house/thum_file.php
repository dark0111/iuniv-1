
<? 
//썸네일 코드 시작
$data_path ="./imageData";//라이브러리 파일 참조
$thumb_path = $data_path . '/thumbOpen';
$thumb_path2 = $data_path . '/thumbOpen2';


//파일 뽑기
$sql = " select I_id, I_classify, I_classify_id, I_filename from room_imageinfo where I_classify_id='$h_cd' order by priority desc,I_classify asc,I_id"; 
$result = sql_query($sql);
$c_r=mysql_num_rows($result);

		
for ($i=0;$i<$c_r ; $i++) 
{

	$row = sql_fetch_array($result);
	

	//$view_w = 430; //썸네일 가로사이즈
	//$view_h = 330; //썸네일 세로사이즈
	$sch_q = 100; //썸네일 퀼리티

	if (!is_dir($thumb_path2)) {
		@mkdir($thumb_path2, 0707);
		@chmod($thumb_path2, 0707);
		
	}

	if (!is_dir($thumb_path)) {
		@mkdir($thumb_path, 0707);
		@chmod($thumb_path, 0707);
		
	}

	$filename = $row[I_filename]; //파일명
	$thumb = $thumb_path.'/'.$filename; //썸네일

	if (!file_exists($thumb)) { //view 용 이미지 생성

		$file = $data_path.'/'.$filename; //원본
		
		if (preg_match("/\.(jp[e]?g|gif|png)$/i", $file) && file_exists($file)) 
		{
			$width_d = 120; //사이즈를고정한다.
			$height_d=100;
			$file_name_type= explode(".",$filename);
			//echo $file_name_type[0]."/".$file_name_type[1];
			$size = @getimagesize($file);
			if ($size[2] == 1){
			exec( "giftopnm '$file' > '$thumb_path/$file_name_type[0].pnm'");
			exec( "pnmscale -width=".$width_d." -height=".$height_d." '$thumb_path/$file_name_type[0].pnm' | cjpeg -progressive -optimize -smooth 20 -outfile '$thumb_path/$file_name_type[0].jpg'"); 
			unlink( "$thumb_path/$file_name_type[0].pnm" ); 
			}else if ($size[2] == 2)
			$src = imagecreatefromjpeg($file);
			else if ($size[2] == 3)
			$src = imagecreatefrompng($file);
			else
			continue;

			$rate = $width_d / $size[0];
			$height = (int)($size[1] * $rate);

			if ($height < $height_d)
			$dst = imagecreatetruecolor($width_d, $height);
			else
			$dst = imagecreatetruecolor($width_d, $height_d);
			
			if ($size[2] == 1){//gif가 아니면 실행 gif이면 위에서 생성함 exec()부분
				chmod($thumb_path.'/'.$file_name_type[0].'.jpg', 0777);
			}else{
				imagecopyresampled($dst, $src, 0, 0, 0, 0, $width_d, $height, $size[0], $size[1]);
				// imagepng($dst, $thum, $board[bo_3]);
				//imagepng($dst, $thumb_path.'/'.$filename);
				imagejpeg($dst,$thumb_path.'/'.$filename);   // jpeg로 변경
				chmod($thumb_path.'/'.$filename, 0777);
			}				
		}
	}//view 용 이미지 생성 끝
	
	//$view_w = 640; //썸네일 가로사이즈
	//$view_h = 480; //썸네일 세로사이즈

	$thumb2 = $thumb_path2.'/'.$filename; //썸네일

	if(!file_exists($thumb2)) { //큰이미지 썸네일
		$file = $data_path.'/'.$filename; //원본
		if (preg_match("/\.(jp[e]?g|gif|png)$/i", $file) && file_exists($file)) {		
			$width_d = 450; //사이즈를고정한다.
			$height_d=375;

			$file_name_type= explode(".",$filename);
			//echo $file_name_type[0]."/".$file_name_type[1];
			$size = @getimagesize($file);
				if ($size[2] == 1){
					if($size[0]>=$size[1]){
						$rate = $width_d / $size[0];
						$height_d = (float)($size[1] * $rate);
					}else{ //세로가더 클때
						$rate = $height_d / $size[1];
						$width_d = (float)($size[0] * $rate);
					}
					exec( "giftopnm '$file' > '$thumb_path2/$file_name_type[0].pnm'");
					exec( "pnmscale -width=".(int)$width_d." -height=".(int)$height_d." '$thumb_path2/$file_name_type[0].pnm' | cjpeg -progressive -optimize -smooth 20 -outfile '$thumb_path2/$file_name_type[0].jpg'"); 
					unlink("$thumb_path2/$file_name_type[0].pnm"); 
				}else if ($size[2] == 2)
					$src = imagecreatefromjpeg($file);
				else if ($size[2] == 3)
					$src = imagecreatefrompng($file);
				else
					continue;

				if($size[0]>=$size[1]){//가로가 더 클때
					$rate = $width_d / $size[0];
					$height_d = (float)($size[1] * $rate);
				
					$dst = imagecreatetruecolor($width_d, $height_d);
					
					if ($size[2] == 1){//gif가 아니면 실행 gif이면 위에서 생성함 exec()부분
						chmod($thumb_path2.'/'.$file_name_type[0].'.jpg', 0777);
					}else{
						imagecopyresampled($dst, $src, 0, 0, 0, 0, $width_d, $height_d, $size[0], $size[1]);
						// imagepng($dst, $thum, $board[bo_3]);
						//imagepng($dst, $thumb_path2.'/'.$filename);
						imagejpeg($dst,$thumb_path2.'/'.$filename);   // jpeg로 변경
						chmod($thumb_path2.'/'.$filename, 0777);
					}
				}else{ //세로가더 클때
					$rate = $height_d / $size[1];
					$width_d = (float)($size[0] * $rate);
					$dst = imagecreatetruecolor($width_d, $height_d);
					
					if ($size[2] == 1){//gif가 아니면 실행 gif이면 위에서 생성함 exec()부분
						chmod($thumb_path2.'/'.$file_name_type[0].'.jpg', 0777);
					}else{
						imagecopyresampled($dst, $src, 0, 0, 0, 0, $width_d, $height_d, $size[0], $size[1]);
						// imagepng($dst, $thum, $board[bo_3]);
						//imagepng($dst, $thumb_path2.'/'.$filename);
						imagejpeg($dst,$thumb_path2.'/'.$filename);   // jpeg로 변경
						chmod($thumb_path2.'/'.$filename, 0777);
					}
				}
		}

	}//큰이미지 썸네일 끝				
	//echo"$thumb2 <br>";
	$file_replace=str_replace(".gif",".jpg",$row[I_filename]);
	$thumb_check = $thumb_path2.'/'.$file_replace; //썸네일
	if(file_exists("$thumb_check"))
	{
		
	?>
		<!--<?=$thumb2?>-->
		
		<img src="./imageData/thumbOpen/<?=$file_replace?>" />
	<?
	}
}
?>