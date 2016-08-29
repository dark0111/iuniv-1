
<html>
<head>
	<title>산업과 예술의 만남 - 홍익대학교</title>
	<meta http-equiv='Content-Type' content='text/html; charset=euc-kr'>
	<base target='_top'>
	<script language="javascript"> 
	<!-- 
		var scrollerheight=105; // 스크롤러의 세로 
		var html,total_area=0,wait_flag=true, scroll_flag = true; 
		 
		var bMouseOver = 1; 
		var scrollspeed = 1; // Scrolling 속도 
		var waitingtime = 5000; // 멈추는 시간 
		var s_tmp = 0, s_amount = 105; 
		var scroll_content=new Array(); 
		var startPanel=0, n_panel=0, i=0; 

		function startscroll() { // 스크롤 시작 
			i=0; 
			for (i in scroll_content) n_panel++; 
			n_panel = n_panel -1 ; 
			startPanel = Math.round(Math.random()*n_panel); 
			if(startPanel == 0) { 
				i=0; 
				for (i in scroll_content) insert_area(total_area, total_area++); // area 삽입 
			} else if(startPanel == n_panel) { 
				insert_area(startPanel, total_area); 
				total_area++; 
				for (i=0; i<startPanel; i++) { 
					insert_area(i, total_area); // area 삽입 
					total_area++; 
				} 
			} else if((startPanel > 0) || (startPanel < n_panel)) { 
				insert_area(startPanel, total_area); 
				total_area++; 
				for (i=startPanel+1; i<=n_panel; i++) { 
					insert_area(i, total_area); // area 삽입 
					total_area++; 
				} 
				for (i=0; i<startPanel; i++) { 
					insert_area(i, total_area); // area 삽입 
					total_area++; 
				} 
			} 
			window.setTimeout("scrolling()",waitingtime); 
		} 
		function scrolling(){ // 실제로 스크롤 하는 부분 
			if (!bMouseOver && !wait_flag) {
				wait_flag = false;
				scroll_flag = false;
			} else if (bMouseOver) {
				scroll_flag = true;
			}
			if(wait_flag && scroll_flag) {
				for (i=0;i<total_area;i++){ 
					tmp = document.getElementById('scroll_area'+i).style;
					tmp.top = parseInt(tmp.top)-scrollspeed;
					if (parseInt(tmp.top) <= -scrollerheight) {
						tmp.top = scrollerheight*(total_area-1); 
					} 
					if (s_tmp++ > (s_amount-1)*scroll_content.length){
						wait_flag=false;
						window.setTimeout("wait_flag=true;s_tmp=0;",waitingtime);
					}
				}
			}
			window.setTimeout("scrolling()",1); 
		}
		
		function insert_area(idx, n){ // area 삽입 
			html='<div style="left: 0px; width: 100%; position: absolute; top: '+(scrollerheight*n)+'px" id="scroll_area'+n+'">\n'; 
			html+=scroll_content[idx]+'\n'; 
			html+='</div>\n'; 
			document.write(html); 
		} 

	//-->
	</script>
</head>

<body leftmargin=0 topmargin=0 >
<script>
scroll_content[0]="<div style='padding:2 5 0 10px'><img src='http://home.hongik.ac.kr/site/File/Photo/20090717/20090717091100-200907158772g_2009071575531.jpg' width=90 height=48 align=left class=photo onError=this.src='/images/blank.gif'><a href='/site/Common/Board/BoardView.php?BBS_ID=49055&BRD_ID=135&PageNo=1' class=title><b>정보산업공학과졸업생 서재식 국제 광고제인 뉴욕페스티벌에서 ..</b></div><div class=content>`비 오면 젖는 섹시 속옷광고`&hellip;대학생들 `세계 3대 광고제` 수상 개가&quot;중학교 때 물풍선을 던지고 ..</a></div>";
scroll_content[1]="<div style='padding:2 5 0 10px'><img src='http://home.hongik.ac.kr/site/File/Photo/20090715/20090715110857-1246266518_6000264290_20090630.jpg' width=90 height=48 align=left class=photo onError=this.src='/images/blank.gif'><a href='/site/Common/Board/BoardView.php?BBS_ID=49006&BRD_ID=135&PageNo=1' class=title><b>‘세계디자인수도 서울2010’ 총감독에 나건 홍익대학교 교..</b></div><div class=content>서울시가 내년에 열리는 &lsquo;세계디자인수도(WDC&middot;World Design Ca pital) 서울 201..</a></div>";
scroll_content[2]="<div style='padding:2 5 0 10px'><img src='http://home.hongik.ac.kr/site/File/Photo/20090625/20090625114042-111.jpg' width=90 height=48 align=left class=photo onError=this.src='/images/blank.gif'><a href='/site/Common/Board/BoardView.php?BBS_ID=48376&BRD_ID=135&PageNo=1' class=title><b>제44회 대한민국 디자인 전람회에 본교 미술대학 목조형가구..</b></div><div class=content>2009년 대한민국 디자인 전람회에 본교 미술대학 목조형가구학과 재학생 12명이 대거 수상하는 성과를 올렸다.대한민국 디자..</a></div>";
scroll_content[3]="<div style='padding:2 5 0 10px'><img src='http://home.hongik.ac.kr/site/File/Photo/20090521/20090521125337-001.jpg' width=90 height=48 align=left class=photo onError=this.src='/images/blank.gif'><a href='/site/Common/Board/BoardView.php?BBS_ID=46919&BRD_ID=135&PageNo=1' class=title><b>'망고패션어워드'에서 대상을 수상한 의상디자인과 박사과정 ..</b></div><div class=content>세계적 패션브랜드 망고가 주최하는 제2회 망고패션어워드에서 홍익대홍익대 재학생이진윤(31)씨가 대상을 수상하였다. 망고패션..</a></div>";
scroll_content[4]="<div style='padding:2 5 0 10px'><img src='http://home.hongik.ac.kr/site/File/Photo/20090521/20090521124650-10.jpg' width=90 height=48 align=left class=photo onError=this.src='/images/blank.gif'><a href='/site/Common/Board/BoardView.php?BBS_ID=46918&BRD_ID=135&PageNo=1' class=title><b>‘Wound & Aggression’ 공간국제판화비엔날레에..</b></div><div class=content>공간국제판화비엔날레 서울 조직위원회는 제15회 공간국제판화비엔날레 대상 수상작으로 홍익대 미대 판화과에 재학중인돈선필의 &..</a></div>";
</script>

<table width=240 height=117 border=0 cellspacing=0 cellpadding=0 style='margin-top:5px;border:1px solid #DFDFDF' !style='margin-top:5px;border-left:1px solid #FFFFFF;border-right:1px solid #DFDFDF;border-top:1px solid #FFFFFF;border-bottom:1px solid #DFDFDF;' bgcolor=#F7F7F7>
<tr>
	<td height=117 valign=top><div style='width:230px; height:105px; position:absolute; left:0px; top:15px; z-index:1; overflow:hidden;' onMouseover='bMouseOver=0' onMouseout='bMouseOver=1' id='scroll_image'><p><script>startscroll();</script></p></div></td>
</tr>
</table>


</body>
</html>
