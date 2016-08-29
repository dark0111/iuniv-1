<?
session_start();
include_once("../../define_path.php");
//IF($HTTP_SESSION_VARS[OLD_NO] AND $HTTP_SESSION_VARS[OLD_ID] AND $HTTP_SESSION_VARS[OLD_NAME]) 
if(1)
{
$LoadProductQuery = "select * from $productSQL where product_code='$product_code'";
$LoadProductSQL = mysql_query($LoadProductQuery, $connection) or die("LoadProductQuery error");
$LoadProductFetch = mysql_fetch_array($LoadProductSQL);

// 저장될 디렉토리의 정보를 가져옵니다.
INCLUDE $dark_define['dark_mall_prt_img_path']."/load_dir.php";
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
	<link rel="STYLESHEET" type="text/css" href="<?=$dark_define['site_url']?>/dark_css/style_mall_admin.css">
	
	<script language="javascript">
	function imageAdd() {
		product_code = ProductForm.product_code.value;
		var PreForm = window.open('__image_add.php?product_code='+product_code, 'zipcode','top=50, left=50, width=640, height=650, scrollbars=no, resizable=no, status=no, menubar=no, toolbar=no');
	}	
	
	function contents_preview() {
		contents = ProductForm.product_code.value;
		var PreForm = window.open('__image_add.php?product_code='+product_code, 'zipcode','top=50, left=50, width=640, height=650, scrollbars=no, resizable=no, status=no, menubar=no, toolbar=no');
	}
	
	function addCancel() {
		if(confirm("상품등록을 취소하시겠습니까?          ")) {
			location.href="_list.php?ccn=<?=$ccn?>&wcn=<?=$wcn?>";
		}
	}
	
	function ProductAdd() {
		if(!ProductForm.company_code.value) {
			alert("중요한 코드가 생성되지 않았습니다.        ");
			return false;
		}
		
		if(!ProductForm.product_code.value) {
			alert("상품코드가 생성되지 않았습니다.           ");
			return false;
		}
		
		if(!ProductForm.extend_cate_name.value) {
			alert("카테고리 정보가 넘어오지 않았습니다.         ");
			return false;
		}
		
		if(!ProductForm.product_name.value) {
			alert("상품명을 입력하십시오.         ");
			ProductForm.product_name.focus();
			return false;
		}
		
		if(ProductForm.product_image_number.value=="0") {
			alert("상품이미지를 등록하셔야 합니다.         ");
			imageAdd();
			return false;
		}
		
		if(!ProductForm.make_in.value) {
			alert("제조사를 입력하십시오.         ");
			ProductForm.make_in.focus();
			return false;
		}
		
		if(!ProductForm.made_in.value) {
			alert("원산지를 입력하십시오.         ");
			ProductForm.made_in.focus();
			return false;
		}
				
		if(!ProductForm.color_class.value) {
			alert("상품의 색상 및 종류를 입력하십시오.         ");
			ProductForm.color_class.focus();
			return false;
		}
		
		if(!ProductForm.sales_product_num.value) {
			alert("판매수량을 입력하십시오.         ");
			ProductForm.sales_product_num.focus();
			return false;
		}
		
		if(!ProductForm.price.value) {
			alert("판매금액을 입력하십시오.         ");
			ProductForm.price.focus();
			return false;
		}
		
		if(!ProductForm.point_check.checked) {

			if(!ProductForm.point.value) {
			alert("포인트를 입력하십시오.          ");
			ProductForm.point.focus();
			return false;
			}

		} else {

			ProductForm.point.disabled = true;

		}
		
		if(!ProductForm.sale_price_check.checked) {
			if(!ProductForm.sale_price.value) {
			alert("할인금액을 입력하십시오.      ");
			ProductForm.sale_price.focus();
			return false;
			}
			
			if(!ProductForm.sale_price_temp.value) {
			alert("'계산' 버튼을 클릭하셔야 합니다.          ");
			ProductForm.sum_button.focus();
			return false;
			}

		} else {
			ProductForm.sale_price.disabled = true;
			ProductForm.sale_price_temp.disabled = true;
		}

		
		if(!ProductForm.price.value) {
			alert("판매금액을 입력하십시오.         ");
			ProductForm.price.focus();
			return false;
		}
		
		if(!ProductForm.delivery_area.value) {
			alert("배송지역을 입력하십시오.         ");
			ProductForm.delivery_area.focus();
			return false;
		}
		
		if(!ProductForm.delivery_money_check.checked) {
			if(!ProductForm.delivery_money.value) {
				alert("배송비를 입력하십시오.         ");
				ProductForm.delivery_money.focus();
				return false;
			}
		}
		
				
		if(!ProductForm.delivery_way.value) {
			alert("배송방법을 입력하십시오.         ");
			ProductForm.delivery_way.focus();
			return false;
		}
		
		if(!ProductForm.delivery_mean_day.value) {
			alert("평균 배송일을 입력하십시오.         ");
			ProductForm.delivery_mean_day.focus();
			return false;
		}
		
		if(!ProductForm.delivery_max_day.value) {
			alert("최대 배송일을 입력하십시오.         ");
			ProductForm.delivery_max_day.focus();
			return false;
		}
		
		if(confirm("작성이 완료되었습니다.     \n상품을 등록하시겠습니까?       ")) {

			ProductForm.action = "_result.php";

		} else {

			return false;

		}
	}
	
	function NumberIns(field) {
		var valid = "1234567890";
		var ok = "yes";
		var temp;
		for (var i=0; i<field.value.length; i++) {
			temp = "" + field.value.substring(i, i+1);
			if (valid.indexOf(temp) == "-1") ok = "no";
		}
		if (ok == "no") {
			alert("숫자만 입력이 가능합니다.        ");
			field.focus();
			return false;
		}
	}
	
	function pointCheck() {
		if(ProductForm.point_check.checked) {
			ProductForm.point.disabled = true;
		} else {
			ProductForm.point.disabled = false;;
		}
	}
	
	function sale_price_check_form() {
		if(ProductForm.sale_price_check.checked) {
			ProductForm.sale_price.disabled = true;
			ProductForm.sale_price_temp.disabled = true;
		} else {
			ProductForm.sale_price.disabled = false;
			ProductForm.sale_price_temp.disabled = false;
		}
	}
	
	function sumForm() {
		if(!ProductForm.sale_price_check.checked) {

			if(!ProductForm.price.value) {
				alert("판매금액을 입력하셔야 합니다.     ");
				ProductForm.price.focus();

			} else {
				sum_price = eval(ProductForm.price.value);
				sum_price_sale = ProductForm.sale_price.value;
				
				if(sum_price_sale>=sum_price) {
					ProductForm.sale_price_temp.value = "무료";
				} else {
					ProductForm.sale_price_temp.value = sum_price - sum_price_sale;
				}
				
			}

		}
	}
	
	function delivery_check() {

		if(ProductForm.delivery_money_check.checked) {
			ProductForm.delivery_money.disabled = true;
			ProductForm.delivery_type[0].disabled = true;
			ProductForm.delivery_type[1].disabled = true;
		} else {
			ProductForm.delivery_money.disabled = false;
			ProductForm.delivery_type[0].disabled = false;
			ProductForm.delivery_type[1].disabled = false;
		}

	}
	
	
	function point_result(point) {
	
		if(ProductForm.price.value) {
			price = eval(ProductForm.price.value);
			ProductForm.point.value = price*point;
		} else {
			ProductForm.point.value = 0;
		}
	}
	
	</script>
	
	<style>
	textarea {
	  behavior:url("../../web_edit/itp_editor.htc");
	}
	
	.TextBold {
		font-size:10pt;
		font-family:굴림; 
		color:#000000;
		text-decoration:none;
		font-weight: bold;
	}

	.Price {
		font-size:10pt;
		font-family:굴림; 
		color:#000000;
		text-decoration:none;
		font-weight: bold;
	}

	
	.Sale_Price {
		font-size:10pt;
		font-family:굴림; 
		color:#0000cc;
		text-decoration:none;
		font-weight: bold;
	}

	
	.Sale_Price_Temp {
		font-size:10pt;
		font-family:굴림; 
		color:#ff0000;
		text-decoration:none;
		font-weight: bold;
	}

	</style>
	
	
</head>

<body>
<table border=0 cellpadding=0 cellspacing=0 width=790>

<form name="ProductForm" method="post" onsubmit="return ProductAdd()" enctype="multipart/form-data">
<input type="hidden" name="result" value="modify">
<input type="hidden" name="ccn" value="<?=$ccn?>">
<input type="hidden" name="wcn" value="<?=$wcn?>">
<input type="hidden" name="q" value="<?=$q?>">
<tr>
<td>
	<table border=0 cellpadding=0 cellspacing=0 bgcolor="#ffffff">
	<!-- HR -->
	<tr><td height=25>

		<table border=0 cellpadding=0 cellspacing=0 width=790 height=37>
		<tr>
		<td align=center background="../../mall_images/more/title_main.gif">
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
	<td background="../../mall_images/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">회사코드</td></tr>
		</table>
	</td>
	</tr>


	<tr><td height=5 bgcolor="#ffffff">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730>
		<input type="text" name="company_code" size="10" maxlength="10" readonly value="<?=$LoadProductFetch[company_code]?>" class="input_bold">
		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>

	</td></tr>
	
	<!-- 상품코드 -->
	<tr height=24>
	<td background="../../mall_images/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">상품코드</td></tr>
		</table>
	</td>
	</tr>

	<tr><td height=5 bgcolor="#ffffff">

		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730>

		<input type="text" name="product_code" size="10" maxlength="10" readonly value="<?=$LoadProductFetch[product_code]?>" class="input_bold">

		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>

	</td></tr>

	<!-- 상품이 등록될 카테고리 -->
	<tr height=24>
	<td background="../../mall_images/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">카테고리</td></tr>
		</table>
	</td>
	</tr>

	<tr><td height=5 bgcolor="#ffffff">

		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730>
		<input type="text" name="extend_cate_name" size=83 readonly value="<?=$LoadProductFetch[extend_cate_name]?>" class="input_bold">
		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>

	</td></tr>
		

	<!-- HR -->
	<tr><td height=25>
		<table border=0 cellpadding=0 cellspacing=0 width=790 height=37>
		<tr>
		<td align=center background="../../mall_images/more/title_main.gif">
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
	<td background="../../mall_images/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">상품명</td></tr>
		</table>
	</td>
	</tr>

	<tr><td height=5 bgcolor="#ffffff">

		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730>

		<input type="text" name="product_name" size="95" maxlength="255" value="<?=$LoadProductFetch[product_name]?>">

		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>
	
	</td></tr>
	
	<!-- 부타이틀 -->
	<tr height=24>
	<td background="../../mall_images/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">부 타이틀</td></tr>
		</table>
	</td>
	</tr>

	<tr><td height=5 bgcolor="#ffffff">

		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730>

		<input type="text" name="second_product_name" size="95" maxlength="100" value="<?=$LoadProductFetch[second_product_name]?>">

		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>
	
	</td></tr>


	<!-- 상품이미지 -->
	<tr height=24>
	<td background="../../mall_images/more/title_sub.gif">
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
			<td style="padding:0 10 0 10"><img src="<?if(${"prt_".$img}){ print $dark_define['site_url']."/sub/mall/dark_mall_prt_img/120/".$product_code."_".$img.".".${"prt_".$img}; } else { print "../../mall_images/more/image13.gif";}?>" name="prd_image<?=$img?>" width="120" height="120" border="0" <?if(!strcmp($img,"1")) {?>style="border:2 solid;border-color:#66ccff;"<?}?>></td>

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
		
		<tr><td colspan=3 height=10 align=center></td></tr>


		<tr><td colspan=3 height=10 align=center>
			<a href="javascript:imageAdd()"><img src="../../mall_images/more/image12.gif" width="96" height="21" border="0"></a>
		</td></tr>

		<tr><td colspan=3 height=10></td></tr>
		</table>
	
	<input type="hidden" name="product_image_number" value="<?=$product_image_number-1?>">

	</td></tr>


	<!-- 상품설명 -->
	<tr height=24>
	<td background="../../mall_images/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">상품설명</td></tr>
		</table>
	</td>
	</tr>
	
	<tr><td height=5 bgcolor="#ffffff">

		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40><img width=40 height=0></td><td width=730 height=500>
		<?
		/*
		$product_contents_load = $LOAD_DIRECTORY."cnt/".$product_code.".itp";
		$product_contents_load_file = @file($product_contents_load, "r");
		$product_contents_load_count = count($product_contents_load_file);
		for($i=0;$i<$product_contents_load_count;$i++) {
			$product_contents .= STR_REPLACE('\"', '"', $product_contents_load_file[$i]);
		}*/

		?><!--itp_edit="true"-->
		<textarea  cols="95" rows="14" name="product_exp"><?=$LoadProductFetch[product_exp]?></textarea>

		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>
	
	</td></tr>


	<!-- 주의사항 -->
	<tr height=24>
	<td background="../../mall_images/more/title_sub.gif">
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
			
			<textarea cols="95" rows="5" name="product_attention" style="width:700"><?=$LoadProductFetch[product_attention]?></textarea>

		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>
	
	</td></tr>
	
	<!-- HR -->
	<tr><td height=25>
		<table border=0 cellpadding=0 cellspacing=0 width=790 height=37>
		<tr>
		<td align=center background="../../mall_images/more/title_main.gif">
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
	<td background="../../mall_images/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">제조사</td></tr>
		</table>
	</td>
	</tr>
		
	<tr><td height=5 bgcolor="#ffffff">

		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730>

		<input type="text" name="make_in" size="40" maxlength="50" value="<?=$LoadProductFetch[make_in]?>">

		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>
	
	</td></tr>

	
	<!-- 원산지 -->
	<tr height=24>
	<td background="../../mall_images/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">원산지</td></tr>
		</table>
	</td>
	</tr>


	<tr><td height=5 bgcolor="#ffffff">

		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730>

		<input type="text" name="made_in" size="40" maxlength="50" value="<?=$LoadProductFetch[made_in]?>">

		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>
	
	</td></tr>

	
	<!-- 색상 및 종류 -->
	<tr height=24>
	<td background="../../mall_images/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">상품의 색상 및 종류 입력!</td></tr>
		</table>
	</td>
	</tr>
	
	<tr><td height=5 bgcolor="#ffffff">

		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730>
			<table broder=0 cellpadding=0 cellspacing=0>
			<tr><td><textarea cols="60" rows="5" name="color_class"><?=$LoadProductFetch[color_class]?></textarea></td></tr>
			<tr><td height=10></td></tr>
			<tr><td style="line-height:20px;">
			<strong>[등록방법]</strong><br>
			상품종류1<br>
			상품종류2<br>
			...<br>
			...<br>
			</td></tr>
			</table>

		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>
	
	</td></tr>

	<!-- 판매수량 -->
	<tr height=24>
	<td background="../../mall_images/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">판매수량</td></tr>
		</table>
	</td>
	</tr>

	<tr><td height=5 bgcolor="#ffffff">

		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730>

			<input type="text" name="sales_product_num" size="10" value="<?=$LoadProductFetch[sales_product_num]?>" maxlength="5" value="100" style="text-align:right"> 개

		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>
	
	</td></tr>

	
	<!-- HR -->
	<tr><td height=25>
		<table border=0 cellpadding=0 cellspacing=0 width=790 height=37>
		<tr>
		<td align=center background="../../mall_images/more/title_main.gif">
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
	<td background="../../mall_images/more/title_sub.gif">
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
			<td style="padding:0 1 0 0"><img src="../../mall_images/more/image17.gif" width="21" height="21" border="0"></td>
			<td><input type="text" name="price" size="20" value="<?=$LoadProductFetch[price]?>" maxlength="15" style="text-align:right" onblur="NumberIns(this)" class="Price"></td>
			<td style="padding:3 0 0 5" class="TextBold">원</td>
			</tr>
			</table>
			

		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>
	
	</td></tr>
	
	<!-- 적립금 -->
	<tr height=24>
	<td background="../../mall_images/more/title_sub.gif">
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
			<td style="padding:0 1 0 0"><img src="../../mall_images/more/image15.gif" width="21" height="21" border="0"></td>
			<td><input type="text" name="point" size="10" <?if(!strcmp($LoadProductFetch[point],0)) { print "disabled";} else {?> value="<?=$LoadProductFetch[point]?>" <?}?> maxlength="10" style="text-align:right" onblur="NumberIns(this)"></td>
			<td style="padding:3 0 0 5" class="TextBold">점</td>
			<td width=10></td>
			<td style="padding:3 5 0 5"><a href="javascript:point_result('0.01')">1%</a></td>
			<td width=10></td>
			<td style="padding:3 5 0 5"><a href="javascript:point_result('0.05')">5%</a></td>
			<td width=10></td>
			<td style="padding:3 5 0 5"><a href="javascript:point_result('0.10')">10%</a></td>
			<td width=10></td>
			<td style="padding:3 5 0 5"><a href="javascript:point_result('0.15')">15%</a></td>
			<td width=10></td>
			<td style="padding:3 5 0 5"><a href="javascript:point_result('0.20')">20%</a></td>
			<td width=10></td>
			<td><input type="checkbox" name="point_check" <?if(!strcmp($LoadProductFetch[point],0)) { print "checked";}?> onclick="javascript:pointCheck()" value"1"></td>
			<td style="padding:3 0 0 0">사용안함</td>
			</tr>

			<tr><td colspan=14 height=10></td></tr>

			<tr><td colspan=14>
			포인트를 이용하실 경우 입력하시기 바랍니다. 
			</td></tr>
			
			</table>

		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>
	
	</td></tr>


	
	<!-- 할인 -->
	<tr height=24>
	<td background="../../mall_images/more/title_sub.gif">
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
			<td style="padding:0 1 0 0"><img src="../../mall_images/more/image16.gif" width="21" height="21" border="0"></td>
			<td><input type="text" name="sale_price" size="8" <?if(!strcmp($LoadProductFetch[sale_price],"0")) { print "disabled";} else {?> value="<?=$LoadProductFetch[sale_price]?>" <?}?> maxlength="6" style="text-align:right" onblur="NumberIns(this)" onchange="javascript:sumForm()" class="Sale_Price"></td>
			<td style="padding:3 0 0 5" class="TextBold">원</td>
			<td width=5></td>
			<td style="padding:0 1 0 0"><img src="../../mall_images/more/image17.gif" width="21" height="21" border="0"></td>
			<td><input type="text" name="sale_price_temp" size="20" <?if(!strcmp($LoadProductFetch[sale_price],"0")) { print "disabled";} else {?>value="<?=$LoadProductFetch[price]-$LoadProductFetch[sale_price]?>"<?}?> readonly maxlength="15" style="text-align:right" class="Sale_Price_Temp"></td>
			<td style="padding:3 0 0 5" class="TextBold">원</td>
			<td width=10></td>
			<td><input type="checkbox" name="sale_price_check" <?if(!strcmp($LoadProductFetch[sale_price],"0")) { print "checked";}?> onclick="javascript:sale_price_check_form()" value="1"></td>
			<td style="padding:3 0 0 0">사용안함</td>
			</tr>
			
			<tr><td colspan=10 height=10></td></tr>

			<tr><td colspan=10>
			할인되는 금액을 입력하시면 자동으로 계산됩니다.
			</td></tr>
			
			</table>

		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>
	
	</td></tr>


	
	<!-- HR -->
	<tr><td height=25>
		<table border=0 cellpadding=0 cellspacing=0 width=790 height=37>
		<tr>
		<td align=center background="../../mall_images/more/title_main.gif">
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
	<td background="../../mall_images/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">배송지역</td></tr>
		</table>
	</td>
	</tr>

	<tr><td height=5 bgcolor="#ffffff">

		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730>

			<input type="text" name="delivery_area" size="20" maxlength="15" value="<?=$LoadProductFetch[delivery_area]?>">

		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>
	
	</td></tr>
	
	<!-- 배송비 -->
	<tr height=24>
	<td background="../../mall_images/more/title_sub.gif">
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
			<td style="padding:0 1 0 0"><img src="../../mall_images/more/image17.gif" width="21" height="21" border="0"></td>
			<td><input type="text" name="delivery_money" <?if(!strcmp($LoadProductFetch[delivery_money],"0")) { print "disabled"; } else {?> value="<?=$LoadProductFetch[delivery_money]?>" <?}?> size="10" maxlength="5" style="text-align:right" onblur="NumberIns(this)"></td>
			<td style="padding:3 0 0 5" class="TextBold">원</td>
			<td width=10></td>
			<td align=center><input type="checkbox" name="delivery_money_check" <?if(!strcmp($LoadProductFetch[delivery_money],"0")) { print "checked"; } ?> value="<?=$LoadProductFetch[delivery_money_check]?>" onclick="javascript:delivery_check()"></td>
			<td style="padding:3 0 0 0">무료</td>
			</tr>
			
			<tr><td colspan=6 height=10></td></tr>

			<tr><td colspan=6>
			배송비를 입력하여 주십시오.
			</td></tr>
			
			</table>

		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>
	
	</td></tr>

	<!-- 배송비 지불 선택 -->
	<tr height=24>
	<td background="../../mall_images/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">배송비 지불 선택</td></tr>
		</table>
	</td>
	</tr>

	<tr><td height=5 bgcolor="#ffffff">

		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730>
			
			<table border=0 cellpadding=0 cellspacing=0>
			<tr>
			<td><input type="radio" name="delivery_type" <?if(!strcmp($LoadProductFetch[delivery_money],"0")) { print "disabled checked"; }?> value="착불" <?if(!strcmp($LoadProductFetch[delivery_type],"착불")) { print "checked";}?>></td>
			<td style="padding:4 0 0 0">착불</td>
			<td width=10></td>
			<td><input type="radio" name="delivery_type" <?if(!strcmp($LoadProductFetch[delivery_money],"0")) { print "disabled"; }?> value="선불" <?if(!strcmp($LoadProductFetch[delivery_type],"선불")) { print "checked";}?>></td>
			<td style="padding:4 0 0 0">선불</td>
			<td width=10></td>
			</tr>
			</table>

		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>
	
	</td></tr>

	<!-- 배송방법 -->
	<tr height=24>
	<td background="../../mall_images/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">배송방법</td></tr>
		</table>
	</td>
	</tr>

	<tr><td height=5 bgcolor="#ffffff">

		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730 style="line-height:20px">



			<table broder=0 cellpadding=0 cellspacing=0>
			<tr><td><input type="text" name="delivery_way" size="10" maxlength="10" value="<?=$LoadProductFetch[delivery_way]?>"></td></tr>
			<tr><td height=10></td></tr>
			<tr><td style="line-height:20px;">
			택배사를 입력하여 주십시오.
			</td></tr>
			</table>
			
			

		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>
	
	</td></tr>


	<!-- 평균 배송일 -->
	<tr height=24>
	<td background="../../mall_images/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">평균 배송일</td></tr>
		</table>
	</td>
	</tr>

	<tr><td height=5 bgcolor="#ffffff">

		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730>

			<input type="text" name="delivery_mean_day" size="30" maxlength="20" value="<?=$LoadProductFetch[delivery_mean_day]?>">

		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>
	
	</td></tr>


	<!-- 최대 배송일 -->
	<tr height=24>
	<td background="../../mall_images/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">최대 배송일</td></tr>
		</table>
	</td>
	</tr>
	
	<tr><td height=5 bgcolor="#ffffff">

		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730>

			<input type="text" name="delivery_max_day" size="30" maxlength="20" value="<?=$LoadProductFetch[delivery_max_day]?>">

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
		<table border=0 cellpadding=0 cellspacing=0 align=center>
		<tr><td colspan=3 height=10></td></tr>
		<tr>
		<td><input type="image" src="../../mall_images/more/product_save.gif" width="96" height="21" border="0"></td>
		<td width=5></td>
		<td><a href="javascript:addCancel()"><img src="../../mall_images/more/product_add_cancel.gif" width="96" height="21" border="0"></a></td>
		</tr>
		</table>
	</td></tr>
	</table>
</td>
</tr>
</form>
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
