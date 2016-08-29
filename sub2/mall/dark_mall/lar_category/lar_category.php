<?
session_start();
include "../include/dbcon.php";

$categoryLoadQuery = "select no, scn, wcn, cate_name, extend_cate_name, cate_info from $categorySQL where no='$no'";
$categoryLoadSQL = mysql_query($categoryLoadQuery, $connection) or die("categoryLoadQuery error");
$categoryLoadFetch = mysql_fetch_array($categoryLoadSQL);
$category_Value = $categoryLoadFetch[extend_cate_name];

$PNO = $no;

if($categoryLoadFetch[wcn]>2) {
	$no = $categoryLoadFetch[scn];
}

if($sno) {

	$sCateQuery = "select no, scn, wcn, cate_name, extend_cate_name, cate_info from $categorySQL where no='$sno'";
	$sCateSQL = mysql_query($sCateQuery, $connection) or die("sCateQuery error");
	$sCateFetch = mysql_fetch_array($sCateSQL);
	$category_Value = $sCateFetch[extend_cate_name];
	$PNO = $sno;

}

// 카테고리의 표현 <시작>
$category_ValueExplode = explode(" > ",$category_Value);
$CATEVALUE = "<a href=\"/\" class='user_category_value'>홈</a>";
for($b=0;$b<4;$b++) {
	$CATEGORYLOAD = "select no from $categorySQL where cate_name like '%".trim($category_ValueExplode[$b])."%' and wcn='".($b+1)."'";
	$CATEGORYLOAD_SQL = mysql_Query($CATEGORYLOAD, $connection) or dir("CATEGORYLOAD error");
	$CATEGORYLOAD_FETCH = mysql_fetch_array($CATEGORYLOAD_SQL);
	if($category_ValueExplode[$b]) {
		if(!strcmp($b,0) or !strcmp($b,1)) {
			$CATEVALUE .= " > <a href=\"javascript:category('".$CATEGORYLOAD_FETCH[no]."', '')\" class='user_category_value'>".$category_ValueExplode[$b]."</a>";
		} else {
			$CATEVALUE .= " > ".$category_ValueExplode[$b];
		}
	}
}
// 카테고리의 표현 <종료>
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title><?=$categoryLoadFetch[extend_cate_name]?></title>
	<link rel="STYLESHEET" type="text/css" href="../style/style.css">
	<script language="javascript">
	<?if(!$category_Value) {?>

	location.href="javascript:history.back()";

	<?}?>

	function category(no, sno) {
		location.href="lar_category.php?no="+no+"&sno="+sno;
	}
	</script>
