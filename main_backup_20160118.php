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
		<!-- <li class="widget" id="widget0">  
			<div class="widget-head">
				<img src="css/dash_img/dt_quicktools.png" alt="빠른거래" title="빠른거래" class="widget-logo" />
				<h3>Quick Deal</h3>
				<h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;quick-deal 거래는 성사시 자동 삭제 됩니다.</h4>
			</div>
			<div class="widget-content">	
				<div class="widget-content-chat">
				
					<?
						include"./main_j_quick_deal.php";
					?> 
					
				</div>
		  </div>
		</li> -->
		<li class="widget" id="widget20">
			<div class="widget-head">
				<img src="css/dash_img/dt_quicktools.png" alt="QUICK TOOLS" title="QUICK TOOLS" class="widget-logo" />
				<h3>Quick TOOLS</h3>
			</div>
			<div class="widget-content">
				<ul class="myfeed">
			<!-- root element for everything -->
					<div id="scroll">
						<!-- scrollable items -->
						<!-- 2~4 "page" -->
						<div id="tools">
							<!-- empty slot -->
							<div class="tool">
								&nbsp;
							</div>
							<!-------------------------------------------------------------------------tools > 추천주거--------------------->
							<div   class="tool" style="background:#fff url(./css/img/tools/h320.png) repeat-x;">
								<!-- container for the slides -->
								<div class="tools_com_house">
									<!-- first slide -->
									<div>
										<h3 onclick="javascript:location.href='../index.php?mode=house_view&h_cd=154';">세영오피스텔</h3> 
										<img onclick="javascript:location.href='../index.php?mode=house_view&h_cd=154';" src="./imageData/thumbOpen2/EAB1B4EBACBCEC82ACECA784+5.jpg" width="250" height="200" alt="세영오피스텔" style="float:left;margin:15px 30px 20px 0" /> 
										<p style="font-weight:bold">연락처 : 010-5433-5745<br>주소 : 조치원읍 서창리</p> 
										<p>&nbsp; 세영오피스텔의 규모는 지상6층의 규모로 엘리베이터가 설치되어 있습니다. 세영오피스텔의 출입구에는 방범용 현관도어시스템과 CCTV가 설치 되어있습니다. 또 건물 내에 오피스텔을 관리하시는 아주머니가 상주하고 계시기 때문에 건물이 깨끗이 유지되고 건물 내의 사건사고 방지에 유리합니다. 세영오피스텔은 다양한 타입의 방을 제공합니다. 혼자 지낼 수 있는 원룸형, 취침실이 분리된 복층형, 두 사람이 이용할 수 있는 투룸 </p>
									</div> 
									<!-- second slide -->
									<div>
										<h3 onclick="javascript:location.href='./board/index.php?mode=house_view&h_cd=97';">유니크하우스</h3> 
										<img onclick="javascript:location.href='./board/index.php?mode=house_view&h_cd=97';" src="./imageData/thumbOpen2/_BVI0141_1.jpg" width="250" height="210" alt="유니크하우스" style="float:left;margin:15px 30px 20px 0" /> 
										<p style="font-weight:bold">연락처 : 041-864-0525 , 016-442-8104<br>주소 : 조치원읍 죽림리</p> 
										<p>&nbsp;최근 들어 하숙집들이 줄어 들었습니다. 유니크 하우스는 전세 찾기가 힘든 가운데 다른 곳에 비해 저렴한 가격으로 전세 방을 구할 수 있는 집입니다. 단, 전세시 공과금은 별도 입니다. 년세 방값 250 이고, 하숙시 밥값 월 25만원 입니다. 하숙시 공과금 일체 없습니다. 하숙집이지만 학생들 방과 주인댁과의 입구도 따로 있고 일반 원룸형태 입니다. 개인 생활하는데 불편함 없으리라 생각됩니다.</p>
									</div>
									<!-- third slide -->
									<div>
										<h3 onclick="javascript:location.href='./board/index.php?mode=house_view&h_cd=36';">대원빌리지</h3> 
										<img onclick="javascript:location.href='./board/index.php?mode=house_view&h_cd=36';" src="http://iuniv.kr/imageData/thumbOpen2/_BVI0011.jpg" width="250" height="195" alt="대원빌리지" style="float:left;margin:15px 30px 20px 0" /> 
										<p style="font-weight:bold">연락처 : 041-865-3003 , 011-209-4911 <br>주소 : 서창리 66-14</p> 
										<p>&nbsp;쾌적한 환경에서 생활을 하고 싶으십니까? 안전이 걱정 되십니까? 학교 정문 옆의 대원빌리지를 추천 드립니다. 전문 관리자 분이 항시 상주하시며 입주자들의 불편함을 해결해 드립니다. 넓은 방과 깨끗한 가구, 시원한 에어콘,방과 분리되어 있는 부엌,자유롭게 사용가능한 공용 정수기와 세탁기 ,거기에 2인용 식탁까지 부족한게 없는 원룸 입니다. 또한 오토바이,자전거,자동차를 소지하신 분들은 넓은 전용주차장을 이용하실 수 있습니다. 요즘 여러 도난 사건이 많은데 이런 걱정을 한번에 떨쳐 버릴수 있는곳 바로 대원 빌리지 입니다.</p>
									</div>
									
									<div>
										<h3 onclick="javascript:location.href='./board/index.php?mode=house_view&h_cd=103';"> 스마일 하우스 </h3> 
										<img onclick="javascript:location.href='./board/index.php?mode=house_view&h_cd=103';" src="./imageData/thumbOpen2/2042081282_baa6be02_smile_b1.JPG" width="250" height="190" alt="스마일 하우스" style="float:left;margin:15px 30px 20px 0" /> 
										<p style="font-weight:bold">연락처 : 011-9808-4553 , 016-423-0345<br>주소 : 서창리 130</p> 
										<p>&nbsp;주변에 넘처나는 원룸들이 있습니다. 신축도 많고 리모델링된 건물도 많죠. 하지만 그 화려함 만큼이나 가격이 부담되는 분들이 있으실 것입니다. 여기 저렴한 가격에 친절한 주인분까지 있는 집을 소개 드립니다. 주로 소음을 피해 고학번들이 즐겨 찾는 신안리에 위치하고 있는 스마일 하우스....집 앞으로 은하수 마트 가 있고 주차장이 따로 마련되어 있습니다. 동일 건물 3층에 거주하고 있으시는 주인분들이 참 친절하십니다. 학생의 불편을 최소화 하고자 노력 하십니다.</p>
									</div>
									<!-- third slide -->
									<div>
										<h3 onclick="javascript:location.href='./board/index.php?mode=house_view&h_cd=113';">대창아튼빌</h3> 
										<img onclick="javascript:location.href='./board/index.php?mode=house_view&h_cd=113';" src="http://iuniv.kr/imageData/thumbOpen2/2042081282_63d14027_IMG_0261-6.jpg" width="250" height="250" alt="신동아 305호" style="float:left;margin:15px 30px 20px 0" /> 
										<p style="font-weight:bold">연락처 : 011-236-7904 <br>주소 : 서창리 297-1</p> 
										<p>&nbsp;주소상 서창리 이고 침산리에 더 가까운 대창 아튼빌 입니다. 조여고 쪽 육교 에서 욱일아파트 방향에 있는 조용한 집입니다. 2007년 후반기에 완공된 깨끗한 건물,욱일 아파트 상권과 걸어서 5분거리라서 편의점,식당 등을 이용하기에 좋습니다. 총 5층으로 이루어진 건물에 학교 근처 건물에선 보기 드물에 엘리베이터가 있어 고층 거주도 불편함이 없습니다.</p>
									</div>
								</div>
								 <!-- the tabs -->
								<div class="tools_com_house_tabs">
									<a href="#"></a>
									<a href="#"></a>
									<a href="#"></a>
									<a href="#"></a>
									<a href="#"></a>
									<a href="#"></a>
								</div> 
								<div class="tools_com_house_button" style="clear:both;margin:30px 0;text-align:center;padding-right:40px"> 
									<button onClick='$("div.tools_com_house_tabs").tabs().play();'>Play</button>
									<button onClick='$("div.tools_com_house_tabs").tabs().stop();'>Stop</button>
								</div>
							</div>
							<!-------------------------------------------------------------------------/tools > /추천주거--------------------->

							<!-------------------------------------------------------------------------tools > 식당정보--------------------->
							<div  class="tool" style="background-image:url(<?=$IU[url]?>/css/img/tools/tools_content_bg4.jpg)">
								<div><img onclick="location.href='./index.php?mode=restaurant&order=nightfood'" style='cursor:pointer;'  src="<?=$IU[url]?>/css/img/tools/tools_food_icon1.png"></div>
								<div><img onclick="location.href='./index.php?mode=restaurant&order=big'" style='cursor:pointer;'  src="<?=$IU[url]?>/css/img/tools/tools_food_icon2.png"></div>
								<div><img onclick="location.href='./index.php?mode=restaurant&order=cheap'" style='cursor:pointer;'  src="<?=$IU[url]?>/css/img/tools/tools_food_icon3.png"></div>
								<div><img onclick="location.href='./index.php?mode=restaurant&order=matzip'" style='cursor:pointer;'  src="<?=$IU[url]?>/css/img/tools/tools_food_icon4.png"></div>
								<div><img onclick="location.href='./index.php?mode=restaurant&order=party'" style='cursor:pointer;'  src="<?=$IU[url]?>/css/img/tools/tools_food_icon5.png"></div>
								<div><img onclick="location.href='./index.php?mode=restaurant&order=soju'" style='cursor:pointer;'  src="<?=$IU[url]?>/css/img/tools/tools_food_icon6.png"></div>
							</div>
							<!-------------------------------------------------------------------------tools > /식당정보--------------------->
							<!-------------------------------------------------------------------------tools > 주거정보--------------------->
							<div  class="tool" style="background:url(<?=$IU[url]?>/css/img/tools/tools_content_bg4.jpg)  no-repeat">
								<div><img onclick="location.href='./index.php?mode=house_list&order=luxury'" style='cursor:pointer;' src="<?=$IU[url]?>/css/img/tools/tools_house_icon1.png" ></div>
								<div><img onclick="location.href='./index.php?mode=house_list&order=cheap'" style='cursor:pointer;' src="<?=$IU[url]?>/css/img/tools/tools_house_icon2.png"></div>
								<div><img onclick="location.href='./index.php?mode=house_list&order=quiet'" style='cursor:pointer;' src="<?=$IU[url]?>/css/img/tools/tools_house_icon3.png"></div>
								<div><img onclick="location.href='./index.php?mode=house_list&hasuk_yn=Y'" style='cursor:pointer;' src="<?=$IU[url]?>/css/img/tools/tools_house_icon4.png"></div>
								<div><img onclick="location.href='./index.php?mode=house_list&order=luxury'" style='cursor:pointer;' src="<?=$IU[url]?>/css/img/tools/tools_house_icon5.png"></div>
								<div><img onclick="location.href='./index.php?mode=house_list&order=good_point'" style='cursor:pointer;' src="<?=$IU[url]?>/css/img/tools/tools_house_icon6.png"></div>
							</div>
							<!-------------------------------------------------------------------------tools > /주거정보--------------------->
							<div  class="tool" style="background:url(<?=$IU[url]?>/css/img/tools/tools_content_bg4.jpg)  no-repeat">
								<!-- main navigator -->
								<ul id="tools_menu_main_navi"> 
									<li><strong>치킨</strong></li>
									<li><strong>피자</strong></li>
									<li><strong>탕수육/깐풍기</strong></li>
									<li><strong>자장면/짬뽕</strong></li>
									<li><strong>해장국/순대국</strong></li>
									<li><strong>보쌈/족발</strong></li>
									<li><strong>분식/기타</strong></li>
								</ul>
								<!-- root element for the main scrollable -->
								<div id="tools_menu_main"> 
									<!-- root element for pages -->
									<div id="tools_menu_pages"> 
										<!-- page #1 -->
										<div class="tools_menu_page"> 
											<!-- sub navigator #1 -->
											<div class="tools_menu_navi"></div> 
											<!-- inner scrollable #1 -->
											<div class="tools_menu_scrollable"> 
												<!-- root element for scrollable items -->
												<div class="tools_menu_items"> 
													<!-- items  -->
													<div class="tools_menu_item">
														<div class="menu_box" style="background:#fff url(./css/img/tools/menu_food_1_1.jpg) repeat-x;">
															<div class="menu_text_box"> 
																<h1>아프리카<span onclick="javascript:location.href='./board/bbs/board.php?bo_table=restaurant&wr_id=58'">more</span></h1>
																<h2>041-866-8840</h2>
																<h3>간장마늘 : 14,000</h3>
															</div>
														</div>
														<div class="menu_box" style="background:#fff url(./css/img/tools/menu_food_1_2.jpg) repeat-x;">
															<div class="menu_text_box"> 
																<h1>다송<span onclick="javascript:location.href='./board/bbs/board.php?bo_table=restaurant&wr_id=83'">more</span></h1>
																<h2>041-865-9910</h2>
																<h3>파닭/양념 : 13,000</h3>
															</div>
														</div>
														<div class="menu_box" style="background:#fff url(./css/img/tools/menu_food_1_3.jpg) repeat-x;">
															<div class="menu_text_box"> 
																<h1>호식이 두마리<span onclick="javascript:location.href='./board/bbs/board.php?bo_table=restaurant&wr_id=61'">more</span></h1>
																<h2>041-864-9922</h2>
																<h3>간장&후라이드 : 15,000</h3>
															</div>
														</div>
														<div class="menu_box" style="background:#fff url(./css/img/tools/menu_food_1_4.jpg) repeat-x;">
															<div class="menu_text_box"> 
																<h1>네네<span onclick="javascript:location.href='./board/bbs/board.php?bo_table=restaurant&wr_id=82'">more</span></h1>
																<h2>041-862-9285</h2>
																<h3>양념&후라이드 : 15,000</h3>
															</div>
														</div>
														<div class="menu_box" style="background:#fff url(./css/img/tools/menu_food_1_5.jpg) repeat-x;">
															<div class="menu_text_box"> 
																<h1>리치리치<span onclick="javascript:location.href='./board/bbs/board.php?bo_table=restaurant&wr_id=76'">more</span></h1>
																<h2>041-866-2782</h2>
																<h3>매운맛구운치킨 : 13,000</h3>
															</div>
														</div>
														<div class="menu_box" style="background:#fff url(./css/img/tools/menu_food_1_6.jpg) repeat-x;">
															<div class="menu_text_box"> 
																<h1>백록담<span onclick="javascript:location.href='./board/bbs/board.php?bo_table=restaurant&wr_id=115'">more</span></h1>
																<h2>041-868-8001</h2>
																<h3>반반바베큐 : 14,000</h3>
															</div>
														</div>
													</div>
													<div class="tools_menu_item">
														12
													</div>
													<div class="tools_menu_item">
														13
													</div>
												</div>
											</div>
										</div>
										<!-- page #2 -->
										<div class="tools_menu_page"> 
											<div class="tools_menu_navi"></div> 
											<!-- inner scrollable #2 -->
											<div class="tools_menu_scrollable"> 
												<!-- root element for scrollable items -->
												<div class="tools_menu_items"> 
													<!-- items on the second page -->
													<div class="tools_menu_item">
														<div class="menu_box" style="background:#fff url(./css/img/tools/menu_food_2_1.jpg) repeat-x;">
															<div class="menu_text_box"> 
																<h1>피자에땅<span onclick="javascript:location.href='./board/bbs/board.php?bo_table=restaurant&wr_id=207'">more</span></h1>
																<h2>041-865-3651</h2>
																<h3>옥토쉬림프XL(2판) : 27,900</h3>
																<h3>스윗나마스떼(2판) : 27,900</h3>
															</div>
														</div>
														<div class="menu_box" style="background:#fff url(./css/img/tools/menu_food_2_2.jpg) repeat-x;">
															<div class="menu_text_box"> 
																<h1>카티지피자<span onclick="javascript:location.href='./board/bbs/board.php?bo_table=restaurant&wr_id=176'">more</span></h1>
																<h2>041-865-8482</h2>
																<h3>도이치L : 21,000</h3>
																<h3>윙골드L : 21,000</h3>
															</div>
														</div>
														<div class="menu_box" style="background:#fff url(./css/img/tools/menu_food_2_3.jpg) repeat-x;">
															<div class="menu_text_box"> 
																<h1>미스터피자<span onclick="javascript:location.href='./board/bbs/board.php?bo_table=restaurant&wr_id=208'">more</span></h1>
																<h2>041-866-1177</h2>
																<h3>게살몽땅R(ori.) : 25,500</h3>
																<h3>쉬림프R(ori.) : 22,500</h3>
															</div>
														</div>
														<div class="menu_box" style="background:#fff url(./css/img/tools/menu_food_2_4.jpg) repeat-x;">
															<div class="menu_text_box"> 
																<h1>도미노피자<span onclick="javascript:location.href='./board/bbs/board.php?bo_table=restaurant&wr_id=82'">more</span></h1>
																<h2>041-865-3082</h2>
																<h3>양념&후라이드 : 15,000</h3>
															</div>
														</div>
														<div class="menu_box" style="background:#fff url(./css/img/tools/menu_food_2_5.jpg) repeat-x;">
															<div class="menu_text_box"> 
																<h1>베베피자<span onclick="javascript:location.href='./board/bbs/board.php?bo_table=restaurant&wr_id=76'">more</span></h1>
																<h2>041-865-9282</h2>
															</div>
														</div>
														<div class="menu_box" style="background:#fff url(./css/img/tools/menu_food_2_6.jpg) repeat-x;">
															<div class="menu_text_box"> 
																<h1>두배로 치킨.피자<span onclick="javascript:location.href='./board/bbs/board.php?bo_table=restaurant&wr_id=76'">more</span></h1>
																<h2>041-866-4321</h2>
																<h3>치즈크러스트 : 10,000</h3>
																<h3>순살치킨2마리 : 12,000</h3>
															</div>
														</div>
													</div>
													<div class="tools_menu_item">
														22
													</div>
													<div class="tools_menu_item">
														23
													</div> 
												</div> 
											</div> 
										</div> 
										<!-- page #3 -->
										<div class="tools_menu_page"> 
											<div class="tools_menu_navi"></div> 
											<!-- inner scrollable #3 -->
											<div class="tools_menu_scrollable"> 
												<!-- root element for scrollable items -->
												<div class="tools_menu_items"> 
													<!-- items on the first page -->
													<div class="tools_menu_item">
														<div class="menu_box" style="background:#fff url(./css/img/tools/menu_food_3_1.jpg) repeat-x;">
															<div class="menu_text_box"> 
																<h1>이선영 별난 탕수육<span onclick="javascript:location.href='./board/bbs/board.php?bo_table=restaurant&wr_id=66'">more</span></h1>
																<h2>041-865-9991</h2>
																<h3>별난피자치즈(중) : 16,000</h3>
																<h3>양념탕수육(중) : 14,000</h3>
															</div>
														</div>
														<div class="menu_box" style="background:#fff url(./css/img/tools/menu_food_nothing.jpg) repeat-x;">
															<div class="menu_text_box"> 
																<h1>송박사 탕수육<span onclick="javascript:location.href='./board/bbs/board.php?bo_table=restaurant&wr_id=166'">more</span></h1>
																<h2>041-865-7361</h2>
																<h3>양념/송박사탕수육(중) : 13,000</h3>
															</div>
														</div>
														<div class="menu_box" style="background:#fff url(./css/img/tools/menu_food_3_3.jpg) repeat-x;">
															<div class="menu_text_box"> 
																<h1>북경깐풍기<span onclick="javascript:location.href='./board/bbs/board.php?bo_table=restaurant&wr_id=67'">more</span></h1>
																<h2>041-868-8228</h2>
																<h3>북경깐풍기(대) : 13,000</h3>
															</div>
														</div>
														<div class="menu_box" style="background:#fff url(./css/img/tools/menu_food_nothing.jpg) repeat-x;">
															<div class="menu_text_box"> 
																<h1>미등록</h1>
															</div>
														</div>
														<div class="menu_box" style="background:#fff url(./css/img/tools/menu_food_nothing.jpg) repeat-x;">
															<div class="menu_text_box"> 
																<h1>미등록</h1>
															</div>
														</div>
														<div class="menu_box" style="background:#fff url(./css/img/tools/menu_food_nothing.jpg) repeat-x;">
															<div class="menu_text_box"> 
																<h1>미등록</h1>
															</div>
														</div>
													</div>
													<div class="tools_menu_item">
														32
													</div>
													<div class="tools_menu_item">
														33
													</div> 
												</div> 
											</div> 
										</div> 
										<!-- page #4 -->
										<div class="tools_menu_page"> 
											<div class="tools_menu_navi"></div> 
											<!-- inner scrollable #4 -->
											<div class="tools_menu_scrollable"> 
												<!-- root element for scrollable items -->
												<div class="tools_menu_items"> 
													<!-- items on the first page -->
													<div class="tools_menu_item">
														<div class="menu_box" style="background:#fff url(./css/img/tools/menu_food_4_1.jpg) repeat-x;">
															<div class="menu_text_box"> 
																<h1>자금성
																<span onclick="javascript:location.href='./board/bbs/board.php?bo_table=restaurant&wr_id=158'">more</span></h1>
																<h2>041-868-2333</h2>
																<h3>짬뽕 : 4,000</h3>
																<h3>자장면 : 3,500</h3>
															</div>
														</div>
														<div class="menu_box" style="background:#fff url(./css/img/tools/menu_food_4_3.jpg) repeat-x;">
															<div class="menu_text_box"> 
																<h1>고대반점<span onclick="javascript:location.href='./board/bbs/board.php?bo_table=restaurant&wr_id=17'">more</span></h1>
																<h2>041-863-6667</h2>
																<h3>set1(탕+짜1+짬1) : 14000</h3>
																<h3>set2(탕+짜2) : 13000</h3>
															</div>
														</div>
														<div class="menu_box" style="background:#fff url(./css/img/tools/menu_food_4_3.jpg) repeat-x;">
															<div class="menu_text_box"> 
																<h1>북경손짜장(수타)<span onclick="javascript:location.href='./board/bbs/board.php?bo_table=restaurant&wr_id=187'">more</span></h1>
																<h2>041-865-2244</h2>
																<h3>자장면 : 4,000</h3>
																<h3>짬뽕 : 5,000</h3>
															</div>
														</div>
														<div class="menu_box" style="background:#fff url(./css/img/tools/menu_food_nothing.jpg) repeat-x;">
															<div class="menu_text_box"> 
																<h1>흑룡강</h1>
																<h2>041-862-8420</h2>
															</div>
														</div>
														<div class="menu_box" style="background:#fff url(./css/img/tools/menu_food_nothing.jpg) repeat-x;">
															<div class="menu_text_box"> 
																<h1>미등록</h1>
															</div>
														</div>
														<div class="menu_box" style="background:#fff url(./css/img/tools/menu_food_nothing.jpg) repeat-x;">
															<div class="menu_text_box"> 
																<h1>미등록</h1>
															</div>
														</div>
													</div>
													<div class="tools_menu_item">
														42
													</div>
													<div class="tools_menu_item">
														43
													</div> 
												</div> 
											</div> 
										</div> 
										<!-- page #5 -->
										<div class="tools_menu_page"> 
											<div class="tools_menu_navi"></div> 
											<!-- inner scrollable #5 -->
											<div class="tools_menu_scrollable"> 
												<!-- root element for scrollable items -->
												<div class="tools_menu_items"> 
													<!-- items on the first page -->
													<div class="tools_menu_item">
														<div class="menu_box" style="background:#fff url(./css/img/tools/menu_food_5_1.jpg) repeat-x;">
															<div class="menu_text_box"> 
																<h1>조인해장국<span onclick="javascript:location.href='./board/bbs/board.php?bo_table=restaurant&wr_id=58'">more</span></h1>
																<h2>041-865-7078</h2>
																<h3>등뼈해장국 : 5,000</h3>
																<h3>순대해장국 : 5,000</h3>
															</div>
														</div>
														<div class="menu_box" style="background:#fff url(./css/img/tools/menu_food_5_2.jpg) repeat-x;">
															<div class="menu_text_box"> 
																<h1>남들 감자탕<span onclick="javascript:location.href='./board/bbs/board.php?bo_table=restaurant&wr_id=58'">more</span></h1>
																<h2>041-866-8253</h2>
																<h3>뼈다귀해장국 : 5,000</h3>
															</div>
														</div>
														<div class="menu_box" style="background:#fff url(./css/img/tools/menu_food_5_3.jpg) repeat-x;">
															<div class="menu_text_box"> 
																<h1>뚝배기나라<span onclick="javascript:location.href='./board/bbs/board.php?bo_table=restaurant&wr_id=58'">more</span></h1>
																<h2>041-865-1178</h2>
																<h3>뼈다귀해장국 : 5,000</h3>
																<h3>감자탕(소) : 17,000</h3>
															</div>
														</div>
														<div class="menu_box" style="background:#fff url(./css/img/tools/menu_food_5_4.jpg) repeat-x;">
															<div class="menu_text_box"> 
																<h1>송탄부대찌개<span onclick="javascript:location.href='./board/bbs/board.php?bo_table=restaurant&wr_id=215'">more</span></h1>
																<h2>041-867-8866</h2>
															</div>
														</div>
														<div class="menu_box" style="background:#fff url(./css/img/tools/menu_food_nothing.jpg) repeat-x;">
															<div class="menu_text_box"> 
																<h1>미등록</h1>
															</div>
														</div>
														<div class="menu_box" style="background:#fff url(./css/img/tools/menu_food_nothing.jpg) repeat-x;">
															<div class="menu_text_box"> 
																<h1>미등록</h1>
															</div>
														</div>
													</div>
													<div class="tools_menu_item">
														52
													</div>
													<div class="tools_menu_item">
														53
													</div> 
												</div> 
											</div> 
										</div> 
										<!-- page #6 -->
										<div class="tools_menu_page"> 
											<div class="tools_menu_navi"></div> 
											<!-- inner scrollable #6 -->
											<div class="tools_menu_scrollable"> 
												<!-- root element for scrollable items -->
												<div class="tools_menu_items"> 
													<!-- items on the first page -->
													<div class="tools_menu_item">
														<div class="menu_box" style="background:#fff url(./css/img/tools/menu_food_nothing.jpg) repeat-x;">
															<div class="menu_text_box"> 
																<h1>꼬마족발</h1>
																<h2>041-868-3336</h2>
															</div>
														</div>
														<div class="menu_box" style="background:#fff url(./css/img/tools/menu_food_nothing.jpg) repeat-x;">
															<div class="menu_text_box"> 
																<h1>장충동왕족발보쌈 </h1>
																<h2>041-864-3300</h2>
															</div>
														</div>
														<div class="menu_box" style="background:#fff url(./css/img/tools/menu_food_nothing.jpg) repeat-x;">
															<div class="menu_text_box"> 
																<h1>왕초왕족발보쌈</h1>
																<h2>041-863-4001</h2>
															</div>
														</div>
														<div class="menu_box" style="background:#fff url(./css/img/tools/menu_food_nothing.jpg) repeat-x;">
															<div class="menu_text_box"> 
																<h1>미등록</h1>
															</div>
														</div>
														<div class="menu_box" style="background:#fff url(./css/img/tools/menu_food_nothing.jpg) repeat-x;">
															<div class="menu_text_box"> 
																<h1>미등록</h1>
															</div>
														</div>
														<div class="menu_box" style="background:#fff url(./css/img/tools/menu_food_nothing.jpg) repeat-x;">
															<div class="menu_text_box"> 
																<h1>미등록</h1>
															</div>
														</div>
													</div>
													<div class="tools_menu_item">
														62
													</div>
													<div class="tools_menu_item">
														63
													</div> 
												</div> 
											</div> 
										</div>
										<!-- page #7 -->
										<div class="tools_menu_page"> 
											<div class="tools_menu_navi"></div> 
											<!-- inner scrollable #7 -->
											<div class="tools_menu_scrollable"> 
												<!-- root element for scrollable items -->
												<div class="tools_menu_items"> 
													<!-- items on the first page -->
													<div class="tools_menu_item">
														<div class="menu_box" style="background:#fff url(./css/img/tools/menu_food_7_1.jpg) repeat-x;">
															<div class="menu_text_box"> 
																<h1>한솥도시락<span onclick="javascript:location.href='./board/bbs/board.php?bo_table=restaurant&wr_id=209'">more</span></h1>
																<h2>041-866-4582</h2>
																<h3>치킨마요 : 2,500</h3>
																<h3>돈까스도련님스패셜 : 4,200</h3>
															</div>
														</div>
														<div class="menu_box" style="background:#fff url(./css/img/tools/menu_food_7_2.jpg) repeat-x;">
															<div class="menu_text_box"> 
																<h1>샌드데이<span onclick="javascript:location.href='./board/bbs/board.php?bo_table=restaurant&wr_id=102'">more</span></h1>
																<h2>041-862-3322</h2>
																<h3>치킨햄샌드 : 2,500</h3>
																<h3>햄&치즈오믈렛샌드 : 3,000</h3>
															</div>
														</div>
														<div class="menu_box" style="background:#fff url(./css/img/tools/menu_food_7_3.jpg) repeat-x;">
															<div class="menu_text_box"> 
																<h1>명동왕만두<span onclick="javascript:location.href='./board/bbs/board.php?bo_table=restaurant&wr_id=77'">more</span></h1>
																<h2>041-866-1524</h2>
																<h3>고기만두 : 2,500&nbsp&nbsp물만두 : 3,000</h3>
																<h3>제육덮밥 : 4,000</h3>
															</div>
														</div>
														<div class="menu_box" style="background:#fff url(./css/img/tools/menu_food_7_4.jpg) repeat-x;">
															<div class="menu_text_box"> 
																<h1>만두나라 김밥마을<span onclick="javascript:location.href='./board/bbs/board.php?bo_table=restaurant&wr_id=163'">more</span></h1>
																<h2>041-866-5550</h2>																
																<h3>오삼불덮 : 5,000&nbsp&nbsp순두부 : 4,500</h3>
																<h3>치즈돈까스 : 6,000</h3>
															</div>
														</div>
														<div class="menu_box" style="background:#fff url(./css/img/tools/menu_food_nothing.jpg) repeat-x;">
															<div class="menu_text_box"> 
																<h1>미등록</h1>
															</div>
														</div>
														<div class="menu_box" style="background:#fff url(./css/img/tools/menu_food_nothing.jpg) repeat-x;">
															<div class="menu_text_box"> 
																<h1>미등록</h1>
															</div>
														</div>
													</div>
													<div class="tools_menu_item">
														72
													</div>
													<div class="tools_menu_item">
														73
													</div> 
												</div> 
											</div> 
										</div> 
									</div> 
								</div>
							</div>
							<!-- expose -->
							
							
						</div>
						<!-- /2~4 "page" -->
						<!-- intro "page" -->
						<!--------------------------------------------------------------------------------------------------------helpTalk--------------------------->
						<div  id="intro" class="tool" style="background:url(<?=$IU[url]?>/css/img/tools/h320.png)  x-repeat">
							<!-- HTML structures -->
							<!--
							<div id="talk_actions">
								<a class="prevPage">&laquo; Back</a>
								<a class="nextPage">More pictures &raquo;</a>
							</div>
							 -->
							<!-- root element for scrollable -->
							<div class="talk_vertical">
								<!-- root element for the items -->
								<div class="talk_items">
									<?echo $st_helptalk;	//dbo_main->helptalk ?>
								</div>
							</div>								
						</div>
						<!---------------------------------------------------------------------------------------------------------/helpTalk---------------------------->
							<!-- required for IE6/IE7 -->
						<br clear="all" />
						<!-- thumbnails -->
						<div id="thumbs" class="t">
							<!-- intro page navi button -->
							<a id="t4" class="active"></a>
							<!-- scrollable navigator root element -->
							<div class="navi">
								<a style="display:none"></a>
								<a id="t0"></a>
								<a id="t1"></a>
								<a id="t2"></a>
								<a id="t3"></a>
								
							</div>
						</div>
					</div>
				</ul>
			</div>
		</li>
		<br>
		
		
		<li class="widget" id="widget22">
			<div class="widget-head-tab">
				<ul class="tabs">
					<li><a href="#">룸메이트</a></li>
					<li><a href="#">방거래</a></li>
					<li><a href="#">질문답변</a></li>
					<li><a href="#">알바정보</a></li>
				</ul>
			</div>
			<div class="widget-content">
				<!-- tab "panes" -->
				<div class="tab_panes">
					<div><?=$st_roommate?></div>
					<div><?=$st_marketroom?></div>
					<div><?=$st_qna?></div>
					<div><?=$st_albainfo?></div>
				</div>
			</div>
		</li>
		<li class="widget" id="widget21"> 
		<?
			//include"./main_j_gallery2.php";
		?> 
		</li>
		<!--
		<li class="widget" id="widget22">  
			<div class="widget-head">
				<a href="http://net.tutsplus.com"><img src="css/dash_img/dt_restaurant.png" alt="식당/배달 정보" title="식당/배달 정보" class="widget-logo" /></a>
				<h3>식당/배달 정보</h3>
			</div>
			<div class="widget-content">
				<ul class="myfeed"><li><a href="http://feedproxy.google.com/~r/nettuts/~3/HOB4iYwmYRY/" rel="external">How to Make All Browsers Render HTML5 Mark-up Correctly – Even IE6</a></li><li><a href="http://feedproxy.google.com/~r/nettuts/~3/rNUV47ui378/" rel="external">Getting Started with XSL(T)</a></li><li><a href="http://feedproxy.google.com/~r/nettuts/~3/0A98fSFgvNY/" rel="external">Sexy Animated Tabs Using MooTools</a></li><li><a href="http://feedproxy.google.com/~r/nettuts/~3/FgnkJPN_68g/" rel="external">How to Make All Browsers Render HTML5 Mark-up Correctly: Screencast</a></li><li><a href="http://feedproxy.google.com/~r/nettuts/~3/GMS9_RFKc7I/" rel="external">Terminal, Git, and GitHub for the Rest of Us: Screencast</a></li>
				</ul>
		  </div>
		</li>-->
		<!--
		<li class="widget" id="widget23">  
			<div class="widget-head">
				<a href="http://vector.tutsplus.com"><img src="css/dash_img/dt_house.png" alt="주거정보" title="주거정보" class="widget-logo" /></a>
				<h3>주거 정보</h3>
			</div>
			<div class="widget-content">
				<ul class="myfeed"><li><a href="http://feedproxy.google.com/~r/vectortuts/~3/neiUCcMlXIs/" rel="external">Create a Vector Tree with Custom Brushes and the Gradient Mesh Tool</a></li><li><a href="http://feedproxy.google.com/~r/vectortuts/~3/uGePi7Fvc9w/" rel="external">Comment to Win: a Book on Character Facial Expressions</a></li><li><a href="http://feedproxy.google.com/~r/vectortuts/~3/KcPtCl4GEOA/" rel="external">Create an Illustration of a Pearl-Filled Clam on an Ocean Bed</a></li><li><a href="http://feedproxy.google.com/~r/vectortuts/~3/Qyd3Uof7Qbg/" rel="external">Interview with Chris Leavens</a></li><li><a href="http://feedproxy.google.com/~r/vectortuts/~3/zv3IVYHPC-Q/" rel="external">Sexy Vector Cell Phone</a></li>
				</ul>
		  </div>
		</li>
		 <li class="widget" id="widget24">  
			<div class="widget-head">
				<a href="http://ae.tutsplus.com"><img src="/wp-content/themes/tutsplus/images/aetuts.png" alt="Aetuts+" class="widget-logo" /></a>
				<h3>Latest</h3>
			</div>
			<div class="widget-content">
				<ul class="myfeed"><li><a href="http://feedproxy.google.com/~r/aetuts/~3/Lzi76Q4e2_k/" rel="external">Enhance Your Images With HolOS – AE Plus</a></li><li><a href="http://feedproxy.google.com/~r/aetuts/~3/laTGEJ_PcA8/" rel="external">Learn How To Composite A Zombie-Like Tear Of Blood</a></li><li><a href="http://feedproxy.google.com/~r/aetuts/~3/Y3aTpLnbKas/" rel="external">Create A Heart Monitor With Expressions</a></li><li><a href="http://feedproxy.google.com/~r/aetuts/~3/mJpk_3L53Po/" rel="external">15 Companies That Make After Effects Plug-ins</a></li><li><a href="http://feedproxy.google.com/~r/aetuts/~3/tXWiNGrOeWI/" rel="external">How to Make “When I Was Your Age” Footage</a></li>
				</ul>
		  </div>
		</li>-->
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
		<!---------------------------------------------------------------------최근 댓글---------------------------------------------------->
		<!---------------------------------------------------------------------파란 위치정보 접속정보-------------------------------------->
		<!-- <li class="widget" id="widget31">
			<div class="widget"><img src='http://local.paran.com/widgetConn/?uc=feaa2ef830a63dc6b2319bab8e027f7a' width=150 height=244 border=0 style='DISPLAY: none; '> <embed src='http://image.paran.com/search/local/widget/Visit.swf' flashVars='userCode=feaa2ef830a63dc6b2319bab8e027f7a&skinType=2&iconType=4&colorType=4' quality='high' bgcolor='#ffffff' width='150' height='244' allowScriptAccess='always' wmode='transparent' allowFullScreen='false' type='application/x-shockwave-flash' pluginspage='http://www.macromedia.com/go/getflashplayer'></div>  
		</li> -->
		<!---------------------------------------------------------------------/파란 위치정보 접속정보-------------------------------------->
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
