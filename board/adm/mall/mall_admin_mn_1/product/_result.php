<meta http-equiv="content-type" content="text/html; charset=utf-8">
<?
include_once("../../define_path.php");
//IF($HTTP_SESSION_VARS[OLD_NO] AND $HTTP_SESSION_VARS[OLD_ID] AND $HTTP_SESSION_VARS[OLD_NAME]) 
if(1)
{
# product_contents 에 포함되어 있는 이미지들을 추출하여 변경하고 이미지를 해당 디렉토리에 저장한다. <시작>
?>
	<?
	IF(!STRCMP($result, "save")) {
		INCLUDE $dark_define['dark_mall_prt_img_path']."/load_dir.php";// 디렉토리의 절대경로를 불러옵니다.
		@CHMOD($LOAD_DIRECTORY."cnt_img",0777); // 이미지 디렉토리에 권한을 설정합니다.
		@CHMOD($LOAD_DIRECTORY."cnt", 0777); // 컨텐츠 함에 권한을 설정합니다.
		
		$REAL_SAVE_CONTENTS_NAME = $LOAD_DIRECTORY."cnt/".$product_code.".itp"; // 컨텐츠가 저장될 실제 디렉토리를 구합니다.
		$REAL_SAVE_CONTENTS_IMAGE_NAME = $LOAD_DIRECTORY."cnt_img/".$product_code."_".time()."_"; // 이미지가 저장될 실제 디렉토리를 구합니다.
		$URL_IMAGE_NAME = "http://".$_SERVER[HTTP_HOST]."/prt_img/cnt_img/".$product_code."_".time()."_"; // img로 불러드릴 디렉토리를 구합니다.
		
		$product_contents_explode = str_replace('src','||-||', $product_contents);
		$product_contents_explode = explode('||-||', $product_contents_explode);
		$img_loop = 0;
		for($i=0;$i<100;$i++) {
			$checkFile[$i] = explode('"', $product_contents_explode[$i]);
			$checkFile_check_temp[$i] = substr($checkFile[$i][1],1,1);
			if(!strcmp($checkFile_check_temp[$i],":") or !strcmp($checkFile_check_temp[$i],"i")) {
				$img_loop=$img_loop+1;
				${"array_image"}[$img_loop] = $checkFile[$i][1];
				$product_contents = str_replace(${"array_image"}[$img_loop],"_--|--_".$img_loop,$product_contents);
			}
		
		}
		
		for($j=1;$j<11;$j++) {
				if($itp_array_image[$j]) {
					$ExtendName[$j] = explode(".", $itp_array_image_name[$j]);
					$ExtendName_Real[$j] = $ExtendName[$j][1];
					$RealSaveImageName[$j] = $REAL_SAVE_CONTENTS_IMAGE_NAME.$j.".".$ExtendName_Real[$j]; // 저장할 절대경로를 만듭니다.
					$RealHttpImageName[$j] = $URL_IMAGE_NAME.$j.".".$ExtendName_Real[$j];// Img에서 불러 올 Http 경로를 만듭니다.
					@copy($itp_array_image[$j], $RealSaveImageName[$j]); // 파일을 복사합니다.
					$product_contents = str_replace("_--|--_".$j, $RealHttpImageName[$j], $product_contents);
					$product_contents = str_replace('\"', '"', $product_contents);
		
			}
		}
		
		# product_contents 에 포함되어 있는 이미지들을 추출하여 변경하고 이미지를 해당 디렉토리에 저장한다. <종료>
		$Write_ProductContents = fopen($REAL_SAVE_CONTENTS_NAME, 'w');
		@fwrite($Write_ProductContents, $product_contents);
		@fclose($Write_ProductContents);
		
		
		$AddQuery = "INSERT INTO $productSQL (";
		
		$AddQuery .= "ccn,";
		$AddQuery .= "wcn,";
		$AddQuery .= "extend_cate_name,";
		$AddQuery .= "company_code,";
		$AddQuery .= "product_code,";
		$AddQuery .= "product_name,";
		$AddQuery .= "second_product_name,";
		$AddQuery .= "product_exp, ";
		$AddQuery .= "product_attention, ";
		$AddQuery .= "sales_product_num,";
		$AddQuery .= "make_in,";
		$AddQuery .= "made_in,";
		$AddQuery .= "color_class,";
		$AddQuery .= "price, ";
		$AddQuery .= "point,";
		$AddQuery .= "sale_price,";
		$AddQuery .= "delivery_area,";
		$AddQuery .= "delivery_money,";
		$AddQuery .= "delivery_type,";
		$AddQuery .= "delivery_way,";
		$AddQuery .= "delivery_mean_day,";
		$AddQuery .= "delivery_max_day,";
		$AddQuery .= "ip,";
		$AddQuery .= "date";
	
		$AddQuery .= ") VALUES (";
	
		$AddQuery .= "'$ccn',";  // default '0'
		$AddQuery .= "'$wcn',"; // default '0'
		$AddQuery .= "'$extend_cate_name',"; 
		$AddQuery .= "'$company_code',"; // default 'ITP0000000'
		$AddQuery .= "'$product_code',"; // default '0000000000'
		$AddQuery .= "'$product_name',";
		$AddQuery .= "'$second_product_name',";
		$AddQuery .= "'$product_exp', ";
		$AddQuery .= "'$product_attention', ";
		$AddQuery .= "'$sales_product_num',"; //  default '100'
		$AddQuery .= "'$make_in',";
		$AddQuery .= "'$made_in',";
		$AddQuery .= "'$color_class',";
		$AddQuery .= "'$price', "; //  default '0'
		$AddQuery .= "'$point',"; // default '0'
		$AddQuery .= "'$sale_price',"; // default '0'
		$AddQuery .= "'$delivery_area',"; // default '전국'
		$AddQuery .= "'$delivery_money',";// default '0'
		$AddQuery .= "'$delivery_type',";// default '무료'
		$AddQuery .= "'$delivery_way',";// default '택배'
		$AddQuery .= "'$delivery_mean_day',";// default '결제 후 4일 (휴일제외)'
		$AddQuery .= "'$delivery_max_day',";// default '결제 후 6일 (휴일제외)'
		$AddQuery .= "'$REMOTE_ADDR',";
		$AddQuery .= "now()";
		$AddQuery .= ")";
		mysql_query($AddQuery, $connection) or die("AddQuery error");
	
		$CategoryUpdateQuery = "update $categorySQL set cate_info=cate_info+1 where no='$ccn'";
		mysql_query($CategoryUpdateQuery, $connection) or die("CategoryUpdateQuery error");
		?>

		<script language="javascript">
		alert("상품이 정상적으로 등록되었습니다.1");
		location.href="./_list.php?ccn=<?=$ccn?>&wcn=<?=$wcn?>";
		</script>

	<?
	} ELSE IF(!STRCMP($result, "modify")) {
	
		if($product_contents) {
			INCLUDE $dark_define['dark_mall_prt_img_path']."/load_dir.php"; // 디렉토리의 절대경로를 불러옵니다.
			@CHMOD($LOAD_DIRECTORY."cnt_img",0777); // 이미지 디렉토리에 권한을 설정합니다.
			@CHMOD($LOAD_DIRECTORY."cnt", 0777); // 컨텐츠 함에 권한을 설정합니다.
			
			$REAL_SAVE_CONTENTS_NAME = $LOAD_DIRECTORY."cnt/".$product_code.".itp"; // 컨텐츠가 저장될 실제 디렉토리를 구합니다.
			$REAL_SAVE_CONTENTS_IMAGE_NAME = $LOAD_DIRECTORY."cnt_img/".$product_code."_".time()."_"; // 이미지가 저장될 실제 디렉토리를 구합니다.
			$URL_IMAGE_NAME = "http://".$_SERVER[HTTP_HOST]."/prt_img/cnt_img/".$product_code."_".time()."_"; // img로 불러드릴 디렉토리를 구합니다.
			
			$product_contents_explode = str_replace('src','||-||', $product_contents);
			$product_contents_explode = explode('||-||', $product_contents_explode);
			$img_loop = 0;

			$imTj = 0;
			for($k=0;$k<100;$k++) {
				if(file_exists($LOAD_DIRECTORY."75/".$product_code."_".$k.".jpg")) {
					$imTj = $imTj+1;
				}
			}

			for($i=$imTj;$i<($imTj+100);$i++) {
				$checkFile[$i] = explode('"', $product_contents_explode[$i]);
				$checkFile_check_temp[$i] = substr($checkFile[$i][1],1,1);
				if(!strcmp($checkFile_check_temp[$i],":") or !strcmp($checkFile_check_temp[$i],"i")) {
					$img_loop=$img_loop+1;
					${"array_image"}[$img_loop] = $checkFile[$i][1];
					$product_contents = str_replace(${"array_image"}[$img_loop],"_--|--_".$img_loop,$product_contents);
				}
			
			}
			
			for($j=1;$j<11;$j++) {
					if($itp_array_image[$j]) {
						$ExtendName[$j] = explode(".", $itp_array_image_name[$j]);
						$ExtendName_Real[$j] = $ExtendName[$j][1];
						$RealSaveImageName[$j] = $REAL_SAVE_CONTENTS_IMAGE_NAME.$j.".".$ExtendName_Real[$j]; // 저장할 절대경로를 만듭니다.
						$RealHttpImageName[$j] = $URL_IMAGE_NAME.$j.".".$ExtendName_Real[$j];// Img에서 불러 올 Http 경로를 만듭니다.
						@copy($itp_array_image[$j], $RealSaveImageName[$j]); // 파일을 복사합니다.
						$product_contents = str_replace("_--|--_".$j, $RealHttpImageName[$j], $product_contents);
						$product_contents = str_replace('\"', '"', $product_contents);
			
				}
			}
			
			# product_contents 에 포함되어 있는 이미지들을 추출하여 변경하고 이미지를 해당 디렉토리에 저장한다. <종료>
			$Write_ProductContents = fopen($REAL_SAVE_CONTENTS_NAME, 'w');
			@fwrite($Write_ProductContents, $product_contents);
			@fclose($Write_ProductContents);
		}

		$ModifyQuery = "update $productSQL set ";
		$ModifyQuery .= "ccn='$ccn',";
		$ModifyQuery .= "wcn='$wcn',";
		$ModifyQuery .= "extend_cate_name='$extend_cate_name',";
		$ModifyQuery .= "company_code='$company_code',";
		$ModifyQuery .= "product_code='$product_code',";
		$ModifyQuery .= "product_name='$product_name',";
		$ModifyQuery .= "second_product_name='$second_product_name',";
		$ModifyQuery .= "product_exp='$product_exp', ";
		$ModifyQuery .= "product_attention='$product_attention', ";
		$ModifyQuery .= "sales_product_num='$sales_product_num',";
		$ModifyQuery .= "make_in='$make_in',";
		$ModifyQuery .= "made_in='$made_in',";
		$ModifyQuery .= "color_class='$color_class',";
		$ModifyQuery .= "price='$price', ";
		$ModifyQuery .= "point='$point',";
		$ModifyQuery .= "sale_price='$sale_price',";
		$ModifyQuery .= "delivery_area='$delivery_area',";
		$ModifyQuery .= "delivery_money='$delivery_money',";
		$ModifyQuery .= "delivery_type='$delivery_type',";
		$ModifyQuery .= "delivery_way='$delivery_way',";
		$ModifyQuery .= "delivery_mean_day='$delivery_mean_day',";
		$ModifyQuery .= "delivery_max_day='$delivery_max_day',";
		$ModifyQuery .= "ip='$REMOTE_ADDR',";
		$ModifyQuery .= "date=now() where product_code='$product_code'";
		mysql_query($ModifyQuery, $connection) or die("ModifyQuery error");
		?>

		<script language="javascript">
		alert("상품이 정상적으로 수정되었습니다.2 ");
		location.href="./_pdt_view.php?product_code=<?=$product_code?>&ccn=<?=$ccn?>&wcn=<?=$wcn?>&page=<?=$page?>&limit=<?=$limit?>&q=<?=$q?>";
		</script>

	<?
	} ELSE IF(!STRCMP($result, "drop")) {

		// 이미지와 내용의 디렉토리를 검색하여 실제파일을 비교하고 동일할 경우 삭제합니다. <시작>
		
		INCLUDE $dark_define['dark_mall_prt_img_path']."/load_dir.php"; // 디렉토리의 절대경로를 불러옵니다.
		$CNT_IMAGE_DIR = $LOAD_DIRECTORY."cnt_img/";
		$CNT_IMAGE = dir($CNT_IMAGE_DIR);
		
		while(($filename = $CNT_IMAGE->read())!==FALSE) {
			$tempFile = substr($filename,0,10);
			if(!strcmp($product_code, $tempFile)) {
				@unlink($CNT_IMAGE_DIR.$filename);
			
			}
		}

		$CNT_CNT_DIR = $LOAD_DIRECTORY."cnt/";
		$CNT_CNT = dir($CNT_CNT_DIR);

		while(($filename = $CNT_CNT->read())!==FALSE) {
			$tempFile = substr($filename,0,10);
			if(!strcmp($product_code, $tempFile)) {
				@unlink($CNT_CNT_DIR.$filename);
			
			}
		}

		$ORI_IMAGE_DIR = $LOAD_DIRECTORY."ori/";
		$ORI_IMAGE = dir($ORI_IMAGE_DIR);

		while(($filename = $ORI_IMAGE->read())!==FALSE) {
			$tempFile = substr($filename,0,10);
			if(!strcmp($product_code, $tempFile)) {
				@unlink($ORI_IMAGE_DIR.$filename);
			
			}
		}

		$IMAGE_75_DIR = $LOAD_DIRECTORY."75/";
		$IMAGE_75 = dir($IMAGE_75_DIR);

		while(($filename = $IMAGE_75->read())!==FALSE) {
			$tempFile = substr($filename,0,10);
			if(!strcmp($product_code, $tempFile)) {
				@unlink($IMAGE_75_DIR.$filename);
			
			}
		}

		$IMAGE_120_DIR = $LOAD_DIRECTORY."120/";
		$IMAGE_120 = dir($IMAGE_120_DIR);

		while(($filename = $IMAGE_120->read())!==FALSE) {
			$tempFile = substr($filename,0,10);
			if(!strcmp($product_code, $tempFile)) {
				@unlink($IMAGE_120_DIR.$filename);
			
			}
		}
		
		
		$IMAGE_280_DIR = $LOAD_DIRECTORY."280/";
		$IMAGE_280 = dir($IMAGE_280_DIR);

		while(($filename = $IMAGE_280->read())!==FALSE) {
			$tempFile = substr($filename,0,10);
			if(!strcmp($product_code, $tempFile)) {
				@unlink($IMAGE_280_DIR.$filename);
			
			}
		}

		// 이미지와 내용의 디렉토리를 검색하여 실제파일을 비교하고 동일할 경우 삭제합니다. <시작>

		$CategoryUpdateQuery = "update $categorySQL set cate_info=cate_info-1 where no='$ccn'";
		mysql_query($CategoryUpdateQuery, $connection) or die("CategoryUpdateQuery error");

		$DropQuery = "delete from $productSQL where product_code='$product_code'";
		mysql_query($DropQuery, $connection) or die("DropQuery error");

		?>

		<script language="javascript">
		alert("상품이 정상적으로 삭제되었습니다.");
		location.href="./_list.php?ccn=<?=$ccn?>&wcn=<?=$wcn?>";
		</script>

	<?
	}
	?>



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
