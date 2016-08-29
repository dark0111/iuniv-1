// 지도 이동
function move(direction) {
	var curPos = mapObj.getCenter() ;
	setMoveGap() ;
	switch(direction) {
		case 'left_top':
			curPos.set(curPos.getX()-moveGap['garo'], curPos.getY()) ;
			curPos.set(curPos.getX(), curPos.getY()+moveGap['sero']) ;
			break;
		case 'left':
			curPos.set(curPos.getX()-moveGap['garo'], curPos.getY()) ;
			break;
		case 'right':
			curPos.set(curPos.getX()+moveGap['garo'], curPos.getY()) ;
			break;
		case 'up':
			curPos.set(curPos.getX(), curPos.getY()+moveGap['sero']) ;
			break;
		case 'down':
			curPos.set(curPos.getX(), curPos.getY()-moveGap['sero']) ;
			break;
	}

	mapObj.setCenterAndZoom( new NPoint(curPos.getX(), curPos.getY()), mapObj.getZoom() );		
}

// 지도 방항키를 눌렀을때, 확대 level 에 따라 이동 거리를 조정한다.
function setMoveGap() {
	var boundary = mapObj.getBound() ;
	
	moveGap['garo'] = (boundary[2]-boundary[0]) * 0.20 ;
	moveGap['sero'] = (boundary[1]-boundary[3]) * 0.20 ;
}

// 화면 크기가 변경되면 자동으로 실행된다.
function setSize() {
	
	if( document.body.clientWidth <= 480) { // 새로 보기만 실행된다.
		if(defWidth != document.body.clientWidth || defHeight != document.body.clientHeight) {
		
			document.getElementById('wrap').style.width = 0 + 'px' ;
			document.getElementById('wrap').style.height = 0 + 'px' ;
		
			document.getElementById('mapContainer').style.width = 0 + 'px' ;
			document.getElementById('mapContainer').style.height = 0 + 'px' ;

			document.getElementById('path').innerHTML = document.body.clientWidth + " * " + document.body.clientHeight + " / " + screen.availWidth  + " * " + screen.availHeight ;
			document.getElementById('wrap').style.width = document.body.clientWidth ;
			document.getElementById('wrap').style.height = document.body.clientHeight ;

			// 지도
			if(document.body.clientHeight == 700) { // 전체보기 해제 상태
				document.getElementById('mapContainer').style.width = document.body.clientWidth - minusWidth ;
				document.getElementById('mapContainer').style.height = document.body.clientHeight - minusHeight + 60 ;
				document.getElementById('searchListBox').style.width = document.body.clientHeight - minusWidth ;
				document.getElementById('searchListBox').style.height = document.body.clientHeight - minusHeight + 60 ;
				document.getElementById('shopDetailInfoBox').style.width = document.body.clientHeight - minusWidth ;
				document.getElementById('shopDetailInfoBox').style.height = document.body.clientHeight - minusHeight + 60 ;
				defWidth = document.body.clientWidth ;
				defHeight = document.body.clientHeight ;
			} else { // 전체보기 상태
				document.getElementById('mapContainer').style.width = document.body.clientWidth - minusWidth ;
				document.getElementById('mapContainer').style.height = document.body.clientHeight - minusHeight ;
				defWidth = document.body.clientWidth ;
				defHeight = document.body.clientHeight ;
			}
		
		
		
			mapObj.resize() ;
			setMoveBtn() ;
		}
	}

	setTimeout( setSize , 500 ) ;
}

