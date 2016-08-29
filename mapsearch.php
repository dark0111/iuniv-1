<?php

define('MAPKEY', '38d7c40856c862f0bbd28b271019dca9');
define('NAVERKEY', '8381033fde246a4610f0c41f80888b9e');

if (isset($_GET['query'])) {
	$query = trim($_GET["query"]);
}

if (strlen($query) > 0) {
	$minx = 999999;
	$maxx = 0;
	$miny = 999999;
	$maxy = 0;

    $encodedquery = urlencode($query);
    $url = "http://openapi.naver.com/search?query=$encodedquery&target=local&sort=vote&key=8381033fde246a4610f0c41f80888b9e";
    $result = simplexml_load_file($url);
    $list = array();
    $result = $result->channel;
    foreach($result->item as $item) {
        $title = $item->title;
        $link = $item->link;
        $desc = $item->description;
        $tel = $item->telephone;
        $addr = $item->address;
        $mapx = $item->mapx;
        $mapy = $item->mapy;
        // 지도가 표시될 영역을 결정합니다.
        $minx = min($minx, $mapx);
        $maxx = max($maxx, $mapx);
        $miny = min($miny, $mapy);
        $maxy = max($maxy, $mapy);

        $tmparr = array($title, $link, $desc, $tel, $addr, $mapx, $mapy);
        array_push($list, $tmparr);
	}
}

if ($maxx == 0 && $maxy == 0) {
	$minx = -575679;
	$maxx = 1176804;
	$miny = 1384811;
	$maxy = 39513;
}
else {
	$intVal = 30;
	$minx -= $intVal;
	$maxx += $intVal;
	$miny -= $intVal;
	$maxy += $intVal;
}

?>
<html>
<head>
<meta http-equiv=Content-Type content="text/html;charset=utf-8">
<meta http-equiv=Cache-Control content=No-Cache>
<meta http-equiv=Pragma content=No-Cache>
<title>Map Search</title>
<style type="text/css">
.bar{
	scrollbar-face-color:#F9F9F2;
	scrollbar-highlight-color:#FFFFFF;
	scrollbar-shadow-color:#F9F9F2;
	scrollbar-3dlight-color:#E3E3DD;
	scrollbar-arrow-color:#C7C7B6;
	scrollbar-track-color:#FCFCF8;
	scrollbar-darkshadow-color:#E3E3DD;
	scrollbar-base-color:#F7F7ED;
}
</style>
</head>
<body style="margin:0px 0px 0px 0px">
<script type="text/JavaScript" src="xml2obj.js"></script>
<script type="text/JavaScript" src="http://maps.naver.com/js/naverMap.naver?key=<?=MAPKEY?>"></script>
<div id='mapContainer' style='width:960px;height:550px'></div>
<script type="text/javascript">
// 기본 지도 생성
var mapObj = new NMap(document.getElementById('mapContainer'),960,550);
mapObj.setBound(<?=$minx?>, <?=$maxy?>, <?=$maxx?>, <?=$miny?>);
mapObj.zoomOut();

// 확대, 축소를 위한 컨트롤을 생성합니다.
var zoom = new NZoomControl(); 
zoom.setAlign("right"); 
zoom.setValign("bottom"); 
mapObj.addControl(zoom);

// 정보 출력을 위한 NInfoWindow 객체를 생성하여 등록합니다.
var infowin = new NInfoWindow();
mapObj.addOverlay(infowin);

// 검색 결과를 마커를 사용하여 지도에 표시합니다.
function initMarker(pos, count, content){
	var iconUrl = 'http://sstatic.naver.com/search/local/icon3/icos_L'+String.fromCharCode(64+count)+'.gif';
           // 마커 생성
	var marker = new NMark(pos, new NIcon(iconUrl, new NSize(16, 15)));
          // marker 객체에 마우스가 오버했을 때, 실행할 함수를 등록합니다.
	NEvent.addListener(marker, "mouseover",
		function(pos){
			infowin.set(pos, getContent(content));
			infowin.showWindow();
                               getInfo(content[0]);
		}
	);

          // 지도에 마커를 등록합니다.
	mapObj.addOverlay(marker);
}

function getInfo(title){
        var url = "blogsearch.php?query="+encodeURIComponent(title);
        var xmlhttp = new NXmlhttp();
        xmlhttp.setType(0);
        xmlhttp.loadhttp(url, processInfo);
}

function processInfo(res){
        var target = document.getElementById("tmpl");
        var obj = JINDO.xml2obj(res);

        var items = obj.channel.item || [];
        for(var i = 0; i < items.length; i++){
                var title = items[i].title;
                var link = items[i].link;
                if(title.length > 15){
                        title = title.substring(0, 15) + "...";
                }
                var con = "<li><a href=\"" + link + "\" target=_blank>"+title+"</a><br>";
                target.innerHTML += con;
        }
}

function setInfo(){
<?
if (isset($list)) {
	for($i = 0; $i < count($list); $i++){
		$cnt = $i + 1;
		$title = $list[$i][0];
		$tel = $list[$i][3];
		$mapx = $list[$i][5];
		$mapy = $list[$i][6];
		echo "initMarker(new NPoint($mapx, $mapy), $cnt, new Array('$title', '$tel') );\n";
	}
}
?>

}

function getContent(content){
	var title = content[0];
	var tel = content[1];

	var body = ' \
	<div style="width:220px;border:dotted 1px #000000; background:#ffffff;padding:5px 5px 5px 5px;"> \
	<div style="font-size:10pt;font-family:굴림, tahoma;font-weight:bold;float:left;">'+title+'</div> \
	<div style="font-size:8pt;font-family:굴림, tahoma;">'+tel+'</div> \
	<div style="width:200px;font-size:8pt;padding:5px 0px 0px 0px;" id="tmpl"></div> \
	<div style="margin:10px 3px 3px 80px;"><a href="javascript:infowin.hideWindow()"> \
	<img src=http://static.naver.com/n/cmn/btn_close.gif border=0 width=48 height=17></a></div> \
	';
	return body;
}

// 검색된 결과를 지도에 표시합니다.
setInfo();
</script>
<div id="searchform">
	<form name="mapsearch" method="get" action="mapsearch.php">
		<input type="text" name="query">
		<input type="submit" value="Map Search">
	</form>
</div>
</body>
</html>
