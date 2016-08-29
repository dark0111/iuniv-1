<!-- 이미지 및 왼쪽메뉴 -->
<ul id="page_subnav" class="clearfix">
<?if($mode=="house"||$mode=="house_list"||$bo_table=="room_mate"||$bo_table=="house_deal"||$mode=="house_view"){?>
	<li class="<?if($mode=='house'){echo'current_page_item';}else{echo'page_item';}?>" ><a href="<?=$IU[url]?>/index.php?mode=house" title="주거정보">주거정보</a></li>
	<li class="<?if($mode=='house_list' || $mode=="house_view"){echo'current_page_item';}else{echo'page_item';}?>"><a href="<?=$IU[url]?>/index.php?mode=house_list" title="원룸/하숙정보">원룸/하숙정보</a></li>
	<li class="<?if($bo_table=='room_mate'){echo'current_page_item';}else{echo'page_item';}?>"><a href="<?=$IU[url]?>/board/bbs/board.php?bo_table=room_mate" title="룸메이트">룸메이트</a></li>
	<li class="<?if($bo_table=='house_deal'){echo'current_page_item';}else{echo'page_item';}?>"><a href="<?=$IU[url]?>/board/bbs/board.php?bo_table=house_deal" title="방거래">방거래</a></li>
<?}elseif($bo_table=="restaurant"||$bo_table=="food_story"){?>
	<li class="<?if($bo_table=='restaurant'){echo'current_page_item';}else{echo'page_item';}?>"><a href="<?=$IU[url]?>/board/bbs/board.php?bo_table=restaurant" title="맛집정보">맛집정보</a></li>
	<!-- <li class="<?if($bo_table=='food_story'){echo'current_page_item';}else{echo'page_item';}?>"><a href="<?=$IU[url]?>/board/bbs/board.php?bo_table=food_story" title="맛집탐방">맛집탐방</a></li> -->
<?}elseif($mode=="community"||$bo_table=="board1"||$bo_table=="notice"||$bo_table=="gallery"||$bo_table=="add"||$bo_table=="market" ){?>
	<li class="<?if($mode=='community'){echo'current_page_item';}else{echo'page_item';}?>"><a href="<?=$IU[url]?>/index.php?mode=community" title="커뮤니티">커뮤니티</a></li>
	<li class="<?if($bo_table=='board1'){echo'current_page_item';}else{echo'page_item';}?>"><a href="<?=$IU[url]?>/board/bbs/board.php?bo_table=board1" title="자유게시판">자유게시판</a></li>
	<li class="<?if($bo_table=='notice'){echo'current_page_item';}else{echo'page_item';}?>"><a href="<?=$IU[url]?>/board/bbs/board.php?bo_table=notice" title="룸메이트">공지사항</a></li>
	<li class="<?if($bo_table=='add'){echo'current_page_item';}else{echo'page_item';}?>"><a href="<?=$IU[url]?>/board/bbs/board.php?bo_table=add" title="룸메이트">홍보</a></li>
<?}elseif($mode=="information"||$bo_table=="life"||$bo_table=="class"||$bo_table=="class_data"||$bo_table=="schedule"||$bo_table=="study"||$bo_table=="alba" ){?>
	<!-- <li class="<?if($mode=='information'){echo'current_page_item';}else{echo'page_item';}?>"><a href="<?=$IU[url]?>/index.php?mode=information" title="정보마당">정보마당</a></li>
	<li class="<?if($bo_table=='life'){echo'current_page_item';}else{echo'page_item';}?>"><a href="<?=$IU[url]?>/board/bbs/board.php?bo_table=life" title="생활정보">생활정보</a></li> -->
	<li class="<?if($bo_table=='alba'){echo'current_page_item';}else{echo'page_item';}?>"><a href="<?=$IU[url]?>/board/bbs/board.php?bo_table=alba" title="알바정보">알바정보</a></li>
<?}elseif($mode=="qna"||$bo_table=="reg_room"||$bo_table=="reg_restaurant"){?>
	<li class="<?if($mode=='qna'){echo'current_page_item';}else{echo'page_item';}?>"><a href="<?=$IU[url]?>/index.php?mode=qna" title="커뮤니티">질문답변</a></li>
	<li class="<?if($bo_table=='reg_room'){echo'current_page_item';}else{echo'page_item';}?>"><a href="<?=$IU[url]?>/board/bbs/board.php?bo_table=reg_room" title="주거정보 등록신청">주거정보 등록신청</a></li>
	<li class="<?if($bo_table=='reg_restaurant'){echo'current_page_item';}else{echo'page_item';}?>"><a href="<?=$IU[url]?>/board/bbs/board.php?bo_table=reg_restaurant" title="식당정보 등록신청">식당정보 등록신청</a></li>
<?}elseif($mode=="toeic_study" && 0){

include_once("$IU[sub_path]/study/file_controle_lib.php");
if(!$file_name)$file_name="Day1.lrc";
$file_folder=new mh_files;
	$list_folder=$file_folder->fl($IU[path]."english_study_word");
	$file_name_array=array();
	foreach($list_folder[file] as $aaaa=>$kkkkk)
	{
		$file_name_array[]=$kkkkk;
	}
	asort($file_name_array);
	foreach($file_name_array as $key_l=>$value_l)
	{
		?>
		
		<li class="<?if($file_name==$value_l){echo'current_page_item';}else{echo'page_item';}?>"><a href="<?=$IU[url]?>/index.php?mode=toeic_study&file_name=<?=$value_l?>" title="영어공부">파랭이 보카 <?=$value_l?></a></li>
		<?
	}
}elseif($mode=="toeic_study"){
	$etc_view='blank';
	for($ivoca=1;$ivoca<=30;$ivoca++)
	{
		$value_l="Day".$ivoca.".lrc";
	?>
	<li class="<?if($file_name==$value_l){echo'current_page_item';}else{echo'page_item';}?>"><a href="<?=$IU[url]?>/index.php?mode=toeic_study&file_name=<?=$value_l?>" title="영어공부">파랭이 보카 Day<?=$ivoca?></a></li>

<?
	}
	
}elseif($mode=="toeic_word_test"){?>
<li class="page_item"><a href="<?=$IU[url]?>/index.php?mode=toeic_study&file_name=<?=$value_l?>" title="Join Plus">대숙이 토익 Voca Test</a></li>
<?}else if($mode=='my_word_reg'){?>
	<li class="page_item"><a href="<?=$IU[url]?>/index.php?mode=my_word_reg" title="Join Plus">내 영어 단어 등록</a></li>

<?}
elseif($bo_table=="tech01_board1"){?>
	<li class="<?if($bo_table=='tech01_board1'){echo'current_page_item';}else{echo'page_item';}?>"><a href="<?=$IU[url]?>/board/bbs/board.php?bo_table=tech01_board1" title="택공일 공부">택공일 공부</a></li>
<?}
elseif($mode=="support_board"){?>
<li class="page_item"><a href="<?=$IU[url]?>/board/bbs/board.php?bo_table=tech01_board1" title="Join Plus">택공일 공부 모임</a></li>
<?}else if($mode=='my_word_reg'){?>
	<li class="page_item"><a href="<?=$IU[url]?>/index.php?mode=my_word_reg" title="Join Plus">내 영어 단어 등록</a></li>

<?}else{?>
	<li class="page_item"><a href="#" title="Join Plus">메뉴 조건 오류</a></li>
<?}
if($etc_view!='blank')
{
?>
	<li class="current_page_item2"><a href="<?=$IU[home_file]?>?mode=house_advice"><img src="<?=$IU['url']?>/image/house_left_banner01.gif" border="0" alt="주거 거래시 주의사항"></a></li>
	<li class="current_page_item2"><a href="http://haansoft.com/hnc/down/down_viewer.action?boardcode=TAEMB&amp;largecode=NVI&amp;svstate=Y" target="_blank"><img src="<?=$dark_define['site_url']?>/image/icon_han.gif" border="0"/ align="absmiddle"> 한글뷰어</a></li>
	<li class="current_page_item2"><a href="http://www.korea.adobe.com/products/acrobat/readstep2.html" target="_blank"><img src="<?=$dark_define['site_url']?>/image/icon_acrobat.gif" border="0" align="absmiddle" /> 아크로벳 리더</a></li>
	
<?
}	
?>
</ul>

<!-- /이미지 및 왼쪽메뉴 -->