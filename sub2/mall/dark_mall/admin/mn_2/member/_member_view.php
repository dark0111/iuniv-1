<?
session_start();
include "../../../include/dbcon.php";
IF($HTTP_SESSION_VARS[OLD_NO] AND $HTTP_SESSION_VARS[OLD_ID] AND $HTTP_SESSION_VARS[OLD_NAME]) {

$memberLoadQuery = "select * from $memberSQL where no='$no'";
$memberLoadSQL = mysql_query($memberLoadQuery, $connection) or die("memberLoadQuery error");
$memberLoadFetch = mysql_fetch_array($memberLoadSQL);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>

	<title>회원(고객)관리</title>
	<link rel="STYLESHEET" type="text/css" href="../../../style/style.css">
	<script language="javascript">
	function list() {
		location.href="_list.php?page=<?=$page?>&limit=<?=$limit?>&q=<?=$q?>";
	}
	
	function memberModify() {
		location.href="_member_modify.php?no=<?=$no?>&page=<?=$page?>&limit=<?=$limit?>&q=<?=$q?>";
	}
	
	function memberDrop() {
		if(confirm("본 회원(고객)의 정보를 삭제하시겠습니까?       ")) {
			location.href="_result.php?result=drop&no=<?=$no?>&page=<?=$page?>&limit=<?=$limit?>&q=<?=$q?>";
		} else {
		
		}
	}
	
	</script>
</head>

<body>

<table border=0 cellpadding=0 cellspacing=0 width=790>
<tr>
<td>

	<table border=0 cellpadding=0 cellspacing=0 bgcolor="#ffffff">
	<!-- HR -->
	<tr><td height=25>

		<table border=0 cellpadding=0 cellspacing=0 width=790 height=37>
		<tr>
		<td align=center background="../../image/more/title_main.gif">
			<table border=0 cellpadding=0 cellspacing=0>
			<tr><td height=15></td></tr>
			<tr height=22>
			<td width=40></td>
			<td width=750 class="hr_text">로그인 정보 입력</td>
			</tr>
			</table>
		</td>
		</tr>
		<tr><td height=20></td></tr>
		</table>

	</td></tr>
	<!-- HR -->

	<!-- 아이디 -->
	<tr height=24>
	<td background="../../image/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">아이디</td></tr>
		</table>
	</td>
	</tr>

	<tr><td height=5 bgcolor="#ffffff">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730 class="bold_s_name">
			<?=$memberLoadFetch[id]?>
		</td><td width=20>
		</td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>

	</td></tr>
	<!-- 아이디 -->
	
	
	<!-- 비밀번호 -->
	<tr height=24>
	<td background="../../image/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">비밀번호</td></tr>
		</table>
	</td>
	</tr>

	<tr><td height=5 bgcolor="#ffffff">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730 class="bold_s_name">
		<?=$memberLoadFetch[pw]?>
		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>

	</td></tr>
	

	<!-- HR -->
	<tr><td height=25>

		<table border=0 cellpadding=0 cellspacing=0 width=790 height=37>
		<tr>
		<td align=center background="../../image/more/title_main.gif">
			<table border=0 cellpadding=0 cellspacing=0>
			<tr><td height=15></td></tr>
			<tr height=22>
			<td width=40></td>
			<td width=750 class="hr_text">기본 정보 입력</td>
			</tr>
			</table>
		</td>
		</tr>
		<tr><td height=20></td></tr>
		</table>

	</td></tr>
	<!-- HR -->

	<!-- 이름 -->
	<tr height=24>
	<td background="../../image/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">이름</td></tr>
		</table>
	</td>
	</tr>

	<tr><td height=5 bgcolor="#ffffff">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730 class="bold_s_name">
		<?=$memberLoadFetch[name]?>
		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>

	</td></tr>
	<!-- 이름 -->
	
	<!-- 주민등록번호 -->
	<tr height=24>
	<td background="../../image/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">주민등록번호</td></tr>
		</table>
	</td>
	</tr>

	<tr><td height=5 bgcolor="#ffffff">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730 class="bold_s_name">
		<?=substr($memberLoadFetch[jumin],0,6)?> - *******
		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>

	</td></tr>
	<!-- 주민등록번호 -->		

	<!-- HR -->
	<tr><td height=25>

		<table border=0 cellpadding=0 cellspacing=0 width=790 height=37>
		<tr>
		<td align=center background="../../image/more/title_main.gif">
			<table border=0 cellpadding=0 cellspacing=0>
			<tr><td height=15></td></tr>
			<tr height=22>
			<td width=40></td>
			<td width=750 class="hr_text">상세 정보 입력</td>
			</tr>
			</table>
		</td>
		</tr>
		<tr><td height=20></td></tr>
		</table>

	</td></tr>
	<!-- HR -->
	
	
	<!-- 주소 -->
	<tr height=24>
	<td background="../../image/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">주소</td></tr>
		</table>
	</td>
	</tr>

	<tr><td height=5 bgcolor="#ffffff">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730 class="bold_s_name">
			<?=$memberLoadFetch[add_1]?>
			<?=$memberLoadFetch[add_2]?>

		
		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>

	</td></tr>
	<!-- 주소 -->		
	
	
	<!-- 우편번호 -->
	<tr height=24>
	<td background="../../image/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">우편번호</td></tr>
		</table>
	</td>
	</tr>

	<tr><td height=5 bgcolor="#ffffff">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730 class="bold_s_name">
		<?=$memberLoadFetch[zip_1]?>-<?=$memberLoadFetch[zip_2]?>
		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>

	</td></tr>
	<!-- 우편번호 -->		


	<!-- HR -->
	<tr><td height=25>

		<table border=0 cellpadding=0 cellspacing=0 width=790 height=37>
		<tr>
		<td align=center background="../../image/more/title_main.gif">
			<table border=0 cellpadding=0 cellspacing=0>
			<tr><td height=15></td></tr>
			<tr height=22>
			<td width=40></td>
			<td width=750 class="hr_text">연락처 입력</td>
			</tr>
			</table>
		</td>
		</tr>
		<tr><td height=20></td></tr>
		</table>

	</td></tr>
	<!-- HR -->
	
	
	<!-- 이메일 -->
	<tr height=24>
	<td background="../../image/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">이메일</td></tr>
		</table>
	</td>
	</tr>

	<tr><td height=5 bgcolor="#ffffff">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730 class="bold_s_name">
		<?=$memberLoadFetch[email]?>
		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>

	</td></tr>
	<!-- 이메일 -->		
	
	<!-- 전화번호 -->
	<tr height=24>
	<td background="../../image/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">전화번호</td></tr>
		</table>
	</td>
	</tr>

	<tr><td height=5 bgcolor="#ffffff">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730 class="bold_s_name">
		<?=$memberLoadFetch[tel]?>
		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>

	</td></tr>
	<!-- 전화번호 -->		
	
	<!-- 팩스번호 -->
	<tr height=24>
	<td background="../../image/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">팩스번호</td></tr>
		</table>
	</td>
	</tr>

	<tr><td height=5 bgcolor="#ffffff">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730 class="bold_s_name">
		<?=$memberLoadFetch[fax]?>
		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>

	</td></tr>
	<!-- 팩스번호 -->		

	
	<!-- 휴대폰 -->
	<tr height=24>
	<td background="../../image/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">휴대폰</td></tr>
		</table>
	</td>
	</tr>

	<tr><td height=5 bgcolor="#ffffff">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730 class="bold_s_name">
		<?="0".$memberLoadFetch[hp]?>
		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>

	</td></tr>
	<!-- 휴대폰 -->		
	

	<!-- HR -->
	<tr><td height=25>

		<table border=0 cellpadding=0 cellspacing=0 width=790 height=37>
		<tr>
		<td align=center background="../../image/more/title_main.gif">
			<table border=0 cellpadding=0 cellspacing=0>
			<tr><td height=15></td></tr>
			<tr height=22>
			<td width=40></td>
			<td width=750 class="hr_text">비밀번호 분실 관련 정보 입력</td>
			</tr>
			</table>
		</td>
		</tr>
		<tr><td height=20></td></tr>
		</table>

	</td></tr>
	<!-- HR -->
	
	
	<!-- 비밀번호 분실시 질문 -->
	<tr height=24>
	<td background="../../image/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">비밀번호 분실시 질문</td></tr>
		</table>
	</td>
	</tr>

	<tr><td height=5 bgcolor="#ffffff">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730 class="bold_s_name">
		<?=$memberLoadFetch[pw_q]?>
		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>

	</td></tr>
	<!-- 비밀번호 분실시 질문 -->		

	<!-- 질문의 답 -->
	<tr height=24>
	<td background="../../image/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">질문의 답</td></tr>
		</table>
	</td>
	</tr>

	<tr><td height=5 bgcolor="#ffffff">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730 class="bold_s_name">
		<?=$memberLoadFetch[pw_a]?>
		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>

	</td></tr>
	<!-- 비밀번호 분실시 질문 -->		

	<!-- HR -->
	<tr><td height=25>
	<hr size=1 color="#666666">
	</td></tr>
	<!-- HR -->
	
	<tr><td align=center>
		<table border=0 cellpadding=0 cellspacing=0 align=center>
		<tr><td colspan=3 height=10></td></tr>
		<tr>
		<td><a href="javascript:memberModify()"><img src="../../image/more/member_modify.gif" width="96" height="21" border="0"></a></td>
		<td width=5></td>
		<td><a href="javascript:memberDrop()"><img src="../../image/more/member_drop.gif" width="96" height="21" border="0"></a></td>
		<td width=5></td>
		<td><a href="javascript:list()"><img src="../../image/more/member_list.gif" width="75" height="21" border="0"></a></td>
		</tr>
		</table>
	</td></tr>
	
	<tr><td height=50></td></tr>
	
	</table>

</td>
</tr>

</table>	


</body>
</html>
<script>
self.resizeTo(document.body.scrollWidth,document.body.scrollHeight); 
</script>

<?
} ELSE {
?>
	<script language="javascript">
	location.href="/admin/";
	</script>
<?
}
?>

<?
mysql_close($connection);
?>
