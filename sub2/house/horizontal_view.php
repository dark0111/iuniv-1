<? 
	//썸네일 코드 시작
	$data_path = $g4['path'] . "/data/file/{$bo_table}";//라이브러리 파일 참조
	$thumb_path = $data_path . '/thumbOpen';
	$thumb_path2 = $data_path . '/thumbOpen2';
?>
 <?
 //function UnsharpMask 는 DQ엔진과 중복되므로 삭제
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
		$sql2 = " select bf_file from $g4[board_file_table] where bo_table = '$bo_table' and wr_id = '$wr_id' order by bf_no limit 0, 12 "; 
		$result2 = sql_query($sql2);
		for ($j=0; $row2 = sql_fetch_array($result2); $j++) {
			if($j==0) $view_one = "{$thumb_path2}/{$row2['bf_file']}";
		}
		?>
		

		//  -->
		</SCRIPT>

		<table cellspacing="0" cellpadding="0" border="0" align="left">
		  <tr height="5">
				<td colspan="5"></td>
			</tr>
			
			<tr>
			
			<td  style="border:1px solid #D4DBE1;" width="610" height="400" align="center" valign="top" bgcolor=white>
			  <div style='width:610px;position:relative; 'align="center" id="loadarea"><img src="<?=$view_one?>" border="0"></div>
			</td>
			
			</tr>
			<tr>
			<!--작은사진목록-->	
			<td bgcolor="#f1f1f1" style="padding:4 0 4 0px;" width="610" height="120" align="center" valign="top"> 
				<table border="0" cellpadding="0" cellspacing="0" width="100%" valign='top'>
				<tr>
					<td style="border:solid 1px #D3D3D3; background-color:#E5E5E5; " valign='top'>
							
							<tr>
					
							 <?
							//파일 뽑기
							$sql = " select bf_file, bf_source from $g4[board_file_table] where bo_table = '$bo_table' and wr_id = '$wr_id' order by bf_no limit 0, 12 "; 
							$result = sql_query($sql);
							for ($i=0; $row = sql_fetch_array($result); $i++) {

								if($i != 0 && $i % 6 == 0) echo "</tr><tr><td colspan='3' style='height:7px;'></td></tr><tr>";
							    if($i % 6 != 0) echo "<td width=10></td>";
								$view_w = 610; //썸네일 가로사이즈
								$view_h = 400; //썸네일 세로사이즈
								$sch_q = 100; //썸네일 퀼리티

								if (!is_dir($thumb_path2)) {
									@mkdir($thumb_path2, 0707);
									@chmod($thumb_path2, 0707);
									
								}

								if (!is_dir($thumb_path)) {
									@mkdir($thumb_path, 0707);
									@chmod($thumb_path, 0707);
									
								}

								$filename = $row[bf_file]; //파일명
								$thumb2 = $thumb_path2.'/'.$filename; //썸네일

								if (!file_exists($thumb2)) { //view 용 이미지 생성

									$file = $data_path.'/'.$filename; //원본
									if (preg_match("/\.(jp[e]?g|gif|png)$/i", $file) && file_exists($file)) {
										$size = getimagesize($file);
										if ($size[2] == 1)
											$src = imagecreatefromgif($file);
										else if ($size[2] == 2)
											$src = imagecreatefromjpeg($file);
										else if ($size[2] == 3)
											$src = imagecreatefrompng($file);
										else
											continue;

										$rate = $view_h / $size[1];
										//$width = (int)($size[0] * $rate);
										$width = 610; //가로 사이즈 고정
										
										//echo "rate : $rate ,width : $width, $height : $board[bo_2] <br>";
										if($width <= $view_w) { //width가 지정된 사이즈보다 작을경우 rate 비율로 썸네일 생성
											$dst = imagecreatetruecolor($width, $view_h);
											imagecopyresampled($dst, $src, 0, 0, 0, 0, $width, $view_h, $size[0], $size[1]);
											imagepng($dst, $thumb_path2.'/'.$filename, $sch_q);
										} else {
											$rate = $view_w / $size[0];
											$height = (int)($size[1] * $rate);

											$dst = imagecreatetruecolor($view_w, $height);
											imagecopyresampled($dst, $src, 0, 0, 0, 0, $view_w, $height, $size[0], $size[1]);
											imagepng($dst, $thumb_path2.'/'.$filename, $sch_q);
										}
										chmod($thumb_path2.'/'.$filename, 0707);
									}

								}
								
								$view_w = 100; //썸네일 가로사이즈
								$view_h = 66; //썸네일 세로사이즈
								$thumb = $thumb_path.'/'.$filename; //썸네일
								if (!file_exists($thumb)) { //기본 썸네일 

									$file = $data_path.'/'.$filename; //원본
									if (preg_match("/\.(jp[e]?g|gif|png)$/i", $file) && file_exists($file)) {
										$size = getimagesize($file);
										if ($size[2] == 1)
											$src = imagecreatefromgif($file);
										else if ($size[2] == 2)
											$src = imagecreatefromjpeg($file);
										else if ($size[2] == 3)
											$src = imagecreatefrompng($file);
										else
											continue;

										$rate = $view_h / $size[1];
										//$width = (int)($size[0] * $rate);
										$width = 100;
										
										//echo "rate : $rate ,width : $width, $height : $board[bo_2] <br>";
										if($width <= $view_w) { //width가 지정된 사이즈보다 작을경우 rate 비율로 썸네일 생성
											$dst = imagecreatetruecolor($width, $view_h);
											imagecopyresampled($dst, $src, 0, 0, 0, 0, $width, $view_h, $size[0], $size[1]);
											$dst = UnsharpMask($dst, 80, 0.5, 3);
											imagepng($dst, $thumb_path.'/'.$filename, $sch_q);
										} else {
											$rate = $view_w / $size[0];
											$height = (int)($size[1] * $rate);

											$dst = imagecreatetruecolor($view_w, $height);
											imagecopyresampled($dst, $src, 0, 0, 0, 0, $view_w, $height, $size[0], $size[1]);
											$dst = UnsharpMask($dst, 80, 0.5, 3);
											imagepng($dst, $thumb_path.'/'.$filename, $sch_q);
										}
										chmod($thumb_path.'/'.$filename, 0707);
									}

								}

								if (file_exists($thumb) && $filename) {
								?>

								  <td style="border:solid 1px #D0D0D0;height:66px;width:100px;" align='left' width=100 height=66>
									<a rel="enlargeimage::mouseover" rev="loadarea" href="<?=$thumb_path2?>/<?=$filename?>"><img src="<?=$thumb?>" style="border-width:0px;" /></a>
								  </td>
									
								<?
								//onMouseOut="bgChange('clear');"
									}
								}
								?>

								<? for($c = 0; $c < (6 - ($i-1 % 6)); $c ++) echo "<td width=10></td><td width=100 height=66></td>"; ?>
								</tr>
								</table>
							</td>
						</tr>
						</table>
					<!--작은사진목록-->
