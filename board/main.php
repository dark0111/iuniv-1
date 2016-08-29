<?
$gi_sql = " SELECT wr_id, wr_subject, wr_content, wr_datetime, wr_hit FROM `g4_write_gallery` WHERE wr_is_comment = '0'  order by wr_id desc LIMIT 0 , 5 ";
$ds_gi_list = sql_query($gi_sql);
		
  $gi_num = 1;
  $gi_arry = array();
  $gi_txt_arry = array();

  for ($k=0; $row = sql_fetch_array($ds_gi_list); $k++) {  
  $gi_txt_cnt = 0;
  /////////////////////////////////////////////////////////////////////////////
	$gi_txt_arry[$k][0]=$row[wr_subject];
	$gi_txt_arry[$k][1]=str_ireplace("<br>","",strip_tags($row[wr_content]));
	$gi_txt_arry[$k][2]=$row[wr_datetime];
	$gi_txt_arry[$k][3]=$row[wr_hit];
	$gi_txt_arry[$k][4]=strval($row[wr_id]);
	$gi_txt_cnt = $gi_txt_cnt+1;
  /////////////////////////////////////////////////////////////////////////////
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
	//content에 <img>테그 추출했을때 없을시 이미지디비를 검색
	if(count($buff)==0){
		$sql = " SELECT a.wr_id, a.wr_subject, a.wr_content, b.bf_source, b.bf_file
					FROM 
						`g4_write_gallery` a, 
						(
							SELECT 
								bo_table, wr_id, bf_source, bf_file
							FROM
								`g4_board_file` 
							WHERE 
								bo_table = 'gallery' AND
						bf_no = '0'
						)b
					WHERE 
						a.wr_id = b.wr_id and 
						a.wr_id='".$row[wr_id]."'
					order by a.wr_id desc limit 0, 1";
		$ds_list = sql_query($sql);
		
		for ($j=0; $row2 = sql_fetch_array($ds_list); $j++) { 
			//print_r($row2);
			$gia_cnt=count($gi_arry);
			$gi_arry[$gia_cnt] = $g4[path]."/data/file/gallery/".$row2[bf_file];
		}
	}
	//echo $sql;
	//echo count($gi_arry);
	//echo "<xmp>"; 
	//print_r($buff);
	//echo "</xmp>"; 
	//echo count($buff);						
}	//print_r($gi_txt_arry);
	//print_r($gi_arry);