// 화면 크기가 변경되면 자동으로 실행된다
function setMoveBtn() {

	var mapWidth = parseInt(document.getElementById('mapContainer').style.width) ;
	var mapHeight = parseInt(document.getElementById('mapContainer').style.height) ;

	var moveUp=document.getElementById("moveUp");
	var moveDown=document.getElementById("moveDown");
	var moveLeft=document.getElementById("moveLeft");
	var moveRight=document.getElementById("moveRight");
	var zoomIn=document.getElementById("zoomIn");
	var zoomOut=document.getElementById("zoomOut");

	moveUp.style.left=mapWidth/2-20+'px';
	moveUp.style.top=5+46+'px';

	moveDown.style.left=mapWidth/2-20+'px';
	moveDown.style.top=mapHeight-41-5-33+'px';

	moveLeft.style.left=5+'px';
	moveLeft.style.top=mapHeight/2-20+'px';

	moveRight.style.left=mapWidth-41-5+'px';
	moveRight.style.top=mapHeight/2-20+'px';

	zoomIn.style.left=mapWidth-40-5+'px';
	zoomIn.style.top=mapHeight-77-40+'px';

	zoomOut.style.left=mapWidth-40-5+'px';
	zoomOut.style.top=mapHeight-38-40+'px';
}









/* 이전에 있던 지도 js */

var NAVER_KEY = "38d7c40856c862f0bbd28b271019dca9" ; // 네이버 지도 KEY

// 왼쪽메뉴 숨김
function layerHide() 
{
	var docs=document.getElementById('leftSearchResult');
	var btnSh=document.getElementById('btnSh');
	var menu=document.getElementById('mt_left_menu');
	docs.style.display='none';
	btnSh.src='http://static.naver.com/n/local/206/map/0730/btn_view.gif';
	mapObj.resizeType.set(-1,0);
	mapObj.resize();
	mapObj.resizeType.set(1,0);
}

// 왼쪽메뉴 보여줌.
function layerShow(docs,btnOpen,btnClose) 
{
	var docStyle = docs.style; 
	var openStyle = btnOpen.style;
	var closeStyle = btnClose.style;
	var leftFrame = document.getElementById('left');
	//leftFrame.contentWindow.setInputBoxBlur();
	
	if(docStyle.display == 'none') {
		docStyle.display='';
		openStyle.display='none';
		closeStyle.display='';

	}else{
		docStyle.display='none';
		openStyle.display='';
		closeStyle.display='none';
	}
	
	mapObj.resizeType.set(-1,0);
	mapObj.resize();
	mapObj.resizeType.set(1,0);
}

function layerLeft() {
	var docs=document.getElementById('snb');
	var btnOpen=document.getElementById('btnOpen');
	var btnClose=document.getElementById('btnClose');
	
	layerShow(docs,btnOpen,btnClose);
}



var addr_xindex = 0;
var addr_yindex = 0;
// 지역별로 업소 테이블이 구분되어 있기 때문에, 현위치에 시도의 코드를 넘겨줘야 하므로
// 드레그로 이동할때 드레그 했을때 현 위치에 시도를 넣어두기 위한 용도
// updateDong() 에서 사용된다.
var pre_sido = ''; 


// 네이버 카텍 TM128 <=> 구글 WGS84 방식 변환
function findDong() {
	//return ;
	var ptCenter	= mapObj.getCenter();
	
	// 부자아빠 소스를 이용한 TM128(네이버) <=> WGS84 로 변환
	//var TM128_naver = new CS(csList.TM128_katech_3param);
	//var WGS84_google = new CS(csList.GOOGLE_WGS84);
	//var p2 = new PT(ptCenter.x,ptCenter.y); //(X_east,Y_north)
	//cs_transform(TM128_naver, WGS84_google, p2);
	
	var latlng = mapObj.fromTM128ToLatLng(ptCenter);

	var curr_xindex	= Math.floor(ptCenter.x / 256);
	var curr_yindex	= Math.floor(ptCenter.y / 256);

	if (addr_xindex == curr_xindex && addr_yindex == curr_yindex) {
		if(document.getElementById('moveSearch').checked) submitValue () ;
		return ;
	}
	addr_xindex		= curr_xindex;
	addr_yindex		= curr_yindex;
	
	//document.getElementById("display").innerHTML = latlng;

	//alert(latlng.y) ;
	url = encodeURI('http://map.naver.com/common/getDong/?x='+latlng.x+'&y='+latlng.y) ;
	var xmlhttp		= new NXmlhttp() ;
	xmlhttp.loadhttp('/common/cross_xml.php?type=xml&url='+url, updateDong) ;
}


