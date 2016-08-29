<?
include_once("../sub/mall/dark_include/mall_func.php");
?>
<?
$p_date=$p_ready_year."-".$p_ready_month."-".$p_ready_day;

$o_post=$o_post1."-".$o_post2;
$r_post=$r_post1."-".$r_post2;
$o_tel=$o_tel21."-".$o_tel22."-".$o_tel23;
$r_tel=$r_tel21."-".$r_tel22."-".$r_tel23;

reset($Cbasket->vgoods);
$i_basket=$Cbasket->basket_count();
$total_money=0;
$total_point=0;
for($cc=0;$cc<$i_basket;$cc++)
{
	$i_temp=$Cbasket->basket_fetch();
	$iaa[goods_no]=$i_temp->goods_no;
	$iaa[goods_count]=$i_temp->goods_count;
	$iaa[basket_no]=$i_temp->basket_no;

	$sProductQuery = "select * from $productSQL where no='$iaa[goods_no]'";
	$sProductSQL = mysql_query($sProductQuery, $connection) or die("sProductQuery error");
	$sProductFetch = mysql_fetch_array($sProductSQL);

	$t_money=$sProductFetch[price]-$sProductFetch[sale_price];
	
	$iQuery2[$cc] = "insert into $mall_order_goodsSQL set
	goods_no='$iaa[goods_no]',
	goods_code='$sProductFetch[product_code]',
	goods_name='$sProductFetch[product_name]',
	goods_price='$sProductFetch[price]',
	goods_sale_price='$sProductFetch[sale_price]',
	goods_point='$sProductFetch[point]',
	order_count='$iaa[goods_count]',
	order_date=now(),
	order_code='$order_code'
	";
	$total_money+=($sProductFetch[price]-$sProductFetch[sale_price])*$iaa[goods_count];
	$total_point+=$sProductFetch[point];

	//

	$uque[$cc]="update $productSQL set sales_product_num=sales_product_num-$iaa[goods_count] where no='$iaa[goods_no]'";
	//
	
}

	$iQuery = "insert into $mall_orderSQL set
	order_code='$order_code',
	order_price='$total_money',
	order_point='$use_point',
	get_point='$order_point',
	order_id='$_SESSION[ss_mb_id]',
	order_date=now(),
	o_name='$o_name',
	o_email='$o_email',
	o_tel='$o_tel',
	o_post='$o_post',
	o_address1='$o_address1',
	o_address2='$o_address2',
	r_name='$r_name',
	r_email='$r_email',
	r_tel='$r_tel',
	r_post='$r_post',
	r_address1='$r_address1',
	r_address2='$r_address2',
	order_demand='$r_demand',
	pay_type='online_bank',
	p_name='$p_name',
	p_date='$p_date'
	";

	$iSQL = @mysql_query($iQuery, $connection);
	if($iSQL)
	{
		for($cc=0;$cc<$i_basket;$cc++)
		{
			$iSQL2 = mysql_query($iQuery2[$cc], $connection) or die("iQuery2 error");
			$ures = mysql_query($uque[$cc], $connection) or die("uque error");
		}
		//취소시 제품 재고+
	}
	$rt=order_goods_show($order_code);
	$sst=order_show($order_code);
	$show="
	<table width='700' align='center' border='0' cellpadding='0' cellspacing='0'>
	<tr>
		<td>$rt</td>
	</tr>
	<tr>
		<td height=10></td>
	</tr>

	<tr>
		<td>$sst</td>
	</tr>
	<tr>
		<td align='center'><input type='button' value=' 홈 ' class='button' onclick=\"location.href='$dark_define[site_url]/board/index.php?mode=mall'\"></td>
	</tr>
	</table>	
	";
	echo"$show";
	$mail_body="
	<table width='700' align='center' border='0' cellpadding='0' cellspacing='0'>
	<tr>
		<td>$rt</td>
	</tr>
	<tr>
		<td height=10></td>
	</tr>

	<tr>
		<td>$sst</td>
	</tr>
	<tr>
		<td align='center' ><a href='$dark_define[site_url]' target='_blank'  > $dark_define[site_name] 바로가기</a></td>
	</tr>
	</table>	
	";
	dark_mail("$o_email","$dark_define[mall_name] 주문내역","$mail_body","$dark_define[admin_mail_addr]","$dark_define[admin_mail_addr]");

	$Cbasket->basket_del_all();
?>
