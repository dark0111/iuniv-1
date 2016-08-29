<table width="100%"  border="0" cellspacing="0" cellpadding="0">
<tr>
	<td>
		<table width="100%"  border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td height="60" width="130" align="right">계룡산 촌놈의 가을</td>
			<td>&nbsp;</td>
			<td width="200">
				접속아이디 : <?=$_mb['mb_id']?><br />
				관리자레벨 : <?=$_level_info[$_mb['mb_level']]?>
			</td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td align="left" bgcolor="#3366AA">
		<table  border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td width="80" align="center"><a href="site_setup.php" class="menu">기본정보</a></td>
			<td width="5"><img src="images/m_top_bar.gif" width="5" height="40"></td>
			<td width="80" align="center"><a href="member_list.php" class="menu">회원관리</a></td>
			<td width="5"><img src="images/m_top_bar.gif" width="5" height="40"></td>
			<td width="80" align="center" ><a href="group_list.php" class="menu">그룹관리</a></td>
			<td width="5"><img src="images/m_top_bar.gif" width="5" height="40"></td>
			<td width="80" align="center" ><a href="bbs_list.php" class="menu">게시판관리</a></td>
			<td width="5"><img src="images/m_top_bar.gif" width="5" height="40"></td>
			<td width="80" align="center" ><a href="create_zip_tables.php" class="menu">기타관리</a></td>
			<td width="5"><img src="images/m_top_bar.gif" width="5" height="40"></td>
			<td width="150" align="center" ><a href="cate_list.php" class="menu">분류 및 상품 설정</a></td>
			<td width="5"><img src="images/m_top_bar.gif" width="5" height="40"></td>
			<td width="80" align="center" ><a href="order_list.php" class="menu">주문</a></td>
		</tr>
		</table>
	</td>
</tr>
</table>

<table width="100%" height="600"  border="0" cellpadding="0" cellspacing="0">
<tr>
	<td width="175" valign="top" bgcolor="#F5F5F5">

	<?
