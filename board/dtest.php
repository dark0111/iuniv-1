
<html>
<head>
	<title>����� ������ ���� - ȫ�ʹ��б�</title>
	<meta http-equiv='Content-Type' content='text/html; charset=euc-kr'>
	<base target='_top'>
	<script language="javascript"> 
	<!-- 
		var scrollerheight=105; // ��ũ�ѷ��� ���� 
		var html,total_area=0,wait_flag=true, scroll_flag = true; 
		 
		var bMouseOver = 1; 
		var scrollspeed = 1; // Scrolling �ӵ� 
		var waitingtime = 5000; // ���ߴ� �ð� 
		var s_tmp = 0, s_amount = 105; 
		var scroll_content=new Array(); 
		var startPanel=0, n_panel=0, i=0; 

		function startscroll() { // ��ũ�� ���� 
			i=0; 
			for (i in scroll_content) n_panel++; 
			n_panel = n_panel -1 ; 
			startPanel = Math.round(Math.random()*n_panel); 
			if(startPanel == 0) { 
				i=0; 
				for (i in scroll_content) insert_area(total_area, total_area++); // area ���� 
			} else if(startPanel == n_panel) { 
				insert_area(startPanel, total_area); 
				total_area++; 
				for (i=0; i<startPanel; i++) { 
					insert_area(i, total_area); // area ���� 
					total_area++; 
				} 
			} else if((startPanel > 0) || (startPanel < n_panel)) { 
				insert_area(startPanel, total_area); 
				total_area++; 
				for (i=startPanel+1; i<=n_panel; i++) { 
					insert_area(i, total_area); // area ���� 
					total_area++; 
				} 
				for (i=0; i<startPanel; i++) { 
					insert_area(i, total_area); // area ���� 
					total_area++; 
				} 
			} 
			window.setTimeout("scrolling()",waitingtime); 
		} 
		function scrolling(){ // ������ ��ũ�� �ϴ� �κ� 
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
		
		function insert_area(idx, n){ // area ���� 
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
scroll_content[0]="<div style='padding:2 5 0 10px'><img src='http://home.hongik.ac.kr/site/File/Photo/20090717/20090717091100-200907158772g_2009071575531.jpg' width=90 height=48 align=left class=photo onError=this.src='/images/blank.gif'><a href='/site/Common/Board/BoardView.php?BBS_ID=49055&BRD_ID=135&PageNo=1' class=title><b>����������а������� ����� ���� �������� �����佺Ƽ������ ..</b></div><div class=content>`�� ���� ���� ���� �ӿʱ���`&hellip;���л��� `���� 3�� ������` ���� ����&quot;���б� �� ��ǳ���� ������ ..</a></div>";
scroll_content[1]="<div style='padding:2 5 0 10px'><img src='http://home.hongik.ac.kr/site/File/Photo/20090715/20090715110857-1246266518_6000264290_20090630.jpg' width=90 height=48 align=left class=photo onError=this.src='/images/blank.gif'><a href='/site/Common/Board/BoardView.php?BBS_ID=49006&BRD_ID=135&PageNo=1' class=title><b>����������μ��� ����2010�� �Ѱ����� ���� ȫ�ʹ��б� ��..</b></div><div class=content>����ð� ���⿡ ������ &lsquo;��������μ���(WDC&middot;World Design Ca pital) ���� 201..</a></div>";
scroll_content[2]="<div style='padding:2 5 0 10px'><img src='http://home.hongik.ac.kr/site/File/Photo/20090625/20090625114042-111.jpg' width=90 height=48 align=left class=photo onError=this.src='/images/blank.gif'><a href='/site/Common/Board/BoardView.php?BBS_ID=48376&BRD_ID=135&PageNo=1' class=title><b>��44ȸ ���ѹα� ������ ����ȸ�� ���� �̼����� ����������..</b></div><div class=content>2009�� ���ѹα� ������ ����ȸ�� ���� �̼����� �����������а� ���л� 12���� ��� �����ϴ� ������ �÷ȴ�.���ѹα� ����..</a></div>";
scroll_content[3]="<div style='padding:2 5 0 10px'><img src='http://home.hongik.ac.kr/site/File/Photo/20090521/20090521125337-001.jpg' width=90 height=48 align=left class=photo onError=this.src='/images/blank.gif'><a href='/site/Common/Board/BoardView.php?BBS_ID=46919&BRD_ID=135&PageNo=1' class=title><b>'�����мǾ����'���� ����� ������ �ǻ�����ΰ� �ڻ���� ..</b></div><div class=content>������ �мǺ귣�� ���� �����ϴ� ��2ȸ �����мǾ���忡�� ȫ�ʹ�ȫ�ʹ� ���л�������(31)���� ����� �����Ͽ���. �����м�..</a></div>";
scroll_content[4]="<div style='padding:2 5 0 10px'><img src='http://home.hongik.ac.kr/site/File/Photo/20090521/20090521124650-10.jpg' width=90 height=48 align=left class=photo onError=this.src='/images/blank.gif'><a href='/site/Common/Board/BoardView.php?BBS_ID=46918&BRD_ID=135&PageNo=1' class=title><b>��Wound & Aggression�� ����������ȭ�񿣳�����..</b></div><div class=content>����������ȭ�񿣳��� ���� ��������ȸ�� ��15ȸ ����������ȭ�񿣳��� ��� ���������� ȫ�ʹ� �̴� ��ȭ���� �������ε������� &..</a></div>";
</script>

<table width=240 height=117 border=0 cellspacing=0 cellpadding=0 style='margin-top:5px;border:1px solid #DFDFDF' !style='margin-top:5px;border-left:1px solid #FFFFFF;border-right:1px solid #DFDFDF;border-top:1px solid #FFFFFF;border-bottom:1px solid #DFDFDF;' bgcolor=#F7F7F7>
<tr>
	<td height=117 valign=top><div style='width:230px; height:105px; position:absolute; left:0px; top:15px; z-index:1; overflow:hidden;' onMouseover='bMouseOver=0' onMouseout='bMouseOver=1' id='scroll_image'><p><script>startscroll();</script></p></div></td>
</tr>
</table>


</body>
</html>
