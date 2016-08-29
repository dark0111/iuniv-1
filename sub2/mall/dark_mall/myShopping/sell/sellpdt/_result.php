<?
session_start();
include "../../../include/dbcon.php";
IF($HTTP_SESSION_VARS[ON_ID] AND $HTTP_SESSION_VARS[ON_NAME] AND $HTTP_SESSION_VARS[ON_EMAIL]) {

# product_contents 에 포함되어 있는 이미지들을 추출하여 변경하고 이미지를 해당 디렉토리에 저장한다. <시작>
?>
	<?
	IF(!STRCMP($result, "save")) {
		INCLUDE "../../../prt_img/load_dir.php"; // 디렉토리의 절대경로를 불러옵니다.
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
		
		
		$AddQuery = "INSERT INTO $_table[product] (";
		
		$AddQuery .= "ccn,";
		$AddQuery .= "wcn,";
		$AddQuery .= "extend_cate_name,";
		$AddQuery .= "company_code,";
		$AddQuery .= "product_code,";
		$AddQuery .= "product_name,";
		$AddQuery .= "second_product_name,";
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
		$AddQuery .= "user_type,";
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
		$AddQuery .= "'$itp_product',";
		$AddQuery .= "'$REMOTE_ADDR',";
		$AddQuery .= "now()";
		$AddQuery .= ")";

		mysql_query($AddQuery, $connection) or die("AddQuery error");
		$CategoryUpdateQuery = "update $categorySQL set cate_info=cate_info+1 where no='$ccn'";
		mysql_query($CategoryUpdateQuery, $connection) or die("CategoryUpdateQuery error");

		$ON_CATE = $extend_cate_name;
		SESSION_REGISTER("ON_CATE");

		$CCN = $ccn;
		SESSION_REGISTER("CCN");

		$WCN = $wcn;
		SESSION_REGISTER("WCN");
		?>
		<script language="javascript">
		alert("상품이 정상적으로 등록되었습니다.               ");
		location.href="./sellpdt.html?ccn=<?=$ccn?>&wcn=<?=$wcn?>";
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
