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
  date datetime,
  login_date datetime default '0000-00-00 00:00:00',
  logout_date datetime default '0000-00-00 00:00:00',
  ip varchar(15) default '000.000.000.000',
  primary key(no)
);
*/

if($HTTP_SESSION_VARS[OLD_ID]) {

	$updateQuery = "insert into $supervisorSQL(lno, name, id, logout_date, ip)";
	$updateQuery .= "values('$HTTP_SESSION_VARS[OLD_NO]', '$HTTP_SESSION_VARS[OLD_NAME]', '$HTTP_SESSION_VARS[OLD_ID]', now(), '$REMOTE_ADDR')";
	mysql_query($updateQuery, $connection) or die("updateQuery error");

}

SESSION_UNREGISTER("OLD_NO"); 
SESSION_UNREGISTER("OLD_ID"); 
SESSION_UNREGISTER("OLD_NAME"); 
SESSION_UNREGISTER("PRODUCT_CODE");
SESSION_UNREGISTER("CCN");
SESSION_DESTROY();

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>쇼핑몰 관리자</title>
	<link rel="STYLESHEET" type="text/css" href="../style/style.css">

		<script language="javascript">
		location.href="./";
		</script>

	
</head>
</html>
<?
mysql_close($connection);
?>
