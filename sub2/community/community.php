<!-- 위치타이틀 -->
<table border="0" cellpadding="0" cellspacing="0" background="<?=$IU['board']?>/main/image/tit_bg.gif" style='background-repeat:repeat-x'>
<tr>
	<td><img src="<?=$IU['board']?>/main/image/tit_edge01.gif" border="0"></td>
	<td><img src="<?=$IU['sub_url']?>/community/image/tit.gif" border="0"></td>
	<td width="486" align="right" style="color:#aaabab;line-height:px"><img src="<?=$IU['board']?>/main/image/tit_icon.gif" border="0" align="absmiddle">&nbsp;Home > <b>커뮤니티</b></td>
	<td><img src="<?=$IU['board']?>/main/image/tit_edge02.gif" border="0"></td></tr>
</table>
<!-- /위치타이틀 -->

<!-- 공간 -->
<table border="0" cellpadding="0" cellspacing="0">
<tr>
	<td height="14"></td></tr>
</table>
<!-- /공간 -->

<!-- 이미지 및 텍스트 -->
<table border="0" cellpadding="0" cellspacing="0">
<tr>
	<td valign="top"><img src="<?=$IU['sub_url']?>/community/image/tit_txt.gif" border="0"></td>
	<td><img src="<?=$IU['sub_url']?>/community/image/tit_img01.gif" border="0"></td></tr>
</table>
<!-- /이미지 및 텍스트 -->

<!-- 게시판 -->
<table border="0" cellpadding="0" cellspacing="0">