switch($MENU_L) 
{
	case 'm2' :
	?>
		<table width="175"  border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td height="10"></td>
		</tr>
		<tr>
			<td height="25" align="center">- 회원관리 -</td>
		</tr>
		<tr>
			<td>
				<table width="95%"  border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="5" height="1"></td>
					<td height="1" bgcolor="#C1C1C1"></td>
					<td width="5" height="1"></td>
				</tr>
				<tr>
					<td height="1" colspan="3"></td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td height="25"><img src="images/m_sub_icon01.gif" width="18" height="10" align="absmiddle"> <a href="member_list.php">회원목록</a></td>
		</tr>
		<tr>
			<td>
				<table width="95%"  border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="5" height="1"></td>
					<td height="1" bgcolor="#C1C1C1"></td>
					<td width="5" height="1"></td>
				</tr>
				<tr>
					<td height="1" colspan="3"></td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
	<?
	break;
	case 'm3' :
	?>
		<table width="175"  border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td height="10"></td>
		</tr>
		<tr>
			<td height="25" align="center">- 그룹관리 -</td>
		</tr>
		<tr>
			<td>
				<table width="95%"  border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="5" height="1"></td>
					<td height="1" bgcolor="#C1C1C1"></td>
					<td width="5" height="1"></td>
				</tr>
				<tr>
					<td height="1" colspan="3"></td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td height="25"><img src="images/m_sub_icon01.gif" width="18" height="10" align="absmiddle" /> <a href="group_list.php">그룹목록</a></td>
		</tr>
		<tr>
			<td>
				<table width="95%"  border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="5" height="1"></td>
					<td height="1" bgcolor="#C1C1C1"></td>
					<td width="5" height="1"></td>
				</tr>
				<tr>
					<td height="1" colspan="3"></td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td height="25"><img src="images/m_sub_icon01.gif" width="18" height="10" align="absmiddle" /> <a href="group_member_list.php">그룹회원목록</a></td>
		</tr>
		<tr>
			<td>
				<table width="95%"  border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="5" height="1"></td>
					<td height="1" bgcolor="#C1C1C1"></td>
					<td width="5" height="1"></td>
				</tr>
				<tr>
					<td height="1" colspan="3"></td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
	<?
	break;
	case 'm4' :
	?>
		<table width="175"  border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td height="10"></td>
		</tr>
		<tr>
			<td height="25" align="center">- 게시판관리 -</td>
		</tr>
		<tr>
			<td>
				<table width="95%"  border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="5" height="1"></td>
					<td height="1" bgcolor="#C1C1C1"></td>
					<td width="5" height="1"></td>
				</tr>
				<tr>
					<td height="1" colspan="3"></td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td height="25"><img src="images/m_sub_icon01.gif" width="18" height="10" align="absmiddle"> <a href="bbs_list.php">게시판관리</a><a href="jin_list.php"></a></td>
		</tr>
		<tr>
			<td>
				<table width="95%"  border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="5" height="1"></td>
					<td height="1" bgcolor="#C1C1C1"></td>
					<td width="5" height="1"></td>
				</tr>
				<tr>
					<td height="1" colspan="3"></td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
	<?
	break;
	case 'm5' :
	?>
		<table width="175"  border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td height="10"></td>
		</tr>
		<tr>
			<td height="25" align="center">- 기타관리 -</td>
		</tr>
		<tr>
			<td>
				<table width="95%"  border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="5" height="1"></td>
					<td height="1" bgcolor="#C1C1C1"></td>
					<td width="5" height="1"></td>
				</tr>
				<tr>
					<td height="1" colspan="3"></td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td height="25"><img src="images/m_sub_icon01.gif" width="18" height="10" align="absmiddle"> <a href="create_zip_tables.php">우편번호 테이블생성</a></td>
		</tr>
		<tr>
			<td>
				<table width="95%"  border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="5" height="1"></td>
					<td height="1" bgcolor="#C1C1C1"></td>
					<td width="5" height="1"></td>
				</tr>
				<tr>
					<td height="1" colspan="3"></td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td height="25"><img src="images/m_sub_icon01.gif" width="18" height="10" align="absmiddle"> <a href="<?=$_url['counter']?>" target="_blank">접속통계</a></td>
		</tr>
		<tr>
			<td>
				<table width="95%"  border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="5" height="1"></td>
					<td height="1" bgcolor="#C1C1C1"></td>
					<td width="5" height="1"></td>
				</tr>
				<tr>
					<td height="1" colspan="3"></td>
				</tr>
				</table>
			</td>
		</tr>


		<tr>
			<td height="25">&nbsp;</td>
		</tr>
		</table>
		<?
		break;
		case 'm8' :
		?>
		<table width="175"  border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td height="10"></td>
		</tr>
		<tr>
			<td height="25" align="center">- 방문자통계 -</td>
		</tr>
		<tr>
			<td>
				<table width="95%"  border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="5" height="1"></td>
					<td height="1" bgcolor="#C1C1C1"></td>
					<td width="5" height="1"></td>
				</tr>
				<tr>
					<td height="1" colspan="3"></td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td height="25"><img src="images/m_sub_icon01.gif" width="18" height="10" align="absmiddle"> <a href="vister.php?type=hour">시간대별</a></td>
		</tr>
		<tr>
			<td>
				<table width="95%"  border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="5" height="1"></td>
					<td height="1" bgcolor="#C1C1C1"></td>
					<td width="5" height="1"></td>
				</tr>
				<tr>
					<td height="1" colspan="3"></td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td height="25"><img src="images/m_sub_icon01.gif" width="18" height="10" align="absmiddle"> <a href="vister.php?type=day">일별</a></td>
		</tr>
		<tr>
			<td>
				<table width="95%"  border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="5" height="1"></td>
					<td height="1" bgcolor="#C1C1C1"></td>
					<td width="5" height="1"></td>
				</tr>
				<tr>
					<td height="1" colspan="3"></td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td height="25"><img src="images/m_sub_icon01.gif" width="18" height="10" align="absmiddle"> <a href="vister.php?type=week">요일별</a></td>
		</tr>
		<tr>
			<td>
				<table width="95%"  border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="5" height="1"></td>
					<td height="1" bgcolor="#C1C1C1"></td>
					<td width="5" height="1"></td>
				</tr>
				<tr>
					<td height="1" colspan="3"></td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td height="25"><img src="images/m_sub_icon01.gif" width="18" height="10" align="absmiddle"> <a href="vister.php?type=month">월별</a></td>
		</tr>
		<tr>
			<td>
				<table width="95%"  border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="5" height="1"></td>
					<td height="1" bgcolor="#C1C1C1"></td>
					<td width="5" height="1"></td>
				</tr>
				<tr>
					<td height="1" colspan="3"></td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td height="25"><img src="images/m_sub_icon01.gif" width="18" height="10" align="absmiddle"> <a href="vister.php?type=year">년도별</a></td>
		</tr>
		<tr>
			<td>
				<table width="95%"  border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="5" height="1"></td>
					<td height="1" bgcolor="#C1C1C1"></td>
					<td width="5" height="1"></td>
				</tr>
				<tr>
					<td height="1" colspan="3"></td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
		<?
	break;
	case 'm9' :
	?>
		<table width="175"  border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td height="10"></td>
		</tr>
		<tr>
			<td height="25" align="center">- 분류 및 상품 설정 -</td>
		</tr>
		<tr>
			<td>
				<table width="95%"  border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="5" height="1"></td>
					<td height="1" bgcolor="#C1C1C1"></td>
					<td width="5" height="1"></td>
				</tr>
				<tr>
					<td height="1" colspan="3"></td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td height="25"><img src="images/m_sub_icon01.gif" width="18" height="10" align="absmiddle"> <a href="javascript:CallMenu('1', '1', 'category')">카테고리</a></td>
		</tr>
		<tr>
			<td>
				<table width="95%"  border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="5" height="1"></td>
					<td height="1" bgcolor="#C1C1C1"></td>
					<td width="5" height="1"></td>
				</tr>
				<tr>
					<td height="1" colspan="3"></td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td height="25"><img src="images/m_sub_icon01.gif" width="18" height="10" align="absmiddle"> <a href="javascript:CallMenu('1', '2', 'product')">상품관리</a></td>
		</tr>
		<tr>
			<td>
				<table width="95%"  border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="5" height="1"></td>
					<td height="1" bgcolor="#C1C1C1"></td>
					<td width="5" height="1"></td>
				</tr>
				<tr>
					<td height="1" colspan="3"></td>
				</tr>
				</table>
			</td>
		</tr>


		<tr>
			<td height="25">&nbsp;</td>
		</tr>
		</table>
		<?
		break;
		case 'm10' :
	?>
		<table width="175"  border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td height="10"></td>
		</tr>
		<tr>
			<td height="25" align="center">- 주문 -</td>
		</tr>
		<tr>
			<td>
				<table width="95%"  border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="5" height="1"></td>
					<td height="1" bgcolor="#C1C1C1"></td>
					<td width="5" height="1"></td>
				</tr>
				<tr>
					<td height="1" colspan="3"></td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td height="25"><img src="images/m_sub_icon01.gif" width="18" height="10" align="absmiddle"> <a href="javascript:CallMenu('1', '1', 'category')">주문리스트</a></td>
		</tr>
		<tr>
			<td>
				<table width="95%"  border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="5" height="1"></td>
					<td height="1" bgcolor="#C1C1C1"></td>
					<td width="5" height="1"></td>
				</tr>
				<tr>
					<td height="1" colspan="3"></td>
				</tr>
				</table>
			</td>
		</tr>
		

		<tr>
			<td height="25">&nbsp;</td>
		</tr>
		</table>
		<?
		break;
		default :
		?>
		<table width="175"  border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td height="10"></td>
		</tr>
		<tr>
			<td height="25" align="center">- 기본정보 -</td>
		</tr>
		<tr>
			<td>
				<table width="95%"  border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="5" height="1"></td>
					<td height="1" bgcolor="#C1C1C1"></td>
					<td width="5" height="1"></td>
				</tr>
				<tr>
					<td height="1" colspan="3"></td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td height="25"><img src="images/m_sub_icon01.gif" width="18" height="10"> <a href="site_setup.php">환경설정</a></td>
		</tr>
		<tr>
			<td>
				<table width="95%"  border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="5" height="1"></td>
					<td height="1" bgcolor="#C1C1C1"></td>
					<td width="5" height="1"></td>
				</tr>
				<tr>
					<td height="1" colspan="3"></td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td height="25"><img src="images/m_sub_icon01.gif" width="18" height="10"> <a href="site_member_form.php">회원항목설정</a></td>
		</tr>
		<tr>
			<td>
				<table width="95%"  border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="5" height="1"></td>
					<td height="1" bgcolor="#C1C1C1"></td>
					<td width="5" height="1"></td>
				</tr>
				<tr>
					<td height="1" colspan="3"></td>
				</tr>
				</table>
			</td>
		</tr>
		<?php /*?>
		<tr>
			<td height="25"><img src="images/m_sub_icon01.gif" width="18" height="10"> <a href="site_setup_deny.php">제한설정</a></td>
		</tr>
		<tr>
			<td>
				<table width="95%"  border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="5" height="1"></td>
					<td height="1" bgcolor="#C1C1C1"></td>
					<td width="5" height="1"></td>
				</tr>
				<tr>
					<td height="1" colspan="3"></td>
				</tr>
				</table>
			</td>
		</tr>
		<?php */?>
		<tr>
			<td>&nbsp;</td>
		</tr>
		</table>

		<?
		break;
		}
		?>
	</td>
	<td valign="top" class="m1" style="padding:10px 10px 10px 10px ">
