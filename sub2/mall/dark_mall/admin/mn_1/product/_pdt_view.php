<?
session_start();
include "../../../include/dbcon.php";
IF($HTTP_SESSION_VARS[OLD_NO] AND $HTTP_SESSION_VARS[OLD_ID] AND $HTTP_SESSION_VARS[OLD_NAME]) {

// 저장될 디렉토리의 정보를 가져옵니다.
INCLUDE "../../../prt_img/load_dir.php";

$ExtendName = array("jpg", "gif", "png");

$product_image_number = 1;
for($n=1;$n<6;$n++) {
	for($i=0;$i<3;$i++) {
		if(file_exists($LOAD_DIRECTORY."75/".$product_code."_".$n.".".$ExtendName[$i])) {
			$product_image_number = $product_image_number+1;
			${"prt_".$n} = $ExtendName[$i];
		}
	}
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>상품관리</title>
	<link rel="STYLESHEET" type="text/css" href="../../../style/style.css">

	<script language="javascript">
	function PrdList() {
		location.href="./_list.php?ccn=<?=$ccn?>&wcn=<?=$wcn?>&page=<?=$page?>&limit=<?=$limit?>&q=<?=$q?>";
	}
	
	function PrdModify() {
		location.href="_modify.php?product_code=<?=$product_code?>&ccn=<?=$ccn?>&wcn=<?=$wcn?>&page=<?=$page?>&limit=<?=$limit?>&q=<?=$q?>";
	}
	
	function PrdDelete() {
	
		if(confirm("본 상품정보를 삭제하시겠습니까?     ")) {
			location.href="_result.php?result=drop&product_code=<?=$product_code?>&ccn=<?=$ccn?>&wcn=<?=$wcn?>&page=<?=$page?>&limit=<?=$limit?>";
		}
	}
	</script>
	
<?
$LoadProductQuery = "select * from $productSQL where product_code='$product_code'";
$LoadProductSQL = mysql_query($LoadProductQuery, $connection) or die("LoadProductQuery error");
$LoadProductFetch = mysql_fetch_array($LoadProductSQL);
?>
	
</head>
<body>


<table border=0 cellpadding=0 cellspacing=0 width=790>
<tr>
<td>
	<table border=0 cellpadding=0 cellspacing=0 bgcolor="#ffffff">
	<!-- HR -->
	<tr><td height=25>

		<table border=0 cellpadding=0 cellspacing=0 width=790 height=37>
		<tr>
		<td align=center background="../../image/more/title_main.gif">
			<table border=0 cellpadding=0 cellspacing=0>
			<tr><td height=15></td></tr>
			<tr height=22>
			<td width=40></td>
			<td width=750 class="hr_text">상품등록시 필수정보 확인!</td>
			</tr>
			</table>
		</td>
		</tr>
		<tr><td height=20></td></tr>
		</table>

	</td></tr>
	<!-- HR -->

	<!-- 회사코드 -->
	<tr height=24>
	<td background="../../image/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">회사코드</td></tr>
		</table>
	</td>
	</tr>


	<tr><td height=5 bgcolor="#ffffff">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730 class="input_bold">
		<?=$LoadProductFetch[company_code]?>
		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>

	</td></tr>
	
	<!-- 상품코드 -->
	<tr height=24>
	<td background="../../image/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">상품코드</td></tr>
		</table>
	</td>
	</tr>

	<tr><td height=5 bgcolor="#ffffff">

		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730 class="input_bold">
		<?=$LoadProductFetch[product_code]?>
		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>

	</td></tr>

	<!-- 상품이 등록될 카테고리 -->
	<tr height=24>
	<td background="../../image/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">카테고리</td></tr>
		</table>
	</td>
	</tr>

	<tr><td height=5 bgcolor="#ffffff">

		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730 class="input_bold">
		<?=$LoadProductFetch[extend_cate_name]?>
		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>

	</td></tr>
		

	<!-- HR -->
	<tr><td height=25>
		<table border=0 cellpadding=0 cellspacing=0 width=790 height=37>
		<tr>
		<td align=center background="../../image/more/title_main.gif">
			<table border=0 cellpadding=0 cellspacing=0>
			<tr><td height=15></td></tr>
			<tr height=22>
			<td width=40></td>
			<td width=750 class="hr_text">상품의 기본정보 입력!</td>
			</tr>
			</table>
		</td>
		</tr>
		<tr><td height=20></td></tr>
		</table>

	</td></tr>
	<!-- HR -->

	
	<!-- 상품명 -->
	<tr height=24>
	<td background="../../image/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">상품명</td></tr>
		</table>
	</td>
	</tr>

	<tr><td height=5 bgcolor="#ffffff">

		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730 class="bold_name">
		<?=$LoadProductFetch[product_name]?>
		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>
	
	</td></tr>
	
	<!-- 부타이틀 -->
	<tr height=24>
	<td background="../../image/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">부 타이틀</td></tr>
		</table>
	</td>
	</tr>

	<tr><td height=5 bgcolor="#ffffff">

		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730 class="bold_name">
		<?=$LoadProductFetch[second_product_name]?>
		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>
	
	</td></tr>


	<!-- 상품이미지 -->
	<tr height=24>
	<td background="../../image/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">상품이미지</td></tr>
		</table>
	</td>
	</tr>

	<tr><td height=150 bgcolor="#ffffff">

		<table border=0 cellpadding=0 cellspacing=0 width=790>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730 height=150>
			<table border=0 cellpadding=0 cellspacing=0 height=150>
			<tr>
			<?
			for($img=1;$img<6;$img++) {
			?>
			<td style="padding:0 10 0 10"><img src="<?if(${"prt_".$img}){ print "http://".$_SERVER[HTTP_HOST]."/prt_img/120/".$product_code."_".$img.".".${"prt_".$img}; } else { print "../../image/more/image13.gif";}?>" name="prd_image<?=$img?>" width="120" height="120" border="0" <?if(!strcmp($img,"1")) {?>style="border:2 solid;border-color:#66ccff;"<?}?>></td>
			<?
			}
			?>
			</tr>
			</table>
		</td><td width=20></td></tr>
		
		<tr><td colspan=3 height=10 align=center></td></tr>

		<tr><td colspan=3 height=10 align=center style="line-height:20px;">
		<font style='letter-spacing:1px'>
		이미지의 3가지로 사이즈로 분류되어 자동 압축 저장됩니다. <br>
		<strong>1</strong>. 75*75, <strong>2</strong>.120*120, <strong>3</strong>.280*280
		</font>
		</td></tr>
		
		<tr><td colspan=3 height=10></td></tr>
		</table>
	

	</td></tr>


	<!-- 상품설명 -->
	<tr height=24>
	<td background="../../image/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">상품설명</td></tr>
		</table>
	</td>
	</tr>
	
	<tr><td height=5 bgcolor="#ffffff" valign=top>

		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40><img width=40 height=0></td><td width=730 height=500 valign=top style="border:1 dashed;border-color:#eeeeee;">
			<?
			$product_contents_load = $LOAD_DIRECTORY."cnt/".$product_code.".itp";
			$product_contents_load_file = @file($product_contents_load, "r");
			$product_contents_load_count = @count($product_contents_load_file);
			for($i=0;$i<$product_contents_load_count;$i++) {
				print STR_REPLACE('\"', '"', $product_contents_load_file[$i]);
			}
			?>
		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>
	
	</td></tr>


	<!-- 주의사항 -->
	<tr height=24>
	<td background="../../image/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">주의사항 [텍스트]</td></tr>
		</table>
	</td>
	</tr>
	
	<tr><td height=5 bgcolor="#ffffff">

		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730>
			
			<?=nl2br($LoadProductFetch[product_attention])?>
			

		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>
	
	</td></tr>
	
	<!-- HR -->
	<tr><td height=25>
		<table border=0 cellpadding=0 cellspacing=0 width=790 height=37>
		<tr>
		<td align=center background="../../image/more/title_main.gif">
			<table border=0 cellpadding=0 cellspacing=0>
			<tr><td height=15></td></tr>
			<tr height=22>
			<td width=40></td>
			<td width=750 class="hr_text">상품의 부가정보 입력!</td>
			</tr>
			</table>
		</td>
		</tr>
		<tr><td height=20></td></tr>
		</table>

	</td></tr>
	<!-- HR -->


	<!-- 제조사 -->
	<tr height=24>
	<td background="../../image/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">제조사</td></tr>
		</table>
	</td>
	</tr>
		
	<tr><td height=5 bgcolor="#ffffff">

		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730 class="bold_name">
		<?=$LoadProductFetch[make_in]?>
		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>
	
	</td></tr>

	
	<!-- 원산지 -->
	<tr height=24>
	<td background="../../image/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">원산지</td></tr>
		</table>
	</td>
	</tr>


	<tr><td height=5 bgcolor="#ffffff">

		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730 class="bold_name">
		<?=$LoadProductFetch[made_in]?>
		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>
	
	</td></tr>

	
	<!-- 색상 및 종류 -->
	<tr height=24>
	<td background="../../image/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">상품의 색상 및 종류 입력!</td></tr>
		</table>
	</td>
	</tr>
	
	<tr><td height=5 bgcolor="#ffffff">

		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730 style="line-height:20px">
			<?
			$color_class_explode = explode(chr(13), nl2br(trim($LoadProductFetch[color_class])));

			for($i=0;$i<20;$i++) {
				if($color_class_explode[$i]) {
					print "<strong>".($i+1)."</strong>.".trim($color_class_explode[$i]);
				}
			}
			?>
		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>
	
	</td></tr>

	<!-- 판매수량 -->
	<tr height=24>
	<td background="../../image/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">판매수량</td></tr>
		</table>
	</td>
	</tr>

	<tr><td height=5 bgcolor="#ffffff">

		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730 class="bold_name">
			<?=$LoadProductFetch[sales_product_num]?>개
		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>
	
	</td></tr>

	
	<!-- HR -->
	<tr><td height=25>
		<table border=0 cellpadding=0 cellspacing=0 width=790 height=37>
		<tr>
		<td align=center background="../../image/more/title_main.gif">
			<table border=0 cellpadding=0 cellspacing=0>
			<tr><td height=15></td></tr>
			<tr height=22>
			<td width=40></td>
			<td width=750 class="hr_text">상품의 판매금액 입력!</td>
			</tr>
			</table>
		</td>
		</tr>
		<tr><td height=20></td></tr>
		</table>

	</td></tr>
	<!-- HR -->


	
	<!-- 판매금액 -->
	<tr height=24>
	<td background="../../image/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">판매금액</td></tr>
		</table>
	</td>
	</tr>

	<tr><td height=5 bgcolor="#ffffff">

		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730>
			
			<table border=0 cellpadding=0 cellspacing=0>
			<tr>
			<td style="padding:0 1 0 0"><img src="../../image/more/image17.gif" width="21" height="21" border="0"></td>
			<td style="padding:3 0 0 5">
			<?
			if($LoadProductFetch[sale_price]>0) {
				print "<span class='sale_price'>".number_format($LoadProductFetch[price])."원</span>";
				print "<br>";
				print number_format($LoadProductFetch[price]-$LoadProductFetch[sale_price])."원";

			} else {
				print "<span class='Price'>".number_format($LoadProductFetch[price])."원</span>";
			}
			?>
			
			</td>
			</tr>
			</table>
			

		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>
	
	</td></tr>
	
	<!-- 적립금 -->
	<tr height=24>
	<td background="../../image/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">포인트</td></tr>
		</table>
	</td>
	</tr>

	<tr><td height=5 bgcolor="#ffffff">

		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730>
		
			
			<table border=0 cellpadding=0 cellspacing=0>
			<tr>
			<td style="padding:0 1 0 0"><img src="../../image/more/image15.gif" width="21" height="21" border="0"></td>
			<td class="bold_name" style="padding:3 0 0 5"><?if($LoadProductFetch[point]>0) { print number_format($LoadProductFetch[point])."점"; } else { print "포인트 없음";}?> </td>
			</tr>

			</table>

		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>
	
	</td></tr>


	
	<!-- 할인 -->
	<tr height=24>
	<td background="../../image/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">할인</td></tr>
		</table>
	</td>
	</tr>

	<tr><td height=5 bgcolor="#ffffff">

		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730>
			<table border=0 cellpadding=0 cellspacing=0>
			<tr>
			<td style="padding:0 1 0 0"><img src="../../image/more/image16.gif" width="21" height="21" border="0"></td>
			<td class="bold_name" style="padding:3 0 0 5">
			<?
			if($LoadProductFetch[sale_price]>0) {
				print number_format($LoadProductFetch[sale_price])."원";
			} else {
				print "할인없음";
			}
			?>
			</td>
			</tr>
			
			</table>

		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>
	
	</td></tr>


	
	<!-- HR -->
	<tr><td height=25>
		<table border=0 cellpadding=0 cellspacing=0 width=790 height=37>
		<tr>
		<td align=center background="../../image/more/title_main.gif">
			<table border=0 cellpadding=0 cellspacing=0>
			<tr><td height=15></td></tr>
			<tr height=22>
			<td width=40></td>
			<td width=750 class="hr_text">상품의 배송정보 입력!</td>
			</tr>
			</table>
		</td>
		</tr>
		<tr><td height=20></td></tr>
		</table>

	</td></tr>
	<!-- HR -->

	
	<!-- 배송지역 -->
	<tr height=24>
	<td background="../../image/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">배송지역</td></tr>
		</table>
	</td>
	</tr>

	<tr><td height=5 bgcolor="#ffffff">

		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730 class="bold_name">

			<?=$LoadProductFetch[delivery_area]?>

		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>
	
	</td></tr>
	
	<!-- 배송비 -->
	<tr height=24>
	<td background="../../image/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">배송비</td></tr>
		</table>
	</td>
	</tr>

	<tr><td height=5 bgcolor="#ffffff">

		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730>


			<table border=0 cellpadding=0 cellspacing=0>
			<tr>
			<td style="padding:0 1 0 0"><img src="../../image/more/image17.gif" width="21" height="21" border="0"></td>
			<td class="bold_name" style="padding:3 0 0 5"><?IF(STRCMP($LoadProductFetch[delivery_type],"")) { print number_format($LoadProductFetch[delivery_money]); } ELSE { PRINT "0";}?>원</td>
			</tr>
			</table>

		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>
	
	</td></tr>

	<!-- 배송비 지불 선택 -->
	<tr height=24>
	<td background="../../image/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">배송비 지불 선택</td></tr>
		</table>
	</td>
	</tr>

	<tr><td height=5 bgcolor="#ffffff">

		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730 class="bold_name">
			<?
			IF(!STRCMP($LoadProductFetch[delivery_type],"착불")) { 
				$DELIVERY_TYPE = "착불<br>결제가능";
			} ELSE IF(!STRCMP($LoadProductFetch[delivery_type],"선불")) { 
				$DELIVERY_TYPE = "선불";
			} ELSE IF(!STRCMP($LoadProductFetch[delivery_type],"")) { 
				$DELIVERY_TYPE = "무료배송";
			}
			?>
			<?=$DELIVERY_TYPE?>

		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>
	
	</td></tr>

	<!-- 배송방법 -->
	<tr height=24>
	<td background="../../image/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">배송방법</td></tr>
		</table>
	</td>
	</tr>

	<tr><td height=5 bgcolor="#ffffff">

		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730 style="line-height:20px" class="bold_name">

			<?=$LoadProductFetch[delivery_way]?>

		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>
	
	</td></tr>


	<!-- 평균 배송일 -->
	<tr height=24>
	<td background="../../image/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">평균 배송일</td></tr>
		</table>
	</td>
	</tr>

	<tr><td height=5 bgcolor="#ffffff">

		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730 class="bold_name">

			<?=$LoadProductFetch[delivery_mean_day]?>

		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>
	
	</td></tr>


	<!-- 최대 배송일 -->
	<tr height=24>
	<td background="../../image/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">최대 배송일</td></tr>
		</table>
	</td>
	</tr>
	
	<tr><td height=5 bgcolor="#ffffff">

		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730 class="bold_name">

			<?=$LoadProductFetch[delivery_max_day]?>

		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>
	
	</td></tr>
	<!-- HR -->
	<tr><td height=25>
	<hr size=1 color="#666666">
	</td></tr>
	<!-- HR -->
	
	<tr><td align=center>
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td><a href="javascript:PrdModify()"><img src="../../image/more/product_modify.gif" width="96" height="21" border="0"></a></td>
		<td width=5></td>
		<td><a href="javascript:PrdDelete()"><img src="../../image/more/product_delete.gif" width="96" height="21" border="0"></a></td>
		<td width=5></td>
		<td><a href="javascript:PrdList()"><img src="../../image/more/product_list.gif" width="96" height="21" border="0"></a></td>
		</tr>
		</table>
	
	</td></tr>
	</table>
</td>
</tr>

</table>



</body>
</html>


<?
} ELSE {
?>
	<script language="javascript">
	location.href="/admin/";
	</script>
<?
}
?>

<?
mysql_close($connection);
?>

<script> 
self.resizeTo(document.body.scrollWidth,document.body.scrollHeight+100); 
</script> 
