<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<?

include_once("common/common.set.php"); 

include_once("common/dbcon.php");	
include_once("$g4[path]/lib/latest.lib.php"); 

?>
<title>IUNIV 주거정보 커뮤니티</title>
<link rel="stylesheet" href="./css/style.css" type="text/css" media="screen" />
<script type="text/javascript" src="./js/flashObj.js"></script> 
<script type="text/javascript" src="./js/jquery.tools.min.js"></script>
<script type="text/javascript" src="./js/cookie.jquery.js"></script>
<script language="javascript">
// 자바스크립트에서 사용하는 전역변수 선언 sub
var g4_path      = "<?=$g4['path']?>";
var g4_bbs       = "<?=$g4['bbs']?>";
var g4_bbs_img   = "<?=$g4['bbs_img']?>";
var g4_url       = "<?=$g4['url']?>";
var g4_is_member = "<?=$is_member?>";
var g4_is_admin  = "<?=$is_admin?>";
var g4_bo_table  = "<?=isset($bo_table)?$bo_table:'';?>";
var g4_sca       = "<?=isset($sca)?$sca:'';?>";
var g4_charset   = "<?=$g4['charset']?>";
var g4_cookie_domain = "<?=$g4['cookie_domain']?>";
var g4_is_gecko  = navigator.userAgent.toLowerCase().indexOf("gecko") != -1;
var g4_is_ie     = navigator.userAgent.toLowerCase().indexOf("msie") != -1;
var tool_page	 = "<?=$_REQUEST['tool_page']?>";
<? if ($is_admin) { echo "var g4_admin = '{$g4['admin']}';"; } ?>
</script>
</head>

<body topmargin="0" leftmargin="0" marginheight="0" marginwidth="0" >
<a name="g4_head"></a>
<?
include_once("_navi.php"); //상단 메뉴 부분
if(!$mode){
	include_once("dbo_main.php");
	include_once("_main.script.php"); //메인 사용 스크립트 인클루드 & 실행 함수
}
?>
<div id="content_wrap">
  <div id="content" class="clearfix">
<?
if(!$mode)
{
	include_once("./main.php");
	//옵션값은 공지게시판의 분류명을 직접 입력합니다.
	echo popup_multi("latest_pop_new", "popup", 5, 40, "after");
}
else
{
?>

	<?
		$read_file_ex=explode('/',$_SERVER['PHP_SELF']);
		$read_file=$read_file_ex[count($read_file_ex)-1];
		if($bo_table || $read_file=='login.php' ||  $read_file=='house.php' || $read_file=='member_confirm.php' || $mode || $read_file=='house_view.php' || $read_file=='house_write.php')
		{
			include_once "./_leftmenu.php";
		}
		?>
		<div id="main">
		<?
	switch($mode)
	{
		case 'community':
			include_once("./sub2/community/community.php");
			break;
		case 'information':
			include_once("./sub2/information/information.php");
			break;
		case 'qna':
			include_once("./sub2/qna/qna.php");
			break;
		case 'house':
			include_once("_submain.script.php"); //메인 사용 스크립트 인클루드 & 실행 함수
			include_once("./sub2/house/house.php");
			break;
		case 'house_list':
			include_once("./sub2/house/house_list.php");
			break;
		case 'house_view':
			include_once("./sub2/house/house_view.php");
			break;
		case 'house_write':
			include_once("./sub2/house/house_write.php");
			break;
		case 'house_advice':
			include_once("./sub2/house/house_advice.php");
			break;
		case 'intro':
			include_once("./sub2/intro/intro.php");
			break;
		case 'house_password':
			include_once("./sub2/house/password.php");
			break;
		case 'mall':
			include_once("./sub/mall/index_mall.php");
			break;
		case 'mall_goods_list':
			include_once("./sub/mall/mall_goods_list.php");
			break;
		case 'mall_goods_show':
			include_once("./sub/mall/mall_goods_show.php");
			break;
		case 'mall_basket':
			include_once("./sub/mall/mall_basket.php");
			break;
		case 'mall_basket_show':
			include_once("./sub/mall/mall_basket_show.php");
			break;
		case 'mall_order1':
			include_once("./sub/mall/mall_order1.php");
			break;
		case 'mall_order2':
			include_once("./sub/mall/mall_order2.php");
			break;
		case 'mall_order3':
			include_once("./sub/mall/mall_order3.php");
			break;
		case 'mall_order_service':
			include_once("./sub2/mall/mall_order_service.php");
			break;
		case 'mall_order_show':
			include_once("./sub2/mall/mall_order_show.php");
			break;
		case 'restaurant':
			include_once("./sub2/restaurant/restaurant.php");
			break;
		case 'search_all':
			include_once("$IU[sub_path]/search/search_all.php");
			break;
		case 'toeic_study':
			include_once("$IU[sub_path]/study/toeic_study.php");
			break;
		case 'toeic_word_test':
			include_once("$IU[sub_path]/study/toeic_word_test.php");
			break;
		case 'my_word_reg':
			include_once("$IU[sub_path]/study/my_word_reg.php");
			break;
		case 'nexus_word_reg':
			include_once("$IU[sub_path]/study/nexus_word_reg.php");
			break;
		case 'nexus_word_search':
			include_once("$IU[sub_path]/study/nexus_word_search.php");
			break;
		default:
			
			//include_once("./main.php");
			//옵션값은 공지게시판의 분류명을 직접 입력합니다.
			//echo popup_multi("latest_pop_multi", "popup", 5, 40, "");
			break;
	}
	?>
	</div>
	<?
}

?>
		
	</div>
</div>
<?
include_once("./_tail.php");
?>	
</body>
</html>
