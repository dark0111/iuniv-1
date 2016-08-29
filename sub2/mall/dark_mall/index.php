<?
include "include/dbcon.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<table border=0 cellpadding=0 cellspacing=0 width=100% align=center>
<tr>
<td>
	<table border=0 cellpadding=0 cellspacing=1>
	<tr>
	<td width=700 >

		<!-- 카테고리 표현 <시작> -->
		<table border=0 cellpadding=0 cellspacing=0 width=100%>
		<tr>
		<?
		# 카테고리 분류 <시작>
		$CategoryQuery = " where wcn='1'";
		$CategoryCountQuery = "select count(no) as no from $categorySQL".$CategoryQuery;
		$CategoryCountSQL = mysql_query($CategoryCountQuery, $connection) or die("CategoryCountQuery error");
		$CategoryCountFetch = mysql_fetch_array($CategoryCountSQL);

		$RealCategoryQuery = "select no, scn, wcn, cate_name, extend_cate_name, cate_info from $categorySQL ".$CategoryQuery." order by no asc";
		$RealCategorySQL = mysql_query($RealCategoryQuery, $connection) or die("RealCategoryQuery error");

		$trSel = 0;
		for($i=0;$i<$CategoryCountFetch[0];$i++) {

			$trSel++;
			$RealCategoryFetch = mysql_fetch_array($RealCategorySQL);
			if(!strcmp($trSel,5)) {
				print "</tr><tr><td colspan=4 height=10></td></tr><tr>";
				$trSel=1;
			}
			?>

			<td width=25% valign=top>
				<table border=0 cellpadding=0 cellspacing=0 width=100%>

				<tr>
				<td width=10 align=center><img src="image/icon/icon2.gif" width="4" height="4" border="0"></td>
				<td><a href="javascript:category('<?=$RealCategoryFetch[no]?>')"><span class="user_category"><?=$RealCategoryFetch[cate_name]?></span></a></td>
				</tr>
				
				<tr><td height=2></td></tr>
				
				<tr>
				<td width=10></td>
				<td>

				<?
				$SubLoadQuery = "select no, scn, wcn, cate_name, extend_cate_name, cate_info from $categorySQL where scn='$RealCategoryFetch[no]' order by no asc";
				$SubLoadSQL = mysql_Query($SubLoadQuery, $connection) or die("SubLoadQuery error");
				for($w=0;$w<3;$w++) {
					$SubLoadFetch = mysql_fetch_array($SubLoadSQL);
					?>

					<a href="javascript:category('<?=$SubLoadFetch[no]?>')"><span class="user_category_sub"><?=$SubLoadFetch[cate_name]?></span></a>

					<?
				}
				?>
				
				</td>
				</tr>

				</table>

			</td>

			<?if($trSel<4) {?>
			<td width=15 align=center>
			<img width=15 height=1>
			</td>
			<?}?>

			<?
		}
		# 카테고리 분류 <종료>
		?>
		</tr>
		</table>
		<!-- 카테고리 표현 <종료> -->

	</td>
	<td width=200 ></td>
	</tr>
	</table>

</td>
</tr>
</table>


