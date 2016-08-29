<?
$mysql_host = 'localhost';
$mysql_user = 'dark0111';
$mysql_password = 'wjswkwjdqh04';
$mysql_db = 'dark0111';
$connection = mysql_connect($mysql_host, $mysql_user, $mysql_password) or die("Not Connection");
mysql_select_db($mysql_db, $connection);

##############################################################
	$mall_orderSQL					="mall_order";
	$mall_order_goodsSQL			="mall_order_goods";
	$supervisorSQL					= "itp_supervisor";
	$categorySQL					= "mall_category";
	$productSQL						= "mall_goods";
	$memberSQL						= "g4_member";
	$zipcodeSQL						= "zipcode";
	$dark_define['home_file']		="index.php";//home_file_url로 대체 추후 삭제 예정
	$dark_define['skin_name']		="black_v1";
	$dark_define['path']			='/home/hosting_users/dark0111/www';
	$dark_define['site_url']		="http://iuniv.kr";
	$dark_define['home_file_url']	="http://iuniv.kr/board/index.php";
	
	$_common_cd[order_states]		='order_stat'; //공통코드 주문상태코드

	$_table['order']				=$mall_orderSQL;	//	주문정보
	$_table['order_goods']			=$mall_order_goodsSQL;	//	주문상품
	$_table['product']				=$productSQL;	//	상품
	$_table['category']				=$categorySQL; //카테고리테이블
	$_table[common_cd]				="mall_common_code";
###############################################################

	header("Content-type: text/html; charset=utf-8");
#####################################################################################
//쇼핑몰 부분을 위한 설정 파트
$__dbconf=@file("$dark_define[path]/sub/mall/dark_include/db_info.php");
for($i=0;$i<count($__dbconf);$i++) {
	$__dbconf[$i]=trim(str_replace("\n","",$__dbconf[$i]));
}
include_once("$dark_define[path]/sub/mall/dark_include/mysql_class.php");
include_once("$dark_define[path]/sub/mall/dark_include/product_func.php");
include_once("$dark_define[path]/sub/mall/dark_include/func_comm.php");
include_once("$dark_define[path]/sub/mall/dark_include/config.php");
include_once("$dark_define[path]/sub/mall/dark_include/order_class.php");

//include_once("./dark_include/mysql_class.php");
//include_once("./dark_include/product_func.php");
//include_once("./dark_include/Cbasket.php");

$dbcon = new mysql();
$dbcon->set_debug(0);
$dbcon->connect($mysql_host, $mysql_user, $mysql_password,$mysql_db,3306);

if(!is_object($dbcon) || !$dbcon->dbcon) {
	echo '데이타베이스 접속에러. 데이타베이스 정보를 확인해주세요.';
	exit;
}
for($i=0;$i<count($__dbconf);$i++) {
		$__dbconf[$i]=trim(str_replace("\n","",$__dbconf[$i]));
	}
//2008-08-20 jh 선언 array
$year_array[2011]="2011";
$year_array[2010]="2010";
$year_array[2009]="2009";
$year_array[2008]="2008";
$year_array[2007]="2007";
$year_array[2006]="2006";
$year_array[2005]="2005";
$month_array[1]="1";
$month_array[2]="2";
$month_array[3]="3";
$month_array[4]="4";
$month_array[5]="5";
$month_array[6]="6";
$month_array[7]="7";
$month_array[8]="8";
$month_array[9]="9";
$month_array[10]="10";
$month_array[11]="11";
$month_array[12]="12";
for($d=1;$d<32;$d++)
{
	$day_array[$d]=$d;
}



CLASS gdLibrary {
	
	/*
	$GD_LIBRARY = new gdLibrary;
	$GD_LIBRARY->RealPath = './test/img'; // 이미지의 원본
	$GD_LIBRARY->MovePath = './test/thum'; // 적게 변경할 이미지
	$GD_LIBRARY->PlusName = ''; // 앞에 변도로 붙어야 할 것이 있다면 실행 예 ss_image.jpg
	$GD_LIBRARY->ImageQuality = 80; // 퀄리트
	$GD_LIBRARY->ImageResize('na42ASAD.jpg', 100, 100); // 이미지 사이즈
	*/

	VAR $RealPath = '.';
	VAR $MovePath = '.';
	VAR $PlusName = 'img_';
	VAR $ImageQuality = 75;

	function ImageResize($REAL_IMAGE, $WIDTH, $HEIGHT) {

		static $SOURCE;
		static $THUMB;
		
		$EXTEND_NAME = SUBSTR($REAL_IMAGE,-3);

		SWITCH($EXTEND_NAME) {

			CASE 'jpeg' : 

			CASE 'jpg' : 
				echo$this->RealPath;
			$SOURCE = ImageCreateFromJPEG($this->RealPath . '/' . $REAL_IMAGE) or die('jpg 파일을 열 수 없습니다.    ');
			BREAK;

			CASE 'gif' :
			$SOURCE = ImageCreateFromGIF($this->RealPath . '/' . $REAL_IMAGE) or die('gif 파일을 열 수 없습니다.    ');
			BREAK;

			CASE 'png' :
			$SOURCE = ImageCreateFromPNG($this->RealPath . '/' . $REAL_IMAGE) or die('png 파일을 열 수 없습니다.    ');
			BREAK;

			DEFAULT :
			PRINT '현재의 파일은 변환 할 수 없습니다.        ';
			EXIT;

		}

		$THUMB = ImageCreateTrueColor($WIDTH, $HEIGHT);
		ImageCopyResampled($THUMB, $SOURCE, 0,0,0,0, $WIDTH, $HEIGHT, ImageSX($SOURCE), ImageSY($SOURCE) ); 

		switch($EXTEND_NAME) {

			CASE 'jpeg' : 

			CASE 'jpg' : 
			ImageJPEG($THUMB, $this->MovePath . '/' . $this->PlusName . $REAL_IMAGE, $this->ImageQuality) or die('디렉토리를 확인하시기 바랍니다.        ');
			BREAK;

			CASE 'gif' :
			ImageGIF($THUMB, $this->MovePath . '/' . $this->PlusName . $REAL_IMAGE, $this->ImageQuality) or die('디렉토리를 확인하시기 바랍니다.         ');
			BREAK;

			CASE 'png' :
			ImagePNG($THUMB, $this->MovePath . '/' . $this->PlusName . $REAL_IMAGE, $this->ImageQuality) or die('디렉토리를 확인하시기 바랍니다.         ');
			BREAK;

			DEFAULT :
			PRINT '지원되지 않는 확장자입니다.     ';
			EXIT;

		}
		
		ImageDestroy($SOURCE); 
		ImageDestroy($THUMB); 

	}
}


?>
