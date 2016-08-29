<div id="header_wrap">
  <div id="header">
  	<a href="<?=$IU[url]?>/index.php"><img src="<?=$IU[url]?>/css/img/logo.png" class="logo" alt="Logo" /></a>
  	<span id="toggle"></span>    
	<ul id="navigation">
		 <li><a href="<?=$IU[url]?>/index.php?mode=house_list">주거정보</a>
        	<ul>
        		<li><a href="<?=$IU[url]?>/index.php?mode=house_list">원룸/하숙정보</a></li>
        		<li><a href="<?=$IU[url]?>/board/bbs/board.php?bo_table=room_mate">룸메이트</a></li>
				<li><a href="<?=$IU[url]?>/board/bbs/board.php?bo_table=house_deal">방거래</a></li>
        	</ul>
         </li>
         <li><a href="<?=$IU[url]?>/board/bbs/board.php?bo_table=restaurant">맛집정보</a>
        	<!-- <ul>
        		<li><a href="<?=$IU[url]?>/board/bbs/board.php?bo_table=restaurant">맛집정보</a></li>
        		<li><a href="<?=$IU[url]?>/board/bbs/board.php?bo_table=food_story">맛집탐방</a></li>
        	</ul> -->
        </li>		
		 <li><a href="<?=$IU[url]?>/board/bbs/board.php?bo_table=board1">자유게시판</a>
        	<!-- <ul>
        		<li><a href="<?=$IU[url]?>/index.php?mode=community">커뮤니티</a></li>
        		<li><a href="<?=$IU[url]?>/board/bbs/board.php?bo_table=notice">공지사항</a></li>
        		<li><a href="<?=$IU[url]?>/board/bbs/board.php?bo_table=gallery">이미지겔러리</a></li>
        		<li><a href="<?=$IU[url]?>/board/bbs/board.php?bo_table=add">홍보</a></li>
        		<li><a href="<?=$IU[url]?>/board/bbs/board.php?bo_table=market">중고장터</a></li> 
        	</ul>-->
        </li>
		 <li><a href="<?=$IU[url]?>/board/bbs/board.php?bo_table=alba">알바정보</a>
        	<!--<ul>
        		<li><a href="<?=$IU[url]?>/board/bbs/board.php?bo_table=life">생활정보</a></li>
        		 <li><a href="<?=$IU[url]?>/board/bbs/board.php?bo_table=class">강의정보</a></li>
        		<li><a href="<?=$IU[url]?>/board/bbs/board.php?bo_table=class_data">강의자료실</a></li>
        		<li><a href="<?=$IU[url]?>/board/bbs/board.php?bo_table=schedule">학사일정</a></li>
        		<li><a href="<?=$IU[url]?>/board/bbs/board.php?bo_table=study">스터디그룹</a></li> 
        		<li><a href="/index.php?mode=information">정보마당</a></li>
        	</ul>-->
        </li>
		 <li><a href="/index.php?mode=qna">질문답변</a>
        	<ul>
        		<li><a href="<?=$IU[url]?>/board/bbs/board.php?bo_table=qna">문의사항</a></li>
        		<li><a href="<?=$IU[url]?>/board/bbs/board.php?bo_table=reg_room">주거정보등록신청</a></li>
        		<li><a href="<?=$IU[url]?>/board/bbs/board.php?bo_table=reg_restaurant">맛집정보등록신청</a></li>
        	</ul>
        </li>
		<?if($is_admin)//중현 작업용 .. 지우지 마세요
				{?>
		<!-- <li><a href="<?=$IU[url]?>/index.php?mode=toeic_study">Study</a>
        	<ul>
        		<li><a href="<?=$IU[url]?>/index.php?mode=toeic_study">해커즈Toeic 파랭이 Voca</a></li>
				<li><a href="<?=$IU[url]?>/index.php?mode=my_word_reg">내 단어장 관리</a></li>
				
				<li><a href="<?=$IU[url]?>/index.php?mode=nexus_word_reg">넥서스 단어장 관리</a></li>
				<li><a href="<?=$IU[url]?>/board/bbs/board.php?bo_table=tech01_board1">Study Support</a></li>
				<li><a href="<?=$IU[url]?>/index.php?mode=support_board">Study Support2</a></li>
				<li><a href="<?=$IU[url]?>/index.php?mode=toeic_word_test">Voca Test</a></li>
				
				
        	</ul>
        </li> -->
		<?
				}
				?>
	</ul>
  </div>
</div>
<div id="extended_wrap">
	<div id="extended">
		<div id="plus_form">
			<form method="post" name=all_search_form action="<?=$IU[url]?>/index.php" id="signIn">
			<input type='hidden' name=mode value='search_all'>
			<fieldset>
				<input type="text" name="search_txt" id="search_txt" value='<?=$search_txt?>'class="input" style='width:260px'/>
				<span><a style='cursor:pointer' onclick="document.getElementsByName('all_search_form')[0].submit()">통합검색</a></span><br>
			</fieldset>
			</form>
		</div>
	</div>
</div>