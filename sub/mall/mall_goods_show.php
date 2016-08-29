<?

$categoryLoadQuery = "select no, scn, wcn, cate_name, cate_info from $categorySQL where no='$cate_no'";
$categoryLoadSQL = mysql_query($categoryLoadQuery, $connection) or die("categoryLoadQuery error");
$categoryLoadFetch = mysql_fetch_array($categoryLoadSQL);
$category_Value = $categoryLoadFetch[extend_cate_name];

$PNO = $cate_no;

if($categoryLoadFetch[wcn]>2) {
	$no = $categoryLoadFetch[scn];
}

if($sno) {

	$sCateQuery = "select no, scn, wcn, cate_name,  cate_info from $categorySQL where no='$sno'";
	$sCateSQL = mysql_query($sCateQuery, $connection) or die("sCateQuery error");
	$sCateFetch = mysql_fetch_array($sCateSQL);
	$category_Value = $sCateFetch[cate_name];
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
			$CATEVALUE .= " > <a href=\"$dark_define[home_file_url]?mode=mall_goods_list&cate_no=$CATEGORYLOAD_FETCH[no]\" class='user_category_value'>".$category_ValueExplode[$b]."</a>";
		} else {
			$CATEVALUE .= " > ".$category_ValueExplode[$b];
		}
	}
}



$LoadProductQuery = "select * from $productSQL where product_code='$goods_no'";
$LoadProductSQL = mysql_query($LoadProductQuery, $connection) or die("LoadProductQuery error");
$LoadProductFetch = mysql_fetch_array($LoadProductSQL);

// 카테고리의 표현 <종료>
?>
<script>
	function basket_add()
	{
		document.basket_form.basket_mode.value='add';
		document.basket_form.mode.value='mall_basket';
		document.basket_form.submit();
	}
	function direct_order()
	{
		document.basket_form.basket_mode.value='direct';
		document.basket_form.mode.value='mall_basket';
		document.basket_form.submit();
	}
</script>
<?
echo"
<table border=0 cellpadding=0 cellspacing=4 width=100%>
<tr>
	<td>$CATEVALUE</td>