</head>
<body>
<?
include "../template/head.php";
?>
<table border=0 cellpadding=0 cellspacing=0 width=900 align=center>
<tr>
<td bgcolor="#ffffff">
	<!-- 카테고리의 정보표현 <시작> -->
	<table broder=0 cellpadding=0 cellspacing=0 width=100%>
	<tr>
	<td bgcolor="#ffffff" class="user_category_value"><?=$CATEVALUE;?></td>
	</tr>

	<tr><td height=5 bgcolor="#ffffff"></td></tr>
	<tr><td height=1 bgcolor="#eeeeee"></td></tr>
	<tr><td height=5 bgcolor="#ffffff"></td></tr>

	<tr>
	<td bgcolor="#ffffff" width="900">

		<table border=0 cellpadding=0 cellspacing=0 width=100%>
		<tr>
		<?
		# 카테고리 표현의 <시작>
		$CategoryCountLoadQuery = "select count(no) as no from $categorySQL where scn='$no'";
		$CategoryCountLoadSQL = mysql_query($CategoryCountLoadQuery, $connection) or die("CategoryLoadQuery error");
		$CategoryCountLoadFetch = mysql_fetch_array($CategoryCountLoadSQL);

		$CategoryRealQuery = "select no, scn, wcn, cate_name, extend_cate_name, cate_info from $categorySQL where scn='$no'";
		$CategoryRealSQL = mysql_query($CategoryRealQuery, $connection) or die("CategoryRealQuery error");

		$trSel = 0;
		for($i=0;$i<$CategoryCountLoadFetch[0];$i++) {
			$trSel++;
			if(!strcmp($trSel,6)) {
				print "</tr>
				<tr><td colspan=5 height=5 bgcolor=\"#ffffff\"></td></tr>
				<tr><td colspan=5 height=1 bgcolor=\"#eeeeee\"><img width=0 height=1></td></tr>
				<tr><td colspan=5 height=5 bgcolor=\"#ffffff\"></td></tr>";
				$trSel = 1;
			}
			$CategoryRealFetch = mysql_fetch_array($CategoryRealSQL);

			if($CategoryRealFetch[wcn]>2) {
				$sno = $CategoryRealFetch[no];
			} else {
				$no = $CategoryRealFetch[no];
				$sno = "";
			}
			?>
	
			<td width=180 valign="top" bgcolor="#ffffff">
				<table border=0 cellpadding=1 cellspacing=0 width=100%>
				<tr>
				<td>
					<table border=0 cellpadding=0 cellspacing=0>
					<tr>
					<td <?if(!strcmp($sCateFetch[no],$CategoryRealFetch[no])) { print "bgcolor='#eeeeee'";}?> style="padding:0 0 0 1"><img src="../image/icon/icon1.gif" width="9" height="9" border="0"></td>
					<td <?if(!strcmp($sCateFetch[no],$CategoryRealFetch[no])) { print "bgcolor='#eeeeee'";}?> style="padding:3 6 1 6"><a href="javascript:category('<?=$no?>', '<?=$sno?>')"><span class="user_category"><?=$CategoryRealFetch[cate_name]?></span></a></td>
					</tr>
					</table>
					
				
				</td>
				</tr>
				<tr><td height=5></td></tr>
				
				<?
				$CheckCountTreeQuery = "select count(no) as no from $categorySQL where scn='$CategoryRealFetch[no]'";
				$CheckCountTreeSQL = mysql_query($CheckCountTreeQuery, $connection) or die("CheckTreeQuery error");
				$CheckCountTreeFetch = mysql_fetch_array($CheckCountTreeSQL);

				$CheckRealTreeQuery = "select no, scn, wcn, cate_name, extend_cate_name, cate_info from $categorySQL where scn='$CategoryRealFetch[no]'";
				$CheckRealTreeSQL = mysql_query($CheckRealTreeQuery, $connection) or die("CheckRealTreeQuery error");
				for($s=0;$s<$CheckCountTreeFetch[0];$s++) {
				$CheckRealTreeFetch = mysql_fetch_array($CheckRealTreeSQL);

				if($CheckRealTreeFetch[wcn]>2) {
					$sno_value = $CheckRealTreeFetch[no];
				} else {
					$no = $CheckRealTreeFetch[no];
					$sno_value = "";
				}
				?>

				<tr>
				<td>
					<table border=0 cellpadding=0 cellspacing=0>
					<tr>
					<td width=10 align=center style="padding:2 0 3 0"><img src="../image/icon/icon2.gif" width="4" height="4" border="0"></td>
					<td style="padding:3 6 1 6" <?if(!strcmp($sCateFetch[no],$CheckRealTreeFetch[no])) { print "bgcolor='#eeeeee'";}?>><a href="javascript:category('<?=$no?>', '<?=$sno_value?>')"><span class="user_category_normal_value"><?=$CheckRealTreeFetch[cate_name]?></span></a></td>
					</tr>
					</table>
				</td>
				</tr>
				
				<?
				}
				?>
				
				</table>
			</td>

			<?
		}
		# 카테고리 표현의 <종료>
		?>
		</tr>
		</table>
	
	</td>
	</tr>

	<!-- 검색폼의 시작 -->
	<tr><td height=5 bgcolor="#ffffff"></td></tr>
	<tr><td height=2 bgcolor="#0099cc"><img width=0 height=2></td></tr>
	<tr><td height=38 bgcolor="#dce9f1" align=center style="padding:0 0 3 0">
		
		<script language="javascript">
		function ProductSearch() {
			if(!ProductForm.q.value) {
			alert("검색어를 입력하시기 바랍니다.              ");
			ProductForm.q.focus();
			return false;
			}
			ProductForm.action = "/search/search.php";
		}
		</script>
	
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<form name="ProductForm" method="post" onsubmit="return ProductSearch()">
		<td style="padding:4 3 0 5"><img src="../image/icon/icon3.gif" width="15" height="15" border="0"></td>
		<td style="padding:5 5 0 5" class="user_product_search_value">상품검색 : </td>
		<td><input type="radio" name="search_Form" value="all" checked> 전체상품</td>
		<td width=10></td>
		<td><input type="radio" name="search_Form" value="category"> 현재 카테고리</td>
		<td width=5></td>
		<td style="padding:3 0 0 5"><input type="text" name="q" size=25></td>
		<td style="padding:3 0 0 5"><input type="image" src="../image/icon/icon4.gif" width="66" height="23" border="0"></td>
		</tr>
		</form>
		</table>

	</td></tr>
	<!-- 검색폼의 종료 -->
	
	
	</table>
	<!-- 카테고리의 정보표현 <종료> -->
</td>
</tr>
</table>
<?
include "../template/footer.php";
?>
</body>
</html>
<?
mysql_close($connection);
?>
