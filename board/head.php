<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

include_once("$g4[path]/head.sub.php");
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
<center>
<!-- 상단부분 -->
<table border="0" cellspacing="0" cellpadding="0" width="950">
<?
if($c_ex>1)
{
?>
<tr>
	<td style='position:relative; left:4px;'>
		<?
		if($mode=="house_view"){
			$dung_dung_x_position="1000";
		}else{
			$dung_dung_x_position="950";
		}
		?>
		<div id='bar' style='position:absolute; left:<?=$dung_dung_x_position?>px; top:280px; width:100px; height:145px; z-index:2; visibility: visible' > 
		<table id="ta1" width="70" border="0" radius="3" rborder="#999999" rbgcolor="#F8F8F8" border=0 cellpadding=0 cellspacing=0 height=200 bordercolor=cccccc>
		<tr>
			<td valign=top height=20 align=center>구경한집</td>
		</tr>
		<tr>
			<td align=center>
			<?
			
			if($c_ex > 6) $c_ex=6;
			
			for($ia=$c_ex;$ia>0;$ia--)
			{
				$h_cd_temp=$ex_hv[$ia];
				$sql_tv="select H.h_cd,H.h_nm,I.I_filename from room_house as H,room_imageinfo as I where H.h_cd='$h_cd_temp' and I.I_classify_id='$h_cd_temp' order by I.priority desc,I.I_id asc limit 1";
				
				$row_tv = sql_fetch($sql_tv);
				if(!$row_tv[h_nm])continue;
				?>
				<tr id='view_tv'.<?=$itv?> style='display:; padding-bottom:5px;'>
					<td valign=top align=center><a href='<?=$g4[board_path]?>/board/index.php?mode=house_view&h_cd=<?=$row_tv[h_cd]?>&<?=$view_qstr?>'><img src='<?if($row_tv[I_filename]!=""){echo$g4['house_img_path']."thumbOpen2/".$row_tv[I_filename];}else{echo$g4[path]."/img/no_img.gif";}?>' width='80' height='70' style='border:1;'><br><?=$row_tv[h_nm]?></a></td>
				</tr>
			<?			
			}			
			?>
			</td>
		</tr>
		<!--<tr>
			<td valign=top height=20 align=center><img src='<?=$g4['path']?>/img/btn_next.gif'></td>
		</tr> -->
		</table>
		</div>
		<script>roundTable("ta1");</script>
	</td>
</tr>
<?}
else
{
?>
<div id='bar'></div>
<?
}
?>
<tr>
	<td width="950" valign="top">
		<!-- 로고 및 메뉴부분 -->
		<table border="0" cellspacing="0" cellpadding="0" width="950">
		<tr>
			<td height="21"></td>
		</tr>
		<tr>
			<td><a href="/board/index.php"><img src="<?=$g4['path']?>/main/image/logo.gif" border="0" alt="로고"></a></td>
			<td valign="top" align=right>
				<!-- 탑메뉴 -->
				<table border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="600" align="right"><?=outlogin("cj_login"); // 외부 로그인 ?></td>
					<td width=50><!--<a href="#"><img src="<?=$g4['path']?>/main/image/top_menu01.gif" border="0" alt="HOME"></a> <a href="<?=$g4['bbs_path']?>/login.php"><img src="<?=$g4['path']?>/main/image/top_menu02.gif" border="0" alt="LOGIN"></a></td>
					<td><a href="#"><img src="<?=$g4['path']?>/main/image/top_menu03.gif" border="0" alt="SITEMAP"></a></td>
					<td><a href="#"><img src="<?=$g4['path']?>/main/image/top_menu04.gif" border="0" alt="CONTACT US"></a>--></td></tr> 
				</table>
				<!-- /탑메뉴 -->

				<!-- 메인메뉴플래시 적용 부분-->
				<script type="text/javascript">
					FlashObject("<?=$g4['path']?>/main/swf/index.swf?route=0", 680, 95, "#ffffff", "");
				</script>
				<!-- /메인메뉴플래시 적용 부분-->
			</td>
		</tr>
		</table>
		<!-- /로고 및 메뉴부분 -->
	</td>
</tr>
<tr>
	<td>
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<?
			$read_file_ex=explode('/',$_SERVER['PHP_SELF']);
			$read_file=$read_file_ex[count($read_file_ex)-1];
			if($bo_table || $read_file=='login.php' ||  $read_file=='house.php' || $read_file=='member_confirm.php' || $mode || $read_file=='house_view.php' || $read_file=='house_write.php')
			{
		
		?>
			<!-- 왼쪽 메뉴 -->
			<td width=270 valign=top>
				<?
				include_once "$g4[path]/leftmenu.php";
				?>
			</td>
			<!-- 중간 -->
			<td width=680 valign=top>
				<table border=0 cellpadding=0 cellspacing=0 width=100%>
				<tr>
					<td>
						<!-- 서브비쥬얼플래시 적용 부분-->
						<script type="text/javascript">
							FlashObject("<?=$g4[path]?>/main/swf/subvisual.swf", 680, 140, "#ffffff", "");
						</script>
						<!-- /서브비쥬얼플래시 적용 부분-->
					</td>
				</tr>
				<tr>
					<td>
			<?
				
			}
			else
			{
			?>
			<td width=950 valign=top>
				<table border=0 cellpadding=0 cellspacing=0 width=100%>
				<tr>
					<td>
			<?
			}
			?>

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
	}
if($bo_table!=""){
?>
<table border="0" cellpadding="0" cellspacing="0" background="<?=$g4['path']?>/main/image/tit_bg.gif">
<tr>
	<td><img src="<?=$g4['path']?>/main/image/tit_edge01.gif" border="0"></td>
	<td><img src="<?=$IU['url']?><?=$stitle_img?>" border="0"></td>
	<td width="486" align="right" style="color:#aaabab;line-height:px"><img src="<?=$g4['path']?>/main/image/tit_icon.gif" border="0" align="absmiddle">&nbsp;<?=$stitle_txt?></td>
	<td><img src="<?=$g4['path']?>/main/image/tit_edge02.gif" border="0"></td></tr>
</table><Br>
<?
}
?>

<!-- /서브타이틀 -->