</tr>
<tr>
	<td>
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
			<td width=300 align=center>".show_product_image("280","$LoadProductFetch[product_code]")."</td>
			<td width=400 align=center valign=top>";
			?>
				<iframe name="basket_frame" width=0 height=0 border=0></iframe>

				<table border=0 cellpadding=0 cellspacing=3 width=100%>
				
				<tr>
					<td height="20" onMouseOver="this.style.cursor='hand'; this.style.backgroundColor='#3e3e3e';" onMouseOut="this.style.backgroundColor='';">&nbsp;&nbsp;<img src="<?=$dark_define[site_url]?>/sub/mall/dark_mall_image/icon/bul.gif" border=0 align=absmiddle>&nbsp;&nbsp;상품명 : &nbsp;<?=$LoadProductFetch[product_name]?></td>
				</tr>
				<tr><td height=1  bgcolor=#000000></td></tr>
				<tr><td height=1 bgcolor="#494949"></tr>
				<tr>
					<td height="20" onMouseOver="this.style.cursor='hand'; this.style.backgroundColor='#3e3e3e';" onMouseOut="this.style.backgroundColor='';">&nbsp;&nbsp;<img src="<?=$dark_define[site_url]?>/sub/mall/dark_mall_image/icon/bul.gif" border=0 align=absmiddle>&nbsp;&nbsp;간단설명 : &nbsp;<?=$LoadProductFetch[second_product_name]?></td>
				</tr>
				<tr><td height=1  bgcolor=#000000></td></tr>
				<tr><td height=1 bgcolor="#494949"></tr>
				<tr>
					<td height="20" onMouseOver="this.style.cursor='hand'; this.style.backgroundColor='#3e3e3e';" onMouseOut="this.style.backgroundColor='';">&nbsp;&nbsp;<img src="<?=$dark_define[site_url]?>/sub/mall/dark_mall_image/icon/bul.gif" border=0 align=absmiddle>&nbsp;&nbsp;상품코드 : &nbsp;<?=$LoadProductFetch[product_code]?></td>
				</tr>
				<tr><td height=1  bgcolor=#000000></td></tr>
				<tr><td height=1 bgcolor="#494949"></tr>
				<tr>
					<td height="20" onMouseOver="this.style.cursor='hand'; this.style.backgroundColor='#3e3e3e';" onMouseOut="this.style.backgroundColor='';">&nbsp;&nbsp;<img src="<?=$dark_define[site_url]?>/sub/mall/dark_mall_image/icon/bul.gif" border=0 align=absmiddle>&nbsp;&nbsp;제조사/원산지 : &nbsp;<?=$LoadProductFetch[make_in]?>/<?=$LoadProductFetch[made_in]?></td>
				</tr>
				<tr><td height=1  bgcolor=#000000></td></tr>
				<tr><td height=1 bgcolor="#494949"></tr>
				<tr>
					<td height="20">
						<table border=0 cellpadding=0 cellspacing=0 width=100%>
						<tr>
							<td  width=120 onMouseOver="this.style.cursor='hand'; this.style.backgroundColor='#3e3e3e';" onMouseOut="this.style.backgroundColor='';">&nbsp;&nbsp;<img src="<?=$dark_define[site_url]?>/sub/mall/dark_mall_image/icon/bul.gif" border=0 align=absmiddle>&nbsp;&nbsp;색상 및 종류 : &nbsp;</td>
							<td valign=top>
							<?
					$color_class_explode = explode(chr(13), nl2br(trim($LoadProductFetch[color_class])));

					for($i=0;$i<20;$i++) {
						if($color_class_explode[$i]) {
							print "<strong>".($i+1)."</strong>.".trim($color_class_explode[$i])."<br>";
							
						}
					}
					?>
							</td>
						</tr>
						</table>
					</td>
				</tr>
				<tr><td height=1  bgcolor=#000000></td></tr>
				<tr><td height=1 bgcolor="#494949"></tr>
				<tr>
					<td height="20">
						<table border=0 cellpadding=0 cellspacing=0 width=100%>
						<tr>
							<td  width=100 onMouseOver="this.style.cursor='hand'; this.style.backgroundColor='#3e3e3e';" onMouseOut="this.style.backgroundColor='';">&nbsp;&nbsp;<img src="<?=$dark_define[site_url]?>/sub/mall/dark_mall_image/icon/bul.gif" border=0 align=absmiddle>&nbsp;&nbsp;판매금액 : &nbsp;</td>
							<td valign=top>
							<?
			if($LoadProductFetch[sale_price]>0) 
			{
				print "<span class='sale_price'>".number_format($LoadProductFetch[price])."원</span>";
				print "&nbsp;&nbsp;";
				print number_format($LoadProductFetch[price]-$LoadProductFetch[sale_price])."원";

			} 
			else 
			{
				print "<span class='Price'>".number_format($LoadProductFetch[price])."원</span>";
			}
			?>
							</td>
						</tr>
						</table>
					</td>
				</tr>
				<tr><td height=1  bgcolor=#000000></td></tr>
				<tr><td height=1 bgcolor="#494949"></tr>
				<tr>
					<td height="20" onMouseOver="this.style.cursor='hand'; this.style.backgroundColor='#3e3e3e';" onMouseOut="this.style.backgroundColor='';">&nbsp;&nbsp;<img src="<?=$dark_define[site_url]?>/sub/mall/dark_mall_image/icon/bul.gif" border=0 align=absmiddle>&nbsp;&nbsp;포인트 : &nbsp;<?if($LoadProductFetch[point]>0) { print number_format($LoadProductFetch[point])."점"; } else { print "포인트 없음";}?></td>
				</tr>
				<tr><td height=1  bgcolor=#000000></td></tr>
				<tr><td height=1 bgcolor="#494949"></tr>
				<tr>
					<td height="20">
						<table border=0 cellpadding=0 cellspacing=0 width=100%>
						<form name=basket_form action="<?=$dark_define['home_file_url']?>" method=post target='basket_frame'>
						<input type=hidden name='mode' value="mall_basket">
						<input type=hidden name='basket_mode' value="add">
						<input type=hidden name=goods_no value="<?=$LoadProductFetch[no]?>">
						<tr>
							<td  width=100 onMouseOver="this.style.cursor='hand'; this.style.backgroundColor='#3e3e3e';" onMouseOut="this.style.backgroundColor='';">&nbsp;&nbsp;<img src="<?=$dark_define[site_url]?>/sub/mall/dark_mall_image/icon/bul.gif" border=0 align=absmiddle>&nbsp;&nbsp;주문수량 : &nbsp;</td>
							<td valign=top><input type=text name=goods_count size=10 value=1></td>
						</tr>
						</form>
						</table>
					</td>
				</tr>
				<tr><td height=1  bgcolor=#000000></td></tr>
				<tr><td height=1 bgcolor="#494949"></tr>
				<tr>
					<td height="20">
						<table border=0 cellpadding=0 cellspacing=4 width=100%>
						<tr>
							<td height="28" class="uni3D" align=center  style='cursor:pointer'  onclick="direct_order();"><span class="order_btn">바로구매 하기</span></td>
							<td height="28" class="uni3D" align=center style='cursor:pointer' onclick="basket_add();"><span class="order_btn">장바구니 담기</span></td>
						</tr>
						</table>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
	</td>
</tr>
<tr><td height=20></td></tr>
<tr height=24>
	<td bgcolor="#eeeeee" height="22" width="100%">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
			<td style="padding:5 0 0 20">상품설명</td>
		</tr>
		</table>
	</td>
</tr>

<tr>
	<td height=5  valign=top>

		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr>
			<td width=40><img width=40 height=0></td>
			<td valign=top style="border:1;dashed;border-color:#eeeeee;">
				<?
				/*$product_contents_load = $LOAD_DIRECTORY."cnt/".$product_code.".itp";
				$product_contents_load_file = @file($product_contents_load, "r");
				$product_contents_load_count = @count($product_contents_load_file);
				for($i=0;$i<$product_contents_load_count;$i++) {
				print STR_REPLACE('\"', '"', $product_contents_load_file[$i]);
				}*/
				
				?>
				<?=nl2br($LoadProductFetch[product_exp])?>
			</td>
			<td width=20></td>
		</tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>
	</td>
</tr>
<!-- 주의사항 -->
<tr height=24>
	<td bgcolor="#eeeeee" height="22" width="100%">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
			<td style="padding:5 0 0 20">주의사항 [텍스트]</td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td height=5 >
		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr>
			<td width=40></td>
			<td width=730><?=nl2br($LoadProductFetch[product_attention])?></td>
			<td width=20></td>
		</tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>

	</td>
</tr>

<tr>
	<td>
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
			<td></td>
		</tr>
		</table>
	</td>
</tr>
</table>
