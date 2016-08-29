<?
//session_start();
/* =====================================================
	프로그램명 : dark builder V1
  화일명 : order_list.php (주문관리)
  작성일 :
  작성자 : 유중현 ( http://gupanjang.net )
  작성자 E-Mail : dark0111@dreamwiz.com

  최종수정일 :
===================================================== */


$sub_menu = "400300";

include_once("./define_path.php");
$rs = new recordset($dbcon);

include_once("$dark_define[path]/sub/mall/dark_include/mall_func.php");

if($mode=='delete')
{
	$rs->clear();
	$rs->set_table($_table['order']);
	$rs->add_where("no=$num");
	$rs->select();
	if($rs->num_rows()!=1) { // 주문정보가 올바르지 않다면
		echo"
		<script>
			alert('주문정보가 이상합니다.');	
		</script>
		";
		exit;
	}
	$rs->delete();
	echo"
	<script>
		alert('삭제되었습니다.');	
		parent.location.reload();
	</script>
	";
}
elseif($mode=='order_state_modify')
{
	$rs->clear();
	$rs->set_table($_table['order']);
	$rs->add_where("no='$num'");
	$rs->select();

	if(!$R=$rs->fetch()) // 주문정보가 올바르지 않다면
	{ 
		echo"
		<script>
			alert('주문정보가 이상합니다.');	
		</script>
		";
		exit;
	} 
	$T_order_state=$R[order_state];//기존 주문 상태
	$R_order_state=$order_state;//변경할 주문 상태
	
	if($T_order_state==$R_order_state)
	{
		echo"
		<script>
			alert('이미 처리 되었습니다.');	
		</script>
		";
		exit;
	}

	if($T_order_state=='cancel')//주문취소 처리
	{
		echo"
		<script>
			alert('취소된 주문은 변경 불가능 합니다.');	
		</script>
		";
		exit;
	}
	elseif($T_order_state=='complete' && ($R_order_state!='cancel' || $R_order_state!='return') )//기존상태가 배송완료 인데 다른 상태로 변경시..
	{
		echo"
		<script>
			alert('배송완료된 주문이므로 주문취소 및 반품/환불 상태로 변경만 가능합니다.');	
		</script>
		";
		exit;
	}


	if($R_order_state=='complete')//배송완료로 변경 처리
	{
		set_point('',$_po_type_code['mall'],"-$R[order_point]",'상품주문','구매포인트',"$R[order_code]",$R[order_id]);
		set_point('',$_po_type_code['mall'],$R[get_point],'상품주문','구매포인트',"$R[order_code]",$R[order_id]);
	}
	elseif($R_order_state=='cancel')//주문취소
	{
		if($T_order_state=='complete')
		{
			set_point('',$_po_type_code['mall'],"$R[order_point]",'주문취소','구매포인트',"$R[order_code]",$R[order_id]);
			set_point('',$_po_type_code['mall'],"-$R[get_point]",'주문취소','구매포인트',"$R[order_code]",$R[order_id]);
		}
		$rs->clear();
		$rs->set_table($_table['order_goods']);
		$rs->add_where("order_code='$R[order_code]'");
		$rs->select();
		
		$total_basket=$rs->num_rows();
		for($c=0;$c<$total_basket;$c++)
		{
			$R_G=$rs->fetch();
			$uque="update $_table[order_goods] set sales_product_num=sales_product_num+$R_G[order_count] where no='$R_G[no]'";
			$ures = mysql_query($uque, $connection) or die("uque error");
		}

		
	}
	elseif($R_order_state=='send')
	{
		$rt=order_goods_show($R[order_code]);
		$sst=order_show($R[order_code]);
	
		$mail_body="
		<table width='700' align='center' border='0' cellpadding='0' cellspacing='0'>
		<tr>
			<td>$rt</td>
		</tr>
		<tr>
			<td height=10></td>
		</tr>
		<tr>
			<td height=10 align=right>
				송장번호:<a href='$R[delivery_url]'>$R[delivery_company] &nbsp; $R[delivery_number] </a>
			</td>
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
		rg_mail("$R[o_email]","$site_info[site_name]에서 주문하신 상품 발송 되었습니다.","$mail_body","$site_info[mail_from]","$site_info[mail_return]");
	}

	
	$rs->clear();
	$rs->set_table($_table[order]);
	$rs->add_field("order_state","$R_order_state");
	$rs->add_where("order_code='$R[order_code]'");
	$rs->update();
	
	echo"
	<script>
		alert('변경 되었습니다.');	
		parent.location.reload();
	</script>
	";
}
elseif($mode=='m_update')
{
	$rs->clear();
	$rs->set_table($_table[order]);
	$rs->add_where("order_code='$order_code'");
	$rs->clear_field();
	$rs->add_field("delivery_company","$delivery_company");
	$rs->add_field("delivery_url","$delivery_url");
	$rs->add_field("delivery_number","$delivery_number");
	$rs->add_field("admin_comment","$admin_comment");
	$rs->update();

	echo"
	<script>
		alert('수정되었습니다.');	
		parent.location.reload();
	</script>
	";
}
elseif($mode=='modify')
{
	$rs->clear();
	$rs->set_table($_table[order]);
	$rs->add_where("no=$num");
	$rs->select();
	$R=$rs->fetch();
	$rt=order_goods_show($R[order_code]);
	$sst=order_show($R[order_code]);
	
	$show="
	<iframe width=0 height=0 name=up_frame></iframe>
	<table width='700' align='center' border='0' cellpadding='0' cellspacing='0'>
	<tr>
		<td height=10></td>
	</tr>
	<tr>
		<td height=10>
			<form name=order_edit_form method=post action='./order_edit.php' target='up_frame'>
			<input type=hidden name=mode value='m_update'>
			<input type=hidden name=order_code value='$R[order_code]'>
			<table border=0 cellpadding=0 cellspacing=0>
			<tr>
				<td>배송사</td>
				<td width=550><input name='delivery_company' size=30 value=\"$R[delivery_company]\" type='text' class='input'></td>
			</tr>
			<tr>
				<td>배송사url</td>
				<td width=550><input name='delivery_url' size=50 value=\"$R[delivery_url]\" type='text' class='input'></td>
			</tr>
			<tr>
				<td>송장번호</td>
				<td width=550><input name='delivery_number' size=40  value=\"$R[delivery_number]\" type='text' class='input'></td>
			</tr>
			<tr>
				<td>comment</td>
				<td width=550><textarea name='admin_comment' cols=60 rows=10>$R[admin_comment]</textarea></td>
			</tr>
			<tr>
				<td colspan=2 align=center><input  type='submit' value='변경'></td>
			</tr>
			</table>
			</form>
		</td>
	</tr>
	<tr>
		<td height=10></td>
	</tr>
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
		<td align='center'><input type='button' value=' 닫기 ' class='button' onclick=\"self.close();\"></td>
	</tr>
	</table>	
	";
	echo"$show";
	

}
else
{
	
}
?>
