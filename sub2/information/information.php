<!-- 위치타이틀 -->
<table border="0" cellpadding="0" cellspacing="0" background="<?=$g4['path']?>/main/image/tit_bg.gif" style='background-repeat:repeat-x'>
<tr>
	<td><img src="<?=$g4['path']?>/main/image/tit_edge01.gif" border="0"></td>
	<td><img src="<?=$g4['path']?>/main/information/image/tit.gif" border="0"></td>
	<td width="486" align="right" style="color:#aaabab;line-height:px"><img src="<?=$g4['path']?>/main/image/tit_icon.gif" border="0" align="absmiddle">&nbsp;Home > <b>정보마당</b></td>
	<td><img src="<?=$g4['path']?>/main/image/tit_edge02.gif" border="0"></td></tr>
</table>
<!-- /위치타이틀 -->

<!-- 공간 -->
<table border="0" cellpadding="0" cellspacing="0">
<tr>
	<td height="15"></td></tr>
</table>
<!-- /공간 -->

<!-- 타이틀이미지 -->
<table border="0" cellpadding="0" cellspacing="0">
<tr>
	<td><img src="<?=$g4['path']?>/main/information/image/title.gif" border="0"></td></tr>
</table>
<!-- /타이틀이미지 -->
<!-- 게시판 최근목록 -->
<table border="0" cellpadding="5" cellspacing="0" width="680">
	<tr height="140">
		<td width="340" valign="top">
			<? //생활정보 쿼리
			$sql = " SELECT `wr_id` , `wr_subject` , `wr_content` 
							FROM  g4_write_life  
							WHERE wr_comment = '0'
							ORDER BY wr_id DESC 
							LIMIT 0 , 5  ";
			$ds_list = sql_query($sql);
			?>
			<table width='100%' cellspacing='0' cellpadding='0'>
				<tr valign='top'>
					<td height='17' class='tit01'><img src="<?=$g4[path]?>/main/information/image/stit_lifeinfo.gif" border="0" align="absmiddle"></td>
					<td align='right'><a href='<?=$g4[path]?>/bbs/board.php?bo_table=life'><img src='<?=$g4[path]?>/main/community/image/btn_more.gif' alt='더보기' width='37' height='10' style='margin:1px 5px 0 0'></a></td>
				</tr>
				<tr><td height='1' colspan='2' bgcolor='#8FD7EC'></td></tr>
				<?for ($i=0; $row = sql_fetch_array($ds_list); $i++) {  ?>
				<tr><td height='20' colspan="2"><img src='<?=$g4[path]?>/main/image/dot.gif' alt='' style='margin:0 4px 4px 6px'><a href="<?=$g4[path]?>/bbs/board.php?bo_table=life&wr_id=<?=$row[wr_id]?>" title="<?=$row[wr_subject]?> "><?=cut_str($row[wr_subject],77,'..')?></a></td></tr>
				<?}?>
			</table>
		</td>
		<td width="340" valign="top">
			<? //강의정보 쿼리
			$sql = " SELECT `wr_id` , `wr_subject` , `wr_content` 
							FROM  g4_write_class  
							WHERE wr_comment = '0'
							ORDER BY wr_id DESC 
							LIMIT 0 , 5  ";
			$ds_list = sql_query($sql);
			?>
			<table width='100%' cellspacing='0' cellpadding='0'>
				<tr valign='top'>
				<td height='17' class='tit01'><img src="<?=$g4[path]?>/main/information/image/stit_lecture_info.gif" border="0" align="absmiddle"></td>
				<td align='right'><a href='<?=$g4[path]?>/bbs/board.php?bo_table=class'><img src='<?=$g4[path]?>/main/community/image/btn_more.gif' alt='더보기' width='37' height='10' style='margin:1px 5px 0 0'></a></td>
				</tr>
				<tr><td height='1' colspan='2' bgcolor='#8FD7EC'></td></tr>
				<?for ($i=0; $row = sql_fetch_array($ds_list); $i++) {  ?>
				<tr><td height='20' colspan="2"><img src='<?=$g4[path]?>/main/image/dot.gif' alt='' style='margin:0 4px 4px 6px'><a href="<?=$g4[path]?>/bbs/board.php?bo_table=class&wr_id=<?=$row[wr_id]?>" title="<?=$row[wr_subject]?> "><?=cut_str($row[wr_subject],77,'..')?></a></td></tr>
				<?}?>
			</table>
		</td>
	</tr>
	<tr height="140">
		<td valign="top">
			<? //강의자료 쿼리
			$sql = " SELECT `wr_id` , `wr_subject` , `wr_content` 
							FROM  g4_write_class_data  
							WHERE wr_comment = '0'
							ORDER BY wr_id DESC 
							LIMIT 0 , 5  ";
			$ds_list = sql_query($sql);
			?>
			<table width='100%' cellspacing='0' cellpadding='0'>
				<tr valign='top'>
				<td height='17' class='tit01'><img src="<?=$g4[path]?>/main/information/image/stit_lecture_pds.gif" border="0" align="absmiddle"></td>
				<td align='right'><a href='<?=$g4[path]?>/bbs/board.php?bo_table=class_data'><img src='<?=$g4[path]?>/main/community/image/btn_more.gif' alt='더보기' width='37' height='10' style='margin:1px 5px 0 0'></a></td>
				</tr>
				<tr><td height='1' colspan='2' bgcolor='#8FD7EC'></td></tr>
				<?for ($i=0; $row = sql_fetch_array($ds_list); $i++) {  ?>
				<tr><td height='20' colspan="2"><img src='<?=$g4[path]?>/main/image/dot.gif' alt='' style='margin:0 4px 4px 6px'><a href="<?=$g4[path]?>/bbs/board.php?bo_table=class_data&wr_id=<?=$row[wr_id]?>" title="<?=$row[wr_subject]?> "><?=cut_str($row[wr_subject],73,'..')?></a></td></tr>
				<?}?>
			</table>
		</td>
		<td valign="top">
			<? //학사일정 쿼리
			$date=date("Ymd");
			//echo $date;
			$sql = " SELECT wr_id, wr_subject, wr_content, wr_link1, wr_link2
							FROM  g4_write_schedule  
							WHERE wr_comment = '0'
							AND wr_link1 > ".$date."
							ORDER BY wr_link1 asc 
							LIMIT 0 , 5  ";
			$ds_list = sql_query($sql);
			?>
			<table width='100%' cellspacing='0' cellpadding='0'>
				<tr valign='top'>
				<td height='17' class='tit01' width="70%"><img src="<?=$g4[path]?>/main/information/image/stit_sch_sc.gif" border="0" align="absmiddle"></td>
				<td align='right'  width="30%"><a href='<?=$g4[path]?>/bbs/board.php?bo_table=schedule'><img src='<?=$g4[path]?>/main/community/image/btn_more.gif' alt='더보기' width='37' height='10' style='margin:1px 5px 0 0'></a></td>
				</tr>
				<tr><td height='1' colspan='2' bgcolor='#8FD7EC'></td></tr>
				<?for ($i=0; $row = sql_fetch_array($ds_list); $i++) {  ?>
				<tr><td height='20'><img src='<?=$g4[path]?>/main/image/dot.gif' alt='' style='margin:0 4px 4px 6px'><a href="<?=$g4[path]?>/bbs/board.php?bo_table=schedule&wr_id=<?=$row[wr_id]?>" title="<?=$row[wr_subject]?> "><?=cut_str($row[wr_subject],77,'..')?></a></td>
				<td align="right"><?echo "[".substr($row[wr_link1],2,2).".".substr($row[wr_link1],4,2).".".substr($row[wr_link1],6,2)."~".substr($row[wr_link2],2,2).".".substr($row[wr_link2],4,2).".".substr($row[wr_link2],6,2)."]";?></td>
				</tr>
				<?}?>
			</table>
		</td>
	</tr>
	<tr height="140">
		<td valign="top">
			<? //스터디그룹 쿼리
			$sql = " SELECT `wr_id` , `wr_subject` , `wr_content` 
							FROM  g4_write_study  
							WHERE wr_comment = '0'
							ORDER BY wr_id DESC 
							LIMIT 0 , 5  ";
			$ds_list = sql_query($sql);
			?>
			<table width='100%' cellspacing='0' cellpadding='0'>
				<tr valign='top'>
				<td height='17' class='tit01'><img src="<?=$g4[path]?>/main/information/image/stit_study_group.gif" border="0" align="absmiddle"></td>
				<td align='right'><a href='<?=$g4[path]?>/bbs/board.php?bo_table=study'><img src='<?=$g4[path]?>/main/community/image/btn_more.gif' alt='더보기' width='37' height='10' style='margin:1px 5px 0 0'></a></td>
				</tr>
				<tr><td height='1' colspan='2' bgcolor='#8FD7EC'></td></tr>
				<?for ($i=0; $row = sql_fetch_array($ds_list); $i++) {  ?>
				<tr><td height='20' colspan="2"><img src='<?=$g4[path]?>/main/image/dot.gif' alt='' style='margin:0 4px 4px 6px'><a href="<?=$g4[path]?>/bbs/board.php?bo_table=study&wr_id=<?=$row[wr_id]?>" title="<?=$row[wr_subject]?> "><?=cut_str($row[wr_subject],77,'..')?></a></td></tr>
				<?}?>
			</table>
		</td>
		<td valign="top">
			<? //알바정보 쿼리
			$sql = " SELECT `wr_id` , `wr_subject` , `wr_content` 
							FROM  g4_write_alba  
							WHERE wr_comment = '0'
							ORDER BY wr_id DESC 
							LIMIT 0 , 5  ";
			$ds_list = sql_query($sql);
			?>
			<table width='100%' cellspacing='0' cellpadding='0'>
				<tr valign='top'>
				<td height='17' class='tit01'><img src="<?=$g4[path]?>/main/information/image/stit_alba_info.gif" border="0" align="absmiddle"></td>
				<td align='right'><a href='<?=$g4[path]?>/bbs/board.php?bo_table=alba'><img src='<?=$g4[path]?>/main/community/image/btn_more.gif' alt='더보기' width='37' height='10' style='margin:1px 5px 0 0'></a></td>
				</tr>
				<tr><td height='1' colspan='2' bgcolor='#8FD7EC'></td></tr>
				<?for ($i=0; $row = sql_fetch_array($ds_list); $i++) {  ?>
				<tr><td height='20' colspan="2"><img src='<?=$g4[path]?>/main/image/dot.gif' alt='' style='margin:0 4px 4px 6px'><a href="<?=$g4[path]?>/bbs/board.php?bo_table=alba&wr_id=<?=$row[wr_id]?>" title="<?=$row[wr_subject]?> "><?=cut_str($row[wr_subject],77,'..')?></a></td></tr>
				<?}?>
			</table>
		</td>
	</tr>
</table>
<!-- /게시판 최근목록 -->
<br><br>