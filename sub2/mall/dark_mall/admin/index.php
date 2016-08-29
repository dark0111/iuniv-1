<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>쇼핑몰 관리자</title>
	<link rel="STYLESHEET" type="text/css" href="../style/style.css">

	<script language="javascript">
	function LoginCk() {
		if(!LoginForm.id.value) {
		alert("아이디를 입력하십시오.     ");
		LoginForm.id.focus();
		return false;
		}
		if(!LoginForm.pw.value) {
		alert("패스워드를 입력하십시오.     ");
		LoginForm.pw.focus();
		return false;
		}
		LoginForm.action = "login.php";
	}
	</script>

</head>

<body>

<table border=0 cellpadding=0 cellspacing=0 width=100% height=100%>
<tr><td align=center>

	
	<table border=0 cellpadding=0 cellspacing=0 width=230>
	<tr>
	<td height=30><img src="image/more/image7.gif" width="145" height="16" border="0"></td>
	</tr>
	</table>

	<table border=0 cellpadding=0 cellspacing=0 width=230 height=123 background="image/more/image6.gif">
	<tr>
	<td align=center>
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<form name="LoginForm" method="post" onsubmit="return LoginCk()">
		<input type="hidden" name="result" value="login">
		<td class="index" align=right style="padding:0 5 0 0">아이디</td>
		<td><input type="text" size=10 maxlength=20 name="id" style="width:113;height:23"></td>
		</tr>
		
		<tr><td colspan=2 height=5></td></tr>
		
		<tr>
		<td class="index" align=right style="padding:0 5 0 0">비밀번호</td>
		<td><input type="password" size=10 maxlength=20 name="pw" style="width:113;height:23"></td>
		</tr>

		<tr><td colspan=2 height=5></td></tr>

		<tr>
		<td class="index" align=right style="padding:0 5 0 0"></td>
		<td><input type="image" src="image/more/image9.gif" width="80" height="25"></td>
		</tr>
		</form>
		</table>
	
	</td>
	</tr>
	</table>

	<table border=0 cellpadding=0 cellspacing=0 width=230>
	<tr>
	<td height=30><img src="image/more/image8.gif" width="289" height="11" border=0></td>
	</tr>
	</table>

</td></tr>
</table>



</body>
</html>
