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