<?
session_start();
IF(!$HTTP_SESSION_VARS[ON_ID] AND !$HTTP_SESSION_VARS[ON_NAME] AND !$HTTP_SESSION_VARS[ON_EMAIL]) {
include "../../include/dbcon.php";

# product_contents 에 포함되어 있는 이미지들을 추출하여 변경하고 이미지를 해당 디렉토리에 저장한다. <시작>

	IF(!STRCMP($result, "lost_id")) {
		$jumin = $jumin1."-".$jumin2;
		$CheckQuery = "select count(no) as no from $memberSQL where name='$name' and jumin='$jumin'";
		$CheckSQL = mysql_query($CheckQuery, $connection) or die("CheckQuery error");
		$CheckFetch = mysql_fetch_array($CheckSQL);
		if(!strcmp($CheckFetch[0],"0")) {
		?>
		<script language="javascript">
		alert("회원이 아니십니다.      \n다시한번 확인하시기 바랍니다.    ");
		</script>
		<?
		} else {
		?>
		<script language="javascript">
		parent.location.href="./lost_id.html?m=<?=base64_encode($name)?>&n=<?=base64_encode($jumin)?>&r=result";
		</script>
		<?
		}
	} ELSE IF(!STRCMP($result, "lost_pw")) {

		$CheckQuery = "select count(no) as no from $memberSQL where id='$id' and pw_q='$pw_q' and pw_a='$pw_a'";
		$CheckSQL = mysql_query($CheckQuery, $connection) or die("CheckQuery error");
		$CheckFetch = mysql_fetch_array($CheckSQL);
		if(!strcmp($CheckFetch[0],"0")) {
		?>
		<script language="javascript">
		alert("입력하신 정보가 잘못되었습니다.      \n다시한번 확인하시기 바랍니다.    ");
		</script>
		<?
		} else {
			$Random = "p".time();
			$updateQuery = "update $memberSQL set pw=password('$Random') where id='$id' and pw_q='$pw_q' and pw_a='$pw_a'";
			mysql_query($updateQuery, $connection) or die("updateQuery error");
		?>
		<script language="javascript">
		parent.location.href="./lost_pw.html?lp=<?=base64_encode($Random)?>&r=result";
		</script>
		<?
		}
	}
	?>

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


