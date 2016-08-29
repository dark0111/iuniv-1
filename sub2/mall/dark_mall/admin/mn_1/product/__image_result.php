<?
session_start();
include "../../../include/dbcon.php";
IF($HTTP_SESSION_VARS[OLD_NO] AND $HTTP_SESSION_VARS[OLD_ID] AND $HTTP_SESSION_VARS[OLD_NAME]) {
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>상품관리</title>

<?
IF(!STRCMP($result, "save")) { // 이미지를 저장합니다. <시작>
	
	if($product_image_number<6) {
		
		$FileExtendNameParser = explode(".", $file_name); // 실제 파일의 이름과 확장자를 분할합니다.
		$ExtendName = strtolower($FileExtendNameParser[1]); // 확장자를 절대 소문자로 변환합니다.
		
		if(!strcmp($ExtendName,"jpg") or !strcmp($ExtendName,"jpeg") or !strcmp($ExtendName,"gif") or !strcmp($ExtendName,"png")) {
		
			// 저장될 디렉토리의 정보를 가져옵니다.
			INCLUDE "../../../prt_img/load_dir.php";
		
			$TempDirectory = $LOAD_DIRECTORY."ori"; // 원본 이미지를 저장할 디렉토리입니다.
			$TempImageFileName = $product_code."_".$product_image_number.".".$ExtendName; // 원본의 이미지에 새로운 이름을 덧붙입니다.
			$TempImageFile = $TempDirectory."/".$TempImageFileName; // 저장할 실제 디렉토리와 바뀌어진 이름을 저장합니다.
		
			// 디렉토리의 권한을 설정한다.
			@chmod($LOAD_DIRECTORY,0777); 
			@chmod($TempDirectory,0777); 

			// 만약 동일한 그림파일이 존재한다면 삭제한다.
			// 그러나 이러한 경우는 거의 0%에 해당한다. 이유는 시간으로 상품코드를 생성함으로...
			if(file_exists($TempImageFile)) {
				@unlink($TempDirectory."/".$TempImageFile);
			}
		
			if(!@copy($file, $TempImageFile)) {
			?>
			<script language="javascript">
			alert("파일을 저장하는 도중 문제가 발생하였습니다.        \n지금 바로 관리자에게 문의하십시오. ");
			</script>
			<?
			}
		
			// 이미지 사이즈를 설정합니다.
			$gdImageSize = array(75,120,280);
		
			for($i=0;$i<3;$i++) {

				@chmod($LOAD_DIRECTORY.$gdImageSize[$i],0777); // 저장할 디렉토리의 권한을 자동 변경합니다.

				// GD를 이용하여 해당 디렉토리에 압축 축소하여 배열 저장합니다.

				$GD_LIBRARY = new gdLibrary;
				$GD_LIBRARY->RealPath = $TempDirectory; // 이미지의 원본
				$GD_LIBRARY->MovePath = $LOAD_DIRECTORY.$gdImageSize[$i]; // 적게 변경할 이미지
				$GD_LIBRARY->PlusName = ''; // 앞에 변도로 붙어야 할 것이 있다면 실행 예 ss_image.jpg
				$GD_LIBRARY->ImageQuality = 100; // 퀄리트
				$GD_LIBRARY->ImageResize($TempImageFileName, $gdImageSize[$i], $gdImageSize[$i]); // 이미지 사이즈

			}
			?>
			<script language="javascript">
			parent.ViewImage.prd_image<?=$product_image_number?>.src = "http://<?=$_SERVER[HTTP_HOST]?>/prt_img/75/<?=$TempImageFileName?>";
			parent.ViewImage.prd_image75.src = "http://<?=$_SERVER[HTTP_HOST]?>/prt_img/75/<?=$TempImageFileName?>";
			parent.ViewImage.prd_image120.src = "http://<?=$_SERVER[HTTP_HOST]?>/prt_img/120/<?=$TempImageFileName?>";
			parent.ViewImage.prd_image280.src = "http://<?=$_SERVER[HTTP_HOST]?>/prt_img/280/<?=$TempImageFileName?>";
			num = eval(parent.imageForm.product_image_number.value)+1;
			parent.location.href="__image_add.php?product_code=<?=$product_code?>&pi_num=<?=$product_image_number?>";
			parent.opener.ProductForm.prd_image<?=$product_image_number?>.src = "http://<?=$_SERVER[HTTP_HOST]?>/prt_img/120/<?=$TempImageFileName?>";
			parent.opener.ProductForm.product_image_number.value = "<?=$product_image_number?>";
			</script>

		<?
		} else {
		?>
		
			<script language="javascript">
			alert("파일의 형식이 잘못된 것 같습니다.        \n파일형식은 jpg, gif, png 입니다. ");
			</script>
		
		<?
		}
		?>

	<?
	} else {
	?>

		<script language="javascript">
		alert("더 이상 등록할 수 없습니다.         ");
		</script>

	<?
	}
	?>
	
<?
} // 이미지를 저장합니다. <종료>

else if(!strcmp($result,"drop")) { 

// 이미지의 삭제시 처리하는 부분입니다. <시작>

	INCLUDE "../../../prt_img/load_dir.php";

	$unlink_dir = array("75","120","280","ori");
	$ExtendName = array("jpg", "gif", "png");

	for($i=0;$i<4;$i++) {
		unlink($LOAD_DIRECTORY.$unlink_dir[$i]."/".$product_code."_".$bn.".".$extend);
	}

	if($bn<5) {

		for($u=0;$u<5;$u++) {

			for($d=$bn;$d<6;$d++) {

				$d_temp = $d-1;

				for($e=0;$e<3;$e++) {

					@rename($LOAD_DIRECTORY.$unlink_dir[$u]."/".$product_code."_".$d.".jpg", $LOAD_DIRECTORY.$unlink_dir[$u]."/".$product_code."_".$d_temp.".jpg");
					@rename($LOAD_DIRECTORY.$unlink_dir[$u]."/".$product_code."_".$d.".gif", $LOAD_DIRECTORY.$unlink_dir[$u]."/".$product_code."_".$d_temp.".gif");
					@rename($LOAD_DIRECTORY.$unlink_dir[$u]."/".$product_code."_".$d.".png", $LOAD_DIRECTORY.$unlink_dir[$u]."/".$product_code."_".$d_temp.".png");

				}

			}

		}

	}
	?>

	<script language="javascript">
	parent.location.href="__image_add.php?product_code=<?=$product_code?>";
	</script>

	<?

}// 이미지의 삭제시 처리하는 부분입니다. <종료>
?>


</head>
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