<tr>
	<td colspan='3'><!-- 서브메인시작 -->
		<table width='630' cellspacing='0' cellpadding='0' border=0>
			<tr valign='top'>
			<td width='2'></td>	
			<td width='345' style='padding-top:17px'>	
				<!-- 자유게시판 -->
				<?
				$sql = " SELECT `wr_id` , `wr_subject` , `wr_content` 
								FROM `g4_write_board1` 
								WHERE wr_is_comment = '0'
								ORDER BY wr_id DESC 
								LIMIT 0 , 7  ";
				$ds_list = sql_query($sql);
				?>
				<table width='400' cellspacing='0' cellpadding='0'>
				<tr valign='top'>
				<td height='17' class='tit01'><img src="<?=$IU['sub_url']?>/community/image/stit_freeboard.gif" border="0" align="absmiddle"></td>
				<td align='right'><a href='./bbs/board.php?bo_table=board1'><img src='<?=$IU['sub_url']?>/community/image/btn_more.gif' alt='더보기' width='37' height='10' style='margin:1px 5px 0 0'></a></td>
				</tr>
				<tr><td height='1' colspan='2' bgcolor='#8FD7EC'></td></tr>
				</table>
				
				<table width='400' cellspacing='0' cellpadding='0'>
				<tr><td height='10'></td></tr>
				<?for ($i=0; $row = sql_fetch_array($ds_list); $i++) {  ?>
					<tr><td height='20'><img src='<?=$g4[path]?>/main/image/dot.gif' alt='' style='margin:0 4px 4px 6px'><a href="<?=$IU[board]?>/bbs/board.php?bo_table=board1&wr_id=<?=$row[wr_id]?>" title="<?=$row[wr_subject]?> "><?=cut_str($row[wr_subject],100,'..')?></a></td></tr>	
				<?}?>
				<tr><td height='24'></td></tr>
				</table>
				<!-- //자유게시판 -->

				<!-- 공지사항 -->
				<?
				$sql = " SELECT `wr_id`,`wr_subject`,`wr_content` FROM `g4_write_notice` WHERE wr_comment = '0' order by wr_id desc limit 0, 7 ";
				$ds_list = sql_query($sql);
				?>
				<table width='400' cellspacing='0' cellpadding='0'>
				<tr valign='top'>
				<td height='17' class='tit01'><img src="<?=$IU['sub_url']?>/community/image/stit_notice.gif" border="0" align="absmiddle"></td>
				<td align='right'><a href='<?=$IU[board]?>/bbs/board.php?bo_table=notice'><img src='<?=$IU['sub_url']?>/community/image/btn_more.gif' alt='더보기' width='37' height='10' style='margin:1px 5px 0 0'></a></td>
				</tr>
				<tr><td height='1' colspan='2' bgcolor='#8FD7EC'></td></tr>
				</table>
				
				<table width='400' cellspacing='0' cellpadding='0'>
				<tr><td height='10'></td></tr>
				<?for ($i=0; $row = sql_fetch_array($ds_list); $i++) {  ?>
					<tr><td height='20'><img src='<?=$g4[path]?>/main/image/dot.gif' alt='' style='margin:0 4px 4px 6px'><a href="<?=$IU[board]?>/bbs/board.php?bo_table=notice&wr_id=<?=$row[wr_id]?>" title="<?=$row[wr_subject]?> "><?=cut_str($row[wr_subject],100,'..')?></a></td></tr>
				<?}?>
				<tr><td height='24'></td></tr>
				</table>
				<!-- //공지사항 -->
				
				<!-- 홍보게시판 -->
				<?
				$sql = " SELECT `wr_id`,`wr_subject`,`wr_content` FROM `g4_write_add` WHERE wr_comment = '0' order by wr_id desc limit 0, 5 ";
				$ds_list = sql_query($sql);
				?>
				<table width='400' cellspacing='0' cellpadding='0'>
				<tr valign='top'>
				<td height='17' class='tit01'><img src="<?=$IU['sub_url']?>/community/image/stit_ad.gif" border="0" align="absmiddle"></td>
				<td align='right'><a href='<?=$IU[board]?>/bbs/board.php?bo_table=add'><img src='<?=$IU['sub_url']?>/community/image/btn_more.gif' alt='더보기' width='37' height='10' style='margin:1px 5px 0 0'></a></td>
				</tr>
				<tr><td height='1' colspan='2' bgcolor='#8FD7EC'></td></tr>
				</table>
				
				<table width='400' cellspacing='0' cellpadding='0'>
				<tr><td height='10'></td></tr>

				<?for ($i=0; $row = sql_fetch_array($ds_list); $i++) {  ?>
					<tr><td height='20'><img src='<?=$g4[path]?>/main/image/dot.gif' alt='' style='margin:0 4px 4px 6px'><a href="<?=$IU[board]?>/bbs/board.php?bo_table=add&wr_id=<?=$row[wr_id]?>" title="<?=$row[wr_subject]?> "><?=cut_str($row[wr_subject],100,'..')?></a></td></tr>
				<?}?>
		
				<tr><td height='24'></td></tr>
				</table>
				<!-- //홍보게시판 -->						
			</td>
			<td width='198' align='center' bgcolor='#F3F2EE' style='padding:16px 0 20px 0'>

				<!-- 중고장터 -->
				<?
				$sql = " SELECT a.wr_id, a.wr_subject, a.wr_content, a.wr_6, b.bf_source, b.bf_file
							FROM `g4_write_market` a, (
							SELECT bo_table, wr_id, bf_source, bf_file
							FROM `g4_board_file` 
							WHERE bo_table = 'market'
							AND bf_no = '0'
							LIMIT 0 , 30
							)b
							WHERE a.wr_id = b.wr_id
							order by a.wr_id desc limit 0, 3";
				$ds_list = sql_query($sql);
				?>
				<table width='188' cellspacing='0' cellpadding='0'>
				<tr valing='top'><td height='18' class='brn02 b2 dm'><img src="<?=$IU['sub_url']?>/community/image/stit_market.gif" border="0" align="absmiddle"></td><td align='right'><a href='<?=$IU[board]?>/bbs/board.php?bo_table=market'><img src='<?=$IU['sub_url']?>/community/image/btn_more.gif' alt='더보기' width='37' height='10' style='margin:1px 5px 0 0'></a></td></tr>
				</table>
				
				<table border='0' width='184' cellspacing='0' cellpadding='0' bgcolor='#FFFFFF' style='border:1px solid #DFDED9'>
				<?for ($i=0; $row = sql_fetch_array($ds_list); $i++) { 
					$wr_6_arry = explode("|",$row[wr_6]);
				?>
				<tr>
				<td align='center' style='padding:10px 0 9px 0'>
					<table width='175' cellspacing='0' cellpadding='0'>
					<tr><td align='center'><a href="<?=$IU[board]?>/bbs/board.php?bo_table=market&wr_id=<?=$row[wr_id]?>"><img src='<?=$g4[path]?>/data/file/market/<?=$row[bf_file]?>' width='80' height='88' alt=''></a></td>
						<td align="center"><a href="<?=$IU[board]?>/bbs/board.php?bo_table=market&wr_id=<?=$row[wr_id]?>"><font color='orange'><b><?=$wr_6_arry[7]?><br><?=$wr_6_arry[8]?>원</b></font><br>수량:<?=$wr_6_arry[3]?>개</a></td>
					</tr>
					<tr><td height='8' colspan='2'></td></tr>
					<tr><td class='ln13' align='center' colspan='2'><a href="<?=$IU[board]?>/bbs/board.php?bo_table=market&wr_id=<?=$row[wr_id]?>"><?=cut_str($row[wr_subject],48,'..')?></a></td></tr>
					</table>
				</td>
				</tr>
				<?}?>
				</table>				
				<!-- /중고장터 -->

<!--				<table width='178' cellspacing='0' cellpadding='0'><tr><td height='8'></td></tr></table>-->
							
				<!-- 추천 금융 도서 -->
