<?
session_start();
IF($HTTP_SESSION_VARS[ON_ID] AND $HTTP_SESSION_VARS[ON_NAME] AND $HTTP_SESSION_VARS[ON_EMAIL]) {
include "../../../include/dbcon.php";
$CATEVALUE = "<a href=\"/\" class='user_category_value'>홈</a> > <a href=\"/myShopping/myShop.html\" class='user_category_value'>나의쇼핑정보</a>";
$CATEVALUE .= " > <a href=\"/myShopping/sell/sellhome.html\" class='user_category_value'>".$HTTP_SESSION_VARS[ON_NAME]."님의 판매상품 홈</a> > 등록대기 상품";

if(!$page) { $page=1; }
if(!$limit) { $limit=50;}
if(!$row_list) { $row_list=10;}
$first = $limit*($page-1);
$last = $limit*$page;
$no = $total_record - $first;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title><?=$HTTP_SESSION_VARS[ON_NAME]?>의 등록대기 상품</title>
	<link rel="STYLESHEET" type="text/css" href="../../../style/style.css">
	<script language="javascript">
	function page(_phpself, page, limit) {
		location.href=_phpself+"?q=<?=$q?>&page="+page+"&limit="+limit;
	}
	
	function ProductView(product_code) {
		location.href="../chgpdt/_pdt_view.php?product_code="+product_code+"&page=<?=$page?>&limit=<?=$limit?>&q=<?=$q?>";
	}

	function SearchResult() {
		if(!SearchForm.q.value) {
		alert("검색어를 입력하십시오.        ");
		SearchForm.q.focus();
		return false;
		}
		SearchForm.action="<?=$PHP_SELF?>?page=<?=$page?>&limit=<?=$limit?>";
	}	
	</script>	
</head>
<body>
<?
include "../../../template/head.php";
?>
<table border=0 cellpadding=0 cellspacing=0 width=900 align=center>
<tr>
<td bgcolor="#ffffff">
	<table broder=0 cellpadding=0 cellspacing=0 width=100%>
	<tr>
	<td bgcolor="#ffffff" class="user_category_value"><?=$CATEVALUE;?></td>
	</tr>
	<tr><td height=5 bgcolor="#ffffff"></td></tr>
	<tr><td height=1 bgcolor="#eeeeee"></td></tr>
	<tr><td height=5 bgcolor="#ffffff"></td></tr>
	<tr>
	<td bgcolor="#ffffff" width="900" align=center>

		<table border=0 cellpadding=0 cellspacing=1 bgcolor="#ffffff" width=900>
		<tr bgcolor="#eeeeee" height=25>
		<td width=370 colspan=2 align=center class="product_title">물품명</td>
		<td width=80 align=center class="product_title">현상태</td>
		<td width=100 align=center class="product_title">판매가</td>
		<td width=80 align=center class="product_title">배송</td>
		<td width=80 align=center class="product_title">할인</td>
		<td width=90 align=center class="product_title">포인트</td>
		<td width=100 align=center class="product_title">판매자</td>
		</tr>
		
		<tr>
		<td colspan=8 align=center height=1 bgcolor="#c4c4c4"><img width=0 height=1></td>
		</tr>
		
		<?
		
		if($q) {
			$qExtendQuery = " and user_type='0' and (extend_cate_name like '%$q%' or product_code like '%$q%' or product_name like '%$q%' or second_product_name like '%$q%')";
		} else {
			$qExtendQuery = " and user_type='0'";
		}
		
		$CountProductQuery = "select count(no) as no from $productSQL where company_code='$HTTP_SESSION_VARS[ON_ID]'".$qExtendQuery;
		$CountProductSQL = mysql_query($CountProductQuery, $connection) or die("CountProductCount error");
		$CountProductFetch = mysql_fetch_array($CountProductSQL);
		$ResultNumRowsTotal = $CountProductFetch[0];
		
		if(!strcmp($ResultNumRowsTotal,"0")) {
		?>
		<tr height=30>
		<td colspan=8 align=center>현재 등록된 상품이 없습니다</td>
		</tr>
		<tr>
		<td colspan=8 align=center height=1 bgcolor="#c4c4c4"><img width=0 height=1></td>
		</tr>

		<?
		}
		$ProductLoadQuery = "select * from $productSQL where company_code='$HTTP_SESSION_VARS[ON_ID]' ".$qExtendQuery." order by no asc limit $first, $limit";
		$ProductLoadSQL = mysql_query($ProductLoadQuery, $connection) or die("ProductLoadQuery error");
		
		for($i=0;$i<$limit;$i++) {
			$ProductLoadFetch = mysql_fetch_array($ProductLoadSQL);
			if($ProductLoadFetch[0]) {
			?>
				<tr align=center>
				<td width=90 style="padding:5 0 5 0"><img src="../../../prt_img/75/<?=$ProductLoadFetch[product_code]?>_1.jpg" width="75" height="75" border="0" onerror="this.src='../../../prt_img/none/75.gif';" style="border:1 solid;border-color:#c4c4c4;"></td>
				
				<?
					// 세일된 금액이 있을 경우 별도 계산을 시작합니다. <시작>
					IF($ProductLoadFetch[sale_price]>0) {
						$ORIG_PRICE = "<span class='sale_price'>".NUMBER_FORMAT($ProductLoadFetch[price])."원</span>";
						$PRICE = "<span class='price'>".NUMBER_FORMAT($ProductLoadFetch[price] - $ProductLoadFetch[sale_price])."원</span>";
						$SALE_PRICE = "<span class='sale_money'>".NUMBER_FORMAT($ProductLoadFetch[sale_price])."원</span>";
					} ELSE {
						$ORIG_PRICE = "<span class='price'>".NUMBER_FORMAT($ProductLoadFetch[price])."원</span>";
						$PRICE = "&nbsp;";
						$SALE_PRICE = "&nbsp;";
					}
					// 세일된 금액이 있을 경우 별도 계산을 시작합니다. <종료>
					
					IF($ProductLoadFetch[point]>0) {
						$POINT = "<span class='point'>".NUMBER_FORMAT($ProductLoadFetch[point])."점</span>";
					} ELSE {
						$POINT = "&nbsp;";
					}
		
					IF(!STRCMP($ProductLoadFetch[delivery_type],"착불")) { 
						$DELIVERY_TYPE = "착불<br>결제가능";
					} ELSE IF(!STRCMP($ProductLoadFetch[delivery_type],"선불")) { 
						$DELIVERY_TYPE = "선불";
					} ELSE IF(!STRCMP($ProductLoadFetch[delivery_type],"")) { 
						$DELIVERY_TYPE = "무료배송";
					}
				?>

				<td align=left width=250 valign=top style="padding:5 0 5 0;line-height:16px;">
					<table border=0 cellpadding=0 cellspacing=0>
					<tr><td style="padding:2 0 2 0"><a href="javascript:ProductView('<?=$ProductLoadFetch[product_code]?>')" class="link_10px"><?=str_replace($q,"<strong>".$q."</strong>",$ProductLoadFetch[product_name])?></a></td></tr>
					<tr><td style="padding:2 0 2 0"><span class="second_product_title"><?=str_replace($q,"<strong>".$q."</strong>",$ProductLoadFetch[second_product_name])?></span></td></tr>
					<tr><td style="padding:2 0 2 0"><a href="/lar_category/lar_category.php?no=<?=$ProductLoadFetch[ccn]?>"><span class="cate_name_info">[<?=str_replace($q,"<strong>".$q."</strong>",$ProductLoadFetch[extend_cate_name])?>]</span></a></td></tr>
					</table>
				</td>

				<td><img src="../../../image/myshopping/sell/icon<?=$ProductLoadFetch[user_type]?>.gif" width="66" height="25" border="0"></td>
				<td><?=$ORIG_PRICE?><br><?=$PRICE?></td>
				<td>
				<?=$DELIVERY_TYPE?>
				</td>
				<td><?=$SALE_PRICE?></td>
				<td><?=$POINT?></td>
				<td><?=$ProductLoadFetch[company_code]?></td>
				</tr>
				<tr>
				<td colspan=8 align=center height=1 bgcolor="#c4c4c4"><img width=0 height=1></td>
				</tr>
			<?
			}
		}
		?>
		
		</table>
		
		
		<!-- 쪽번호의 시작 -->
		<table border=0 cellpadding=0 cellspacing=0 align=center>
		<tr>
		<?
		$total_page = ceil($ResultNumRowsTotal/$limit);
		$total_block = ceil($total_page/$row_list);
		$block = ceil($page/$row_list);
		$first_page=($block-1)*$row_list;
		
		$last_page=$block*$row_list;
		
		$prev = $first_page;
		$next = $last_page+1;
		$go_page = $first_page+1;
		if($total_block <= $block) {$last_page=$total_page;}
		?>
		
		<?if($block > 1) {?>
		<td style="padding:10 6 0 6"><a href="javascript:page('<?=$PHP_SELF?>', '1', '<?=$limit?>')" class="normal_page">처음페이지</a> ... </td>
		<td style="padding:10 5 0 0"><a href="javascript:page('<?=$PHP_SELF?>', '<?=$prev?>', '<?=$limit?>')" class="normal_page">이전10개</a></td>
		<?}?>
		<?for($go_page; $go_page <= $last_page; $go_page++){  ?>
		
			<?if($page == $go_page) {?>
			<td style="padding:10 6 0 6"><span class="select_page_number"><?=$go_page?></span></td>
			<?} else  {?>
			<td style="padding:10 6 0 6"><a href="javascript:page('<?=$PHP_SELF?>', '<?=$go_page?>', '<?=$limit?>')" class="page_number"><?=$go_page?></a></td>
			<?}?>
		<?}?>
		
		<?if($block < $total_block){?>
		<td style="padding:10 0 0 5"><a href="javascript:page('<?=$PHP_SELF?>', '<?=$next?>', '<?=$limit?>')" class="normal_page">다음10개</a></td>
		<td style="padding:10 6 0 6"> ... <a href="javascript:page('<?=$PHP_SELF?>', '<?=$total_page?>', '<?=$limit?>')" class="normal_page">마지막페이지</a> </td>
		<?}?>
		
		</tr>
		</table>
		<!--/ 쪽번호의 끝 -->
		
		
		<hr size=1 color="#ffffff">
		<table border=0 cellpadding=0 cellspacing=0 width=900>
		<tr><td align=right>
			<table border=0 cellpadding=2 cellspacing=0>
			<tr>
			<form name="SearchForm" method="post" onsubmit="return SearchResult()">
			<input type="hidden" name="ccn" value="<?=$ccn?>">
			<input type="hidden" name="wcn" value="<?=$wcn?>">
			<input type="hidden" name="page" value="<?=$page?>">
			<input type="hidden" name="limit" value="<?=$limit?>">
			<input type="hidden" name="extend_cate_name" value="<?=$extend_cate_name?>">
			<td><input type="text" name="q" size=30 maxlength=20 value="<?=$q?>"></td>
			<td><input type="image" src="../../../image/more/product_search.gif" width="71" height="21" border="0"></td>
			</form>
			<?if($q) {?>
			<td><a href="<?=$PHP_SELF?>?ccn=<?=$ccn?>&wcn=<?=$wcn?>"><img src="../../../image/more/search_end.gif" width="75" height="21" border="0"></a></td>
			<?}?>
			</tr>
			</table>
		</td></tr>
		</table>
	
	</td>
	</tr>
	</table>

</td></tr>
</table>	

<?
include "../../../template/footer.php";
?>
</body>
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
