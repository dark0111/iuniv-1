	<?
	include("../sub/mall/dark_include/mall_func.php");
	$rt=order_goods_show($order_code);
	$sst=order_show($order_code);
	echo"
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
		<td align='center'><input type='button' value=' 리스트 ' class='button' onclick=\"history.go(-1)\"> &nbsp;&nbsp; <input type='button' value=' 홈 ' class='button' onclick=\"location.href='$dark_define[site_url]'\"></td>
	</tr>
	</table>	
	";
	?>
