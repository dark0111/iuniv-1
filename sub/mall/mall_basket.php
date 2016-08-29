<?
//include_once "./dark_include/func_comm.php";
//include_once "./dark_include/dbcon.php";
//include("./dark_include/order_class.php");

if(!isset($Cbasket))
{
	session_register("Cbasket");
	$_SESSION["Cbasket"]=new Cbasket;
}


if($basket_mode=='add')
{
	$LoadProductQuery = "select * from $productSQL where no='$goods_no'";
	$LoadProductSQL = mysql_query($LoadProductQuery, $connection) or die("LoadProductQuery error");
	$LoadProductFetch = mysql_fetch_array($LoadProductSQL);
	if($LoadProductFetch[sales_product_num]<$goods_count)
	{
		echo"
		<script>
			alert('최대 주문가능 수량은 $LoadProductFetch[sales_product_num] 입니다.');	
		</script>
		";
		break;
	}
	$basket_no=mt_rand(11111,99999).date("YmdHis");
	$Cbasket->add_basket($LoadProductFetch[no],$basket_no,$LoadProductFetch[price],$goods_count,$LoadProductFetch[point]);

	echo"
	<script>
		ans=confirm('장바구니에 담겼습니다. 장바구니 페이지로 이동하시겠습니까?');	
		if(ans)
		{
			parent.location.href='$dark_define[home_file_url]?mode=mall_basket&basket_mode=show';
		}
	</script>
	";
}
if($basket_mode=='direct')
{
	$LoadProductQuery = "select * from $productSQL where no='$goods_no'";
	$LoadProductSQL = mysql_query($LoadProductQuery, $connection) or die("LoadProductQuery error");
	$LoadProductFetch = mysql_fetch_array($LoadProductSQL);
	
	if($LoadProductFetch[sales_product_num] < $goods_count)
	{
		echo"
		<script>
			alert('최대 주문가능 수량은 $LoadProductFetch[sales_product_num] 입니다. $goods_count');	
		</script>
		";
		exit;
	}
	$basket_no=mt_rand(11111,99999).date("YmdHis");
	$basket_no2=mt_rand(11111,99999).date("YmdHis");
	
	$_SESSION["Cbasket"]->add_basket($LoadProductFetch[no],$basket_no,$LoadProductFetch[price],$goods_count,$LoadProductFetch[point]);
	
	//$session_var=array($LoadProductFetch[no],$basket_no,$LoadProductFetch[price],$goods_count,$LoadProductFetch[point]);
	//session_register("session_var");	
	//$Cbasket->basket_del_all();
		/*
		$brow_temp=$Cbasket->basket_fetch();
			$total_basket=$Cbasket->basket_count();
		$brow[goods_no]=$brow_temp->goods_no;
		$brow[goods_count]=$brow_temp->goods_count;
		$brow[basket_no]=$brow_temp->basket_no;
		echo"".$brow[basket_no]."<br>".$brow[goods_count]."<br>".$brow[goods_no]."<br>".$total_basket;*/

	echo"
	<script>
		
		parent.location.href='$dark_define[home_file_url]?mode=mall_order1';
		//parent.location.href='./index2.php?mode=mall_order1';
		
	</script>
	";
}
elseif($basket_mode=='delete')
{
	$Cbasket->basket_del($basket_no);

	echo"
	<script>
		alert('삭제되었습니다.');	
		
		parent.location.reload();
		
	</script>
	";
}
elseif($basket_mode=='alldelete')
{
	$Cbasket->basket_del_all();

	echo"
	<script>
		alert('모두 삭제되었습니다.');	
		
		parent.location.href='$dark_define[site_url]';
		
	</script>
	";
}
else
{
	?>
	<iframe name=del_frame width=0 height=0></iframe>
	<script>
	function basket_del(bn)	
	{
		ans=confirm('삭제하시겠습니까?');
		if(ans)
		{
			del_frame.location.href="<?=$dark_define[home_file_url]?>?mode=mall_basket&basket_mode=delete&basket_no="+bn;				
		}
	}
	function basket_all_del()	
	{
		ans=confirm('장바구니를 비우시겠습니까?');
		if(ans)
		{
			del_frame.location.href="<?=$dark_define[home_file_url]?>?mode=mall_basket&basket_mode=alldelete";				
		}
	}
	</script>
	<table border=0 cellpadding=0 cellspacing=0 width=100%>
	
	<tr><td height=20></td></tr>
	<tr height=24>
		<td bgcolor="#eeeeee" height="22" width="100%" >
			<table border=0 cellpadding=0 cellspacing=0 >
			<tr>
				<td width=75 align=center>이미지</td>
				<td width=1></td>
				<td width=160 align=center>제품명</td>
				<td width=1></td>
				<td width=150 align=center>가격</td>
				<td width=1></td>
				<td width=100 align=center>포인트</td>
				<td width=1></td>
				<td width=100 align=center>제품코드</td>
				<td width=1></td>
				<td width=80 align=center>주문수량</td>
				<td width=1></td>
				<td width=80 align=center>삭제</td>
				<td width=1></td>
			</tr>
			</table>
		</td>
	</tr>
	<?
	$total_basket=$Cbasket->basket_count();

	for($c=0;$c<$total_basket;$c++)
	{
		$brow_temp=$Cbasket->basket_fetch();
		$brow[goods_no]=$brow_temp->goods_no;
		$brow[goods_count]=$brow_temp->goods_count;
		$brow[basket_no]=$brow_temp->basket_no;

		$LoadProductQuery = "select * from $productSQL where no='$brow[goods_no]'";
		$LoadProductSQL = mysql_query($LoadProductQuery, $connection) or die("LoadProductQuery error");
		$LoadProductFetch = mysql_fetch_array($LoadProductSQL);
	echo"
	<tr height=24>
		<td >
			<table border=0 cellpadding=0 cellspacing=0 >
			<tr>
				<td width=75 align=center><img src='$dark_define[site_url]/sub/mall/dark_mall_prt_img/75/$LoadProductFetch[product_code]_1.jpg' border='0' onerror=\"this.src='$dark_define[site_url]/sub/mall/dark_mall_prt_img/none/75.gif';\" style='border:1 solid;border-color:#c4c4c4;'></td>
				<td  width=1 align=center bgcolor='#494949'></td>
				<td width=160 align=center>$LoadProductFetch[product_name]</td>
				<td  width=1 align=center bgcolor='#494949'></td>
				<td width=150 align=center>";
				
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
		echo"
				</td>
				<td  width=1 align=center bgcolor='#494949'></td>
				<td width=100 align=center>$LoadProductFetch[point] 점</td>
				<td  width=1 align=center bgcolor='#494949'></td>
				<td width=100 align=center>$LoadProductFetch[product_code] </td>
				<td  width=1 align=center bgcolor='#494949'></td>
				
				<td width=80 align=center>$brow[goods_count] </td>
				<td  width=1 align=center bgcolor='#494949'></td>
				<td width=80 align=center><input type='button' class='button' value='삭제' onClick=\"basket_del('$brow[basket_no]')\"></td>
				<td  width=1 align=center bgcolor='#494949'></td>
			</tr>
			</table>
		</td>
	</tr>
	<tr><td height=1  bgcolor=#000000></td></tr>
	<tr><td height=1 bgcolor='#494949'></tr>
	";
	}
	?>
	<tr><td height=20></td></tr>
	<tr>
		<td align=right>
			<table border=0 cellpadding=0 cellspacing=0>
			<tr>
				<td align=right><input type='button' class='button' value='모두삭제' onClick="basket_all_del()"></td>
				<td width=20></td>
				<td align=right><input type='button' class='button' value='주문하기' onClick="location.href='<?=$dark_define[home_file_url]?>?mode=mall_order1'"></td>
			</tr>
			</table>
		</td>
	</tr>
	</table>
	<?
}
?>