function updateDong(info) {
	var chunk	= '' ;
	var name1	= '' ;
	var name2	= '' ;
	var name3	= '' ;
	var code	= '' ;
	var this_sido = '' ;

	if (info != 'nothing') {
		chunk	= info.split(",") ;
		//name1	= chunk[0]+' <span class="arrow1"></span>' ;
		//name2	= chunk[1]+' <span class="arrow2"></span>' ;
		name1	= chunk[0] ;
		name2	= chunk[1] ;
		name3	= chunk[2] ;
		code	= chunk[3] ;	
	}

	parent.document.getElementById('path').innerHTML		= name1 + " ";
	parent.document.getElementById('path').innerHTML	+= name2 + " " ;
	parent.document.getElementById('path').innerHTML	+= name3 + " " ;

	var this_sido = '' ;
	if(chunk[0] == "서울특별시" || chunk[0] == "인천광역시" || chunk[0] == "경기도")				this_sido = '1' ;
	else if(chunk[0] == "강원도")																						this_sido = '2' ;
	else if(chunk[0] == "충청북도")																						this_sido = '3' ;
	else if(chunk[0] == "대전광역시" || chunk[0] == "충청남도")											this_sido = '4' ;
	else if(chunk[0] == "전라북도")																						this_sido = '5' ; 
	else if(chunk[0] == "전라남도" || chunk[0] == "광주광역시")											this_sido = '6' ;
	else if(chunk[0] == "대구광역시" || chunk[0] == "경상북도")											this_sido = '7' ;
	else if(chunk[0] == "부산광역시" || chunk[0] == "울산광역시" || chunk[0] == "경상남도")	this_sido = '8' ;
	else if(chunk[0] == "제주도" || chunk[0] == "제주특별자치도")																						this_sido = '9' ;
	
	// 변경된 시.도를 combo box 에도 적용한다.
	if(pre_sido != this_sido) {
		pre_sido = this_sido ;
		//alert(this_sido) ;
		document.getElementById('SIDO').options[this_sido-1].selected = true ;
		addrs_gugun.code = this_sido ; 
		addrs_gugun.addrs_ajax() ;
	}

	// 지도이동시 검색에 체크가 되어 있다면.
	if(document.getElementById('moveSearch').checked) submitValue () ;
}

function getHelp() {
	var xmlhttp = new NXmlhttp() ;
	xmlhttp.setType(0) ;
	xmlhttp.loadhttp('/common/getHelp.php', displayHelp) ;
}

function displayHelp(content) {
	document.getElementById('helpBox').innerHTML = content ;
}

function getBoardWrite() {
	var xmlhttp = new NXmlhttp() ;
	xmlhttp.setType(0) ;
	xmlhttp.loadhttp('/board/b_write.php', displayBoard) ;
}

function boardSend() {
	if(document.getElementById('name').value == "") {
		alert('이름을 입력하세요.') ;
		document.getElementById('name').focus() ;
		return ;
	}	

	if(document.getElementById('passwd').value == "") {
		alert('비밀번호를 입력하세요.') ;
		document.getElementById('passwd').focus() ;
		return ;
	}
	
	if(document.getElementById('comment').value == "") {
		alert('내용을 입력하세요.') ;
		document.getElementById('comment').focus() ;
		return ;
	}	

	var name = document.getElementById("name").value; 
	var passwd = document.getElementById("passwd").value; 
	var comment = document.getElementById("comment").value; 
	var xmlhttp = new OXmlhttp() ;
	xmlhttp.sendhttp('2', '/board/b_src.php', "comment="+comment+"&name="+name+"&passwd="+passwd+"&b_id="+encodeURIComponent('board')+"&mode="+escape('add') , getBoard) ;
}

