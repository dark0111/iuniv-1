<?
session_start();
IF($HTTP_SESSION_VARS[ON_ID] AND $HTTP_SESSION_VARS[ON_NAME] AND $HTTP_SESSION_VARS[ON_EMAIL]) {
include "../../include/dbcon.php";
$CATEVALUE = "<a href=\"/\" class='user_category_value'>홈</a> > 회원정보";
$CATEVALUE .= " > ".$HTTP_SESSION_VARS[ON_NAME]."님의 정보변경 ";

$MemberLoadQuery = "select count(no) as no from $memberSQL where id='$HTTP_SESSION_VARS[ON_ID]'";
$MemberLoadSQL = mysql_query($MemberLoadQuery, $connection) or die("MemberLoadQuery error");
$MemberLoadFetch = mysql_fetch_array($MemberLoadSQL);

if($MemberLoadFetch[0]>0) {

	$Password_check_query = "select count(no) as no from $memberSQL where id='$HTTP_SESSION_VARS[ON_ID]' and pw=password('$pw')";
	$Password_check_sql = mysql_query($Password_check_query, $connection) or die("Password_check_query error");
	$Password_check_fetch = mysql_fetch_array($Password_check_sql);
	
	if($Password_check_fetch[0]>0) {

		$tel = $tel_1."-".$tel_2."-".$tel_3;
		$fax = $fax_1."-".$fax_2."-".$fax_3;
		$hp = $hp_1."-".$hp_2."-".$hp_3;
		$pw = $passA;

		IF($passA) {
			$UpdatePassword = "pw = password('$pw'),";
		}

		$updateQuery = "update $memberSQL set ";
		$updateQuery .= $UpdatePassword."add_1 = '$add_1',";
		$updateQuery .= "add_2 = '$add_2',";
		$updateQuery .= "zip_1 = '$zip_1',";
		$updateQuery .= "zip_2 = '$zip_2',";
		$updateQuery .= "email = '$email',";
		$updateQuery .= "tel = '$tel',";
		$updateQuery .= "fax = '$fax',";
		$updateQuery .= "hp = '$hp',";
		$updateQuery .= "pw_q = '$pw_q',";
		$updateQuery .= "pw_a = '$pw_a',";
		$updateQuery .= "ip = '$REMOTE_ADDR',";
		$updateQuery .= "date = now() where id='$HTTP_SESSION_VARS[ON_ID]'";
		mysql_query($updateQuery, $connection) or die("updateQuery error");
		?>
		<script language="javascript">
		alert("정보가 변경되었습니다.     ");
		parent.location.href="./membership.html";
		</script>
		<?
	} else {
		?>
		<script language="javascript">
		alert("비밀번호가 일치하지 않습니다.     ");
		parent.MemberForm.pw.focus();
		</script>
		<?
	}
} else {
	?>
	<script language="javascript">
	alert("정보의 전달이 잘못되었습니다.     ");
	</script>
	<?
}

} ELSE {
?>
<script language="javascript">
parent.location.href="/";
</script>
<?
}
mysql_close($connection);
?>
