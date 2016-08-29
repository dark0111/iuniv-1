<table border=0 cellpadding=0 cellspacing=0 width=900 align=center>
<tr><td><hr size=1></td></tr>
<tr>
<td bgcolor="#ffffff">
<?
IF($HTTP_SESSION_VARS[ON_ID]) {
?>
	<table border=0 cellpadding=0 cellspacing=0>
	<tr>
	<td><a href="/myShopping/myShop.html">마이쇼핑</a></td>
	<td>|</td>
	<td>(<?=$HTTP_SESSION_VARS[ON_ID]?>,<?=$HTTP_SESSION_VARS[ON_NAME]?>,<?=$HTTP_SESSION_VARS[ON_EMAIL]?>)</td>
	<td><a href="/source/signout/signOut.php">로그아웃</a></td>
	</tr>
	</table>
<?
} ELSE {
?>
	<table border=0 cellpadding=0 cellspacing=0>
	<tr>
	<td><a href="/membership/sign/signMember.html">회원가입</a></td>
	<td>|</td>
	<td><a href="/source/signin/Signin.html">로그인</a></td>
	</tr>
	</table>
<?
}
?>

</td></tr>
</table>
