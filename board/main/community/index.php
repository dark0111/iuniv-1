<?
include_once("/board/_common.php"); 
include_once("$g4[path]/lib/latest.lib.php"); 
include_once("/board/_head.php");
?>

<!-- 메인테이블 -->
<table border="0" cellpadding="0" cellspacing="0" width="950">
<tr>
	<td width="270" valign="top">
		<!-- 이미지 및 왼쪽메뉴 -->
		<table border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td colspan="2"><img src="../image/sub_left_img.gif" border="0"></td></tr>
		<tr>
			<td width="55"></td>
			<td width="215" valign="top">
				<!-- 왼쪽메뉴플래시 적용 부분-->
				<script type="text/javascript">
					FlashObject("../swf/left03.swf", 193, 248, "#ffffff", "");
				</script>
				<!-- /왼쪽메뉴플래시 적용 부분-->

				<!-- 공간 -->
				<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td height="16"></td></tr>
				</table>
				<!-- /공간 -->

				<!-- 왼쪽배너 -->
				<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td width="13"></td>
					<td height="62" valign="top"><a href="#"><img src="../image/left_banner01.gif" border="0" alt="홍보동영상"></a></td></tr>
				<tr>
					<td></td>
					<td valign="top"><a href="#"><img src="../image/left_banner02.gif" border="0" alt="클럽자료실"></a></td></tr>
				</table>
				<!-- /왼쪽배너 -->
			</td></tr>
		</table>
		<!-- /이미지 및 왼쪽메뉴 -->
	</td>
	<td width="680" valign="top" align="center">
		<!-- 서브비쥬얼플래시 적용 부분-->
		<script type="text/javascript">
			FlashObject("../swf/subvisual.swf", 680, 140, "#ffffff", "");
		</script>
		<!-- /서브비쥬얼플래시 적용 부분-->

		<!-- 위치타이틀 -->
		<table border="0" cellpadding="0" cellspacing="0" background="../image/tit_bg.gif">
		<tr>
			<td><img src="../image/tit_edge01.gif" border="0"></td>
			<td><img src="image/tit.gif" border="0"></td>
			<td width="486" align="right" style="color:#aaabab;line-height:px"><img src="../image/tit_icon.gif" border="0" align="absmiddle">&nbsp;Home > <b>커뮤니티</b></td>
			<td><img src="../image/tit_edge02.gif" border="0"></td></tr>
		</table>
		<!-- /위치타이틀 -->

		<!-- 공간 -->
		<table border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td height="14"></td></tr>
		</table>
		<!-- /공간 -->

		<!-- 이미지 및 텍스트 -->
		<table border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td valign="top"><img src="image/tit_txt.gif" border="0"></td>
			<td><img src="image/tit_img01.gif" border="0"></td></tr>
		</table>
		<!-- /이미지 및 텍스트 -->

		<!-- 게시판 -->
		<table border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td width="24">&nbsp;</td>
			<td width="329" style="font-family:Gulim;font-size:12px;color:#878b8c"><img src="image/arrow_btn.gif" border="0">&nbsp;총 <font style="font-family:Gulim;font-size:12px;color:#e86985"><b>12개</b></font> 의 글이 올라와 있습니다</td>
			<td width="277" align='right'><img src="image/tit_img02.gif" border="0"></td></tr>
		<tr>
			<td colspan='3'><!-- 서브메인시작 -->
				<table width='630' cellspacing='0' cellpadding='0' border='0'>
					<tr valign='top'>
					<td width='2'></td>	
					<td width='345'>	
						<!-- 펀드뉴스 -->
						<table width='335' cellspacing='0' cellpadding='0' border='0'>
						<tr valign='top'>
						<td height='17'><img src="<?=$g4[path]?>/main/community/image/stit_freeboard.gif" border="0" align="absmiddle"></td>
						<td align='right'><a href='/news/news_fund.nhn'><img src='http://imgfinance.naver.com/bank/btn_more.gif' alt='더보기' width='37' height='10' style='margin:0px 5px 0 0'></a></td>
						</tr>
						<tr><td height='1' colspan='2' bgcolor='#DBCA8F'></td></tr>
						</table>
						
						<table width='335' cellspacing='0' cellpadding='0'>
						<tr><td height='10'></td></tr>

						<tr><td height='20'><img src="<?=$g4[path]?>/main/image/dot.gif" border="0" align="absmiddle"><a href='/news/news_fund_view.nhn?office_id=014&article_id=0002175326'>국내주식형펀드 11일째 자금유출 지속</a></td></tr>
				
						<tr><td height='20'><img src="<?=$g4[path]?>/main/image/dot.gif" border="0" align="absmiddle"><a href='/news/news_fund_view.nhn?office_id=003&article_id=0002801603'>국내펀드 수익률 2주째 '플러스'…해외펀드도 신바람</a></td></tr>
				
						<tr><td height='20'><img src="<?=$g4[path]?>/main/image/dot.gif" border="0" align="absmiddle"><a href='/news/news_fund_view.nhn?office_id=112&article_id=0002024713'>국내주식형펀드 수익률 2주째 ‘플러스’</a></td></tr>
				
						<tr><td height='20'><img src="<?=$g4[path]?>/main/image/dot.gif" border="0" align="absmiddle"><a href='/news/news_fund_view.nhn?office_id=001&article_id=0002792616'>국내 주식펀드 수익률 2주째 '+'</a></td></tr>
				
						<tr><td height='24'></td></tr>
						</table>
						<!-- //펀드뉴스 -->

						<!-- 환율뉴스 -->
						<table width='335' cellspacing='0' cellpadding='0' border='0'>
						<tr valign='top'>
						<td height='17' >환율 뉴스</td>
						<td align='right'><a href='/news/news_exchange_rate.nhn'><img src='http://imgfinance.naver.com/bank/btn_more.gif' alt='더보기' width='37' height='10' style='margin:1px 5px 0 0'></a></td>
						</tr>
						<tr><td height='1' colspan='2' bgcolor='#DBCA8F'></td></tr>
						</table>
						
						<table width='335' cellspacing='0' cellpadding='0' border='0'>
						<tr><td height='10'></td></tr>

						<tr><td height='20'><img src='http://imgfinance.naver.com/bank/sq_gray01.gif' width='2' height='2' alt='' style='margin:0 4px 4px 6px'><a href='/news/news_exchange_rate_view.nhn?office_id=008&article_id=0002184864'>미끄럼탄 환율, 어디까지 내릴까</a></td></tr>
				
						<tr><td height='20'><img src='http://imgfinance.naver.com/bank/sq_gray01.gif' width='2' height='2' alt='' style='margin:0 4px 4px 6px'><a href='/news/news_exchange_rate_view.nhn?office_id=018&article_id=0002138097'>(표)환율 주간 동향</a></td></tr>
				
						<tr><td height='20'><img src='http://imgfinance.naver.com/bank/sq_gray01.gif' width='2' height='2' alt='' style='margin:0 4px 4px 6px'><a href='/news/news_exchange_rate_view.nhn?office_id=055&article_id=0000164244'>코스피,1550선 연중 최고기록…환율은 연중 최저치</a></td></tr>
				
						<tr><td height='20'><img src='http://imgfinance.naver.com/bank/sq_gray01.gif' width='2' height='2' alt='' style='margin:0 4px 4px 6px'><a href='/news/news_exchange_rate_view.nhn?office_id=096&article_id=0000091953'>코스피,1550선 연중 최고기록…환율은 연중 최저치</a></td></tr>
				
						<tr><td height='24'></td></tr>
						</table>
						<!-- //환율뉴스 -->
						
						<!-- 예금 뉴스 -->
						<table width='335' cellspacing='0' cellpadding='0' border='0'>
						<tr valign='top'>
						<td height='17' >예금 뉴스</td>
						<td align='right'><a href='/news/news_deposit.nhn'><img src='http://imgfinance.naver.com/bank/btn_more.gif' alt='더보기' width='37' height='10' ></a></td>
						</tr>
						<tr><td height='1' colspan='2' bgcolor='#DBCA8F'></td></tr>
						</table>
						
						<table width='335' cellspacing='0' cellpadding='0' border='0'>
						<tr><td height='10'></td></tr>

						<tr><td height='20'><img src='http://imgfinance.naver.com/bank/sq_gray01.gif' width='2' height='2' alt='' style='margin:0 4px 4px 6px'><a href='/news/news_deposit_view.nhn?office_id=024&article_id=0000026646'>청약저축 있다면 세곡·우면지구 ‘으뜸’</a></td></tr>
				
						<tr><td height='20'><img src='http://imgfinance.naver.com/bank/sq_gray01.gif' width='2' height='2' alt='' style='margin:0 4px 4px 6px'><a href='/news/news_deposit_view.nhn?office_id=001&article_id=0002792446'><표> 은행 정기예금 금리(7.31일 기준)</a></td></tr>
				
						<tr><td height='20'><img src='http://imgfinance.naver.com/bank/sq_gray01.gif' width='2' height='2' alt='' style='margin:0 4px 4px 6px'><a href='/news/news_deposit_view.nhn?office_id=015&article_id=0002106917'>'대우證CMA 우대수익형' 출시</a></td></tr>
				
						<tr><td height='20'><img src='http://imgfinance.naver.com/bank/sq_gray01.gif' width='2' height='2' alt='' style='margin:0 4px 4px 6px'><a href='/news/news_deposit_view.nhn?office_id=277&article_id=0002204221'>금일 기준 정기예금 금리</a></td></tr>
				
						<tr><td height='24'></td></tr>
						</table>
						<!-- //예금 뉴스 -->
						
						<!-- 대출 뉴스 -->
						<table width='335' cellspacing='0' cellpadding='0' border='0'>
						<tr valign='top'>
						<td height='17'>대출 뉴스</td>
						<td align='right'><a href='/news/news_loan.nhn'><img src='http://imgfinance.naver.com/bank/btn_more.gif' alt='더보기' width='37' height='10' style='margin:1px 5px 0 0'></a></td>
						</tr>
						<tr><td height='1' colspan='2' bgcolor='#DBCA8F'></td></tr>
						</table>
						
						<table width='335' cellspacing='0' cellpadding='0'>
						<tr><td height='10'></td></tr>

						<tr><td height='20'><img src='http://imgfinance.naver.com/bank/sq_gray01.gif' width='2' height='2' alt='' style='margin:0 4px 4px 6px'><a href='/news/news_loan_view.nhn?office_id=021&article_id=0002002340'>수수료 없고 금리는 높고 대출은 쉽고</a></td></tr>
				
						<tr><td height='20'><img src='http://imgfinance.naver.com/bank/sq_gray01.gif' width='2' height='2' alt='' style='margin:0 4px 4px 6px'><a href='/news/news_loan_view.nhn?office_id=018&article_id=0002137888'>(새옷입은 CMA)한화證 `은행 부럽지 않은 대출`</a></td></tr>
				
						<tr><td height='20'><img src='http://imgfinance.naver.com/bank/sq_gray01.gif' width='2' height='2' alt='' style='margin:0 4px 4px 6px'><a href='/news/news_loan_view.nhn?office_id=277&article_id=0002203672'>"美 모기지업체, 구제금융 전액상환 어려워"</a></td></tr>
				
						<tr><td height='20'><img src='http://imgfinance.naver.com/bank/sq_gray01.gif' width='2' height='2' alt='' style='margin:0 4px 4px 6px'><a href='/news/news_loan_view.nhn?office_id=030&article_id=0002028277'>"취업한 뒤 갚는 학자금 대출제 내년 도입"</a></td></tr>
				
						<tr><td height='24'></td></tr>
						</table>
						<!-- //대출 뉴스 -->
						
						<!-- 카드 뉴스 -->
						<table width='335' cellspacing='0' cellpadding='0' border='0'>
						<tr valign='top'>
						<td height='17' >카드 뉴스</td>
						<td align='right'><a href='/news/news_card.nhn'><img src='http://imgfinance.naver.com/bank/btn_more.gif' alt='더보기' width='37' height='10' style='margin:1px 5px 0 0'></a></td>
						</tr>
						<tr><td height='1' colspan='2' bgcolor='#DBCA8F'></td></tr>
						</table>
						
						<table width='335' cellspacing='0' cellpadding='0'>
						<tr><td height='10'></td></tr>

						<tr><td height='20'><img src='http://imgfinance.naver.com/bank/sq_gray01.gif' width='2' height='2' alt='' style='margin:0 4px 4px 6px'><a href='/news/news_card_view.nhn?office_id=015&article_id=0002106972'>외환銀 '카드 포인트로 정치자금 기부'</a></td></tr>
				
						<tr><td height='20'><img src='http://imgfinance.naver.com/bank/sq_gray01.gif' width='2' height='2' alt='' style='margin:0 4px 4px 6px'><a href='/news/news_card_view.nhn?office_id=018&article_id=0002137986'>`외환카드 포인트로 정치자금 기부하세요`</a></td></tr>
				
						<tr><td height='20'><img src='http://imgfinance.naver.com/bank/sq_gray01.gif' width='2' height='2' alt='' style='margin:0 4px 4px 6px'><a href='/news/news_card_view.nhn?office_id=009&article_id=0002137653'>외환은행, 카드 포인트로 정치자금 기부</a></td></tr>
				
						<tr><td height='20'><img src='http://imgfinance.naver.com/bank/sq_gray01.gif' width='2' height='2' alt='' style='margin:0 4px 4px 6px'><a href='/news/news_card_view.nhn?office_id=018&article_id=0002137883'>(새옷입은 CMA)삼성證 `카드·쇼핑 혜택, 고수익 덤`</a></td></tr>
				

						<tr><td height='24'></td></tr>
						</table>
						<!-- //카드 뉴스 -->
					</td>
					<td width='198' align='center' bgcolor='#F3F2EE' style='padding:16px 0 20px 0'>

						<!-- 오늘의tv뉴스 -->


						<table width='178' cellspacing='0' cellpadding='0' border='0'>
						<tr valing='top'><td height='18' >오늘의 TV뉴스</td></tr>
						</table>
						
						<table width='184' cellspacing='0' cellpadding='0' bgcolor='#FFFFFF' style='border:1px solid #DFDED9'>
						<tr>
						<td align='center' style='padding:10px 0 9px 0'>
							<table width='155' cellspacing='0' cellpadding='0'>
							<tr><td align='center'><a href='/news/news_tv_view.nhn?office_id=052&article_id=0000260260'><img src='http://imgnews.naver.com/image/thumb120/052/2009/08/01/260260.jpg' width='120' height='88' alt=''></a></td></tr>
							<tr><td height='8'></td></tr>
							<tr><td  align='center'><a href='/news/news_tv_view.nhn?office_id=052&article_id=0000260260'>부시, "한미 FTA 비준 빨리해야" </a></td></tr>
							</table>
						</td>
						</tr>
						</table>
						<!--// 오늘의tv뉴스 -->
						
						<!-- 오늘의포토뉴스 -->

						<table width='178' cellspacing='0' cellpadding='0' border='0'>
						<tr><td height='20'></td></tr>
						<tr valing='top'><td height='18' >오늘의포토뉴스</td></tr>
						</table>
						
						<table width='184' cellspacing='0' cellpadding='0' bgcolor='#FFFFFF' style='border:1px solid #DFDED9'>
						<tr>
						<td align='center' style='padding:10px 0 9px 0'>
							<table width='155' cellspacing='0' cellpadding='0'>
							<tr><td align='center'><a href='/news/news_photo_view.nhn?office_id=003&article_id=0002801842'><img src='http://imgnews.naver.com/image/thumb120/003/2009/08/01/2801842.jpg' width='120' height='88' alt=''></a></td></tr>
							<tr><td height='8'></td></tr>
							<tr><td  align='center'><a href='/news/news_photo_view.nhn?office_id=003&article_id=0002801842'>국내 첫 중국경제금융사전 출간 </a></td></tr>
							</table>
						</td>
						</tr>
						</table>
						<!--// 오늘의포토뉴스 -->
						
						<table width='178' cellspacing='0' cellpadding='0'><tr><td height='8'></td></tr></table>
									
						<!-- 추천 금융 도서 -->
						<table width='184' cellspacing='0' cellpadding='0' bgcolor='#FFFFFF' style='border:1px solid #DFDED9' border='0'>
						<tr>
						<td align='center' style='padding:5px 0 12px 0'>
							<table width='172' cellspacing='0' cellpadding='0'>
							<tr><td height='23' bgcolor='#F1F1EF' style='padding:3px 0 0 7px'>추천 금융 도서</td></tr>
							<tr><td height='12'></td></tr>
							</table>
						
							<table width='166' cellspacing='0' cellpadding='0' border='0'>
							<tr valign='top'>
							<td width='44'><a href='http://book.naver.com/bookdb/book_detail.php?bid=6048370'><img src='http://bookimg.naver.com/coverimg/kyobo/images/book/large/153/l9788959891153.jpg' width='34' height='50' alt='' style='margin-left:2px'></a></td>
							<td width='122' ><a href='http://book.naver.com/bookdb/book_detail.php?bid=6048370'>펀드의 재구성 다시 시작하는 투자자들을 ...</a></td>
							</tr>
							<tr><td height='7' colspan='2'></td></tr>
							<tr><td height='1' colspan='2' background='http://imgfinance.naver.com/bank/bg_dot01.gif'></td></tr>
							<tr><td height='7' colspan='2'></td></tr>
							<tr valign='top'>
							<td width='44'><a href='http://book.naver.com/bookdb/book_detail.php?bid=6049152'><img src='http://bookimg.naver.com/coverimg/kyobo/images/book/large/089/l9788993536089.jpg' width='34' height='50' alt='' style='margin-left:2px'></a></td>
							<td><a href='http://book.naver.com/bookdb/book_detail.php?bid=6049152'>맞벌이부부 재테크 독하게 하라 맞벌이 부...</a></td>
							</tr>
							</table>
						</td>
						</tr>
						</table>
						<!--// 추천 금융 도서 -->
					</td>
					</tr>
				</table><!--// 서브메인내용 -->
			</td>
		</tr>
		<tr>

			<td colspan="3">
				<!-- 내용 -->
				<table border="0" cellpadding="0" cellspacing="0" background="image/tit_back.gif" style="background-repeat:repeat-x">
				<tr>
					<td width="136" align="center" height="35"><img src="image/txt01.gif" border="0"></td>
					<td width="326" align="center"><img src="image/txt02.gif" border="0"></td>
					<td width="76" align="center"><img src="image/txt03.gif" border="0"></td>
					<td width="91" align="center"><img src="image/txt04.gif" border="0"></td></tr>
				<tr>
					<td height="91" align="center"><img src="image/img01.gif" border="0"></td>
					<td style="color:#b1b3b4"><font style="color:#47c799"><b>상쾌한 아침에...</b></font><br>모닝커피 한잔의 여유를 느껴보는 건 어떨까요<br>기분까지 상쾌해 질 겁니다~^-^<br>오늘하루도 즐거운 하루가 되길 바라며..</td>
					<td align="center" style="color:#b1b3b4">2007-05-10</td>
					<td align="center" style="color:#b1b3b4"><b>30</b></td></tr>
				<tr>
					<td colspan="4"><img src="image/dot_line.gif" border="0"></td></tr>
				<tr>
					<td height="98" align="center"><img src="image/img02.gif" border="0"></td>
					<td style="color:#b1b3b4"><font style="color:#47c799"><b>컴퓨터는 나의 친구...</b></font><br>모닝커피 한잔의 여유를 느껴보는 건 어떨까요<br>기분까지 상쾌해 질 겁니다~^-^<br>오늘하루도 즐거운 하루가 되길 바라며..</td>
					<td align="center" style="color:#b1b3b4">2007-05-10</td>
					<td align="center" style="color:#b1b3b4"><b>330</b></td></tr>
				<tr>
					<td colspan="4"><img src="image/dot_line.gif" border="0"></td></tr>
				<tr>
					<td height="104" align="center"><img src="image/img03.gif" border="0"></td>
					<td style="color:#b1b3b4"><font style="color:#47c799"><b>그 해 여름 바닷가에서~</b></font><br>모닝커피 한잔의 여유를 느껴보는 건 어떨까요<br>기분까지 상쾌해 질 겁니다~^-^<br>오늘하루도 즐거운 하루가 되길 바라며..</td>
					<td align="center" style="color:#b1b3b4">2007-05-10</td>
					<td align="center" style="color:#b1b3b4"><b>330</b></td></tr>
				<tr>
					<td colspan="4"><img src="image/dot_line.gif" border="0"></td></tr>
				<tr>
					<td height="101" align="center"><img src="image/img04.gif" border="0"></td>
					<td style="color:#b1b3b4"><font style="color:#47c799"><b>언제까지나 영원한 나의 벗...</b></font><br>모닝커피 한잔의 여유를 느껴보는 건 어떨까요<br>기분까지 상쾌해 질 겁니다~^-^<br>오늘하루도 즐거운 하루가 되길 바라며..</td>
					<td align="center" style="color:#b1b3b4">2007-05-10</td>
					<td align="center" style="color:#b1b3b4"><b>330</b></td></tr>
				<tr>
					<td colspan="4" height="2" bgcolor="f0e5df"></td></tr>
				</table>
				<!-- /내용 -->
			</td></tr>
		</table>
		<!-- /게시판 -->

		<!-- 페지이동 -->
		<table border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td width="19" height="35"><a href="#"><img src="image/prev_btn01.gif" border="0" alt="처음"></a></td>
			<td><a href="#"><img src="image/prev_btn02.gif" border="0" alt="이전"></a></td>
			<td width="88" align="center" style="color:#8a8a8a">1 <font color="b8a38a">|</font> <b>2</b> <font color="b8a38a">|</font> 3 <font color="b8a38a">|</font> 4</td>
			<td width="15"><a href="#"><img src="image/next_btn01.gif" border="0" alt="다음"></a></td>
			<td><a href="#"><img src="image/next_btn02.gif" border="0" alt="마지막"></a></td></tr>
		</table>
		<!-- /페지이동 -->
	</td></tr>
</table>
<!-- /메인테이블 -->

<!-- 공간 -->
<table border="0" cellpadding="0" cellspacing="0">
<tr>
	<td height="31"></td></tr>
</table>
<!-- /공간 -->
<?
include_once("/board/_tail.php");
?>