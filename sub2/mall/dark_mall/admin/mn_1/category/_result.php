<?
session_start();
include "../../../include/dbcon.php";
IF($HTTP_SESSION_VARS[OLD_NO] AND $HTTP_SESSION_VARS[OLD_ID] AND $HTTP_SESSION_VARS[OLD_NAME]) {

?>

		<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
		<html>
		<head>
			<title>카테고리 관리</title>
			<link rel="STYLESHEET" type="text/css" href="../../../style/style.css">

<?
if(!strcmp($result, "save")) {

	if(!strcmp($scn,"0")) {
		$extend_cate_name = $cate_name;
	} else {
		$extend_cate_name = strip_tags($extend_cate_name)." > ".$cate_name;
	}
	
	
	$checkQuery = "select count(no) as no from $categorySQL where cate_name='$cate_name' and scn='$scn' and wcn='$wcn'";
	$checkSQL = mysql_query($checkQuery, $connection) or die("checkQuery error");
	$checkFetch = mysql_fetch_array($checkSQL);

	if(!strcmp($checkFetch[0],"0")) {
		
		// 카테고리의 정보를 저장합니다.
		$categoryAddQuery = "insert into $categorySQL (";
		$categoryAddQuery .= "scn, wcn, cate_name, extend_cate_name, ip, date";
		$categoryAddQuery .= ") values (";
		$categoryAddQuery .= "'$scn', '$wcn', '$cate_name', '$extend_cate_name', '$REMOTE_ADDR', now()";
		$categoryAddQuery .= ")";
		mysql_query($categoryAddQuery, $connection) or die("categoryAddQuery error");

		$creatingCategoryLoad = "select no from $categorySQL order by no desc";
		$creatingCategoryLoadSQL = mysql_Query($creatingCategoryLoad, $connection) or die("creatingCategoryLoad error");
		$creatingCategoryLoadFetch = mysql_Fetch_array($creatingCategoryLoadSQL);
		?>

			<script language="javascript">
			parent.category.location.href="category.php?no=<?=$no?>&nc=<?=$creatingCategoryLoadFetch[no]?>";
			location.href="_add.php?no=<?=$no?>&scn=<?=$scn?>&wcn=<?=$wcn?>";
			</script>

	<?
	} else {

		$checkQuery = "select no, scn, wcn from $categorySQL where cate_name='$cate_name' and scn='$scn' and wcn='$wcn'";
		$checkSQL = mysql_query($checkQuery, $connection) or die("checkQuery error");
		$checkFetch = mysql_fetch_array($checkSQL);
		?>
			<script language="javascript">
			alert("이미 등록되어 있는 카테고리 입니다.      ");
			parent.category.location.href="category.php?no=<?=$checkFetch[no]?>";
			location.href="_add.php?no=<?=$checkFetch[no]?>&scn=<?=$checkFetch[scn]?>&wcn=<?=$checkFetch[wcn]?>";
			</script>
		
	<?
	}
	?>

<?
} else if(!strcmp($result, "modify")) {

	$updateQuery = "update $categorySQL set cate_name='$cate_name' where no='$no'";
	mysql_query($updateQuery, $connection) or die("updateQuery");
	?>

		<script language="javascript">
		parent.category.location.href="category.php?no=<?=$no?>";
		location.href="_add.php?no=<?=$no?>&scn=<?=$scn?>&wcn=<?=$wcn?>";
		</script>	

<?
} else if(!strcmp($result, "drop")) {

	$up_categoryLoadQuery = "select scn from $categorySQL where no='$no'";
	$up_categoryLoadSQL = mysql_query($up_categoryLoadQuery, $connection) or die("up_categoryLoadQuery error()");
	$up_categoryLoadFetch = mysql_fetch_array($up_categoryLoadSQL);

	$drop_categoryQuery = "delete from $categorySQL where no='$no'";
	mysql_query($drop_categoryQuery, $connection) or die("drop_categoryQuery error");

	if($up_categoryLoadFetch[scn]>0) {

		$real_categoryLoadQuery = "select no, scn, wcn from $categorySQL where no='$up_categoryLoadFetch[scn]'";
		$real_categoryLoadSQL = mysql_query($real_categoryLoadQuery, $connection) or die("real_categoryLoadQuery error");
		$real_categoryLoadFetch = mysql_fetch_array($real_categoryLoadSQL);

		$no = $real_categoryLoadFetch[no];
		$scn = $real_categoryLoadFetch[scn];
		$wcn = $real_categoryLoadFetch[wcn];

		
	} else {

		$no = "";
		$scn = 0;
		$wcn = 1;

	}
	
?>		

	<script language="javascript">
	parent.category.location.href="category.php?no=<?=$real_categoryLoadFetch[no]?>";
	location.href="_add.php?no=<?=$no?>&scn=<?=$scn?>&wcn=<?=$wcn?>";
	</script>	

<?
} else if(!strcmp($result, "which")) {

	$wcn_temp = $wcn-1;

	if(!strcmp($order, "up")) {

		$which_changeQuery = "select no from $categorySQL where no<$no and wcn='$wcn_temp' and scn='$scn' order by no desc limit 0,1";
		$which_changeSQL = mysql_query($which_changeQuery, $connection) or die("which changeQuery error");
		$which_changeFetch = mysql_fetch_array($which_changeSQL);

	} else if(!strcmp($order, "down")) {

		$which_changeQuery = "select no from $categorySQL where no>$no and wcn='$wcn_temp' and scn='$scn' order by no asc limit 0,1";
		$which_changeSQL = mysql_query($which_changeQuery, $connection) or die("which changeQuery error");
		$which_changeFetch = mysql_fetch_array($which_changeSQL);

	}

		$which_original_update = "update $categorySQL set no='0' where no='$no'";
		mysql_query($which_original_update, $connection) or die("which_original_update error");

		// 임시 번호를 발급합니다. <시작>
		$no_a = $no."_";

		
		// 카테고리의 정보를 변경합니다. <시작>
		$which_scn_update = "update $categorySQL set scn='$no_a' where scn='$no'";
		mysql_query($which_scn_update, $connection) or die("which_scn_update error");

		$which_original_update_a = "update $categorySQL set no='$no' where no='$which_changeFetch[no]'";
		mysql_query($which_original_update_a, $connection) or die("which_original_update_a error");

		$which_scn_update_a = "update $categorySQL set scn='$no' where scn='$which_changeFetch[no]'";
		mysql_query($which_scn_update_a, $connection) or die("which_scn_update error");

		$which_original_update_b = "update $categorySQL set no='$which_changeFetch[no]' where no='0'";
		mysql_query($which_original_update_b, $connection) or die("which_original_update_b");

		$which_scn_update_a = "update $categorySQL set scn='$which_changeFetch[no]' where scn='$no_a'";
		mysql_query($which_scn_update_a, $connection) or die("which_scn_update error");
		// 카테고리의 정보를 변경합니다. <종료>
		
		
		// 상품의 고유코드를 변경합니다. <시작>

		// 기본의 ccn 코드를 임시코드로 변경합니다.
		
		// 변경 A
		$which_ccn_update_a = "update $productSQL set ccn='$no_a' where ccn='$no'";
		mysql_query($which_ccn_update_a, $connection) or die("which_ccn_update error");

		// 변경 B
		$which_ccn_update_b = "update $productSQL set ccn='$no' where ccn='$which_changeFetch[no]'";
		mysql_query($which_ccn_update_b, $connection) or die("which_ccn_update error");

		// 변경 C
		$which_ccn_update_b = "update $productSQL set ccn='$which_changeFetch[no]' where ccn='$no_a'";
		mysql_query($which_ccn_update_b, $connection) or die("which_ccn_update error");
		
		
		
		
		
		
		// 상품의 고유코드를 변경합니다. <종료>
		
	?>

	<script language="javascript">
	parent.category.location.href="category.php?no=<?=$which_changeFetch[no]?>";
	location.href="_add.php?no=<?=$which_changeFetch[no]?>&scn=<?=$which_changeFetch[no]?>&wcn=<?=$wcn?>";
	</script>
		
		<?
}
?>	

		</head>
		<body bgcolor="#ffffff">
		</body>
		</html>


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
