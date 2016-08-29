
<?
$arow=array();
$oque="select count(*) as t,goods_no from mall_order_goods group by goods_no order by t desc limit 20";
$ores=mysql_query($oque,$connection);
$atotal=0;
while($orow=mysql_fetch_row($ores))
{

	$gque = "select product_code,product_name,second_product_name,price from $_table[product] where no=$orow[1]";
	$gres = mysql_Query($gque, $connection) or die('gque error');
	$grow=mysql_fetch_array($gres);
	$arow[$atotal][product_code]=$grow[product_code];
	$arow[$atotal][product_name]=$grow[product_name];
	$arow[$atotal][second_product_name]=$grow[second_product_name];
	$arow[$atotal][price]=$grow[price];
	$atotal++;

}
?>
<table cellpadding="0" cellspacing="0" border=0 width=100% >
<tr>
	<td bgcolor='eeeeee' height='22' width='100%' class=uni3Dinset>&nbsp;&nbsp;추천상품</td>
</tr>
</table>
<table border=0 cellpadding=0 cellspacing=4 width=100%>

<tr>
<?

for($a=0;$a<=$atotal;$a++)
{
	$aproductcode=$arow[$a][product_code];
	$aproductname=$arow[$a][product_name];
	$asecondname=$arow[$a][second_product_name];
	$aprice=$arow[$a][price];
	echo"
	<td valign=top>
		<table border=0 cellpadding=0 cellspacing=0 >
		<tr>
			<td align=center><a href='$dark_define[site_url]/board/index.php?mode=mall_goods_show&goods_no=$aproductcode&cate_no=$cate_no'>".show_product_image("120","$aproductcode")."</a></td>
		</tr>
		<tr>
			<td align=center width=120 style='line-height:170%'>$aproductname</td>
		</tr>
		<tr>
			<td align=center>$asecondname</td>
		</tr>
		<tr>
			<td align=center>".number_format($aprice)."원</td>
		</tr>
		</table>
	</td>
	";
	if($a%4==0 && $a!=0)
	{
	echo"
</tr>
<tr><td height=15></td></tr>
<tr>
	";
	}
	
}

?>

	
</tr>

</table>
