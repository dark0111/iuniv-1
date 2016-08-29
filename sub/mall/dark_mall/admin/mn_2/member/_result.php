<?
session_start();
include "../../../include/dbcon.php";
IF($HTTP_SESSION_VARS[OLD_NO] AND $HTTP_SESSION_VARS[OLD_ID] AND $HTTP_SESSION_VARS[OLD_NAME]) {

# product_contents 에 포함되어 있는 이미지들을 추출하여 변경하고 이미지를 해당 디렉토리에 저장한다. <시작>

	IF(!STRCMP($result, "id")) {

		$IDCheckQuery = "select count(no) as no from $memberSQL where id='$idValue'";
		$IDCheckSQL = mysql_query($IDCheckQuery, $connection) or die("IDCheckQuery error");
		$IDCheckFetch = mysql_fetch_array($IDCheckSQL);
		if($IDCheckFetch[0]>0) {
		?>
		<script language="javascript">
		alert("아이디 '<?=$idValue?>'는 이용할 수 없는 아이디입니다.         ");
		parent.MemberForm.idvalue.value="";
		</script>
		<?
		} else {
		?>
		<script language="javascript">
		alert("아이디 '<?=$idValue?>'는 이용할 수 있는 아이디입니다.         ");
		parent.MemberForm.idvalue.value="<?=$idValue?>";
		</script>
		<?
		}

	} ELSE IF(!STRCMP($result, "save")) {

		$jumin = $jumin1."-".$jumin2;
		$tel = $tel_1."-".$tel_2."-".$tel_3;
		$fax = $fax_1."-".$fax_2."-".$fax_3;
		$hp = $hp_1."-".$hp_2."-".$hp_3;
		$pw = $passA;

		$SaveQuery = "insert into $memberSQL(";
		$SaveQuery .= "id,";
		$SaveQuery .= "pw,";
		$SaveQuery .= "name,";
		$SaveQuery .= "jumin,";
		$SaveQuery .= "add_1,";
		$SaveQuery .= "add_2,";
		$SaveQuery .= "zip_1,";
		$SaveQuery .= "zip_2,";
		$SaveQuery .= "email,";
		$SaveQuery .= "tel,";
		$SaveQuery .= "fax,";
		$SaveQuery .= "hp,";
		$SaveQuery .= "pw_q,";
		$SaveQuery .= "pw_a,";
		$SaveQuery .= "member_class,";
		$SaveQuery .= "ip,";
		$SaveQuery .= "login_date,"; // default '0000-00-00 00:00:00'
		$SaveQuery .= "date";
		$SaveQuery .= ") values (";
		$SaveQuery .= "'$id',";
		$SaveQuery .= "password('$pw'),";
		$SaveQuery .= "'$name',";
		$SaveQuery .= "'$jumin',";
		$SaveQuery .= "'$add_1',";
		$SaveQuery .= "'$add_2',";
		$SaveQuery .= "'$zip_1',";
		$SaveQuery .= "'$zip_2',";
		$SaveQuery .= "'$email',";
		$SaveQuery .= "'$tel',";
		$SaveQuery .= "'$fax',";
		$SaveQuery .= "'$hp',";
		$SaveQuery .= "'$pw_q',";
		$SaveQuery .= "'$pw_a',";
		$SaveQuery .= "'1',";
		$SaveQuery .= "'$REMOTE_ADDR',";
		$SaveQuery .= "'',"; 
		$SaveQuery .= "now()";
		$SaveQuery .= ")";
		mysql_query($SaveQuery, $connection) or die("SaveQuery error");
		?>

		<script language="javascript">
		alert("회원등록이 완료되었습니다.         ");
		location.href="_list.php";
		</script>

		<?
	} ELSE IF(!STRCMP($result, "modify")) {

		$tel = $tel_1."-".$tel_2."-".$tel_3;
		$fax = $fax_1."-".$fax_2."-".$fax_3;
		$hp = $hp_1."-".$hp_2."-".$hp_3;

		$UpdateQuery = "update $memberSQL set ";
		$UpdateQuery .= "add_1='$add_1',";
		$UpdateQuery .= "add_2='$add_2',";
		$UpdateQuery .= "zip_1='$zip_1',";
		$UpdateQuery .= "zip_2='$zip_2',";
		$UpdateQuery .= "email='$email',";
		$UpdateQuery .= "tel='$tel',";
		$UpdateQuery .= "fax='$fax',";
		$UpdateQuery .= "hp='$hp',";
		$UpdateQuery .= "pw_q='$pw_q',";
		$UpdateQuery .= "pw_a='$pw_a',";
		$UpdateQuery .= "ip='$REMOTE_ADDR',";
		$UpdateQuery .= "date=now() where no='$no'";
		mysql_query($UpdateQuery, $connection) or die("UpdateQuery error");
		?>

		<script language="javascript">
		alert("회원등록이 완료되었습니다.         ");
		location.href="_member_view.php?no=<?=$no?>&page=<?=$page?>&limit=<?=$limit?>&q=<?=$q?>";
		</script>

		<?
	} ELSE IF(!STRCMP($result, "drop")) {

		$DropQuery = "delete from $memberSQL where no='$no'";
		mysql_query($DropQuery, $connection) or die("UpdateQuery error");	
		?>

		<script language="javascript">
		alert("회원의 정보를 삭제하였습니다.         ");
		location.href="_list.php?page=<?=$page?>&limit=<?=$limit?>&q=<?=$q?>";
		</script>

		<?
	}
	?>

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
