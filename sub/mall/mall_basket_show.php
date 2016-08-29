
<table border=0 cellpadding=0 cellspacing=0 width=100%>
	<tr><td height=20></td></tr>
	<tr height=24>
		<td bgcolor="#eeeeee" height="22" width="100%" class=uni3Dinset>
			<table border=0 cellpadding=0 cellspacing=0 >
			<tr>
				<td width=75 align=center>이미지</td>
				<td width=1></td>
				<td width=190 align=center>제품명</td>
				<td width=1></td>
				<td width=150 align=center>가격</td>
				<td width=1></td>
				<td width=100 align=center>포인트</td>
				<td width=1></td>
				<td width=100 align=center>제품코드</td>
				<td width=1></td>
				<td width=80 align=center>주문수량</td>
				<td width=1></td>
				
			</tr>
			</table>
		</td>
	</tr>
	<?
	
	$total_basket=$Cbasket->basket_count();
	$total_money=0;
	$total_point=0;
	
	for($c=0;$c<$total_basket;$c++)
	{
		$brow_temp=$Cbasket->basket_fetch();
		$brow[goods_no]=$brow_temp->goods_no;
		$brow[goods_count]=$brow_temp->goods_count;
		$brow[basket_no]=$brow_temp->basket_no;

		$LoadProductQuery = "select * from $productSQL where no='$brow[goods_no]'";
		$LoadProductSQL = mysql_query($LoadProductQuery, $connection) or die("LoadProductQuery error");
		$LoadProductFetch = mysql_fetch_array($LoadProductSQL);
?>
	<tr height=24>
		<td >
			<table border=0 cellpadding=0 cellspacing=0 >
			<tr>
				<td width=75 align='center'><img src='<?=$dark_define[site_url]?>/sub/mall/dark_mall_prt_img/75/<?=$LoadProductFetch[product_code]?>_1.jpg' border='0' onerror="this.src='<?=$dark_define[site_url]?>/sub/mall/dark_mall_prt_img/none/75.gif';" style='border:1; solid;border-color:#c4c4c4;'></td>
				<td  width=1 align=center bgcolor='#494949'></td>
				<td width=190 align=center><?=$LoadProductFetch[product_name]?></td>
				<td  width=1 align=center bgcolor='#494949'></td>
				<td width=150 align=center>
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
			$total_money+=$LoadProductFetch[price]-$LoadProductFetch[sale_price];
			$total_point+=$LoadProductFetch[point];
?>
				</td>
				<td  width=1 align=center bgcolor='#494949'></td>
				<td width=100 align=center><?=$LoadProductFetch[point]?> 점</td>
				<td  width=1 align=center bgcolor='#494949'></td>
				<td width=100 align=center><?=$LoadProductFetch[product_code]?> </td>
				<td  width=1 align=center bgcolor='#494949'></td>
				
				<td width=80 align=center><?=$brow[goods_count]?> </td>
				<td  width=1 align=center bgcolor='#494949'></td>
			
			</tr>
			</table>
		</td>
	</tr>
	<tr><td height=1  bgcolor=#000000></td></tr>
	<tr><td height=1 bgcolor='#494949'></tr>
<?
	}
	?>
</table>

