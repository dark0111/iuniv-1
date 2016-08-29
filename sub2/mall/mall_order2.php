<script>

</script>

<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
<tr>
	<td>
	<?
	include"../sub/mall/mall_basket_show.php";
	
	$count_post=count($_POST);
	$pass_input="";
	$temp_array=array();
	$v_v = array_keys($_POST);
	$v_v = array_unique($v_v);

	foreach ( $v_v as $pv_name ) 
	{
		if(strlen($pv_name)===0) continue;
		$pv_value = $_POST[$pv_name];
		$pass_input.="
		<input type=hidden name=$pv_name value=\"$pv_value\">
		";
	}
	/*
	$t_r_code=rg_get_uniqid(3);
	$order_code=$t_r_code."_".date("YmdHis");
	$ocQuery = "select no from $$mall_orderSQL where order_code='$order_code'";
	$ocSQL = mysql_query($ocQuery, $connection) or die("ocQuery error");
	$ocCount = mysql_num_rows($ocSQL);
	*/
	$ocCount=1;
	while($ocCount > 0)
	{
		$t_r_code=rg_get_uniqid(3);
		$order_code=$t_r_code."_".date("YmdHis");
		$ocQuery = "select no from $mall_orderSQL where order_code='$order_code'";
		$ocSQL = mysql_query($ocQuery, $connection) or die("ocQuery error");
		$ocCount = mysql_num_rows($ocSQL);
	}
	?>
	</td>
</tr>
<tr>
	<td height=10></td>
</tr>
<tr>
	<td>
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td height="3" bgcolor="#54A8BA"><img width="1" height="1"></td>
		</tr>
		<tr>
			<td height="28" class=white1_bold_15>&nbsp;&nbsp;입금 정보</td>
		</tr>
		<tr>
			<td height="1" bgcolor="#54A8BA"><img width="1" height="1"></td>
		</tr>
		</table>
		<form name="order2_form" method="post" onsubmit="return validate(this)" action="<?=$dark_define[site_url]?>/board/index.php" >
		<input type="hidden" name="mode" value="mall_order3">
		<input type="hidden" name="order_code" value="<?=$order_code?>">
		<?=$pass_input?>
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="6">
		<tr>
			<td align="right"><strong>입금 계좌 정보</strong></td>
			<td width=550>농협 123456-78-45325 예금주: 유중현</td>
		</tr>
		<tr>
			<td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
		</tr>
		<tr>
			<td align="right"><strong>결제금액</strong></td>
			<td><?=number_format($total_money)?>  원</td>
		</tr>
		<tr>
			<td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
		</tr>
		<tr>
			<td align="right"><strong>입금자 명</strong></td>
			<td><input type="text" class="input" name="p_name" size="20" maxlength="20" minbyte="2"  hname="입금자 이름" value="" option="hanonly" required></td>
		</tr>
		<tr>
			<td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
		</tr>
		<tr>
			<td align="right"><strong>입금 예정일</strong></td>
			
				
			<td>
			<select name=p_ready_year><?=rg_html_option($year_array,date("Y"))?></select> &nbsp;
			<select name=p_ready_month><?=rg_html_option($month_array,date("m"))?></select> &nbsp;
			<select name=p_ready_day><?=rg_html_option($day_array,date("d"))?></select>
			</td>
		</tr>
		<tr>
			<td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
		</tr>
		</table>


		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td height="1" bgcolor="#54A8BA"><img width="1" height="1"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td align="center"><input type="submit" value=" 다 음 >> " class="button"></td>
		</tr>
		</table>
		</form>
	</td>
</tr>
</table>
