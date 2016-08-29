<!-- 지도 출력 -->
<table width=1000 height=600 cellpadding=1 cellspacing=1 style="border:1px solid #CCCCCC"><tr><td><div id='big_map' name='big_map' style="width:710px; height:450px;"></div></td></tr></table>
<!-- 지도 출력 끝 -->
<?

if($view[gx]==""||$view[gy]==""){
	$view[gx]=336456;
	$view[gy]=445768;
}
?>

<script type="text/javascript" src="http://map.naver.com/js/naverMap.naver?key=38d7c40856c862f0bbd28b271019dca9"></script>
<SCRIPT LANGUAGE="JavaScript">
<!--
	//기본설정
	var mapObj = new NMap(document.getElementById('big_map')); // 지도창
	//alert("//"+'<?=$view[gx]?>');
	var loc_center = new NPoint(<?=$view[gx]?>,<?=$view[gy]?>);  // 지도 중앙 좌표
	
	var zoomlevel = 0// 축적
	//기본설정 끝
	var x_point = new Array();
	var y_point = new Array();
	var infobox = new Array();
	var url = new Array();
	var loc = new Array();
	var cat = new Array();
	var con = new Array();
	var cat_size1 = new Array();
	var cat_size2 = new Array();

		
				cat[0] = "map_home.gif";	
				cat_size1[0] = 20;
				cat_size2[0] = 20;
		
		x_point[0] = '336456';
		y_point[0] = '445768';
		infobox[0] = 'ddddd';
		url[0] = "./index.php?mode=house_view&h_cd=127";	
		con[0] = '연락처:444444';


		for (i=0; i< x_point.length; i++)
		{
			loc[i] = new NPoint(x_point[i],y_point[i]);
			write_map(x_point[i], y_point[i], infobox[i], url[i], cat[i], con[i], cat_size1[i], cat_size2[i]);
		}
	mapObj.setCenterAndZoom(loc_center,zoomlevel); // 지도 중앙과 줌레벨 결정해서 보여준다!
///* 줌버튼 표시 하려면 주석을 풀어주세요
	var zoom = new NZoomControl();
	zoom.setAlign("right"); // 줌 조절 버튼 왼쪽에 위치
	zoom.setValign("bottom"); // 줌 조절 버튼 아래에 위치
	mapObj.addControl(zoom);
	//mapObj.enableWheelZoom(); // 지도 안에서 휠로 줌 조절 가능하게 하려면 주석을 풀어주세요
//*/
//-->
	/* 지도 모드 변경 버튼 생성 */
	var mapBtns = new NMapBtns();
	mapBtns.setAlign("right");
	mapBtns.setValign("top");
	mapObj.addControl(mapBtns);

	//마커 표시 및 마우스 오버 이벤트 등록용
	function write_map(map_x, map_y, map_content, go_href, icon, content, icon_size1, icon_size2) {
		var icon = new NIcon("<?=$IU[url]?>/sub/house/img/map/"+icon+"", new NSize(icon_size1,icon_size2)); // 아이콘파일
		var infowin = new NInfoWindow();
		var loc_point = new NPoint(map_x, map_y);
		var map_mark = new NMark(loc_point, icon );
		var info_box = ' \
						<div style="width:150px;border: 2px solid #cccccc; background:#ffffff;padding:5px 5px 5px 5px;"> \
							<div style="text-align:left;"> \
								<dt>'+map_content+'</dt> \
								<dt>'+content+'</dt> \
							</div> \
						</div> \
						';
		NEvent.addListener(map_mark,"mouseover",function(){infowin.set(loc_point,info_box);infowin.showWindow()});
//		NEvent.addListener(map_mark,"mouseout",function() {infowin.hideWindow();});
		NEvent.addListener(map_mark,"mouseout",function() {infowin.delayHideWindow(250);});
		NEvent.addListener(map_mark, "click", function() {location.href = go_href;} );
		//NEvent.addListener(map_mark, "click", function() {SLB(go_href,'iframe', 508, 400, true, true);} );
		
		mapObj.addOverlay(map_mark); // 지도에 마크표시
		// map_mark.setTargeturl(go_href); //마커 클릭시 새창
		mapObj.addOverlay(infowin);
	}
	function movepoint(go_x_point, go_y_point)
	{
	var go_point = new NPoint(go_x_point, go_y_point);
	mapObj.setCenter(go_point);
	}

	var regFlag = false;

	function addClick()
	{
		if (!regFlag)
		{
			NEvent.addListener(mapObj,"click",clicked);
			regFlag  = true;
		}
	}

	function removeClick()
	{
		NEvent.removeListener(mapObj,"click",clicked);
		regFlag  = false;
	}

	function clicked(pos)
	{
		alert(pos+" clicked");
		var xy = String(pos);
		
		var arrxy = xy.split(",");
		var url='<?=$IU[url]?>/sub/house/house_mapxy_update.php?h_cd=<?=$view[h_cd]?>&gx='+arrxy[0]+'&gy='+arrxy[1];
		//alert(url);
		popupOpenWindow(url,400,100);
		
	}
</SCRIPT>