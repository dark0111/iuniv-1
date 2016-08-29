<?
session_start();
include "../../../include/dbcon.php";
IF($HTTP_SESSION_VARS[ON_ID] AND $HTTP_SESSION_VARS[ON_NAME] AND $HTTP_SESSION_VARS[ON_EMAIL]) {

if($no and !strcmp(($wcn-1),"1")) {

	$NoneCategory = "update $categorySQL set cv='0' where wcn='".($wcn-1)."'";
	mysql_query($NoneCategory, $connection) or die("NoneCategory error");
	$CateUpdateQuery = "update $categorySQL set cv='1' where no='$no' and wcn='".($wcn-1)."'";
	mysql_query($CateUpdateQuery, $connection) or die("CateUpdateQuery error");

} else if($no and !strcmp(($wcn-1),"2")) {

	$NoneCategory = "update $categorySQL set cv='0' where wcn='".($wcn-1)."'";
	mysql_query($NoneCategory, $connection) or die("NoneCategory error");
	$CateUpdateQuery = "update $categorySQL set cv='1' where no='$no' and wcn='".($wcn-1)."'";
	mysql_query($CateUpdateQuery, $connection) or die("CateUpdateQuery error");

} else if($no and !strcmp(($wcn-1),"3")) {

	$NoneCategory = "update $categorySQL set cv='0' where wcn='".($wcn-1)."'";
	mysql_query($NoneCategory, $connection) or die("NoneCategory error");
	$CateUpdateQuery = "update $categorySQL set cv='1' where no='$no' and wcn='".($wcn-1)."'";
	mysql_query($CateUpdateQuery, $connection) or die("CateUpdateQuery error");

}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>카테고리 관리</title>
	<link rel="STYLESHEET" type="text/css" href="../../../style/style.css">
	<style>
	.page {
		font-size:10pt;
		font-family:굴림; 
		color:#666666;
		text-decoration:none;
		padding:3 0 0 0;
		line-height:16px;
	}	

	.none {
		font-size:10pt;
		font-family:굴림; 
		color:#000000;
		font-weight: none;
	}

	.nones {
		font-size:10pt;
		font-family:굴림; 
		color:#000000;
		font-weight: bold;
	}

	</style>

	<script language="javascript">
	function addc() {
		location.href="category_select.php";
	}

	function pre() {
		location.href="category_select.php";
	}
	
	function adds(no, scn, wcn) {
		location.href="category_select.php?no="+no+"&wcn="+wcn;
	}
	
	<?
	if($no) {
	?>
	function check() {
		<?
		if($nc) {
		?>
		FormCheck.ct_<?=$nc?>.focus();
		<?
		} else {
		?>
		FormCheck.ct_<?=$no?>.focus();
		<?
		}
		?>
	}
	<?
	}
	?>
	
	function reForm(ccn, wcn, cateView) {
		// ccn = no
		// wcn = scn
		// cateView = extend_cate_name
		opener.ProductForm.ccn.value = ccn;
		opener.ProductForm.wcn.value = wcn;
		opener.ProductForm.extend_cate_name.value = cateView;
		this.close();
	}
	
	</script>
</head>


<body bgcolor="#ffffff" leftmargin=15 scroll="yes" <?if($no) { print "onload='check()'";}?>>

<?
// 대분류 카테고리가 있는지 확인한다.
$CategoryCountQuery = "select count(no) as no from $categorySQL where wcn='1'";
$CategoryCountSQL = mysql_query($CategoryCountQuery, $connection) or die("CategoryCountQuery error");
$CategoryCountFetch = mysql_fetch_array($CategoryCountSQL);
?>

<?
// 대분류 카테고리가 존재할 경우
if($CategoryCountFetch[0]>0) {
?>

<!-- 타이틀 <시작> -->
<table border=0 cellpadding=0 cellspacing=0 width=304 height=25>
<tr>
<td class="title">카테고리를 선택하시기 바랍니다.</td>
</tr>
</table>
<!-- 타이틀 <종료> -->


<table border=0 cellpadding=0 cellspacing=0 width=300>
<tr>
<td valign=top bgcolor="#ffffff">

	<table border=0 cellpadding=0 cellspacing=0 width=300>
	<form name="FormCheck">
	<?
	// 대분류를 불러온다. <시작>
	$categoryLoadQuery = "select no, scn, wcn, cate_name, cate_info, extend_cate_name, cv from $categorySQL where wcn='1' order by no asc";
	$categoryLoadSQL = mysql_query($categoryLoadQuery, $connection) or die("categoryLoadQuery error");
	for($i=0;$i<$CategoryCountFetch[0];$i++) {
	$categoryLoadFetch = mysql_fetch_array($categoryLoadSQL);
	?>
	<tr>
	<td height=25>
		<table border="0" cellpadding=0 cellspacing=0 height=20>
		<tr>
		<td><img src="../../../image/icon/folder<?if(!strcmp($no, $categoryLoadFetch[0])) { print "s";}?>.gif" width="15" height="16" border="0"></td>
		<td style="padding:3 3 0 3" <?if(!strcmp($no, $categoryLoadFetch[0])) { ?>bgcolor="#C5E7F6" style="border:1 dashed;border-color:#666666;"<?} else if(!strcmp($nc, $categoryLoadFetch[0])) { ?>bgcolor="#ffcc99" style="border:1 dashed;border-color:#666666;"<?}?>><a class="none<?if(!strcmp($no, $categoryLoadFetch[0])) { print "s";}?>" href="javascript:adds('<?=$categoryLoadFetch[no]?>', '<?=$categoryLoadFetch[no]?>', '<?=$categoryLoadFetch[wcn]+1?>')"><?=$categoryLoadFetch[cate_name]?></a> (<?=$categoryLoadFetch[cate_info]?>)</td>
		<td style="padding:0 0 0 5"><?if(!strcmp($no, $categoryLoadFetch[0])) {?><a href="javascript:reForm('<?=$categoryLoadFetch[no]?>','<?=$categoryLoadFetch[scn]?>','<?=$categoryLoadFetch[extend_cate_name]?>')"><img src="../../../image/more/image20.gif" width="33" height="20" border="0"></a><?}?></td>
		</tr>
		<tr><td colspan=3><input type="text" name="ct_<?=$categoryLoadFetch[no]?>" style="width:1;height:1;border:1 solid;border-color:#ffffff"></td></tr>
		</table>
	</td>
	</tr>
		<?
		if(!strcmp($categoryLoadFetch[cv],"1")) {
		// 중분류를 불러온다. <시작>

		$Extend_2_Query = " where scn='$categoryLoadFetch[no]' and wcn='2' ";
		
		$category_2_CountQuery = "select count(no) as no from $categorySQL".$Extend_2_Query;
		$category_2_CountSQL = mysql_query($category_2_CountQuery, $connection) or die("category_2_CountQuery error");
		$category_2_CountFetch = mysql_fetch_array($category_2_CountSQL);

		if($category_2_CountFetch[0]>0) {
	
			$category_2_LoadQuery = "select no, scn, wcn, cate_name, cate_info, extend_cate_name, cv from $categorySQL".$Extend_2_Query." order by no asc";
			$category_2_LoadSQL = mysql_query($category_2_LoadQuery, $connection) or die("category_2_LoadQuery error");
	
			for($i2=0;$i2<$category_2_CountFetch[0];$i2++) {
	
				$category_2_LoadFetch = mysql_fetch_array($category_2_LoadSQL);
				?>
				
				<tr>
				<td height=25>

					<table border="0" cellpadding=0 cellspacing=0>
					<tr>
					<td width=20><img width=20 height=0></td>
					<td><img src="../../../image/icon/folder<?if(!strcmp($no, $category_2_LoadFetch[0])) { print "s";}?>.gif" width="15" height="16" border="0"></td>
					<td style="padding:3 3 0 3" <?if(!strcmp($no, $category_2_LoadFetch[0])) { ?>bgcolor="#C5E7F6" style="border:1 dashed;border-color:#666666;"<?} else if(!strcmp($nc, $category_2_LoadFetch[0])) { ?>bgcolor="#ffcc99" style="border:1 dashed;border-color:#666666;"<?}?>><a class="none<?if(!strcmp($no, $category_2_LoadFetch[0])) { print "s";}?>" href="javascript:adds('<?=$category_2_LoadFetch[no]?>', '<?=$category_2_LoadFetch[no]?>', '<?=$category_2_LoadFetch[wcn]+1?>')"><?=$category_2_LoadFetch[cate_name]?></a> (<?=$category_2_LoadFetch[cate_info]?>)</td>
					<td style="padding:0 0 0 5"><?if(!strcmp($no, $category_2_LoadFetch[0])) {?><a href="javascript:reForm('<?=$category_2_LoadFetch[no]?>','<?=$category_2_LoadFetch[scn]?>','<?=$category_2_LoadFetch[extend_cate_name]?>')"><img src="../../../image/more/image20.gif" width="33" height="20" border="0"></a><?}?></td>
					</tr>
					<tr><td colspan=4><input type="text" name="ct_<?=$category_2_LoadFetch[no]?>"  style="width:1;height:1;border:1 solid;border-color:#ffffff"></td></tr>
					</table>
				
				</td>
				</tr>

				<?
				// 소분류를 불러온다. <시작>
				
				if(!strcmp($category_2_LoadFetch[cv],"1")) {
				
				$Extend_3_Query = " where scn='$category_2_LoadFetch[no]' and wcn='3' ";
				
				$category_3_CountQuery = "select count(no) as no from $categorySQL".$Extend_3_Query;
				$category_3_CountSQL = mysql_query($category_3_CountQuery, $connection) or die("category_3_CountQuery error");
				$category_3_CountFetch = mysql_fetch_array($category_3_CountSQL);
	
				if($category_3_CountFetch[0]>0) {
					
					$category_3_LoadQuery = "select no, scn, wcn, cate_name, cate_info, extend_cate_name, cv from $categorySQL".$Extend_3_Query." order by no asc";
					$category_3_LoadSQL = mysql_query($category_3_LoadQuery, $connection) or die("category_3_LoadQuery error");
		
					for($i3=0;$i3<$category_3_CountFetch[0];$i3++) {
			
						$category_3_LoadFetch = mysql_fetch_array($category_3_LoadSQL);
						?>
						
						<tr>
						<td height=25>
							
							<table border="0" cellpadding=0 cellspacing=0>
							<tr>
							<td width=40><img width=40 height=0></td>
							<td><img src="../../../image/icon/folder<?if(!strcmp($no, $category_3_LoadFetch[0])) { print "s";}?>.gif" width="15" height="16" border="0"></td>
							<td style="padding:3 3 0 3"<?if(!strcmp($no, $category_3_LoadFetch[0])) { ?>bgcolor="#C5E7F6" style="border:1 dashed;border-color:#666666;"<?} else if(!strcmp($nc, $category_3_LoadFetch[0])) { ?>bgcolor="#ffcc99" style="border:1 dashed;border-color:#666666;"<?}?>><a class="none<?if(!strcmp($no, $category_3_LoadFetch[0])) { print "s";}?>" href="javascript:adds('<?=$category_3_LoadFetch[no]?>', '<?=$category_3_LoadFetch[no]?>', '<?=$category_3_LoadFetch[wcn]+1?>')"><?=$category_3_LoadFetch[cate_name]?></a> (<?=$category_3_LoadFetch[cate_info]?>)</td>
							<td style="padding:0 0 0 5"><?if(!strcmp($no, $category_3_LoadFetch[0])) {?><a href="javascript:reForm('<?=$category_3_LoadFetch[no]?>','<?=$category_3_LoadFetch[scn]?>','<?=$category_3_LoadFetch[extend_cate_name]?>')"><img src="../../../image/more/image20.gif" width="33" height="20" border="0"></a><?}?></td>
							</tr>
							<tr><td colspan=4><input type="text" name="ct_<?=$category_3_LoadFetch[no]?>"  style="width:1;height:1;border:1 solid;border-color:#ffffff"></td></tr>
							</table>

						</td>
						</tr>
		
						<?
						// 상세분류를 불러온다. <시작>
						if(!strcmp($category_3_LoadFetch[cv],"1")) {
						$Extend_4_Query = " where scn='$category_3_LoadFetch[no]' and wcn='4' ";
						
						$category_4_CountQuery = "select count(no) as no from $categorySQL".$Extend_4_Query;
						$category_4_CountSQL = mysql_query($category_4_CountQuery, $connection) or die("category_4_CountQuery error");
						$category_4_CountFetch = mysql_fetch_array($category_4_CountSQL);
			
						if($category_4_CountFetch[0]>0) {
							
							$category_4_LoadQuery = "select no, scn, wcn, cate_name, extend_cate_name, cate_info from $categorySQL".$Extend_4_Query." order by no asc";
							$category_4_LoadSQL = mysql_query($category_4_LoadQuery, $connection) or die("category_4_LoadQuery error");
				
							for($i4=0;$i4<$category_4_CountFetch[0];$i4++) {
					
								$category_4_LoadFetch = mysql_fetch_array($category_4_LoadSQL);
								?>
								
								<tr>
								<td height=25>
									
									<table border="0" cellpadding=0 cellspacing=0>
									<tr>
									<td width=60><img width=60 height=0></td>
									<td><img src="../../../image/icon/folder<?if(!strcmp($no, $category_4_LoadFetch[0])) { print "s";}?>.gif" width="15" height="16" border="0"></td>
									<td style="padding:3 3 0 3"<?if(!strcmp($no, $category_4_LoadFetch[0])) { ?>bgcolor="#C5E7F6" style="border:1 dashed;border-color:#666666;"<?} else if(!strcmp($nc, $category_4_LoadFetch[0])) { ?>bgcolor="#ffcc99" style="border:1 dashed;border-color:#666666;"<?}?>><a class="none<?if(!strcmp($no, $category_4_LoadFetch[0])) { print "s";}?>" href="javascript:adds('<?=$category_4_LoadFetch[no]?>', '<?=$category_4_LoadFetch[no]?>', '<?=$category_4_LoadFetch[wcn]+1?>')"><?=$category_4_LoadFetch[cate_name]?></a> (<?=$category_4_LoadFetch[cate_info]?>)</td>
									<td style="padding:0 0 0 5"><?if(!strcmp($no, $category_4_LoadFetch[0])) {?><a href="javascript:reForm('<?=$category_4_LoadFetch[no]?>','<?=$category_4_LoadFetch[scn]?>','<?=$category_4_LoadFetch[extend_cate_name]?>')"><img src="../../../image/more/image20.gif" width="33" height="20" border="0"></a><?}?></td>
									</tr>
									<tr><td colspan=4><input type="text" name="ct_<?=$category_4_LoadFetch[no]?>"  style="width:1;height:1;border:1 solid;border-color:#ffffff"></td></tr>
									</table>
								
								</td>
								</tr>
							
							<?
							}
						}
						}
						// 상세분류를 불러온다. <종료>
						?>


					<?
					}
				}
				}
				// 소분류를 불러온다. <종료>
				?>
		
			
			<?
			}
		}
		}
		// 중분류를 불러온다. <종료>
		?>


	<?
	}
	// 대분류를 불러온다. <종료>
	?>
	</form>
	</table>

</td>
</tr>
</table>


<?
// 대분류 카테고리가 존재하지 않을 경우 
} else {
?>

<table border=0 cellpadding=0 cellspacing=0 width=200 height=400>
<tr>
<td bgcolor="#ffffff" align=center>
	<table border=0 cellpadding=0 cellspacing=0>
	<tr><td class="none">대분류가 존재하지 않습니다</td></tr>
	</table>
</td>
</tr>
</table>

<?
}
?>

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
