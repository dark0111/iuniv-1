<?
session_start();
include "../../../include/dbcon.php";
IF($HTTP_SESSION_VARS[OLD_NO] AND $HTTP_SESSION_VARS[OLD_ID] AND $HTTP_SESSION_VARS[OLD_NAME]) {

// 저장될 디렉토리의 정보를 가져옵니다.
INCLUDE "../../../prt_img/load_dir.php";

$ExtendName = array("jpg", "gif", "png");

$product_image_number = 1;
for($n=1;$n<6;$n++) {
	?>
	<script language="javascript">
	opener.ProductForm.prd_image<?=$n?>.src = "<?="http://".$_SERVER[HTTP_HOST]?>/admin/image/more/120_120.gif";
	</script>		
	<?

	for($i=0;$i<3;$i++) {
		if(file_exists($LOAD_DIRECTORY."75/".$product_code."_".$n.".".$ExtendName[$i])) {
			$product_image_number = $product_image_number+1;
			${"prt_".$n} = $ExtendName[$i];
			
			if(${"prt_".$n}) {
				?>
				<script language="javascript">
				opener.ProductForm.prd_image<?=$n?>.src = "<?="http://".$_SERVER[HTTP_HOST]."/prt_img/120/".$product_code."_".$n.".".${"prt_".$n}?>";
				</script>		
				<?
			}
		}
	}
}
?>

	<script language="javascript">
	opener.ProductForm.product_image_number.value = "<?=$product_image_number-1?>";
	</script>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>상품이미지 등록</title>
	<link rel="STYLESHEET" type="text/css" href="../../../style/style.css">
	<script>

	function AddImage() {
		if(!imageForm.file.value) {
		alert("파일을 선택하십시오.           ");
		imageForm.file.focus();
		return false;
		}

			imageForm.target = 'image_result';
			imageForm.action = '__image_result.php';
	
	}
	
	function imgNum(num, extend) {
		
		input_num = eval(imageForm.product_image_number.value);
		
		if(num<input_num) {
		
			ViewImage.prd_image75.src="http://<?=$_SERVER[HTTP_HOST]?>/prt_img/75/<?=$product_code?>_"+num+"."+extend;
			ViewImage.prd_image120.src="http://<?=$_SERVER[HTTP_HOST]?>/prt_img/120/<?=$product_code?>_"+num+"."+extend;
			ViewImage.prd_image280.src="http://<?=$_SERVER[HTTP_HOST]?>/prt_img/280/<?=$product_code?>_"+num+"."+extend;

		} else {

		}

	}
	
	function dropImg(bn, extend) {
		image_result.location.href="__image_result.php?bn="+bn+"&product_code=<?=$product_code?>&extend="+extend+"&result=drop";
	}

	function CancelImgform() {
		prd_img_num = eval(imageForm.product_image_number.value);

			if(prd_img_num<2) {

				if(confirm("상품이미지는 최소 1개 이상 등록하셔야 합니다.       \n상품이미지가 없습니다. 그래도 종료하시겠습니까?     ")) {
					this.close();
				} 
			
			
			} else {

					this.close();


			}
	}
	
	</script>

	<style>
	
	.selectImage {
		font-size:10pt;
		font-family:굴림; 
		color:#0000cc;
		text-decoration:none;
		font-weight: bold;
	}
	
	</style>	
	
</head>
<body bgcolor="#ffffff" scroll="no" >
<table border=0 cellpadding=0 cellspacing=0 width=620>
<tr><td valign=top>

	<span class="hr_text">상품 이미지 등록!</span>
	<hr size=1 color="#eeeeee">

</td></tr>

<tr><td height=5></td></tr>

<tr><td>
	<table border=0 cellpadding=0 cellspacing=0>
	<tr>
	<td style="padding:0 0 0 10"><img src="../../image/more/image14.gif" width="36" height="36" border="0"></td>
	<td style="padding:0 0 0 10">
		<font style='letter-spacing:1px'>
		이미지는 3가지로 사이즈로 분류되어 자동 압축 저장됩니다. <br>
		<strong>1</strong>. 75*75, <strong>2</strong>.120*120, <strong>3</strong>.280*280
		</font>
	</td>
	</tr>
	</table>
		
</td></tr>

<tr><td height=5></td></tr>
<tr><td height=5><hr size=1 color="#eeeeee"></td></tr>
<tr><td height=5></td></tr>
<form name="ViewImage">
<tr><td align=center>


	
	<table border=0 cellpadding=0 cellspacing=0>
	<tr>
	<td style="padding:0 10 0 10"><img src="<?if($pi_num){ print "http://".$_SERVER[HTTP_HOST]."/prt_img/75/".$product_code."_".$pi_num.".".${"prt_".$pi_num}; } else { print "../../image/more/75_75.gif"; }?>" name="prd_image75" width="75" height="75" border="0"></td>

	<td style="padding:0 10 0 10"><img src="<?if($pi_num){ print "http://".$_SERVER[HTTP_HOST]."/prt_img/120/".$product_code."_".$pi_num.".".${"prt_".$pi_num}; } else { print "../../image/more/120_120.gif"; }?>" name="prd_image120" width="120" height="120" border="0"></td>

	<td style="padding:0 10 0 10"><img src="<?if($pi_num){ print "http://".$_SERVER[HTTP_HOST]."/prt_img/280/".$product_code."_".$pi_num.".".${"prt_".$pi_num}; } else { print "../../image/more/280_280.gif"; }?>" name="prd_image280" width="280" height="280" border="0"></td>

	</tr>
	</table>

</td></tr>

<tr><td height=5></td></tr>
<tr><td>
<span class="hr_text">등록된 이미지!</span>
<hr size=1 color="#eeeeee"></td></tr>

<tr><td height=5></td></tr>
<tr><td align=center>

	<table border=0 cellpadding=0 cellspacing=0>
	<tr>
	<?
	for($img=1;$img<6;$img++) {
	?>
	<td style="padding:0 10 0 10"><a href="javascript:imgNum('<?=$img?>', '<?=${"prt_".$img}?>')"><img src="<?if(${"prt_".$img}){ print "http://".$_SERVER[HTTP_HOST]."/prt_img/75/".$product_code."_".$img.".".${"prt_".$img}; } else { print "../../image/more/75_75.gif";}?>" name="prd_image<?=$img?>" width="75" height="75" border="0" <?if(!strcmp($img,"1")) {?>style="border:2 solid;border-color:#66ccff;"<?}?>></td>
	<?
	}
	?>
	</tr>

	<tr><td colspan=5 height=5></td></tr>
	
	<tr height=20>
	
	<?
	for($bn=1;$bn<6;$bn++) {
	?>
	<td align=center>
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td><a href="javascript:dropImg('<?=$bn?>', '<?=${"prt_".$bn}?>')"><img src="../../image/more/image_delete<?if(${"prt_".$bn}){ print "_s"; }?>.gif" width="29" height="17" border="0"></a></td>
		</tr>
		</table>
	</td>
	<?
	}
	?>

	</tr>
	</table>
	

</td></tr>
<tr><td><hr size=1 color="#eeeeee"></td></tr>
<tr><td height=5></td></tr>
</form>

<tr><td align=center>

	<table border=0 cellpadding=0 cellspacing=0>
	<tr>
	<form name="imageForm" method="post" onsubmit="return AddImage()" enctype="multipart/form-data">
	<input type="hidden" name="result" value="save">
	<input type="hidden" name="product_code" value="<?=$product_code?>">
	<input type="hidden" name="product_image_number" value="<?=$product_image_number?>">

	<td style="padding:3 5 0 5" class="selectImage">이미지 선택</td>
	<td style="padding:0 2 0 2"><input type="file" size="40" name="file" style="border:1 solid;border-color:#666666;height:21;"></td>
	<td style="padding:0 2 0 2"><input type="image" src="../../image/more/image_save.gif" width="96" height="21"></a></td>
	</form>

	</tr>
	</table>

</td></tr>

<tr><td height=5></td></tr>
<tr><td><hr size=1 color="#eeeeee"></td></tr>
<tr><td height=5></td></tr>

<tr><td align=center>
	<table border=0 cellpadding=0 cellspacing=0>
	<tr>
	<td><a href="javascript:CancelImgform()"><img src="../../image/more/image_save_cancel.gif" width="96" height="21" border="0"></a></td>
	</tr>
	</table>

</td></tr>

</table>

<iframe name="image_result" frameborder="0" marginheight="0" marginwidth="0" scrolling="Yes" width=0 height=0></iframe>


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