?>
<script>
var tit_txt = new Array();
var con_txt = new Array();
<?
for($j=0;$j<count($gi_arry);$j++){
?>
tit_txt[<?=$j?>]="<?=cut_str($gi_txt_arry[$j][0],30,'..')?>";
con_txt[<?=$j?>]="<?=cut_str($gi_txt_arry[$j][1],190,'..')?>";
scroll_content[<?=$j?>]="<div style='padding:2 5 0 10px'><a href='<?=$g4['path']?>/bbs/board.php?bo_table=gallery&wr_id=<?=$gi_txt_arry[$j][4];?>'><img src='<?=$gi_arry[$j];?>' width='110' height='90' align='left' class='photo' onError=this.src='/images/blank.gif'></a><a href='<?=$g4['path']?>/bbs/board.php?bo_table=gallery&wr_id=<?=$gi_txt_arry[$j][4];?>' class=title><b>"+tit_txt[<?=$j?>]+"</b></div><div class=content>"+con_txt[<?=$j?>]+"</a></div>";
<?}?>
</script>
<!-- 메인테이블 -->
<table border="0" cellpadding="0" cellspacing="0" width="950">
<tr>
	<td valign="top">
		<!-- 메인비쥬얼플래시 적용 부분-->
		<script type="text/javascript">
			//FlashObject("./main/swf/mainvisual.swf", 580, 530, "#ffffff", "");
			FlashObject("./main/swf/mainvisual.swf", 580, 530, "#ffffff", "");
		</script>
		<!-- /메인비쥬얼플래시 적용 부분-->
	</td>
	<td width="370" valign="top">
		<!-- 테이블 -->
		<table border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td width="17"></td>
			<td width="351">
				<!-- 공지사항 -->
				<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td height="30"></td>
				</tr>
				<tr>
					<td >
						<!-- 타이틀 -->
						<table border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td width="274"><img src="./main/image/asa_tit.gif" border="0"></td>
							<td width="40"><a href='<?=$g4[bbs_path]?>/board.php?bo_table=notice'><img src="./main/image/more_btn.gif" border="0" alt="MORE"></a></td>
						</tr>				
						</table>
						<!-- /타이틀 -->
					</td>
				</tr>
				
				<tr>
					<td><?
					latest('basic', notice,5, 30,'none_title');
					?></td>
				</tr>
				</table>
				<!-- /공지사항 -->

				<!-- 공간 -->
				<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td height="10"></td></tr>
				</table>
				<!-- /공간 -->

				<!-- 맛집탐방 -->
				<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td colspan="4">
						<table border=0 cellpadding=0 cellspacing=0>
						<tr>
							<td><img src="./main/image/today_tit.gif" border="0"></td>
							<td width="180"></td>
							<td width="40" align=right><a href='<?=$g4[bbs_path]?>/board.php?bo_table=food_story'><img src="./main/image/more_btn.gif" border="0" alt="MORE"></a></td>
						</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="4"><img src="./main/image/t_edge01.gif" border="0"></td>
				</tr>
				<tr>
					<td width="3" bgcolor="#ececec"></td>
					<td width="14"></td>
					<td width="293">
						<!-- 이미지 -->
						<table border="0" cellpadding="0" cellspacing="0">
						
						<tr>
							<td width=293 >
								<?
								latest('flair_webzine2',food_story,1, 35,'none_title');
								?>
							</td>
						</tr>
						</table>
						<!-- /이미지 -->
					</td>
					<td width="3" bgcolor="#ececec"></td></tr>
				<tr>
					<td colspan="4"><img src="./main/image/t_edge02.gif" border="0"></td></tr>
				</table>
				<!-- /맛집탐방 -->
<br><br>
				<!-- 포토갤러리 -->
				<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td colspan="4">
						<table border=0 cellpadding=0 cellspacing=0 >
						<tr>
							<td width="260"><img src="./main/image/photo_tit.gif" border="0"></td>							
							<td width="40" align=right><a href='<?=$g4[bbs_path]?>/board.php?bo_table=gallery'><img src="./main/image/more_btn.gif" border="0" alt="MORE"></a></td>
						</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="4"><img src="./main/image/t_edge01.gif" border="0"></td>
				</tr>
				<tr>
					<td width="3" bgcolor="ececec"></td>
					<td width="14"></td>
					<td width="293">
						<!-- 이미지 -->
						<table border="0" cellpadding="0" cellspacing="0">						
						<tr>
							<td width="293" height="90">
								<div style='width:290px; height:100px; position:relative; left:-10px; top:0px; z-index:1; overflow:hidden;' onMouseover='bMouseOver=0' onMouseout='bMouseOver=1' id='scroll_image'><p><script>startscroll();</script></p></div>
							</td>
						</tr>
						</table>
						<!-- /이미지 -->
					</td>
					<td width="3" bgcolor="ececec"></td></tr>
				<tr>
					<td colspan="4"><img src="./main/image/t_edge02.gif" border="0"></td></tr>
				</table>
				<!-- /포토갤러리 -->

				<!-- 바로가기 -->
				<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td><a href="#"><img src="./main/image/banner01.gif" border="0" alt="홍보동영상"></a></td>
					<td><a href="#"><img src="./main/image/banner02.gif" border="0" alt="클럽인사말"></a></td>
					<td><a href="#"><img src="./main/image/banner03.gif" border="0" alt="자료실"></a></td></tr>
				</table>
				<!-- /바로가기 -->
			</td></tr>
		</table>
		<!-- /테이블 -->
	</td></tr>
</table>
<!-- /메인테이블 -->