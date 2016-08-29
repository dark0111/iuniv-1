<?
include_once("./_common.php"); 

include_once("$g4[path]/lib/latest.lib.php"); 
if($mode=='house_view')
{
	$view_house=$_COOKIE[view_house].'/'.$h_cd;
	set_cookie2('view_house',$view_house,60);
}
$g4['title'] = "";
include_once("./_head.php");



switch($mode)
{
	case 'community':
		include_once("../sub/community/community.php");
		break;
	case 'information':
		include_once("../sub/information/information.php");
		break;
	case 'qna':
		include_once("../sub/qna/qna.php");
		break;
	case 'house':
		include_once("../sub/house/house.php");
		break;
	case 'house_list':
		include_once("../sub/house/house_list.php");
		break;
	case 'house_view':
		include_once("../sub/house/house_view.php");
		break;
	case 'house_write':
		include_once("../sub/house/house_write.php");
		break;
	case 'house_advice':
		include_once("../sub/house/house_advice.php");
		break;
	case 'intro':
		include_once("../sub/intro/intro.php");
		break;
	case 'house_password':
		include_once("../sub/house/password.php");
		break;
	case 'mall':
		include_once("../sub/mall/index_mall.php");
		break;
	case 'mall_goods_list':
		include_once("../sub/mall/mall_goods_list.php");
		break;
	case 'mall_goods_show':
		include_once("../sub/mall/mall_goods_show.php");
		break;
	case 'mall_basket':
		include_once("../sub/mall/mall_basket.php");
		break;
	case 'mall_basket_show':
		include_once("../sub/mall/mall_basket_show.php");
		break;
	case 'mall_order1':
		include_once("../sub/mall/mall_order1.php");
		break;
	case 'mall_order2':
		include_once("../sub/mall/mall_order2.php");
		break;
	case 'mall_order3':
		include_once("../sub/mall/mall_order3.php");
		break;
	case 'mall_order_service':
		include_once("../sub/mall/mall_order_service.php");
		break;
	case 'mall_order_show':
		include_once("../sub/mall/mall_order_show.php");
		break;
	case 'chat':
		include_once("./bbs/chat.php");
		break;
	default:
		
		include_once("./main.php");
		//옵션값은 공지게시판의 분류명을 직접 입력합니다.
		echo popup_multi("latest_pop_multi", "popup", 5, 40, "before");
		break;
}

include_once("./_tail.php");
?>
<?php


?>
