<?
session_start();
IF(!$HTTP_SESSION_VARS[ON_ID] AND !$HTTP_SESSION_VARS[ON_NAME] AND !$HTTP_SESSION_VARS[ON_EMAIL]) {
include "../../include/dbcon.php";
$CATEVALUE = "<a href=\"/\" class='user_category_value'>홈</a> ";
$CATEVALUE .= "> 회원가입";

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>회원가입</title>
	<link rel="STYLESHEET" type="text/css" href="../../style/style.css">
	<?
	//  name varchar(10) not null,
	//  jumin varchar(14) not null,
	
	$jumin = $jumin1."-".$jumin2;
	$memberCheckQuery = "select count(no) as no from $memberSQL where name='$name' and jumin='$jumin'";
	$memberCheckSQL = mysql_query($memberCheckQuery, $connection) or die("memberCheckQuery error");
	$memberCheckFetch = mysql_fetch_array($memberCheckSQL);
	?>
	<script language="javascript">

	<?
	if($memberCheckFetch[0]>0) {
	?>
	
	alert("이미 가입된 주민등록번호 입니다.     ");
	
	
	<?
	} else {
	?>
	
	alert("가입되지 않은 주민등록번호 입니다.     ");
	
	parent.MemberForm.signCheck.value="<?=$memberCheckFetch[0]+1?>";
	parent.MemberJoin.name.value="<?=$name?>";
	parent.MemberJoin.jumin1.value="<?=$jumin1?>";
	parent.MemberJoin.jumin2.value="<?=$jumin2?>";
	
	<?
	}
	?>
	
	</script>

</head>
</html>
<?
} ELSE {
?>
<script language="javascript">
parent.location.href="/";
</script>
<?
}
mysql_close($connection);
?>
