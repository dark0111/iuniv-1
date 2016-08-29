<?
session_start();
include_once("../../define_path.php");
//IF($HTTP_SESSION_VARS[OLD_NO] AND $HTTP_SESSION_VARS[OLD_ID] AND $HTTP_SESSION_VARS[OLD_NAME]) 
if(1)
{
function categoryLoad($categorySQL, $connection, $no, $type) {
if($no) {

	$cateQuery = "select no, scn, wcn, cate_name, cate_info from $categorySQL where no='$no'";
	$cateSQL = mysql_query($cateQuery, $connection) or die("cateQuery error");
	$cateFetch = mysql_fetch_array($cateSQL);
	$no = $cateFetch[scn];

	if(!strcmp($cateFetch[wcn],4)) {

		$cateQuery4 = "select no, scn, wcn, cate_name from $categorySQL where no='$no'";
		$cateSQL4 = mysql_query($cateQuery4, $connection) or die("cateQuery error");
		$cateFetch4 = mysql_fetch_array($cateSQL4);
		$cate_4_name = $cateFetch4[cate_name];

		$cateQuery3 = "select no, scn, wcn, cate_name from $categorySQL where no='$cateFetch4[scn]'";
		$cateSQL3 = mysql_query($cateQuery3, $connection) or die("cateQuery error");
		$cateFetch3 = mysql_fetch_array($cateSQL3);
		$cate_3_name = $cateFetch3[cate_name];

		$cateQuery2 = "select no, scn, wcn, cate_name from $categorySQL where no='$cateFetch3[scn]'";
		$cateSQL2 = mysql_query($cateQuery2, $connection) or die("cateQuery error");
		$cateFetch2 = mysql_fetch_array($cateSQL2);
		$cate_2_name = $cateFetch2[cate_name];
		print $cate_2_name." > ".$cate_3_name." > ".$cate_4_name." >";
		?>
			
		<input type='text' value='<?=$cateFetch[cate_name]?>' size='20' maxlength='50' name='cate_name' onkeypress='textCheck(event)'>

		<?
	} else if(!strcmp($cateFetch[wcn],3)) {

		$cateQuery3 = "select no, scn, wcn, cate_name from $categorySQL where no='$no'";
		$cateSQL3 = mysql_query($cateQuery3, $connection) or die("cateQuery error");
		$cateFetch3 = mysql_fetch_array($cateSQL3);
		$cate_3_name = $cateFetch3[cate_name];

		$cateQuery2 = "select no, scn, wcn, cate_name from $categorySQL where no='$cateFetch3[scn]'";
		$cateSQL2 = mysql_query($cateQuery2, $connection) or die("cateQuery error");
		$cateFetch2 = mysql_fetch_array($cateSQL2);
		$cate_2_name = $cateFetch2[cate_name];
		print $cate_2_name." > ".$cate_3_name." >";
		?>

		<input type='text' value='<?=$cateFetch[cate_name]?>' size='20' maxlength='50' name='cate_name' onkeypress='textCheck(event)'>

		<?
	} else if(!strcmp($cateFetch[wcn],2)) {

		$cateQuery2 = "select no, scn, wcn, cate_name from $categorySQL where no='$no'";
		$cateSQL2 = mysql_query($cateQuery2, $connection) or die("cateQuery error");
		$cateFetch2 = mysql_fetch_array($cateSQL2);
		$cate_2_name = $cateFetch2[cate_name];
		print $cate_2_name." > ";
		?>

		<input type='text' value='<?=$cateFetch[cate_name]?>' size='20' maxlength='50' name='cate_name' onkeypress='textCheck(event)'>

		<?
	} else if(!strcmp($cateFetch[wcn],1)) {
		?>

		<input type='text' value='<?=$cateFetch[cate_name]?>' size='20' maxlength='50' name='cate_name' onkeypress='textCheck(event)'>

		<?
	}

	if(!strcmp($type,"1")) {
		print " > ";
	} else if(!strcmp($type,"0")) {
		print "";
	}

}
}
?>
<?
// 버튼의 일부 이미지를 반환하는 변수
$Button_MenuValue = explode(",","a,b,c,d");
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>카테고리 관리</title>
		<link rel="STYLESHEET" type="text/css" href="<?=$dark_define['site_url']?>/dark_css/style_mall_admin.css">
	<style>
	.page {
		font-size:10pt;
		font-family:굴림; 
		color:#666666;
		text-decoration:none;
		padding:3 0 0 0;
		line-height:16px;
	}	
	</style>
	
	<?
	$ClassPar = explode(",","대,중,소,상세");
	?>
	
	<script language="javascript">
	function category() {
		if(!cateForm.cate_name.value) {
			alert("카테고리 이름을 입력하십시오.      ");
			cateForm.cate_name.focus();
			return false;
		}
		if(confirm("(<?=$ClassPar[$wcn-2]?>) 분류를 수정하시겠습니까?      ")) {
			cateForm.action = "_result.php";
		} else {
			return false;
		}
	}

	function textCheck(txt) {
		if((txt.keyCode > 32 && txt.keyCode < 40) || (txt.keyCode > 57 && txt.keyCode < 65) || (txt.keyCode > 90 && txt.keyCode < 97)) {
			txt.returnValue = false;
			alert("특수문자는 입력할 수 없습니다.     ");
		}
	}

	function cancelModify() {
		if(confirm("정보수정을 취소하시겠습니까?       ")) {
			location.href="_add.php?no=<?=$no?>&scn=<?=$scn?>&wcn=<?=$wcn?>";
		}
	}
	
	</script>
	
</head>
<body bgcolor="#ffffff" topmargin=0>

	<?
	$category_QueryLoad = "select cate_name, cate_info, use_yn from $categorySQL where no='$no'";
	//echo $category_QueryLoad;
	$category_SQLLoad = mysql_query($category_QueryLoad, $connection) or die("categoryQueryLoad error");
	$category_FetchLoad = mysql_fetch_array($category_SQLLoad);
	?>

	
	<?
	// 각각의 이미지를 구분하기 위해서 만든 비교문
	$wcn_temp = $wcn-1;
	
	switch ($wcn_temp) {
		case("1"):
		$c1t = "s";
		break;
	
		case("2"):
		$c2t = "s";
		break;
	
		case("3"):
		$c3t = "s";
		break;
	
		case("4"):
		$c4t = "s";
		break;
	}
	?>
		
	<!-- 타이틀 <시작> -->
	<table border=0 cellpadding=0 cellspacing=0 width=529 height=25 align=center>
	<form name="cateForm" method="post" onsubmit="return category()">
	<input type="hidden" name="result" value="modify">
	<input type="hidden" name="no" value="<?=$no?>">
	<input type="hidden" name="scn" value="<?=$scn?>">
	<input type="hidden" name="wcn" value="<?=$wcn?>">

	<tr>
	<td class="title">
		선택한 카테고리의 정보
	</td>
	</tr>
	</table>
	<!-- 타이틀 <종료> -->
	
		
	<table width=530 border=1 cellpadding=1 cellspacing=1 bgcolor="#c4c4c4" bordercolordark="#ffffff" bordercolorlight="#eeeeee" align=center>
		<tr height=25>
			<td bgcolor="#eeeeee" width=150 align=center>
			
				<table border=0 cellpadding=0 cellspacing=0>
				<tr>
				<td width="20"><img src="../../mall_admin_images/icon/cate_1<?=$c1t?>.gif" width="16" height="16" border="0"></td>
				<td width="20"><img src="../../mall_admin_images/icon/cate_2<?=$c2t?>.gif" width="16" height="16" border="0"></td>
				<td width="20"><img src="../../mall_admin_images/icon/cate_3<?=$c3t?>.gif" width="16" height="16" border="0"></td>
				<td width="32"><img src="../../mall_admin_images/icon/cate_4<?=$c4t?>.gif" width="28" height="16" border="0"></td>
				</tr>
				</table>	
			
			</td>
			<td bgcolor="#ffffff" width=380>
				
				<?=categoryLoad($categorySQL, $connection, $no, "0")?>
			</td>
		</tr>
		
		<tr height=25>
			<td bgcolor="#eeeeee" width=150 align=center>
			상품수
			</td>
			<td bgcolor="#ffffff" width=380>
				<?=$category_FetchLoad[cate_info]?> 개
			</td>
		</tr>
		<tr height=25>
			<td bgcolor="#eeeeee" width=150 align=center>
			사용유무
			</td>
			<td bgcolor="#ffffff" width=380>
				<select name='use_yn'>
					<option value='Y'<? if($category_FetchLoad[use_yn]=='Y'){echo'selected';}?>>Y</option>
					<option value='N'<? if($category_FetchLoad[use_yn]=='N'){echo'selected';}?>>N</option>
				</select>
			</td>
		</tr>
	</table>
	
	<br>

	<table border=0 cellpadding=0 cellspacing=0 align=center>
	<tr>
	<td><input type="image" src="../../mall_admin_images/more/cate_<?=$Button_MenuValue[$wcn-2]?>_modify.gif" width="96" height="21"></td>
	<td width=5></td>
	<td><a href="javascript:cancelModify()"><img src="../../mall_admin_images/more/cancel.gif" width="96" height="21" border="0"></a></td>
	</tr>
	</form>
	</table>


</body>
</html>


<script>
self.resizeTo(document.body.scrollWidth,document.body.scrollHeight+50); 
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
