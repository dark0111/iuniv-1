<?
session_start();
include "../../include/dbcon.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>로그인</title>
	<link rel="STYLESHEET" type="text/css" href="../../style/style.css">
	<?
	$SignCheckQuery = "select count(no) as no from $memberSQL where id='$id' and pw=password('$pw')";
	$SignCheckSQL = mysql_query($SignCheckQuery, $connection) or die("SignCheckQuery error");
	$SignCheckFetch = mysql_fetch_array($SignCheckSQL);

	if($SignCheckFetch[0]>0) {
		$SignLoadInformationQuery = "select id, name, email from $memberSQL where id='$id' and pw=password('$pw')";
		$SignLoadInformationSQL = mysql_query($SignLoadInformationQuery, $connection) or die("SignLoadInformationQuery error");
		$SignLoadInformationFetch = mysql_fetch_array($SignLoadInformationSQL);

		$ON_ID = $SignLoadInformationFetch[id];
		$ON_NAME = $SignLoadInformationFetch[name];
		$ON_EMAIL = $SignLoadInformationFetch[email];

		session_register("ON_ID");
		session_register("ON_NAME");
		session_register("ON_EMAIL");
	?>
	<script language="javascript">
//	parent.location.href="/";
	parent.location.href="<?=$hrf?>";
	</script>
	<?
	} else {
	?>
	<script language="javascript">
	alert("로그인정보가 잘못되었습니다.       \n\n다시 확인하여 주십시오.     ");
	</script>
	<?
	}
	?>
</head>

</html>
<?
mysql_close($connection);
?>
