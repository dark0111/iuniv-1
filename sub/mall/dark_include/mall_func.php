<?
/* =====================================================
프로그램명 : dark-builder V1
화일명 : 
작성일 : 
작성자 : 유중현
작성자 E-Mail : dark0111@dreamwiz.com

최종수정일 : 2008-09-7
 ===================================================== */

	/******************************************************************************
	기능 : 주문완료 display
	사용법 : order_show(주문코드 , 테이블 고유값)
	******************************************************************************/
	function order_show($order_code='',$num='')
	{
		global $rs,$_path,$_table,$_url,$_mb,$_auth,$dark_define;
		$rs->clear();
		$rs->set_table($_table['order']);
		if($num)
		{
			$rs->add_where("no=$num");
		}
		elseif($order_code)
		{
			$rs->add_where("order_code='$order_code'");
		}
		$rs->select();
		$R=$rs->fetch();
		$total_money=$R[order_price];
		$o_name=$R[o_name];
		$o_email=$R[o_email];
		$o_tel=$R[o_tel];
		$o_post=$R[o_post];
		$o_address1=$R[o_address1];
		$o_address2=$R[o_address2];
		$r_name=$R[r_name];
		$r_email=$R[r_email];
		$r_tel=$R[r_tel];
		$r_post=$R[r_post];
		$r_address1=$R[r_address1];
		$r_address2=$R[r_address2];
		$r_demand=$R[r_demand];
		$p_date=$R[p_date];
		$p_name=$R[p_name];
		$order_point=number_format($R[order_point]);
		$get_point=number_format($R[get_pooint]);
		$total_money=number_format($total_money);
		$r_demand=nl2br($r_demand);
		$b_show="
		<table width='100%' align='center' border='0' cellpadding='0' cellspacing='0'>
		<tr>
			<td>
				<table width='100%' align='center' border='0' cellpadding='0' cellspacing='0'>
				<tr>
					<td height='3' bgcolor='#54A8BA'><img width='1' height='1'></td>
				</tr>
				<tr>
					<td height='28' class=white1_bold_15>&nbsp;&nbsp;입금 정보</td>
				</tr>
				<tr>
					<td height='1' bgcolor='#54A8BA'><img width='1' height='1'></td>
				</tr>
				</table>
				
				<table width='100%' align='center' border='0' cellpadding='0' cellspacing='6'>
				<tr>
					<td align='right'><strong>입금 계좌 정보</strong></td>
					<td width=550>농협 123456-78-45325 예금주: 유중현</td>
				</tr>
				<tr>
					<td height='1' colspan='2' bgcolor='#ECECEC'><img width='1' height='1'></td>
				</tr>
				<tr>
					<td align='right'><strong>결제금액</strong></td>
					<td>$total_money  원</td>
				</tr>
				<tr>
					<td align='right'><strong>사용포인트</strong></td>
					<td>$order_point  원</td>
				</tr>
				<tr>
					<td align='right'><strong>얻은포인트</strong></td>
					<td>$get_point  원</td>
				</tr>
				<tr>
					<td height='1' colspan='2' bgcolor='#ECECEC'><img width='1' height='1'></td>
				</tr>
				<tr>
					<td align='right'><strong>입금자 명</strong></td>
					<td>$p_name</td>
				</tr>
				<tr>
					<td height='1' colspan='2' bgcolor='#ECECEC'><img width='1' height='1'></td>
				</tr>
				<tr>
					<td align='right'><strong>입금 예정일</strong></td>
					<td>
					$p_date
					</td>
				</tr>
				<tr>
					<td height='1' colspan='2' bgcolor='#ECECEC'><img width='1' height='1'></td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td height=10></td>
		</tr>
		<tr>
			<td>
				<table width='100%' align='center' border='0' cellpadding='0' cellspacing='0'>
				<tr>
					<td height='3' bgcolor='#54A8BA'><img width='1' height='1'></td>
				</tr>
				<tr>
					<td height='28' class=white1_bold_15>&nbsp;&nbsp;주문 정보</td>
				</tr>
				<tr>
					<td height='1' bgcolor='#54A8BA'><img width='1' height='1'></td>
				</tr>
				</table>
			
				<table width='100%' align='center' border='0' cellpadding='0' cellspacing='6'>
				<tr>
					<td align='right'><strong>주문번호</strong></td>
					<td width=550>$order_code</td>
				</tr>
				<tr>
					<td height='1' colspan='2' bgcolor='#ECECEC'><img width='1' height='1'></td>
				</tr>
				<tr>
					<td align='right'><strong>이름</strong></td>
					<td width=550>$o_name</td>
				</tr>
				<tr>
					<td height='1' colspan='2' bgcolor='#ECECEC'><img width='1' height='1'></td>
				</tr>
				<tr>
					<td align='right'><strong>이메일</strong></td>
					<td>$o_email</td>
				</tr>
				<tr>
					<td height='1' colspan='2' bgcolor='#ECECEC'><img width='1' height='1'></td>
				</tr>
				<tr>
					<td align='right'><strong>연락처</strong></td>
					<td>
						$o_tel
					</td>
				</tr>
				<tr>
					<td height='1' colspan='2' bgcolor='#ECECEC'><img width='1' height='1'></td>
				</tr>
				<tr>
					<td align='right'><strong>우편번호</strong></td>
					<td>
						$o_post
						
					</td>
				</tr>
				<tr>
					<td height='1' colspan='2' bgcolor='#ECECEC'><img width='1' height='1'></td>
				</tr>
				<tr>
					<td align='right'><strong>주소</strong></td>
					<td>
						$o_address1
						<br><img width='1' height='5' /><br />
						$o_address2
				</tr>
				</table>

				<table width='100%' align='center' border='0' cellpadding='0' cellspacing='0'>
				<tr>
					<td height='3' bgcolor='#54A8BA'><img width='1' height='1'></td>
				</tr>
				<tr>
					<td height='28' class=white1_bold_15>&nbsp;&nbsp;수신자 정보&nbsp;&nbsp; </td>
				</tr>
				<tr>
					<td height='1' bgcolor='#54A8BA'><img width='1' height='1'></td>
				</tr>
				</table>
				
				<table width='100%' align='center' border='0' cellpadding='0' cellspacing='6'>
				<tr>
					<td align='right'><strong>이름</strong></td>
					<td width=550>$r_name</td>
				</tr>
				<tr>
					<td height='1' colspan='2' bgcolor='#ECECEC'><img width='1' height='1'></td>
				</tr>
				<tr>
					<td align='right'><strong>이메일</strong></td>
					<td>$r_email</td>
				</tr>
				<tr>
					<td height='1' colspan='2' bgcolor='#ECECEC'><img width='1' height='1'></td>
				</tr>
				<tr>
					<td align='right'><strong>연락처</strong></td>
					<td>
						$r_tel
						
					</td>
				</tr>
				<tr>
					<td height='1' colspan='2' bgcolor='#ECECEC'><img width='1' height='1'></td>
				</tr>
				<tr>
					<td align='right'><strong>우편번호</strong></td>
					<td>
						$r_post
						
					</td>
				</tr>
				<tr>
					<td height='1' colspan='2' bgcolor='#ECECEC'><img width='1' height='1'></td>
				</tr>
				<tr>
					<td align='right'><strong>주소</strong></td>
					<td>
						$r_address1
						<br><img width='1' height='5' /><br />
						$r_address2
					</td>
				</tr>
				</table>


				<table width='100%' align='center' border='0' cellpadding='0' cellspacing='0'>
				<tr>
					<td height='3' bgcolor='#54A8BA'><img width='1' height='1'></td>
				</tr>
				<tr>
					<td height='28' class=white1_bold_15>&nbsp;&nbsp;기타 </td>
				</tr>
				<tr>
					<td height='1' bgcolor='#54A8BA'><img width='1' height='1'></td>
				</tr>
				</table>
				<table width='100%' align='center' border='0' cellpadding='0' cellspacing='6'>
			
				<tr>
					<td align='right'><strong>요청사항</strong></td>
					 <td width=550>$r_demand</td>
				</tr>
				</table>

				<table width='100%' align='center' border='0' cellpadding='0' cellspacing='0'>
				<tr>
					<td height='1' bgcolor='#54A8BA'><img width='1' height='1'></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
				
				</table>
			</td>
		</tr>
		</table>";
		return $b_show;

	}
	/******************************************************************************
	기능 : 주문상품 display
	사용법 : order_goods_show(주문코드)
	******************************************************************************/
	function order_goods_show($order_code='')
	{
		global $rs,$_path,$_table,$_url,$_mb,$_auth,$dark_define;
		$title_style="style='color:cccccc'";//메일에도 같이 사용되는 부분이라 .css 파일 적용이 안됨.따라서 직접 style을 줌
		$b_show="
		<table border=0 cellpadding=0 cellspacing=0 width=100%>
		
		<tr><td height=20></td></tr>
		<tr height=24>
			<td bgcolor='#eeeeee' height='22' width='100%' class=uni3Dinset>
				<table border=0 cellpadding=0 cellspacing=0 >
				<tr>
					<td width=75 align=center $title_style>이미지</td>
					<td width=1></td>
					<td width=190 align=center $title_style>제품명</td>
					<td width=1></td>
					<td width=150 align=center $title_style>가격</td>
					<td width=1></td>
					<td width=100 align=center $title_style>포인트</td>
					<td width=1></td> 
					<td width=100 align=center $title_style>제품코드</td>
					<td width=1></td>
					<td width=80 align=center $title_style>주문수량</td>
					<td width=1></td>
					
				</tr>
				</table>
			</td>
		</tr>";
		
		$rs->clear();
		$rs->set_table($_table['order_goods']);
		$rs->add_where("order_code='$order_code'");
		$rs->select();
		
		$total_basket=$rs->num_rows();
		$total_money=0;
		$total_point=0;

		for($c=0;$c<$total_basket;$c++)
		{
			$R=$rs->fetch();
			

			$b_show.="
			<tr height=24>
				<td >
					<table border=0 cellpadding=0 cellspacing=0 >
					<tr>
						<td width=75 align=center><img src='$dark_define[site_url]/sub/mall/dark_mall_prt_img/75/$R[goods_code]_1.jpg' border='0' onerror=\"this.src='$dark_define[site_url]/sub/mall/dark_mall_prt_img/none/75.gif';\" style='border:1 solid;border-color:#c4c4c4;'></td>
						<td  width=1 align=center bgcolor='#494949'></td>
						<td width=190 align=center>$R[goods_name]</td>
						<td  width=1 align=center bgcolor='#494949'></td>
						<td width=150 align=center>";
						
					if($R[goods_sale_price]>0) 
					{
						$sale_price=number_format($R[goods_price]-$R[goods_sale_price]);
						$aprice=number_format($R[goods_price]);
						$b_show.="<span class='sale_price'>$aprice</span>";
						$b_show.="&nbsp;&nbsp;";
						$b_show.=" $sale_price 원 ";
					} 
					else 
					{
						$price=number_format($R[goods_price]);
						$b_show.="<span class='Price'>$price 원</span>";
					}
					$total_money+=$R[goods_price]-$R[goods_sale_price];
					$total_point+=$R[goods_point];
					$b_show.="
						</td>
						<td  width=1 align=center bgcolor='#494949'></td>
						<td width=100 align=center>$R[goods_point] 점</td>
						<td  width=1 align=center bgcolor='#494949'></td>
						<td width=100 align=center>$R[goods_code] </td>
						<td  width=1 align=center bgcolor='#494949'></td>
						
						<td width=80 align=center>$R[order_count] </td>
						<td  width=1 align=center bgcolor='#494949'></td>
					
					</tr>
					</table>
				</td>
			</tr>
			<tr><td height=1  bgcolor=#000000></td></tr>
			<tr><td height=1 bgcolor='#494949'></tr>
			";
		}
$b_show.="
	</table>";
	
return $b_show;

	}



