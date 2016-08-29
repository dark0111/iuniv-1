<?
	if(isset($_REQUEST['site_path'])) exit;
	if(!isset($site_path)) $site_path='../sub/mall/';
	if(!isset($site_url)) $site_url='../sub/mall/';
	if(!isset($site_path) || preg_match("/:\/\//",$site_path)) $site_path='../sub/mall/';	

	define('RGBOARD_VERSION', '4.1.0');
	define('RG_DB_MYSQL', 'MYSQL');
	define('DB_LIKE', 1);
	


	$dark_define['mall_domain']="iuniv.kr";
	$dark_define['mall_name']="iuniv 장터";
	$dark_define['home_file']="index.php";
	$dark_define['site_url']="http://iuniv.kr";
	$dark_define['admin_mail_addr']="parkng5@iuniv.kr";	
	$dark_define['skin_name']		="black_v1";
	$dark_define['path']			='/home/hosting_users/dark0111/www';
	$dark_define['home_file_url']	="http://iuniv.kr/board/index.php";


	$_path['site']					= $site_path;	// 기본경로
	$_path['inc']					= $_path['site'].'dark_include/';	// 라이브러리등
	$_path['mail_form']				= $_path['site'].'dark_mail/';	// 이메일주소경로
	$_path['data']					= $_path['site'].'board/data/';	// 데이타파일
	$_path['member_data']			= $_path['data'].'member/';	// 회원 데이타파일
	$_path['bbs_data']				= $_path['data'].'board/';	// 게시판 첨부파일
	$_path['session']				= $_path['data'].'session/';	// 세션

	

	//JH SET
	//하단과 같은 코드는 앞으로 모두 mall_common_code테이블에 코드화해서 넣고 common_code_ds($_common_cd[order_states) 와 같이 DataSet를 리턴 받아 select박스로 사용한다.
	//예제) echo rg_sql_html_option(common_code_ds($_common_cd[order_states),$R[order_state],'com_cd','cd_value');
	//                                              [코드명]      [selected될코드] [그래로] [그대로씀]
	//$_const['order_states']	= array('wait'=>'주문접수','pay'=>'입금확인','return'=>'반품','cancel'=>'주문취소','send'=>'배송중','complete'=>'배송완료' ); // 주문상태




	// 사용디비
	$_const['db_type']					= array();
	$_const['db_type']['MYSQL']	= array('code'=>'MYSQL','name'=>'Mysql','hname'=>'Mysql','default_port'=>'3306');
	
	// 포인트형태
	$_po_type_code		= array('etc'=>'0','bbs'=>'1','mall'=>'2','admin'=>'10');
	$_po_type_name		= array('0'=>'기타','1'=>'게시판','2'=>'쇼핑몰','10'=>'관리자');
	
	$_auth=false;			// 권한 초기화
	$_bbs_auth=false;	// 게시판 권한 초기화
	$_mb=false;				// 회원정보초기화
?>
