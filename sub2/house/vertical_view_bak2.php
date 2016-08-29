		<?

			/* DQ엔진에서 중복되므로 삭제
				function UnsharpMask($img, $amount, $radius, $threshold) {
			

			
			// Attempt to calibrate the parameters to Photoshop:
			if ($amount > 500) $amount = 500;
			$amount = $amount * 0.016;
			if ($radius > 50) $radius = 50;
			$radius = $radius * 2;
			if ($threshold > 255) $threshold = 255;
	
			$radius = abs(round($radius)); 	// Only integers make sense.
			if ($radius == 0) {	return $img; imagedestroy($img); break;	}
			$w = imagesx($img); $h = imagesy($img);
			$imgCanvas = $img;
			$imgCanvas2 = $img;
			$imgBlur = imagecreatetruecolor($w, $h);
	
			// Gaussian blur matrix:
			//	1	2	1		
			//	2	4	2		
			//	1	2	1		

			// Move copies of the image around one pixel at the time and merge them with weight
			// according to the matrix. The same matrix is simply repeated for higher radii.
			for ($i = 0; $i < $radius; $i++)
				{
				imagecopy	  ($imgBlur, $imgCanvas, 0, 0, 1, 1, $w - 1, $h - 1); // up left
				imagecopymerge ($imgBlur, $imgCanvas, 1, 1, 0, 0, $w, $h, 50); // down right
				imagecopymerge ($imgBlur, $imgCanvas, 0, 1, 1, 0, $w - 1, $h, 33.33333); // down left
				imagecopymerge ($imgBlur, $imgCanvas, 1, 0, 0, 1, $w, $h - 1, 25); // up right
				imagecopymerge ($imgBlur, $imgCanvas, 0, 0, 1, 0, $w - 1, $h, 33.33333); // left
				imagecopymerge ($imgBlur, $imgCanvas, 1, 0, 0, 0, $w, $h, 25); // right
				imagecopymerge ($imgBlur, $imgCanvas, 0, 0, 0, 1, $w, $h - 1, 20 ); // up
				imagecopymerge ($imgBlur, $imgCanvas, 0, 1, 0, 0, $w, $h, 16.666667); // down
				imagecopymerge ($imgBlur, $imgCanvas, 0, 0, 0, 0, $w, $h, 50); // center
				}
			$imgCanvas = $imgBlur;	
				
			// Calculate the difference between the blurred pixels and the original
			// and set the pixels
			for ($x = 0; $x < $w; $x++)
				{ // each row
				for ($y = 0; $y < $h; $y++)
					{ // each pixel
					$rgbOrig = ImageColorAt($imgCanvas2, $x, $y);
					$rOrig = (($rgbOrig >> 16) & 0xFF);
					$gOrig = (($rgbOrig >> 8) & 0xFF);
					$bOrig = ($rgbOrig & 0xFF);
					$rgbBlur = ImageColorAt($imgCanvas, $x, $y);
					$rBlur = (($rgbBlur >> 16) & 0xFF);
					$gBlur = (($rgbBlur >> 8) & 0xFF);
					$bBlur = ($rgbBlur & 0xFF);

					// When the masked pixels differ less from the original
					// than the threshold specifies, they are set to their original value.
					$rNew = (abs($rOrig - $rBlur) >= $threshold) ? max(0, min(255, ($amount * ($rOrig - $rBlur)) + $rOrig)) : $rOrig;
					$gNew = (abs($gOrig - $gBlur) >= $threshold) ? max(0, min(255, ($amount * ($gOrig - $gBlur)) + $gOrig)) : $gOrig;
					$bNew = (abs($bOrig - $bBlur) >= $threshold) ? max(0, min(255, ($amount * ($bOrig - $bBlur)) + $bOrig)) : $bOrig;
					
					if (($rOrig != $rNew) || ($gOrig != $gNew) || ($bOrig != $bNew))
						{
						$pixCol = ImageColorAllocate($img, $rNew, $gNew, $bNew);
						ImageSetPixel($img, $x, $y, $pixCol);
						}
					}
				}
			return $img;
			}
		*/
		?>

		<? 
			//썸네일 코드 시작
			$data_path = $g4['path'] . "/data/file/house";//라이브러리 파일 참조
			$data_path ="../../../imageData";//라이브러리 파일 참조
			$thumb_path = $data_path . '/thumbOpen';
			$thumb_path2 = $data_path . '/thumbOpen2';
		?>


			
			<SCRIPT LANGUAGE='JavaScript'>
			// 이미지뷰어
			<!-- 
			var win= null;
			function View_Open(img, w, h)
			{
				var winl = (screen.width-w)/2;
				var wint = (screen.height-h)/3;
				var settings  ='height='+h+',';
					settings +='width='+w+',';
					settings +='top='+wint+',';
					settings +='left='+winl+',';
					settings +='scrollbars=yes,';
					settings +='resizable=yes,';
					settings +='status=no';

				win=window.open("","newWindow",settings);
				win.document.open(); 
				win.document.write ("<html><head><title>원본 이미지 보기</title></head>"); 
				win.document.write ("<script>function init(){window.resizeBy(document.all.pop_img.width-document.body.clientWidth, document.all.pop_img.height-document.body.clientHeight+10);}</script>"); 
				win.document.write ("<body bgcolor=white topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 oncontextmenu='return false' ondragstart='return false' onkeydown='return false' onselectstart='return false' onload='init();'>");
				win.document.write ("<img src='"+img+"' border=0 onclick='window.close();' style='cursor:hand' title='클릭하면 닫혀요' id='pop_img'>");
				win.document.write ("</body></html>");
				win.document.close();
			}
		//-->
		</SCRIPT>

		<SCRIPT LANGUAGE="JavaScript">
		<!-- 
		image_directory = "";   //배경이미지 경로
		clear = new Image();  clear.src = image_directory + "./img/blank.gif";
		<?
		//파일 뽑기
	
		$sql2 = "  select I_id, I_classify, I_classify_id, I_filename from room_imageinfo where I_classify ='H' and I_classify_id='$h_cd' "; 
		$result2 = sql_query($sql2);
		for ($j=0; $row2 = sql_fetch_array($result2); $j++) {
			if($j==0) $view_one = $g4['house_img_path'].$row2['I_filename'];
		}
		?>
		

		//  -->
		</SCRIPT>

		<table cellspacing="0" cellpadding="0" border="0" align="center">

			<tr>
			
		
			<td  style="padding:0 0 0 0px;border:1px solid #D4DBE1;" width="430" height="330" align="center" valign="top" bgcolor=white>
			  <div style='width:430px;position:relative; overflow:hidden;' align="center" id="loadarea"><img src="<?=$view_one?>" width="420" height="330" border="0"></div>
			</td>
			<td width="10"></td>
				
			
			<td style="padding:0 0 0 0px;border:1px solid #D4DBE1;" width="160" height="100%" align="center" valign="top"> 
				<!--작은사진목록-->	
				<table border="0" cellpadding="0" cellspacing="0" width="100%" valign='top'>
				<tr>
					<td style="border:solid 1px #D3D3D3; background-color:#E5E5E5;" height="330" valign='top'>
						<table border="1" cellpadding="0" cellspacing="0">
	
						<tr>
				
						 <?
						//파일 뽑기
						$sql = " select I_id, I_classify, I_classify_id, I_filename from room_imageinfo where I_classify_id='$h_cd' "; 
						$result = sql_query($sql);
						for ($i=0; $row = sql_fetch_array($result); $i++) {

							
							if($i != 0 && $i % 2 == 0) echo "</tr><tr>";

							$view_w = 430; //썸네일 가로사이즈
							$view_h = 330; //썸네일 세로사이즈
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
							$thumb2 = $thumb_path2.'/'.$filename; //썸네일
						
							if (!file_exists($thumb2)) { //view 용 이미지 생성

								$file = $data_path.'/'.$filename; //원본
								
								if (preg_match("/\.(jp[e]?g|gif|png)$/i", $file) && file_exists($file)) 
								{
									$width_d = 460; //사이즈를고정한다.
									$height_d=500;

									$size = @getimagesize($file);
									if ($size[2] == 1)
									$src = imagecreatefromgif($file);
									else if ($size[2] == 2)
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
									imagecopyresampled($dst, $src, 0, 0, 0, 0, $width_d, $height, $size[0], $size[1]);
									// imagepng($dst, $thum, $board[bo_3]);
									imagepng($dst, $thumb_path.'/'.$filename);
									//imagejpeg($dst,$thum,  $board[bo_3]);   // jpeg로 변경
									chmod($thumb_path.'/'.$filename, 0606);
								}

							}
							
							$view_w = 80; //썸네일 가로사이즈
							$view_h = 60; //썸네일 세로사이즈
						
							$thumb = $thumb_path.'/'.$filename; //썸네일

							if (!file_exists($thumb)) { //기본 썸네일 

								$file = $data_path.'/'.$filename; //원본
								if (preg_match("/\.(jp[e]?g|gif|png)$/i", $file) && file_exists($file)) {
									
									
									$width_d = 80; //사이즈를고정한다.
									$height_d=60;

									$size = @getimagesize($file);
									if ($size[2] == 1)
									$src = imagecreatefromgif($file);
									else if ($size[2] == 2)
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
									imagecopyresampled($dst, $src, 0, 0, 0, 0, $width_d, $height, $size[0], $size[1]);
									// imagepng($dst, $thum, $board[bo_3]);
									imagepng($dst, $thumb_path.'/'.$filename);
									//imagejpeg($dst,$thum,  $board[bo_3]);   // jpeg로 변경
									chmod($thumb_path.'/'.$filename, 0606);
								}

							}
							//echo"$thumb # $filename<br>";
							if (file_exists($thumb) && $filename) {
							?>

							  <td style="border:solid 1px #D0D0D0;height:60px;width:80px;">
									<a rel="enlargeimage::mouseover" rev="loadarea" href="<?=$thumb_path2?>/<?=$filename?>"><img src="<?=$thumb?>" style="border-width:0px;" /></a>
							  </td>
								
							 
							<?
							//onMouseOut="bgChange('clear');"
								}
							}
							?>
							</table>
						</td>
					</tr>
					</table>
				<!--작은사진목록-->
				</td>
			</tr>
		  </table>
		  <!--사진테이블-->
