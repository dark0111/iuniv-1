<?
/* =====================================================
	프로그램명 : dark builder V1
  화일명 : order_list.php (주문관리)
  작성일 :
  작성자 : 유중현
  작성자 E-Mail : dark0111@dreamwiz.com
===================================================== */
$sub_menu = "400300";

include_once("./define_path.php");


$rs_list = new recordset($dbcon);
$rs_list->clear();
$rs_list->set_table($_table[order]);
//echo  $ss[1]."/".$_table[order]."/".$__k."/".$p_str;

	if(is_array($ss)) {
		foreach($ss as $__k => $__v) {
			switch ($__k) {
				/***********************************************************************/
				// 검색어로 검색
				// 1=>'회원아이디',2=>'회원성명',3=>'주문번호',4=>'수신주소',5=>'전화번호', 6=>'이메일'
				case '0' : 
					if($kw!='' && $__v!='') {
						$ss_kw=$dbcon->escape_string($kw,DB_LIKE);
						switch ($__v) {
							case '1' : $rs_list->add_where("order_id LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
							case '2' : $rs_list->add_where("o_name LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
							case '3' : $rs_list->add_where("order_Code LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
							case '4' : $rs_list->add_where("(r_address1 LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."' OR r_address2 LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."') "); break;
							case '5' : $rs_list->add_where("o_tel LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
						
							case '7' : $rs_list->add_where("o_email LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
						}
						unset($ss_kw);
					}
					break; 
				/***********************************************************************/
				// 필터 조건에 의한 필터링
				case '1' : // 회원상태
					if($__v != '') { $rs_list->add_where("$__v =  order_state"); } break;
			}
		}
	}

	switch ($ot) {
		case 10 : $rs_list->add_order("no DESC");		break;
		default : $rs_list->add_order("no DESC");		break;
	}
	
	$page_info=$rs_list->select_list($page,20,10);

	$MENU_L='m10';	

?>

<script>
function confirm_del(href)
{
	if(confirm("정말 삭제하시겠습니까?")) 
		order_frame.location.href = href;
}
function confirm_modify(href)
{
	if(confirm("정말 수정하시겠습니까?")) 
	{
		order_frame.location.href = href+'&order_state='+document.getElementById('order_state').value;
	}
}
function member_mail(){
	if(!chk_checkbox(list_form,'chk_nums[]',true)){
		alert('한명이상 선택 하세요.');
		return;
	}
	list_form.mode.value='check';
	list_form.action='member_mail.php';
	list_form.submit();
}
function member_del(){
	if(!chk_checkbox(list_form,'chk_nums[]',true)){
		alert('한명이상 선택 하세요.');
		return;
	}
	list_form.mode.value='delete';
	list_form.action='<?=$p_str?>';
	list_form.submit();
}
</script>

<iframe name=order_frame width=0 height=0></iframe>
<table border="1" cellpadding="6" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
  <tr>
    <td bgcolor="#F7F7F7">주문목록</td>
  </tr>
</table>
<br>
<table width="100%" cellspacing="0" style="border-collapse:collapse;table-layout:auto">
<form name="search_form" method="get" enctype="multipart/form-data">
<tr>
	<td>
		상태 : 
		<select name="ss[1]" onChange="search_form.submit()">
		<option value="">=전체=</option>
		<?
		echo rg_sql_html_option(common_code_ds($_common_cd[order_states]),"$ss[1]",'com_cd','cd_value');
		?>
		</select>
		검색: 
		<select name="ss[0]">
		<?
		$ss_list = array(1=>'회원아이디',2=>'회원성명',3=>'주문번호',4=>'회원주소',5=>'전화번호',6=>'이메일');
		?>
		<?=rg_html_option($ss_list,"$ss[0]")?>
		</select>
		<input name="kw" type="text" id="kw" value="<?=$kw?>" size="14" class="input"> <input type="submit" name="검색" value="검색" class="button">
		<input type="button" value="취소" onclick="location.href='?'" class="button">
	</td>
	<td align="right">
		Total :
		<?=$page_info['total_rows']?>
		(<?=$page_info['page']?>/<?=$page_info['total_page']?>)
	</td>
</tr>
</form>
<tr>
	<td>
	*배송완료 처리시 포인트 지급/차감이 이루어 집니다.<br>
	*주문취소 처리시 포인트 환급/차감이 이루어 집니다.<br>
	*발송 처리전에 송장번호를 입력 하십시요.<br>
	*배송완료 처리후에는 반품 및 주문 취소만 가능합니다.<br>
	
	</td>
</tr>
</table>
<br>
<form name="list_form" method="post" enctype="multipart/form-data" action="?<?=$p_str?>">
<input name="mode" type="hidden" value="">
<table border="1" cellpadding="0" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" onmouseover="list_over_color(event,'#FFE6E6',1)" onmouseout='list_out_color(event)'>
	<tr align="center" bgcolor="#F0F0F4">
		
		<td width="30" >comment</td>
		<td width="30" >삭제</td>
		<td width="40" >번호</td>
		<td>아이디</td>
		<td>주문상태</td>
		<td>얻은포인트</td>
		<td>사용포인트</td>
		<td>결제가격</td>
		<td>연락처</td>
		<td>결제방법</b></td>		
		<td>주문일</td>
		<td>송장번호</td>
		</tr>
<?
	if($rs_list->num_rows()<1) {
?>
	<tr height="100">
		<td align="center" colspan="12"><B>등록(검색) 된 자료가 없습니다.</td>
	</tr>
<?
	}	
	$no = $page_info['start_no'];
	while($R=$rs_list->fetch()) {
		$no--;
?>
	<tr height="25">
		<td align="center"><a style="cursor:pointer" onclick="window.open('order_edit.php?<?=$p_str?>&page=<?=$page?>&mode=modify&num=<?=$R[no]?>','delivery','scrollbars=yes,width=750,height=600')">수정</a></td>
		<td align="center"><a href="#" onClick="confirm_del('order_edit.php?<?=$p_str?>&page=<?=$page?>&mode=delete&num=<?=$R[no]?>')">삭제</a></td>
		<td align="center"><?=$no?></td>
		<td align="center"><?=$R[order_id]?>&nbsp;</td>
		<td align="center" align=absmiddle>
		<?
		if($R[order_state]=='cancel')
		{
			echo"취소";
		}
		else
		{
		?>
			<select name=order_state id=order_state align=absmiddle>
			<?echo rg_sql_html_option(common_code_ds($_common_cd[order_states]),$R[order_state],'com_cd','cd_value')?>
			</select>
			<input type="button" value="변경" class="button" onClick="confirm_modify('order_edit.php?<?=$p_str?>&page=<?=$page?>&mode=order_state_modify&num=<?=$R[no]?>')" align=absmiddle></td>
		<?}?>
		<td align="center"><?=number_format($R[get_point])?></td>
		<td align="center"><?=number_format($R[order_point])?></td>
		<td align="center"><?=number_format($R[order_price])?></td>
		<td align="center"><?=$R[o_tel]?></td>
		<td align="center"><?=$R[pay_type]?><br /></td>		
		<td align="center"><?=substr($R[order_date],0,10)?></td>
		<td align="center"><a href="<?=$R[delivery_url]?>" target='_blank'><?=$R[delivery_number]?></a>&nbsp;</td>	
		</tr>
<?
}
?>
</table>
</form>
<table width="100%">
	<tr>
		
		<td align="center">
<?=rg_navi_display($page_info,$_get_param[2]); ?>
		</td>
	</tr>
</table>


