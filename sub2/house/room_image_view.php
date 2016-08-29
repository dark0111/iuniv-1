<? 
	$g4_path='../../board';
	$g4['title'] = "";
	include_once("$g4_path/common.php");
	//썸네일 코드 시작
	$data_path ="../../imageData";//라이브러리 파일 참조
	$thumb_path = $data_path . '/thumbOpen';
	$thumb_path2 = $data_path . '/thumbOpen2';
?>
		<html>
		<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<title>IUNIV 주거정보 커뮤니티</title>

		<link rel="stylesheet" href="../../style.css" type="text/css">
		<link rel="stylesheet" href="../../popup_style.css" type="text/css">
		<link rel="stylesheet" href="../../main/link.css">
		</head>
		<SCRIPT LANGUAGE="JavaScript">
		<!-- 
		image_directory = "";   //배경이미지 경로
		clear = new Image();  clear.src = image_directory + "./img/blank.gif";
		<?
		//파일 뽑기	
		$sql2 = "  select I_id, I_classify, I_classify_id, I_filename from room_imageinfo where I_classify ='R' and I_classify_id='$h_cd' and I_room_id='$r_cd' order by priority desc,I_id"; 		
		$result2 = sql_query($sql2);
		for ($j=0; $row2 = sql_fetch_array($result2); $j++) {
			if($j==0) $view_one = $g4['house_img_path'].$row2['I_filename'];
		}
		?>
		
		
		//  -->
		</SCRIPT>
		<script type="text/javascript" src="./thumbnailviewer2.js" defer="defer"></script>
		<?

		//파일 뽑기
		$sql = " select I_id, I_classify, I_classify_id, I_filename from room_imageinfo where I_classify_id='$h_cd' and I_room_id='$r_cd' order by priority desc,I_id"; 
		$result = sql_query($sql);
		$c_r=mysql_num_rows($result);

		?>
		<table cellspacing="0" cellpadding="0" border="0" align="center">
		<tr>
			<td colspan=10 align=center bgcolor=#cccccc height=30><b><?=$row[r_nm]?> 이미지 보기</b></td>
		</tr>
		<tr>
			<?
			if($c_r < 16)
			{
			?>
			<td  style="padding:0 0 0 0px;border:1px solid #D4DBE1;" width="430" height="330" align="center" valign="top" bgcolor=white>
			  <div style='width:480px;position:relative;overflow:hidden;' align="center" id="loadarea"><img src="<?=$view_one?>" border="0"></div>
			</td>
			<td width="10"></td>
				
			
			<td style="padding:0 0 0 0px;border:1px solid #D4DBE1;" width="160" height="100%" align="center" valign="top"> 
			<?
			}
			else
			{
			?>
			<td  style="padding:0 0 0 0px;border:1px solid #D4DBE1;" width="100%" height="500" align="center" valign="top" bgcolor=white>
			  <div style='height:480px;position:relative;overflow:hidden;' align="center" id="loadarea"><img src="<?=$view_one?>" border="0"></div>
			</td>
		</tr>
		<tr><td height=10></td></tr>
		<tr>
			<td style="padding:0 0 0 0px;border:1px solid #D4DBE1;" width="600" height="100%" align="center" valign="top"> 
			<?
			}
			?>
				<!--작은사진목록-->	
				<table border="0" cellpadding="0" cellspacing="0" width="100%" valign='top'>
				<tr>
					<td style="border:solid 1px #D3D3D3; background-color:#E5E5E5;" height="330" valign='top'>
						<table border="1" cellpadding="0" cellspacing="0">
	
						<tr>
				
						 <?
						for ($i=0;$i<$c_r ; $i++) 
						{

							$row = sql_fetch_array($result);
							if($c_r <16)
							{
								if($i != 0 && $i % 2 == 0) echo "</tr><tr>";
							}
							else
							{
								if($i != 0 && $i % 7 == 0) echo "</tr><tr>";
							}

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
							$thumb = $thumb_path.'/'.$filename; //썸네일
						
							if (!file_exists($thumb)) { //view 용 이미지 생성

								$file = $data_path.'/'.$filename; //원본
								
								if (preg_match("/\.(jp[e]?g|gif|png)$/i", $file) && file_exists($file)) 
								{
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
							
							$view_w = 460; //썸네일 가로사이즈
							$view_h = 500; //썸네일 세로사이즈
						
							$thumb2 = $thumb_path2.'/'.$filename; //썸네일

							if (!file_exists($thumb2)) { //기본 썸네일 

								$file = $data_path.'/'.$filename; //원본
								if (preg_match("/\.(jp[e]?g|gif|png)$/i", $file) && file_exists($file)) {
									
									
									$width_d = 480; //사이즈를고정한다.
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
									imagepng($dst, $thumb_path2.'/'.$filename);
									//imagejpeg($dst,$thum,  $board[bo_3]);   // jpeg로 변경
									chmod($thumb_path2.'/'.$filename, 0606);
								}

							}
							
							if (file_exists($thumb) && $filename) 
							{
							?>
							  <td style="border:solid 1px #D0D0D0;height:60px;width:80px;">
									<a rel="enlargeimage::mouseover" rev="loadarea" href="<?=$thumb_path2?>/<?=$filename?>"><img src="<?=$thumb?>" style="border-width:0px;" width=80></a>
							  </td>
							<?
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
		  <script>

		  </script>
