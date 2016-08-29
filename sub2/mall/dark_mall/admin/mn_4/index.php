<?
session_start();
IF($HTTP_SESSION_VARS[OLD_NO] AND $HTTP_SESSION_VARS[OLD_ID] AND $HTTP_SESSION_VARS[OLD_NAME]) {
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>검색</title>
	<link rel="STYLESHEET" type="text/css" href="../../style/style.css">

</head>
<body topmargin=0 marginheight=0 bgcolor="#ffffff">
<table border=0 cellpadding=0 cellspacing=0 width=790 height=400>
<tr>
<td></td>
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
