<?
include_once("../../dark_include/lib.php");
//IF($HTTP_SESSION_VARS[OLD_NO] AND $HTTP_SESSION_VARS[OLD_ID] AND $HTTP_SESSION_VARS[OLD_NAME]) 
if(1)
{
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>ShoppingMall</title>
	<script language="javascript">
	function CallMenu(mn, sn, loc) 
	{
		if(sn) {
			snv = "&sn="+sn;
		} else {
			snv = "";
		}
		
		if(loc) {
			locv = "&loc="+loc;
		} else {
			locv = "";
		}
	
		location.href="./mall_admin_default/?mn=" + mn + snv + locv;
	}
	
	function logout() 
	{
		if(confirm("로그아웃 하시겠습니까?")) 
		{
			location.href="../logout.php";
		} 
	}

	</script>

	<link rel="STYLESHEET" type="text/css" href="../../style/style.css">
</head>
<body topmargin=0 marginheight=0 bgcolor="#ffffff">
<table border=0 cellpadding=0 cellspacing=0 width=960>

<tr>
<td height=20 colspan=17></td>
</tr>


<!-- 메뉴의 시작 -->
<tr height=45>

<td width="158"><a href="javascript:CallMenu('1', '', '')"><img src="../image/menu/menu1<?if(!STRCMP($mn,1)) { PRINT "s"; }?>.gif" width="158" height="45" border="0"></a></td>
<td width=1></td>
<td width="106"><a href="javascript:CallMenu('2', '', '')"><img src="../image/menu/menu2<?if(!STRCMP($mn,2)) { PRINT "s"; }?>.gif" width="106" height="45" border="0"></a></td>
<td width=1></td>
<td width="80"><a href="javascript:CallMenu('3', '', '')"><img src="../image/menu/menu3<?if(!STRCMP($mn,3)) { PRINT "s"; }?>.gif" width="80" height="45" border="0"></a></td>
<td width=1></td>
<td width="81"><a href="javascript:CallMenu('4', '', '')"><img src="../image/menu/menu4<?if(!STRCMP($mn,4)) { PRINT "s"; }?>.gif" width="81" height="45" border="0"></a></td>
<td width=1></td>
<td width="81"><a href="javascript:CallMenu('5', '', '')"><img src="../image/menu/menu5<?if(!STRCMP($mn,5)) { PRINT "s"; }?>.gif" width="81" height="45" border="0"></a></td>
<td width=1></td>
<td width="81"><a href="javascript:CallMenu('6', '', '')"><img src="../image/menu/menu6<?if(!STRCMP($mn,6)) { PRINT "s"; }?>.gif" width="81" height="45" border="0"></a></td>
<td width=1></td>
<td width="110"><a href="javascript:CallMenu('7', '', '')"><img src="../image/menu/menu7<?if(!STRCMP($mn,7)) { PRINT "s"; }?>.gif" width="110" height="45" border="0"></a></td>
<td width=1></td>
<td width="89"><a href="javascript:CallMenu('8', '', '')"><img src="../image/menu/menu8<?if(!STRCMP($mn,8)) { PRINT "s"; }?>.gif" width="89" height="45" border="0"></a></td>
<td width=7></td>
</tr>
<!-- 메뉴의 종료 -->

<tr>
<td height=15 colspan=17></td>
</tr>

<tr>
<td height=1 colspan=17 background="../image/background/hr.gif"><img width=0 height=1></td>
</tr>

<tr>
<td height=5 colspan=17></td>
</tr>

<tr>
<td colspan=17 valign=top>
<!-- 본문의 시작 -->

	<?
	IF($mn) 
	{ // mn의 값이 있을 경우 ../template/leftmenu.php 를 불러옵니다. // 서브 메뉴
		INCLUDE "./mall_template/left_menu.php";
	}
	ELSE 
	{ // mn의 값이 없을 경우 ../template/home.php 를 불러옵니다. // 메인 화면
		INCLUDE "./mall_template/home.php";
	}
	?>

<!-- 본문의 종료 -->
</td>
</tr>

<tr>
<td height=5 colspan=17></td>
</tr>

<tr>
<td height=1 colspan=17 background="../image/background/hr.gif"><img width=0 height=1></td>
</tr>

<tr>
<td height=30 colspan=17 align=center>Copyright ⓒ 2005-2007 <font color="#000072"><strong>IT</strong></font> 파랑새. All rights reserved.</td>
</tr>

</table>
</body>
</html>
<?
} 
ELSE 
{
?>
	<script language="javascript">
	location.href="/dark_admin/";
	</script>
<?
}
?>
<?
mysql_close($connection);
?>
