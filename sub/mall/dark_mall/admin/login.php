<?
session_start();
include "../include/dbcon.php";

/*
$supervisorSQL = "supervisor";
create table supervisor (
  no int not null auto_increment,
  lno int default '0',
  name varchar(20) default '',
  id varchar(20) default '',
  pw varchar(20) default '',
  date datetime default '0000-00-00 00:00:00',
  login_date datetime default '0000-00-00 00:00:00',
  logout_date datetime default '0000-00-00 00:00:00',
  ip varchar(15) default '000.000.000.000',
  primary key(no)
);
*/

if(!strcmp($result,"login")) {
	$LoadCheckQuery = "select count(no) as no from $supervisorSQL where id='$id' and pw=password('$pw') and lno='0'";
	$LoadCheckSQL = mysql_query($LoadCheckQuery, $connection) or die("LoadCheckQuery error");
	$LoadCheckFetch = mysql_fetch_array($LoadCheckSQL);
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>쇼핑몰 관리자</title>
	<link rel="STYLESHEET" type="text/css" href="../style/style.css">

	<?
	if($LoadCheckFetch[0]>0) {

		$SessionResult = "select no, name, id, pw from $supervisorSQL where id='$id' and pw=password('$pw') and lno='0'";
		$SessionResultSQL = mysql_query($SessionResult, $connection) or die("Session Result");
		$SessionResultFetch = mysql_fetch_array($SessionResultSQL);

		$OLD_NO = $SessionResultFetch[no];
		$OLD_ID = $SessionResultFetch[id];
		$OLD_NAME = $SessionResultFetch[name];

		SESSION_REGISTER("OLD_NO");
		SESSION_REGISTER("OLD_ID");
		SESSION_REGISTER("OLD_NAME");

		$updateQuery = "insert into $supervisorSQL(lno, name, id, login_date, ip)";
		$updateQuery .= "values('$HTTP_SESSION_VARS[OLD_NO]', '$HTTP_SESSION_VARS[OLD_NAME]', '$HTTP_SESSION_VARS[OLD_ID]', now(), '$REMOTE_ADDR')";
		mysql_query($updateQuery, $connection) or die("updateQuery error");

		?>

		<script language="javascript">
		location.href="default/";
		</script>

	<?
	} else {
	?>
	
	<script language="javascript">
	alert("입력하신 정보가 맞지 않습니다.");
	location.href="javascript:history.back()";
	</script>

	<?
	}
	?>
	
	
</head>
</html>
<?
mysql_close($connection);
?>
