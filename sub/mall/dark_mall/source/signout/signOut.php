<?
session_start();
include "../../include/dbcon.php";
session_unregister("ON_ID");
session_unregister("ON_NAME");
session_unregister("ON_EMAIL");
session_destroy();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>로그아웃</title>
	<link rel="STYLESHEET" type="text/css" href="../../style/style.css">
	<script language="javascript">
//	parent.location.href="/";
	parent.location.href=document.referrer;
	</script>
</head>
</html>
<?
mysql_close($connection);
?>