function getBoard() {
	document.getElementById('boardListBox').innerHTML = "" ;
	window.scrollTo(0,0);
	document.getElementById('shopLoading').style.display = 'block' ;
	var xmlhttp = new NXmlhttp() ;
	xmlhttp.setType(0) ;
	xmlhttp.loadhttp('/board/b_list.php', displayBoard) ;
}

function displayBoard(content) {
	//document.getElementById('boardListBox').innerHTML = content ;
	content = content.replace(/(<[/]{0,1}response>)/g,"") ;
	document.getElementById('boardListBox').innerHTML	 = content ;
	//eval($('setBound'));
	document.getElementById('boardListBox').style.visibility	 = 'inherit' ;
	exe_myjscript(content);
}

function getSB(b_id, SB_SIDO, page, num) {
	window.scrollTo(0,0);
	document.getElementById('boardListBox').innerHTML = "" ;
	document.getElementById('shopLoading').style.display = 'block' ;

	var xmlhttp = new NXmlhttp() ;
	xmlhttp.setType(0) ;
	if(num != '') xmlhttp.loadhttp('/sb/b_read.php?b_id='+b_id+"&SB_SIDO="+SB_SIDO+"&page="+page+"&num="+num, displayBoard) ;
	else xmlhttp.loadhttp('/sb/b_list.php?b_id='+b_id+"&SB_SIDO="+SB_SIDO+"&page="+page, displayBoard) ;
}

function displaySB(content) {
	/*document.getElementById('boardListBox').innerHTML = content ;	*/
	content = content.replace(/(<[/]{0,1}response>)/g,"") ;
	document.getElementById('boardListBox').innerHTML	 = content ;
	//eval($('setBound'));
	document.getElementById('boardListBox').style.visibility = 'inherit' ;
	exe_myjscript(content);
}

function getShopPhoto(sno, sido, page, num) {
	var xmlhttp = new NXmlhttp() ;
	xmlhttp.setType(0) ;
	xmlhttp.loadhttp('/common/getShopPhoto.php?sno='+sno+'&sido='+sido+'&page='+page+'&num='+num, displayShopPhoto) ;
}

function displayShopPhoto(content) {
	document.getElementById('shopPhoto').innerHTML = content ;
}

function getDetailInfo(sno, sido) {
	var xmlhttp = new NXmlhttp() ;
	xmlhttp.setType(0) ;
	xmlhttp.loadhttp('/common/getDetailInfo.php?sno='+sno+'&sido='+sido, displayDetailInfo) ;
}

function displayDetailInfo(content) {
	document.getElementById('shopDetailInfoBox').innerHTML = content ;
}

function getInfo(sno, sido, pos, apbt) {
	var xmlhttp = new NXmlhttp() ;
	xmlhttp.setType(0) ;
	xmlhttp.loadhttp('/common/getInfo.php?x='+pos.x+'&y='+pos.y+'&sno='+sno+'&sido='+sido+'&apbt='+apbt, displayInfo, pos) ;
}

function displayInfo(content, pos) {
	info.hideWindow() ; // 모바일에선 이상하게 숨겼다 열어줘야 정상적으로 작동한다.
	info.hideWindow() ; // 모바일에선 이상하게 숨겼다 열어줘야 정상적으로 작동한다.
	info.set(pos, content) ;
	info.showWindow();
}

function getInfo2(sno, sido, pos, apbt) {
	var xmlhttp = new NXmlhttp() ;
	xmlhttp.setType(0) ;
	xmlhttp.loadhttp('/common/getInfo.php?x='+pos.x+'&y='+pos.y+'&sno='+sno+'&sido='+sido+'&apbt='+apbt, displayInfo2, pos) ;
}

function displayInfo2(content, pos) {
	//info.hideWindow() ; // 모바일에선 이상하게 숨겼다 열어줘야 정상적으로 작동한다.
	//info.hideWindow() ; // 모바일에선 이상하게 숨겼다 열어줘야 정상적으로 작동한다.
	//info.set(pos, content) ;
	//info.showWindow();
	document.getElementById('shopInfoBox').style.display = 'block' ;
	document.getElementById('shopInfoBox').innerHTML = content ;

}