<!--				<table width='184' cellspacing='0' cellpadding='0' bgcolor='#FFFFFF' style='border:1px solid #DFDED9'>
				<tr>
				<td align='center' style='padding:5px 0 12px 0'>
					<table width='172' cellspacing='0' cellpadding='0'>
					<tr><td height='23' bgcolor='#F1F1EF' class='brn02 b2 dm' style='padding:3px 0 0 7px'>추천 금융 도서</td></tr>
					<tr><td height='12'></td></tr>
					</table>
				
					<table width='166' cellspacing='0' cellpadding='0'>
					<tr valign='top'>
					<td width='44'><a href='http://book.naver.com/bookdb/book_detail.php?bid=6048370'><img src='http://bookimg.naver.com/coverimg/kyobo/images/book/large/153/l9788959891153.jpg' width='34' height='50' alt='' style='margin-left:2px'></a></td>
					<td width='122' class='ln13 pd_t01'><a href='http://book.naver.com/bookdb/book_detail.php?bid=6048370'>펀드의 재구성 다시 시작하는 투자자들을 ...</a></td>
					</tr>
					</table>
				</td>
				</tr>
				</table>  -->
				<!--// 추천 금융 도서 -->
			</td>
			</tr>
		</table><!--// 서브메인내용 -->
	</td>
</tr>
<tr>
	<td colspan="3" width="630">
		<!-- 이미지겔러리 -->
		<table border="0" cellpadding="0" cellspacing="0" width="630" cellpadding=5 cellspacing=5>
		<tr height='15'><td width='110'>&nbsp;</td><td width='280'>&nbsp;</td><td width='120'>&nbsp;</td><td width='40'>&nbsp;</td></tr>
		<tr valign='top'>
				<td height='17' class='tit01' colspan='3'><img src="<?=$IU['sub_url']?>/community/image/stit_img.gif" border="0" align="absmiddle"></td>
				<td align='right' valign='middle'><a href="<?=$IU['board']?>/bbs/board.php?bo_table=gallery"><img src='<?=$IU['sub_url']?>/community/image/btn_more.gif' alt='더보기'  style='margin:1px 5px 0 0'></a></td>
		</tr>
		<tr><td height='1' bgcolor='#8FD7EC' colspan='4'></td></tr>
<?
$gi_sql = " SELECT wr_id, wr_subject, wr_content, wr_datetime, wr_hit FROM `g4_write_gallery` order by wr_id desc LIMIT 0 , 5 ";
$ds_gi_list = sql_query($gi_sql);
		
  $gi_num = 1;
  $gi_arry = array();
  $gi_txt_arry = array();

  for ($k=0; $row = sql_fetch_array($ds_gi_list); $k++) {  
  $gi_txt_cnt = 0;
  /////////////////////////////////////////////////////////////////////////////
	$gi_txt_arry[$k][0]=$row[wr_subject];
	$gi_txt_arry[$k][1]=strip_tags($row[wr_content]);
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
					FROM `g4_write_gallery` a, (
					SELECT bo_table, wr_id, bf_source, bf_file
					FROM `g4_board_file` 
					WHERE bo_table = 'gallery'
					AND bf_no = '0'
					)b
					WHERE a.wr_id = b.wr_id
					and a.wr_id='".$row[wr_id]."'
					order by a.wr_id desc limit 0, 1";
		$ds_list = sql_query($sql);
		
		for ($j=0; $row2 = sql_fetch_array($ds_list); $j++) { 
			//print_r($row2);
			$gia_cnt=count($gi_arry);
			$gi_arry[$gia_cnt] = $g4[path]."/data/file/gallery/".$row2[bf_file];
		}
	}
	//echo count($gi_arry);
	//echo "<xmp>"; 
	//print_r($buff);
	//echo "</xmp>"; 
	//echo count($buff);						
}		//print_r($gi_txt_arry);
		//print_r($gi_arry);
		
		for($j=0;$j<count($gi_arry);$j++){
		?>
		<tr onclick="location.href='<?=$IU['board']?>/bbs/board.php?bo_table=gallery&wr_id=<?=$gi_txt_arry[$j][4];?>'" style="cursor:pointer;">
			<td height="91" align="center"><img src="<?=$gi_arry[$j];?>"  width=100 height=80 border="0"></td>
			<td style="color:#b1b3b4"><font style="color:#47c799"><b><?=cut_str($gi_txt_arry[$j][0],100,'..')?></b></font><br><?=cut_str($gi_txt_arry[$j][1],280,'..')?></td>
			<td align="center" style="color:#b1b3b4" width='120'><?=cut_str($gi_txt_arry[$j][2],10,'')?></td>
			<td align="center" style="color:#b1b3b4"><b><?=$gi_txt_arry[$j][3]?></b></td></tr>
		<tr>
			<td colspan="4"><img src="<?=$IU['sub_url']?>/community/image/dot_line.gif" border="0"></td></tr>
	<?}?>
		</table>
		<!-- /이미지겔러리 -->
	</td></tr>
</table>
<!-- /게시판 -->
<Br><br>