<!-- 위치타이틀 -->
<table border="0" cellpadding="0" cellspacing="0" background="<?=$g4['path']?>/main/image/tit_bg.gif" style='background-repeat:repeat-x'>
	<tr>
		<td><img src="<?=$g4['path']?>/main/image/tit_edge01.gif" border="0"></td>
		<td><img src="<?=$g4['path']?>/main/qna/image/tit.gif" border="0"></td>
		<td width="486" align="right" style="color:#aaabab;line-height:px"><img src="<?=$g4['path']?>/main/image/tit_icon.gif" border="0" align="absmiddle">&nbsp;Home > <b>질문답변/정보등록</b></td>
		<td><img src="<?=$g4['path']?>/main/image/tit_edge02.gif" border="0"></td></tr>
</table>
<!-- /위치타이틀 -->

<!-- 타이틀이미지 -->
<table border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td height="157"><img src="<?=$g4['path']?>/main/qna/image/title.gif" border="0"></td></tr>
</table>
<!-- /타이틀이미지 -->

<!-- 문의게시판 최근글-->
<table border="0" cellpadding="5" cellspacing="0" width="680">
	<tr height="140">		
		<td width="680" valign="top" colspan="2">
			<? //문의사항 쿼리
			$sql = " SELECT `wr_id` , `wr_subject` , `wr_content` 
							FROM  g4_write_qna
							WHERE wr_comment = '0'
							ORDER BY wr_id DESC 
							LIMIT 0 , 5  ";
			$ds_list = sql_query($sql);
			?>
			<table width='680' cellspacing='0' cellpadding='0'>
				<tr valign='top'>
					<td height='17' class='tit01'><img src="<?=$g4[path]?>/main/qna/image/stit_qna.gif" border="0" align="absmiddle"></td>
					<td align='right'><a href='<?=$g4[path]?>/bbs/board.php?bo_table=qna'><img src='<?=$g4[path]?>/main/community/image/btn_more.gif' alt='더보기' width='37' height='10' style='margin:1px 5px 0 0'></a></td>
				</tr>
				<tr><td height='1' colspan='2' bgcolor='#8FD7EC'></td></tr>
				<tr>
					<td colspan=2><?
					latest('basic',qna,10,120,'none_title');
					?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr height="140">
		<td width="340" valign="top">
			<? //주거정보등록 쿼리
			
			?>
			<table width='100%' cellspacing='0' cellpadding='0' border=0>
				<tr valign='top'>
					<td height='17' class='tit01'><img src="<?=$g4[path]?>/main/qna/image/stit_reg_house.gif" border="0" align="absmiddle"></td>
					<td align='right'><a href='<?=$g4[path]?>/bbs/board.php?bo_table=reg_room&sca=%EC%A3%BC%EA%B1%B0%EC%A0%95%EB%B3%B4'><img src='<?=$g4[path]?>/main/community/image/btn_more.gif' alt='더보기' width='37' height='10' style='margin:1px 5px 0 0'></a></td>
				</tr>
				<tr><td height='1' colspan='2' bgcolor='#8FD7EC'></td></tr>
				<tr>
					<td colspan=2><?
					latest('basic','reg_room',10,40,'none_title');
					?></td>
				</tr>
			</table>
		</td>
		<td width="340" valign="top">
			
			<table width='100%' cellspacing='0' cellpadding='0'>
				<tr valign='top'>
					<td height='17' class='tit01'><img src="<?=$g4[path]?>/main/qna/image/stit_reg_res.gif" border="0" align="absmiddle"></td>
					<td align='right'><a href='<?=$g4[path]?>/bbs/board.php?bo_table=reg_restaurant'><img src='<?=$g4[path]?>/main/community/image/btn_more.gif' alt='더보기' width='37' height='10' style='margin:1px 5px 0 0'></a></td>
				</tr>
				<tr><td height='1' colspan='2' bgcolor='#8FD7EC'></td></tr>
				<tr>
					<td colspan=2><?
					latest('basic','reg_restaurant',10,40,'none_title');
					?></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<!-- /문의게시판 최근글 -->