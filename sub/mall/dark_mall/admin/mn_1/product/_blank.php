<?
session_start();
include "../../../include/dbcon.php";
IF($HTTP_SESSION_VARS[OLD_NO] AND $HTTP_SESSION_VARS[OLD_ID] AND $HTTP_SESSION_VARS[OLD_NAME]) {

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>상품관리</title>
	<link rel="STYLESHEET" type="text/css" href="../../../style/style.css">
</head>
<body bgcolor="#ffffff">
<table border=0 cellpadding=0 cellspacing=1 bgcolor="#c4c4c4" width=790 height=400>
<tr><td align=center bgcolor="#ffffff">상품관리</td></tr>
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