function getShop(url) {

	var xmlhttp = new NXmlhttp();
	xmlhttp.setType(0) ;
	xmlhttp.loadhttp(url, displayShop) ;
}

function displayShop(content) {
	//alert(content) ;
	//return ;
	content = content.replace(/(<[/]{0,1}response>)/g,"") ;
	document.getElementById('searchListBox').innerHTML	 = content ;
	//eval($('setBound'));
	document.getElementById('searchListBox').style.visibility	 = 'inherit' ;
	exe_myjscript(content);
}

function exe_myjscript(inStr) {
		//alert(inStr) ;
        var startTag = "<myjscript><!--" ;
        var endTag = "--></myjscript>" ;
        if( (startidx = inStr.indexOf(startTag)) >= 0 ) {
			endidx = inStr.indexOf(endTag) ;
			add_script = inStr.substring( inStr.indexOf(startTag)+startTag.length, endidx) ;
			eval(add_script) ; // <-- 중요한 부분
			inStr = inStr.substring(endidx+endTag.length) ;
			exe_myjscript(inStr);  // 여러번 선언했을 경우가 있으므로
        }
}

function goPos(pos, level) {	
	if(level >= 0) mapObj.setCenterAndZoom(pos, level);
	else mapObj.setCenterAndZoom(pos, 2);
}

function searchMnu(layerId) {

	var mnu = new Array('searchCat', 'searchJuso', 'order') ;
	mnu[0] = 'searchCat' ;
	mnu[1] = 'searchJuso' ;
	mnu[2] = 'order' ;

	for(var i=0; i<mnu.length; i++) {
		document.getElementById(mnu[i]).className = "nav_bt_off" + " " + mnu[i] ;
		//if(mnu[i] == 'searchCat') document.getElementById(mnu[i]).className += " first" ;
		document.getElementById(mnu[i] + 'mnu').style.display = "none" ;
	}

	if(layerId && layerId != "") {
		document.getElementById(layerId).className = "nav_bt_on" + " " + layerId ;
		//if(layerId == 'searchCat') document.getElementById(layerId).className += " first" ;
		document.getElementById(layerId + 'mnu').style.display = "block" ;
	}
}



function ofood_addrs (gubun, code, sido_name) {

	this.sido_name = sido_name ;
	this.gubun = gubun ;
	this.code = code ;

	this.addrs_ajax = function  () { // xml 커넥션

		// 초기화
		if(gubun == 'GUGUN') {
			document.getElementById('GUGUN').options.length = 0 ;
			document.getElementById('DONG').options.length = 0 ;
			document.getElementById('GUGUN').options[document.getElementById('GUGUN').options.length] = new Option('선택하세요', '') ;
			document.getElementById('DONG').options[document.getElementById('DONG').options.length] = new Option('선택하세요', '') ;
		} else if(gubun == 'DONG') {
			document.getElementById('DONG').options.length = 0 ;
			document.getElementById('DONG').options[document.getElementById('DONG').options.length] = new Option('선택하세요', '') ;
		}

		var url = '/common/getAddrs.php?gubun=' + this.gubun + '&code=' + this.code + '&sido_name=' + this.sido_name ;

		var xmlhttp = new NXmlhttp() ;
		xmlhttp.setType(1) ;
		xmlhttp.loadhttp(url, parse_xml) ;
	}

	function parse_xml(xml) { // xml 파싱

		result = xml.getElementsByTagName('item') ;

		//if (result.length == 0) {
		//	alert("검색 결과가 없습니다.") ;
		//	return;
		//}


		for(i=0 ; i < result.length; i++) {

			var name = result[i].getElementsByTagName('name')[0].firstChild.nodeValue ;
			var code = result[i].getElementsByTagName('code')[0].firstChild.nodeValue ;
			var map = result[i].getElementsByTagName('map')[0].firstChild.nodeValue ;

			if(gubun == 'GUGUN') {
				document.getElementById('GUGUN').options[document.getElementById('GUGUN').options.length] = new Option(name, code) ;
			} else if(gubun == 'DONG') {
				document.getElementById('DONG').options[document.getElementById('DONG').options.length] = new Option(name, code) ;
			}
		}
	}
}


