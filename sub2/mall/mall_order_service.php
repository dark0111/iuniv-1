<?
if(($order_code && $o_name ) || $num)
{
	$rs->clear();
	$rs->set_table($_table['order']);
	if($num)
	{
		$rs->add_where("no=$num");
	}
	elseif($order_code && $o_name)
	{
		$rs->add_where("order_code='$order_code' and o_name='$o_name'");
	}
	$rs->select();
	$R=$rs->fetch();
	if(!$R)
	{
		echo"
		<script>
			alert('일치하는 정보가 없습니다.');	
		</script>
		";
		exit;
	}
	else
	{
		echo"
		<script>
			parent.location.href='$dark_define[site_url]/board/$dark_define[home_file]?mode=mall_order_show&num=$R[no]&order_code=$R[order_code]';
		</script>
		";
	}

}
else
{
	if($_SESSION[ss_mb_id])
	{	//echo $_SESSION[ss_mb_id];
		$rs->clear();
		$rs->set_table($_table[order]);
		$rs->add_where("order_id='$_SESSION[ss_mb_id]'");
		$rs->select();
		$R_total=$rs->num_rows();
		
?>
		<table border=0 cellpadding=0 cellspacing=1 width='100%' bgcolor='#e1e1e1'>		
			<tr bgcolor='#eeeeee' height='26'>
				<td width=190 align=center $title_style>주문내역</td>
				<td width=75 align=center $title_style>주문일</td>
				<td width=120 align=center $title_style>주문번호</td>							
				<td width=80 align=center $title_style>가격</td>
				<td width=70 align=center $title_style>얻은포인트</td>
				<!--<td width=100 align=center $title_style>송장번호</td>-->
				<td width=70 align=center $title_style>주문진행</td>
			</tr>
<?	
				
		while($R=$rs->fetch()){
			$order_state=common_code_cd_to_val($_common_cd[order_states],$R[order_state]);	//주문상태 리턴
			$order_goods_sql = "select goods_code, goods_name from $_table[order_goods] where order_code='$R[order_code]'";
			$order_goods_ds = mysql_query($order_goods_sql, $connection) or die("공통코드[코드->값 로드{".$postcd."/".$com_cd."}] Query error");
			
		    $order_total=mysql_num_rows($order_goods_ds);                            
			for($i=0;$i<1;$i++)
			{
			$order_goods_rows = mysql_fetch_array($order_goods_ds);	
			$g_link="<a href='$dark_define[site_url]/board/".$dark_define[home_file]."?mode=mall_order_show&num=".$R[no]."&order_code=".$R[order_code]."'>";
			$g_link2="<a href='$dark_define[site_url]/board/".$dark_define[home_file]."?mode=mall_goods_show&goods_no=".$order_goods_rows[goods_code]."'>";
?>
			<tr bgcolor='#ffffff'>
				<td align='center'><?=$g_link2?><img src='<?=$dark_define[site_url]?>/sub/mall/dark_mall_prt_img/75/<?=$order_goods_rows[goods_code]?>_1.jpg' border='0' onerror="this.src='$dark_define[site_url]/sub/mall/dark_mall_prt_img/none/75.gif';" style='border:1 solid;border-color:#c4c4c4;'> </a><br><?=$g_link2.$order_goods_rows[goods_name]?><?if($order_total>1)echo"<br>외".$order_total."개"?></a></td>
				<td width=75 align=center><?=substr($R[order_date],0,10)?></td>
				<td width=120 align=center><?=$g_link.$R[order_code]?></a></td>
				<td width=80 align=center><?=number_format($R[order_price])?>원</td>
				<td width=70 align=center><?=$R[get_point]?></td>
				<!--<td width=100 align=center><a href='<?=$R[delivery_url]?>' target='_blank'><?=$R[delivery_number]?></a></td>-->
				<td width=70 align=center><?=$order_state?><?if($R[order_state]=='complete'){?><br><a href='<?=$R[delivery_url]?>' target='_blank'><?=$R[delivery_number]?></a><?}?></td>					
			</tr>
<?			}
		}
?>
		</table>
<?
	}
	else
	{
?>
	<iframe name=c_frame width=0 height=0></iframe>
	<table width="300" align="center" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td>
			<form name="search_id_form" method="post" action="<?=$dark_define[site_url]?>/board/index.php" onSubmit="return validate(this)" target='c_frame'>
			<input type="hidden" name="mode" value="<?=$mode?>">
			<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td height="3" bgcolor="#54A8BA"><img width="1" height="1"></td>
			</tr>
			<tr>
				<td height="28" class=white1_bold_15>&nbsp;주문조회</td>
			</tr>
			<tr>
				<td height="1" bgcolor="#54A8BA"><img width="1" height="1"></td>
			</tr>
			</table>
			<table width="100%" align="center" border="0" cellpadding="0" cellspacing="6">
			<tr>
				<td width="80" align="right"><strong>주문번호</strong>&nbsp;</td>
				<td width="130"><input type="text" class="input" name="order_code" size="20"  hname="주문번호" required tabindex="1"></td>
				<td rowspan="3"><input name="submit" type="submit" class="button" value=" 확 인 " style="height:50;width:60" tabindex="4"></td>
			</tr>
			<tr>
				<td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
			</tr>
			<tr>
				<td align="right"><strong>주문자명</strong></td>
				<td>
					<input type="text" class="input" name="o_name" size="20" required  hname="주문자명" value="" span="2" >
				</td>
			</tr>
			<tr>
				<td height="1" colspan="3" bgcolor="#ECECEC"><img width="1" height="1"></td>
			</tr>
			</table>
			<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td height="1" bgcolor="#54A8BA"><img width="1" height="1"></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			</table>
			</form>		
		</td>
	</tr>
	</table>
	<?
	}
}
?>
