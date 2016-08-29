<?
// 지도의 폭
$map_width = 620;

// 지도의 높이
$map_height = 420;

// 지도의 축적 1~11 사이의 자연수. 1에 가까울 수록 지도가 확대
$map_zoom = 2;

// 네이버 지도api 키값
$map_key = "key=이곳에 키값을 넣으세요" ;

// 쿼리 돌릴 주소
$address = substr($view[wr_8], 8); // 3번 여유 필드에 저장 되어 있는 주소의 우편번호를 삭제
$adrress1 = str_replace("|","",$address); // | 태그 삭제
$map_query = str_replace(" ","%20",$adrress1); // 3번 여유 필드에 저장 되어 있는 주소의 공백을 제거하여 변수에 저장

// 여기부터 주소 검색 xml 파싱
$pquery = $map_key. "&query=". $map_query;
    $fp = fsockopen ("maps.naver.com", 80, $errno, $errstr, 30); 
    if (!$fp) { 
        echo "$errstr ($errno)"; 
    } else { 
        fputs($fp, "GET /api/geocode.php?"); 
        fputs($fp, $pquery); 
        fputs($fp, " HTTP/1.1\r\n"); 
        fputs($fp, "Host: maps.naver.com\r\n"); 
        fputs($fp, "Connection: Close\r\n\r\n"); 
         
        $header = ""; 
        while (!feof($fp)) { 
            $out = fgets ($fp,512); 
            if (trim($out) == "") { 
                break; 
            } 
            $header .= $out; 
        } 
         
        $mapbody = ""; 
        while (!feof($fp)) { 
            $out = fgets ($fp,512); 
            $mapbody .= $out; 
        } 
         
        $idx = strpos(strtolower($header), "transfer-encoding: chunked"); 
         
        if ($idx > -1) { // chunk data 
            $temp = ""; 
            $offset = 0; 
            do { 
                $idx1 = strpos($mapbody, "\r\n", $offset); 
                $chunkLength = hexdec(substr($mapbody, $offset, $idx1 - $offset)); 
                 
                if ($chunkLength == 0) { 
                    break; 
                } else { 
                    $temp .= substr($mapbody, $idx1+2, $chunkLength); 
                    $offset = $idx1 + $chunkLength + 4; 
                } 
            } while(true); 
            $mapbody = $temp; 
        } 
        //header("Content-Type: text/xml; charset=utf-8"); 
        fclose ($fp); 
    }     
// 여기까지 주소 검색 xml 파싱


// 여기부터 좌표값 변수에 등록
$map_x_point_1=explode("<x>", $mapbody); 
$map_x_point_2=explode("</x>", $map_x_point_1[1]); 
$map_x_point=$map_x_point_2[0]; 

$map_y_point_1=explode("<y>", $mapbody); 
$map_y_point_2=explode("</y>", $map_y_point_1[1]); 
$map_y_point=$map_y_point_2[0]; 
// 여기까지 좌표값 변수에 등록


?>


<!-- 네이버 지도 키 값 -->
<SCRIPT LANGUAGE="JavaScript" src="http://maps.naver.com/js/naverMap.naver?key=이곳에 키값을 넣으세요"></SCRIPT>
<!-- 네이버 지도 키 값 끝 -->


<table width="605" cellpadding="0" cellspacing="3" bgcolor="f4f4f4" >
	<tr>
		<td bgcolor="ffffff">
			<table width="100%" cellpadding="0" cellspacing="1" bgcolor="cccccc" >
				<tr>
					<td height="1" bgcolor="61AAC4">
					</td>
				</tr>
				<tr>
					<td bgcolor="ffffff">
						<table width="100%" cellpadding="3" cellspacing="1" bgcolor="eeeeee" >
							<tr bgcolor="ffffff">
								<td>
<!-- 지도 출력 -->
<div id='mapContainer'></div> 
<!-- 지도 출력 끝 -->
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>


<SCRIPT LANGUAGE="JavaScript">
<!--
	var x_point = <? echo $map_x_point; ?>;
	var y_point = <? echo $map_y_point; ?>;
	var icon = new NIcon("<?=$IU[house_path]?>/img/map_icon.gif", new NSize(22,22)); // 아이콘파일을 계정에 만드시고(지정된 위치에 표시되는 아이콘입니다) 이미지 주소 및 크기를 변경해주세요
	var loc_Point = new NPoint(x_point,y_point);  // 포인트 표시
	var map_mark = new NMark(loc_Point, icon ); // 지도에 아이콘 표시
	var mapObj = new NMap(document.getElementById('mapContainer'),<? echo $map_width; ?>,<? echo $map_height; ?>); // 지도창
	var infowin = new NInfoWindow();
	var zoom = new NZoomControl();
	var zoomlevel = <? echo $map_zoom; ?>

	mapObj.addOverlay(map_mark); // 지도에 마크표시
	mapObj.setCenterAndZoom(loc_Point,zoomlevel); // 지도 중앙
	mapObj.addOverlay(infowin);
	zoom.setAlign("left"); // 줌 조절 버튼 왼쪽에 위치
	zoom.setValign("bottom"); // 줌 조절 버튼 아래에 위치
	// mapObj.enableWheelZoom();  지도 안에서 휠로 줌 조절 가능하게 하려면 주석을 풀어주세요
	mapObj.addControl(zoom);
//-->
</SCRIPT>