// 자바스크립트 쿠키 생성
function setCookie(cookieName, cookieValue, expiredays) {

	var todayDate = new Date() ;
	todayDate.setDate( todayDate.getDate() + expiredays ) ;
	document.cookie = cookieName + "=" + escape ( cookieValue ) + " ; path=/; expires=" + todayDate.toGMTString() + ";" ;

}

function getCookie( cookieName ) {
	var search = cookieName + "=";
	var cookie = document.cookie;

	// 현재 쿠키가 존재할 경우
	if( cookie.length > 0 ) {
	// 해당 쿠키명이 존재하는지 검색한 후 존재하면 위치를 리턴.
	startIndex = cookie.indexOf( cookieName ) ;

	// 만약 존재한다면
	if( startIndex != -1 ) 	{
		// 값을 얻어내기 위해 시작 인덱스 조절
		startIndex += cookieName.length;

		// 값을 얻어내기 위해 종료 인덱스 추출
		endIndex = cookie.indexOf( ";", startIndex );

		// 만약 종료 인덱스를 못찾게 되면 쿠키 전체길이로 설정
		if( endIndex == -1) endIndex = cookie.length;
			// 쿠키값을 추출하여 리턴
			return unescape( cookie.substring( startIndex + 1, endIndex ) );
		} else {
			// 쿠키 내에 해당 쿠키가 존재하지 않을 경우
			return false;
		}
	} else {
		// 쿠키 자체가 없을 경우
		return false;
	}
}

function disableST() {

	document.getElementById('mapSearch').checked = false ;

	document.getElementById('moveSearch').checked = false ;
	document.getElementById('optional2').style.display = 'none' ;
}
/* 이전에 있던 지도 js */













/* test coding */
// 맵을 클릭했을때
//NEvent.addListener(mapObj,"click",clickMap);
function clickMap(pos) {
	alert(pos.x + " " + pos.y) ;
}




function resize() {
	var w = parseInt(document.getElementById('w').value) 
	var h = parseInt(document.getElementById('h').value) 

	document.getElementById('mapContainer').style.width = 1000 
	document.getElementById('mapContainer').style.height = 800 

	document.getElementById('mapContainer').style.width = w 
	document.getElementById('mapContainer').style.height = h 
}




// text or xml 을 가져오는 class
// (가져오는 값이 xml : 1 , text : 2 , 가져올 주소, callback 함수)
function OXmlhttp() {

	var requestType = [
		function() { return new XMLHttpRequest() ; },
		function() { return new ActiveXObject("Msxml2.XMLHTTP") ; },
		function() { return new ActiveXObject("Microsoft.XMLHTTP") ; }
	];

	// 브라우져에 맞는 XMLHttpRequest 확인 및 생성
	for(var i=0; i<requestType.length; i++) {
		try {
			var requestFunc = requestType[i] ;
			var request = requestFunc() ;
			if(request != null) {
				break ;
			}
		}
		catch(e) {
			continue ;
		}
	}

	this.loadhttp = function(type, url, parse_xml) {
		
		request.onreadystatechange = function handleStateChange () {

			if(request.readyState == 4) {
				if(request.status == 200) {
					if(type == 1) parse_xml(request.responseXML) ;
					else if(type == 2) parse_xml(request.responseText) ;
				}
			}
		}

		request.open("POST", url, true);
		request.send(null);
	}

	this.sendhttp = function(type, url, parameter, parse_xml) {
		
		request.onreadystatechange = function handleStateChange () {

			if(request.readyState == 4) {
				if(request.status == 200) {
					if(type == 1) parse_xml(request.responseXML) ;
					else if(type == 2) parse_xml(request.responseText) ;
				}
			}
		}

		request.open("POST", url, true);
		request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
		request.send(parameter);
	}
}



