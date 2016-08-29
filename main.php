<div id="columns">
	<!----------------------------------------------->
	 <ul id="column1" class="column">	<!---------로그인------------>
		<li class="widget" id="widget3">  
			<div id="placed" class="widget-head join-head">
				<!-- <form method="post" action="/amember/login.php" id="signIn_home" class="expose">
					<fieldset>
							<input type="text" name="amember_login" id="username" class="input" />
							<input type="password" name="amember_pass" id="password" class="input" />
							<input type="submit" id="submit_plus" class="submit_button" value="Sign In" />
							<span><a href="/amember/login.php">Forgotten Password?</a></span>
					</fieldset>
				</form> -->
				<?=outlogin("jquery_login"); // 외부 로그인 ?>
			</div>
			<div class="widget-content join-content">
				<img src="<?=$IU[url]?>/css/img/iphone_icon.png" rel="#mies1" align="left" style="cursor:pointer;">
				<p class="text"> Smart Phone 어플 제공.  좌측 아이폰 아이콘 클릭하시면 아이폰 사용 설명을 보실 수 있습니다.</p>
				<?
				if ($member[mb_id]) 
				{
				?>
					<p class="anchor"><a href="<?=$IU[url]?>/board/bbs/member_confirm.php?url=register_form.php" class="a_button">내정보</a><!--  <a title='Find ID&PASSWORD' href="<?=$IU[board]?>/bbs/memo.php" class="a_button boxen">내쪽지</a>
					<a title='Scrap' href="<?=$IU[board]?>/bbs/scrap.php" class="a_button boxen">스크랩</a><a title='Point' href="<?=$IU[board]?>/bbs/point.php" class="a_button boxen">포인트</a> -->
					<a href="<?=$IU[url]?>/board/bbs/member_confirm.php?url=member_leave.php" class="a_button">탈퇴</a></p>
				<?
				}
				else
				{
				?>
					<p class="anchor"><a href="<?=$IU[url]?>/board/bbs/register.php" class="a_button">Join Now</a> <a title='Find ID&PASSWORD' href="<?=$IU[board]?>/bbs/password_forget.php" class="a_button boxen">Forgotten Password?</a></p>
				<?
				}
				?>
			</div>
		</li>
				<!-------------------------------------------------------------------------채팅--------------------------------------------------->
		
		<!-------------------------------------------------------------------------/채팅--------------------------------------------------->		
		<li class="widget" id="widget2">  
			<div class="widget-head">
				<a href="<?=$IU[url]?>/board/bbs/board.php?bo_table=board1"><img src="css/dash_img/dt_free.png" alt="자유게시판" title="자유게시판" class="widget-logo" /></a>
				<h3>자유게시판</h3>
			</div>				
			<div class="widget-content">
				<ul class="myfeed">
					<?echo $st_freeboard;?>
				</ul>
			</div>
		</li>
		<li class="widget" id="widget1">  
			<div class="widget-head">
				<a href="<?=$IU[url]?>/board/bbs/board.php?bo_table=notice"><img src="css/dash_img/dt_notice.png" alt="공지사항" title="공지사항" class="widget-logo" /></a>
				<h3>공지사항</h3>
			</div>
			<div class="widget-content">
				<ul class="myfeed">
					<?echo $st_noticeboard;?>
				</ul>             
			</div>
		</li>
		

	</ul>
	<!----------------------------------------------------------->
	<ul id="column2" class="column">
	
		<li class="widget" id="widget0">  
			<div class="widget-head">
				<img src="css/dash_img/dt_livetalk.png" alt="실시간 토크" title="실시간 토크" class="widget-logo" />
				<h3>실시간 토크</h3>
			</div>
			<div class="widget-content">	
				<div class="widget-content-chat">
				<iframe id="beforexhr"
				name="beforexhr" style="width:100%; height:300px;  border: 0px; filter: Alpha(Opacity=65);" scrolling="no" frameborder="0" src="./library/module/chat/chat.php?mb_nick=<?=$member[mb_nick]?>"></iframe>
				</div>

		  </div>
		</li>
		<li class="widget" id="widget22">
			<div class="widget-head-tab11">
				<ul class="tabs">
					<li><a href="#">룸메이트</a></li>
					
				</ul>
			</div><br>
			<div><?=$st_roommate?></div>
				<br>
			<div class="widget-head-tab11">
				<ul class="tabs">
					<li><a href="#">방거래</a></li>
					
				</ul>
			</div>
			<div><?=$st_marketroom?></div>	<br>
			<div class="widget-head-tab11">
				<ul class="tabs">
					<li><a href="#">질문답변</a></li>
					
				</ul>
			</div>
		
			<div><?=$st_qna?></div>	<br>
		
			<div class="widget-head-tab11">
				<ul class="tabs">
					<li><a href="#">알바정보</a></li>
					
				</ul>
			</div>
		
			<div><?=$st_albainfo?></div>
			
		</li>
			
	</ul>

   <!------------------------------------------------------  colume 3  -------------------------------------------------------------------->
	
	<ul id="column3" class="column">
		
		<!---------------------------------------------------------------------최근 댓글---------------------------------------------------->
		<li class="widget" id="widget30">     
			<div class="widget-head">
				<img src="css/dash_img/dt_reply.png" alt="최근 댓글"  title="최근 댓글" class="widget-logo" />
			</div>
			<div class="widget-content">
				<ul class="comment"><!-- 이부분 원래 myfeed 여야 하는데 사이즈 컨트롤 위해 comment로 변경 -->
					<?echo$st_comment;?>
				</ul>
			</div>
		</li>  
	
	</ul>
	  <!------------------------------------------------------  /colume 3  ----------------------------------------------------------------->
</div>



<!-- overlays -->
<div class="simple_overlay" id="mies1">
	<!-- setup player container -->
	 <div id="iphone_flash">
		<!--<img src="<?=$IU[url]?>/css/img/play_text_large.png">-->
	</div>	
	<div class="details">
		<h3>&nbsp;아이폰 웹 어플 설정법</h3> 
		<br>
		<p>&nbsp;아이폰 사파리 브라우져 주소창에 http://iuniv.kr 홈페이지 접속과 같은 주소로 접속하시면 아이폰 전용 화면으로 보실 수 있습니다.</p> 
		<p>1. 주소창 http://iuniv.kr 이동</p>
		<p>2. IUNIV 아이폰전용 화면이 보이는지 확인후</p>
		<p>3. 아이폰의 사파리 브라우져 하단에 + 버튼클릭</p>
		<p>4. 홈 화면에 추가 버튼 클릭</p>
		<p>5. 아이폰 화면에 IUNIV 어플 아이콘 확인</p>
		<p>* 오류 혹은 잘 않되시면, batssal5@gmail.com 으로 문의 메일 혹은 IUNIV 질문답변 게시판을 이용해 주십시오.</p>
	</div>
</div>
