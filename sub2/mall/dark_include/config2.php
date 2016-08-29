<?
/* =====================================================
  프로그램명 : 알지보드 V4
  화일명 : 
  작성일 : 
  작성자 : 윤범석 ( http://rgboard.com )
  작성자 E-Mail : master@rgboard.com

  최종수정일 : 
 ===================================================== */
	if(isset($_REQUEST['site_path'])) exit;
	if(!isset($site_path)) $site_path='./';
	if(!isset($site_url)) $site_url='./';
	if(!isset($site_path) || preg_match("/:\/\//",$site_path)) $site_path='./';	

	// 알지보드버전 2008-04-02 ver 4.1.0 (베타버전)
  define('RGBOARD_VERSION', '4.1.0');
  define('RG_DB_MYSQL', 'MYSQL');
  define('RG_DB_CUBRID', 'CUBRID');
  define('RG_DB_ORACLE', 'ORACLE');
	
	define('DB_LIKE', 1);
	


	$dark_define['mall_domain']="iuniv.kr";
	$dark_define['mall_name']="계룡산 구판장";
	$dark_define['home_file']="home.php";
	$dark_define['skin_name']="black_v1";
	$dark_define['site_url']="http://iuniv.kr";

	$_table['prefix']				= 'rg4_';	// 테이블명 접두어
	$_table['member']				= $_table['prefix'].'member';	// 회원
	$_table['group']				= $_table['prefix'].'group';	//	그룹
	$_table['gmember']				= $_table['prefix'].'gmember';	//	그룹회원
	$_table['bbs_cfg']				= $_table['prefix'].'bbs_cfg';	//	게시판설정
	$_table['bbs_body']				= $_table['prefix'].'bbs_body';	//	게시판 본문
	$_table['bbs_comment']			= $_table['prefix'].'bbs_comment';	//	게시판 코멘트
	$_table['bbs_category']			= $_table['prefix'].'bbs_category';	//	게시판 카테고리
	$_table['setup']				= $_table['prefix'].'setup';	//	사이트설정
	$_table['point']				= $_table['prefix'].'point';	//	포인트내역
	$_table['note']					= $_table['prefix'].'note';	//	쪽지
	$_table['product']				='itp_product';	//	쪽지
	$_table['zip']					= $_table['prefix'].'zip';	//	우편번호
	//JH SET
	$_table['order']					='dark_mall_order';	//	주문정보
	$_table['order_goods']					='dark_mall_order_goods';	//	주문상품
	$_table['product']					='itp_product';	//	상품

	$_path['site']				= $site_path;	// 기본경로
	$_path['bbs']				= $_path['site'].'dark_board/';	// 게시판
	$_path['css']				= $_path['site'].'dark_css/';	// 스타일시트
	$_path['member']			= $_path['site'].'dark_member/';	// 회원 
	$_path['js']				= $_path['site'].'dark_js/';	// 스크립트
	$_path['admin']				= $_path['site'].'dark_admin/';	// 관리자
	$_path['counter']			= $_path['site'].'dark_counter/';	// 카운터
	$_path['inc']				= $_path['site'].'dark_include/';	// 라이브러리등
	$_path['mail_form']			= $_path['site'].'dark_mail/';	// 이메일주소경로
	$_path['skin']				= $_path['site'].'dark_skin/';	// 스킨경로
	$_path['bbs_skin']			= $_path['skin'].'board/';	// 게시판 스킨
	$_path['login_skin']		= $_path['skin'].'login/';	// 로그인 스킨
	$_path['last_skin']			= $_path['skin'].'last/';	// 최근글 스킨
	$_path['mall_skin']			= $_path['skin'].'mall/';	// 쇼핑몰 스킨

	$_path['data']			= $_path['site'].'board/data/';	// 데이타파일
	$_path['member_data']	= $_path['data'].'member/';	// 회원 데이타파일
	$_path['bbs_data']		= $_path['data'].'board/';	// 게시판 첨부파일
	$_path['session']		= $_path['data'].'session/';	// 세션

	$_url['site']				= $site_url;	// 기본경로
	$_url['bbs']				= $_url['site'].'board/';	// 게시판
	$_url['css']				= $_url['site'].'dark_css/';	// 스타일시트
	$_url['member']				= $_url['site'].'dark_member/';	// 회원
	$_url['js']					= $_url['site'].'dark_js/';	// 스크립트
	$_url['admin']				= $_url['site'].'dark_admin/';	// 관리자
	$_url['counter']			= $_url['site'].'dark_counter/';	// 카운터
	$_url['mail_form']			= $_url['site'].'dark_mail/';	// 이메일주소경로
	$_url['skin']				= $_url['site'].'dark_skin/';	// 스킨경로
	$_url['bbs_skin']		= $_url['skin'].'board/';	// 게시판 스킨
	$_url['login_skin']	= $_url['skin'].'login/';	// 로그인 스킨
	$_url['last_skin']	= $_url['skin'].'last/';	// 최근글 스킨
	

	//JH SET
	$_const['order_states']	= array('wait'=>'주문접수','pay'=>'입금확인','send'=>'발송','complete'=>'배송완료','return'=>'반품','cancel'=>'주문취소'); // 주문상태


	$_const['member_states']		= array(0=>'대기',1=>'승인',2=>'미승인',3=>'탈퇴'); // 회원상태
	$_const['group_states']			= array(0=>'대기',1=>'승인',2=>'미승인',3=>'폐쇄');	// 그룹상태
	$_const['group_level_type']	= array(0=>'회원레벨',1=>'그룹레벨');	// 그룹레벨 적용방식

	$_const['admin_level']			= 90;	// 최고 관리자 레벨
	$_const['group_admin_level']= 50;	// 그룹 관리자 레벨
	$_const['sex']							= array('M'=>'남자','F'=>'여자'); // 성별

	$_const['member_form_state'] = array(0=>'사용안함',1=>'선택',2=>'필수');
	$_const['member_forms'] = array(
		'mb_name' => '이름',
		'mb_nick' => '닉네임',
		'mb_email' => '이메일',
		'mb_jumin' => '주민등록번호',
		'mb_tel1' => '전화번호',
		'mb_tel2' => '핸드폰번호',
		'mb_address' => '주소',
		'mb_signature' => '서명',
		'mb_introduce' => '자기소개',
		'photo1' => '사진',
		'icon1' => '회원아이콘'
	);
	
	// 사용디비
	$_const['db_type']					= array();
	$_const['db_type']['MYSQL']	= array('code'=>'MYSQL','name'=>'Mysql','hname'=>'Mysql','default_port'=>'3306');
	$_const['db_type']['CUBRID']= array('code'=>'CUBRID','name'=>'Cubrid','hname'=>'큐브리드','default_port'=>'33000');
	$_const['db_type']['ORACLE']= array('code'=>'ORACLE','name'=>'Oracle','hname'=>'오라클','default_port'=>'1521');

	// 포인트형태
	$_po_type_code		= array('etc'=>'0','bbs'=>'1','mall'=>'2','admin'=>'10');
	$_po_type_name		= array('0'=>'기타','1'=>'게시판','2'=>'쇼핑몰','10'=>'관리자');
	
	$_auth=false;			// 권한 초기화
	$_bbs_auth=false;	// 게시판 권한 초기화
	$_mb=false;				// 회원정보초기화
?>