function searchNav(flag) {
	
	if( (document.getElementById('searchNav').style.display == "block" && flag != 'on') || flag == 'off') {
		document.getElementById('searchNav').style.display = "none" ;
		document.getElementById('searchNav').style.display = "none" ;

		// 이미지 롤오버
		document.getElementById('btn_opt_plus').style.display = "block" ;
		document.getElementById('btn_opt_plus_ov').style.display = "none" ;
	} else {
		document.getElementById('searchNavInfo').style.display = "none" ;
		document.getElementById('searchNav').style.display = "block" ;

		// 이미지 롤오버		
		document.getElementById('btn_opt_plus').style.display = "none" ;
		document.getElementById('btn_opt_plus_ov').style.display = "block" ;
	}
}

function layerMnu(mnu) {

		document.getElementById('helpBox').style.display = "none" ;
		document.getElementById('shopDetailInfoBox').style.display = "none" ;
		document.getElementById('searchListBox').style.display = "none" ;
		document.getElementById('boardListBox').style.display = "none" ;
		document.getElementById('contentsMapWrap').style.display = "none" ;
	
	if(mnu == "map") {

		document.getElementById('topWrap').style.display = "block" ;
		document.getElementById('contentsMapWrap').style.display = "block" ;
		mapObj.resize() ;

	} else if(mnu == "list") {

		document.getElementById('topWrap').style.display = "block" ;
		document.getElementById('searchListBox').style.display = "block" ;

	} else if(mnu == "shopDetailInfoBox") {

		document.getElementById('topWrap').style.display = "none" ;
		document.getElementById('shopDetailInfoBox').style.display = "block" ;		

	} else if(mnu == "board") {

		document.getElementById('topWrap').style.display = "none" ;
		document.getElementById('boardListBox').style.display = "block" ;		
		getBoard() ;

	} else if(mnu == "sb") {

		document.getElementById('topWrap').style.display = "none" ;
		document.getElementById('boardListBox').style.display = "block" ;		
		getSB('visit', '', '', '') ;

	} else if(mnu == "help") {

		getHelp() ;
		document.getElementById('helpBox').style.display = "block" ;		

	}
}

function shopTabMnu(layerId) {

	// ajax 로 넣는 높이가 틀리기 땜에 모바일 기기에선 보여질때 문제가 생기므로 맨위로 이동시키자.
	document.getElementById('shopDetailInfoBox').scrollTop = 0 ;
	document.getElementById('shopDetailInfoBox').scrollLeft = 0 ;

	var mnu = new Array('DefInfo', 'Menu', 'Review', 'Photo') ;

	for(var i=0; i<mnu.length; i++) {
		document.getElementById(mnu[i]).className = "" ;
		document.getElementById('shop'+mnu[i]).style.display = "none" ;
	}

	if(layerId && layerId != "") {
		document.getElementById(layerId).className = "on" ;
		document.getElementById('shop'+layerId).style.display = "block" ;
	}
	
	if(layerId != 'DefInfo') document.getElementById('DefInfo').className += " first" ;
}


// Mode Detect
function detectMode() {
	var width = document.documentElement.clientWidth;
	var height = document.documentElement.clientHeight;

	if ( ((width > 780) && (width <= 800)) ) {
		return 'landscape';
	} else if ( ((width > 460) && (width <= 480)) ) {
		return 'portrait';
	}
}

function changeClass() {
	var preMode = "" ;
	preMode = document.body.getAttribute("class") ;
	if (detectMode() == 'portrait') {
			document.body.setAttribute("class", "port");
			if(preMode == "land") { mapObj.resize() ; }


	} else if (detectMode() == 'landscape') {
			document.body.setAttribute("class", "land");
			if(preMode == "port") { mapObj.resize() ; }
	}
}

window.setInterval(changeClass, 100) ;