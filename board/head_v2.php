<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

include_once("$g4[path]/head.sub_v2.php");
include_once("$g4[path]/lib/outlogin.lib.php");
include_once("$g4[path]/lib/poll.lib.php");
include_once("$g4[path]/lib/visit.lib.php");
include_once("$g4[path]/lib/connect.lib.php");
include_once("$g4[path]/lib/popular.lib.php");

//print_r2(get_defined_constants());

// 사용자 화면 상단과 좌측을 담당하는 페이지입니다.
// 상단, 좌측 화면을 꾸미려면 이 파일을 수정합니다.

$table_width = 1080;
$view_qstr = "search_str=$search_str_e&house_ym_type=$house_ym_type&room_type=$room_type&fit_type=$fit_type&room_size=$room_size&price_1=$price_1&price_2=$price_2&order=$order&page=$page";
/*

*/
$te_hv=$_COOKIE[view_house];
$ex_hv=explode('/',$te_hv);
$c_ex=count($ex_hv);

?>

		<?
		INCLUDE"../../_navi.php";
		?>

		<div id="content_wrap">
			<div id="content" class="clearfix">
		
	<?
		$read_file_ex=explode('/',$_SERVER['PHP_SELF']);
		$read_file=$read_file_ex[count($read_file_ex)-1];
		if($bo_table || $read_file=='login.php' ||  $read_file=='house.php' || $read_file=='member_confirm.php' || $mode || $read_file=='house_view.php' || $read_file=='house_write.php' || $read_file=='register_form.php')
		{

				include_once "../../_leftmenu.php";
		}
		?>
		<div id="main">
		

<!-- /상단부분 -->
<!-- 보드출력시 서브타이틀 -->
<?
	if($bo_table=="room_mate"){
		$stitle_img = "/sub/house/image/stit_room_mate.gif";
		$stitle_txt = "Home > 주거정보 > <b>룸메이트</b>";
	}elseif($bo_table=="house_deal"){
		$stitle_img = "/sub/house/image/stit_room_market.gif";
		$stitle_txt = "Home > 주거정보 > <b>방거래</b>";
	}elseif($bo_table=="restaurant"){
		$stitle_img = "/sub/restaurant/image/stit_matzipinfo.gif";
		$stitle_txt = "Home > 맛집정보 > <b>맛집정보</b>";
	}elseif($bo_table=="food_story"){
		$stitle_img = "/sub/restaurant/image/stit_matzipvisit.gif";
		$stitle_txt = "Home > 맛집정보 > <b>맛집탐방</b>";
	}elseif($bo_table=="board1"){
		$stitle_img = "/sub/community/image/stit_free_board.gif";
		$stitle_txt = "Home > 커뮤니티 > <b>자유게시판</b>";
	}elseif($bo_table=="notice"){
		$stitle_img = "/sub/community/image/stit_notice_board.gif";
		$stitle_txt = "Home > 커뮤니티 > <b>공지사항</b>";
	}elseif($bo_table=="gallery"){
		$stitle_img = "/sub/community/image/stit_gallery.gif";
		$stitle_txt = "Home > 커뮤니티 > <b>이미지겔러리</b>";
	}elseif($bo_table=="add"){
		$stitle_img = "/sub/community/image/stit_publicity.gif";
		$stitle_txt = "Home > 커뮤니티 > <b>홍보</b>";
	}elseif($bo_table=="market"){
		$stitle_img = "/sub/community/image/stit_market_board.gif";
		$stitle_txt = "Home > 커뮤니티 > <b>중고장터</b>";
	}elseif($bo_table=="life"){
		$stitle_img = "/sub/information/image/stit_lifeinfo.gif";
		$stitle_txt = "Home > 정보마당 > <b>생활정보</b>";
	}elseif($bo_table=="class"){
		$stitle_img = "/sub/information/image/stit_lecture.gif";
		$stitle_txt = "Home > 정보마당 > <b>강의정보</b>";
	}elseif($bo_table=="class_data"){
		$stitle_img = "/sub/information/image/stit_lecture_files.gif";
		$stitle_txt = "Home > 정보마당 > <b>강의자료실</b>";
	}elseif($bo_table=="schedule"){
		$stitle_img = "/sub/information/image/stit_schedule.gif";
		$stitle_txt = "Home > 정보마당 > <b>학사일정</b>";
	}elseif($bo_table=="study"){
		$stitle_img = "/sub/information/image/stit_study_group.gif";
		$stitle_txt = "Home > 정보마당 > <b>스터디그룹</b>";
	}elseif($bo_table=="alba"){
		$stitle_img = "/sub/information/image/stit_studentjob.gif";
		$stitle_txt = "Home > 정보마당 > <b>알바정보</b>";
	}elseif($bo_table=="qna"){
		$stitle_img = "/sub/qna/image/stit_question.gif";
		$stitle_txt = "Home > 질문답변 > <b>문의사항</b>";
	}elseif($bo_table=="reg_room"){
		$stitle_img = "/sub/qna/image/stit_matzip_reg.gif";
		$stitle_txt = "Home > 질문답변 > <b>주거정보등록신청</b>";
	}elseif($bo_table=="reg_restaurant"){
		$stitle_img = "/sub/qna/image/stit_house_reg.gif";
		$stitle_txt = "Home > 질문답변 > <b>맛집정보등록신청</b>";
	}elseif($bo_table=="club_intro"){
		$stitle_img = "/sub/information/image/stit_club_intro.gif";
		$stitle_txt = "Home > 정보마당 > <b>동아리 정보</b>";
	}
	elseif($bo_table=="tech01_board1"){
		$stitle_img = "/sub/information/image/stit_study_group.gif";
		$stitle_txt = "Home > 공부 > <b>택공일 동아리 지원</b>";
	}
if($bo_table!=""){
?>
<table border="0" cellpadding="0" cellspacing="0" background="<?=$g4['path']?>/main/image/tit_bg.gif" style='background-repeat:repeat-x'>
<tr>
	<td><img src="<?=$g4['path']?>/main/image/tit_edge01.gif" border="0"></td>
	<td><img src="<?=$IU['url']?><?=$stitle_img?>" border="0"></td>
	<td style="color:#aaabab;padding-bottom:5px"><img src="<?=$g4['path']?>/main/image/tit_icon.gif" border="0" align="absmiddle"></td>
	<td width="460" align=right>&nbsp;<?=$stitle_txt?></td>
	<td><img src="<?=$g4['path']?>/main/image/tit_edge02.gif" border="0"></td></tr>
</table>
<?}

?>

<!-- /서브타이틀 -->
