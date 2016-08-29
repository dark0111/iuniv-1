<?
session_start();
include "../../../include/dbcon.php";
IF($HTTP_SESSION_VARS[OLD_NO] AND $HTTP_SESSION_VARS[OLD_ID] AND $HTTP_SESSION_VARS[OLD_NAME]) {

if(!$page) { $page=1; }
if(!$limit) { $limit=50;}
if(!$row_list) { $row_list=10;}
$first = $limit*($page-1);
$last = $limit*$page;
$no = $total_record - $first;

$categoryLoadQuery = "select scn, wcn, cate_name, cate_info, extend_cate_name, cate_info from $categorySQL where no='$ccn'";
$categoryLoadSQL = mysql_query($categoryLoadQuery, $connection) or die("categoryLoadQuery error");
$categoryLoadFetch = mysql_fetch_array($categoryLoadSQL);
$extend_cate_name = $categoryLoadFetch[extend_cate_name];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>

	<title>상품관리</title>
	<link rel="STYLESHEET" type="text/css" href="../../../style/style.css">

	<script language="javascript">
	function Addprd(){
		if(confirm("'<?=$extend_cate_name?>' 에 \n상품을 등록하시겠습니까?           ")) {
			parent.page.location.href="_add.php?ccn=<?=$ccn?>&wcn=<?=$wcn?>&extend_cate_name=<?=$extend_cate_name?>";
		} else {

		}
	}

	function page(_phpself, page, limit) {
		location.href=_phpself+"?ccn=<?=$ccn?>&wcn=<?=$wcn?>&q=<?=$q?>&page="+page+"&limit="+limit;
	}
	
	function ProductView(product_code) {
		location.href="_pdt_view.php?product_code="+product_code+"&ccn=<?=$ccn?>&wcn=<?=$wcn?>&page=<?=$page?>&limit=<?=$limit?>&q=<?=$q?>";
	}

	function SearchResult() {
		if(!SearchForm.q.value) {
		alert("검색어를 입력하십시오.        ");
		SearchForm.q.focus();
		return false;
		}
		SearchForm.action="_list.php?ccn=<?=$ccn?>&wcn=<?=$wcn?>&page=<?=$page?>&limit=<?=$limit?>";
	}	
	</script>
</head>
<body>

<table border=0 cellpadding=0 cellspacing=1 bgcolor="#ffffff" width=790>

<tr bgcolor="#eeeeee" height=25>
<td width=340 colspan=2 align=center class="product_title">물품명</td>
<td width=100 align=center class="product_title">판매가</td>
<td width=80 align=center class="product_title">배송</td>
<td width=80 align=center class="product_title">할인</td>
<td width=90 align=center class="product_title">포인트</td>
<td width=100 align=center class="product_title">판매자</td>
</tr>

<tr>
<td colspan=7 align=center height=1 bgcolor="#c4c4c4"><img width=0 height=1></td>
</tr>

<?

if($q) {
	$qExtendQuery = " and (extend_cate_name like '%$q%' or product_code like '%$q%' or product_name like '%$q%' or second_product_name like '%$q%')";
} else {
	$qExtendQuery = "";
}

$CountProductQuery = "select count(no) as no from $productSQL where ccn='$ccn'".$qExtendQuery;
$CountProductSQL = mysql_query($CountProductQuery, $connection) or die("CountProductCount error");
$CountProductFetch = mysql_fetch_array($CountProductSQL);
$ResultNumRowsTotal = $CountProductFetch[0];

if(!strcmp($ResultNumRowsTotal,"0")) {
?>
<tr height=30>
<td colspan=7 align=center>현재 등록된 상품이 없습니다</td>
</tr>
<tr>
<td colspan=7 align=center height=1 bgcolor="#c4c4c4"><img width=0 height=1></td>
</tr>


<?
}

$ProductLoadQuery = "select * from $productSQL where ccn='$ccn' ".$qExtendQuery." order by no asc limit $first, $limit";
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
			<tr><td style="padding:2 0 2 0"><span class="cate_name_info">[<?=str_replace($q,"<strong>".$q."</strong>",$ProductLoadFetch[extend_cate_name])?>]</span></td></tr>
			</table>
		</td>

		<td><?=$ORIG_PRICE?><br><?=$PRICE?></td>
		<td>
		<?=$DELIVERY_TYPE?>
		</td>
		<td><?=$SALE_PRICE?></td>
		<td><?=$POINT?></td>
		<td><?=$ProductLoadFetch[company_code]?></td>
		</tr>
		<tr>
		<td colspan=7 align=center height=1 bgcolor="#c4c4c4"><img width=0 height=1></td>
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
<table border=0 cellpadding=0 cellspacing=0 width=790>
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
	<td><input type="image" src="../../image/more/product_search.gif" width="71" height="21" border="0"></td>
	</form>
	<?if($q) {?>
	<td><a href="_list.php?ccn=<?=$ccn?>&wcn=<?=$wcn?>"><img src="../../image/more/search_end.gif" width="75" height="21" border="0"></a></td>
	<?}?>
	<td><a href="javascript:Addprd()"><img src="../../image/more/product_add.gif" width="96" height="21" border="0"></a></td>
	</tr>
	</table>
</td></tr>
</table>


</body>
</html>
<script>
self.resizeTo(document.body.scrollWidth,document.body.scrollHeight); 
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
