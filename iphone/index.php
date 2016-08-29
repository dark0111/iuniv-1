<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="utf-8" lang="utf-8" >
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<title>IUNIV for iphone <1.0 beta></title>
		<meta name = "viewport" content = "width=device-width">
		 <!-- Turn off telephone number detection. -->
		<meta name = "format-detection" content = "telephone=no">
        <style type="text/css" media="screen">@import "./jqtouch/jqtouch.css";</style>
        <style type="text/css" media="screen">@import "./themes/apple/theme.css";</style>
		<script type="text/javascript" src="../js/jquery.1.3.2.js" charset="utf-8"></script>        
        <script src="./jqtouch/jqtouch.js" type="application/x-javascript" charset="utf-8"></script>
        <script type="text/javascript" charset="utf-8">
            var jQT = new $.jQTouch({
                icon: 'iphone_icon2.png',
                addGlossToIcon: false,
                startupScreen: 'iuniv_startup.png',
                statusBar: 'white',
                preloadImages: [
                    './themes/apple/img/grayButton.png',
                    './themes/apple/img/whiteButton.png',
                    './themes/apple/img/loading.gif',
					'./img/main_menu_bg_house.png'
                    ]
            });
            // Some sample Javascript functions:
            $(function(){
                // Show a swipe event on swipe test
                $('#swipeme').swipe(function(evt, data) {                
                    $(this).html('You swiped <strong>' + data.direction + '</strong>!');
                });
                // Page animation callback events
                $('#pageevents').
                    bind('pageAnimationStart', function(e, info){ 
                        $(this).find('.info').append('Started animating ' + info.direction );
                    }).
                    bind('pageAnimationEnd', function(e, info){
                        $(this).find('.info').append(' finished animating ' + info.direction + '<br /><br />');
                    });
                // Page animations end with AJAX callback event, example 1 (load remote HTML only first time)
                $('#callback').bind('pageAnimationEnd', function(e, info){
                    if (!$(this).data('loaded')) {                      // Make sure the data hasn't already been loaded (we'll set 'loaded' to true a couple lines further down)
                        $(this).append($('<div>Loading</div>').         // Append a placeholder in case the remote HTML takes its sweet time making it back
                            load('ajax.html .info', function() {        // Overwrite the "Loading" placeholder text with the remote HTML
                                $(this).parent().data('loaded', true);  // Set the 'loaded' var to true so we know not to re-load the HTML next time the #callback div animation ends
                            }));
                    }
                });
                // Orientation callback event 
                $('body').bind('turn', function(e, data){
                    $('#orient').html('Orientation: ' + data.orientation);
                });

				 $('#swipeme').bind('swipe', function(event, info){
					  console.log(info.direction);
				});
            });
			
			function house_id_submit(h_cd){
				alert(h_cd);
				document.HouseFrm.h_nm.value=h_cd;
			}
        </script>
    </head>
	<?
	include_once("../common/dbcon.php");	//db 커넥션
	include_once("./lib/phone_connect_check.php");//스마트폰 접속자 정보 iphone_connect테이블에저장
	include_once("./lib/common.function.php");	//공통 함수
	include_once("./lib/common.vars.php");	//공통 변수
	include_once("./lib/dbo_list.php");	 //메인 구성용 dataSet -> jQturch 화면 구성	
	?>
    <body>
		<!--------------------------------- HOME -------------------------------------------------------------------------------- HOME -------------------------->
        <div id="home" class="current">
            <div class="toolbar">
                <h1><img src="iphone_small_icon.png" valign='middle'/> IUNIV</h1>
                <a class="button slideup" id="infoButton" href="#about">About</a>
            </div>
			<!---------------------------------------------------------------------- 메인 메뉴 이미지 ----------------->
            <ul class="rounded">
                <li class="mainmenu"><a href="#HouseFrm"><img src="img/main_menu_bg_house.png"></a></li>
				<li class="mainmenu"><a href="#FoodFrm"><img src="img/main_menu_bg_food.png"></a></li>
				<li class="mainmenu"><a href="#Community" class="swap"><img src="img/main_menu_bg_community.png"></a></li>
            </ul>
			<!---------------------------------------------------------------------- /메인 메뉴 이미지 ----------------->
			<!--
            <ul class="rounded">
                <li class="arrow"><a href="#ui">User Interface</a> <small class="counter">4</small></li>
                <li class="arrow"><a href="#animations">Animations</a> <small class="counter">8</small></li>
                <li class="arrow"><a href="#ajax">AJAX</a> <small class="counter">3</small></li>
                <li class="arrow"><a href="#callbacks">Callback Events</a> <small class="counter">3</small></li>
                <li class="arrow"><a href="#extensions">Extensions위치정보</a> <small class="counter">4</small></li>
                <li class="arrow"><a href="#demos">Demos</a> <small class="counter">2</small></li>
            </ul>
            
            <ul class="individual">
                <li><a href="&#109;&#097;&#105;&#108;&#116;&#111;:&#100;&#107;&#064;&#109;&#111;&#114;&#102;&#117;&#110;&#107;&#046;&#099;&#111;&#109;" target="_blank">Email</a></li>
                <li><a href="http://tinyurl.com/support-jqt" target="_blank">Donate</a></li>
            </ul>
            <div class="info">
                <p>Add this page to your home screen to view the custom icon, startup screen, and full screen mode.</p>
            </div>-->
        </div>
		<!-------------------------------- /HOME -------------------------------------------------------------------------------- /HOME -------------------------->

		<!-------------------------------- About -------------------------------------------------------------------------------- About -------------------------->
		<div id="about">
			<img src="iphone_icon2.png" />
			<p><strong>IUNIV Touch</strong><br />Version 1.01 beta<br />
						By Nam Gyu, Park<br/><br/>
				<a href="mailto:batssal5@gmail.com?subject=문의 메일" target="_blank">batssal5@gmail.com</a><br />
				<br> 
				<a href="sms:010-7942-5165" target="_blank">SMS:010-7942-5165</a></p>
				
			<p><em> 베타 버젼중 오류가 발생 할 수 있습니다. <BR>문의사항 이나 개선사항 건의를 받습니다.<BR>위, 메일 또는 문자로 보내주시면 수렴하도록 하겠습니다.</em></p>
			<p>1.01 업데이트<br> 
			- 주거정보 사진 보기<br>
			- 식당정보 메뉴 보기<br>
			- 주거목록 세부정보 보기</p>
			<p><a href="#" class="whiteButton goback">Close</a></p>				
		</div>
		<!-------------------------------- /About -------------------------------------------------------------------------------- /About -------------------------->


		<!-------------------------------- House -------------------------------------------------------------------------------- House -------------------------->
		<form id="HouseFrm" action="./lib/house_sub.php" method="POST" class="form">
            <div class="toolbar">
                <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;주거 정보</h1>
                <a class="back" href="#">Back</a>
            </div>
			<h2>주거 검색</h2>
            <ul style="padding: 10px 10px 10px 10px; margin: 15px 10px 17px 10px;">
                <input type="text" name="h_nm" value="" style="padding: 3px 8px 8px 3px;width:215px"><input type="hidden" name="h_cd" value=""> <a href="#" class="submit">  <img align="absmiddle" src="./img/searchButton.png"></a>
			</ul>
			
            <h2>전체 목록</h2>
			<ul class="rounded">
				<?
					$house_sql = " SELECT 
						if(h_nm<'가','ABC..', 
						if(h_nm<'나','ㄱ', 
						if(h_nm<'다','ㄴ',
						if(h_nm<'라','ㄷ',
						if(h_nm<'마','ㄹ',
						if(h_nm<'바','ㅁ',
						if(h_nm<'사','ㅂ',
						if(h_nm<'아','ㅅ',
						if(h_nm<'자','ㅇ',
						if(h_nm<'차','ㅈ',
						if(h_nm<'카','ㅊ',
						if(h_nm<'타','ㅋ',
						if(h_nm<'파','ㅌ',
						if(h_nm<'하','ㅍ',
						if(h_nm>='하','ㅎ',
						'기타..'))))))))))))))) as initial,
						 h_cd, h_nm, build_year, phone, mphone, room_type, gx, gy, fit  FROM `room_house` 
						order by h_nm asc ";
					$ds_house = mysql_Query($house_sql, $connection) or die('house_sql error');
					$temp_initial = "";
					for ($i=0; $row = mysql_fetch_array($ds_house); $i++) {  		
						if($temp_initial==$row[initial]){
					?>
					<li class="arrow"><a href="./lib/house_sub2.php?h_cd='<?=$row[h_cd]?>'"><font align="middle"><?=$row[h_nm]?></font></a></li>
					<?
						}else{
					?>
					<li class='sep'><?=$row[initial]?></li>
					<li class="arrow"><a href="./lib/house_sub2.php?h_cd='<?=$row[h_cd]?>'"><font align="middle"><?=$row[h_nm]?></font></a></li>
					<?	$temp_initial = $row[initial];
						}
					}
				?>
			</ul>
        </form>
			<!-------------------------------- /House > HouseList ---------------------------------------------------------------- /House > HouseList ------------>
		<!-------------------------------- /House -------------------------------------------------------------------------------- /House -------------------------->


		<!-------------------------------- Food -------------------------------------------------------------------------------- /Food -------------------------->
		<form id="FoodFrm" action="./lib/food_sub.php" method="POST" class="form">
			<div class="toolbar">
				<h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;배달/주점/식당 정보</h1>
				<a class="back" href="#">Back</a>
			</div>
			<h2>명칭 검색</h2>
            <ul style="padding: 10px 10px 10px 10px; margin: 15px 10px 17px 10px;">
                <input type="text" name="restaurant_nm" value="" style="padding: 3px 8px 8px 3px;width:215px"><a href="#" class="submit">  <img align="absmiddle" src="./img/searchButton.png"></a>				
			</ul>
			<h2>많이 찿는집</h2>
			<ul class="edgetoedge" style=" margin: 15px 10px 10px 10px;">
				<?=$temp_hit_food;?>
			</ul>
		</form>
		<!-------------------------------- /Food -------------------------------------------------------------------------------- /Food -------------------------->


		<!-------------------------------- Community -------------------------------------------------------------------------------- Community -------------------------->
		 <div id="Community">
			<div class="toolbar">
				<h1>Community</h1>
				<a class="back" href="#">Home</a>
			</div>
<!--
			<h2>Lists</h2>
			<ul class="rounded">
				<li class="arrow"><a href="#HouseList">전체 목록</a></li>
				<li class="arrow"><a href="#plastic">Plastic</a></li>
				<li class="arrow"><a href="#metal">Metal</a></li>
			</ul>-->
			<h2>Live Talk</h2>
			<ul class="talk">
				<iframe id="mobile_talk"
					name="mobile_talk" style="width:100%; height:300px;  border: 0px; filter: Alpha(Opacity=65);" scrolling="auto" frameborder="0" src="../library/module/chat/chat.php?mobile=apple"></iframe>
			</ul>
		</div>	
		<!-------------------------------- /Community -------------------------------------------------------------------------------- /Community -------------------------->
		<div id="img_view"></div>

			 <div id="ui">
				<div class="toolbar">
					<h1>UI Demos</h1>
					<a class="back" href="#">Home</a>
				</div>

				<h2>Lists</h2>
				<ul class="rounded">
					<li class="arrow"><a href="#edge">Edge to Edge</a></li>
					<li class="arrow"><a href="#plastic">Plastic</a></li>
					<li class="arrow"><a href="#metal">Metal</a></li>
				</ul>
				<h2>Forms</h2>
				<ul class="rounded">
					<li class="arrow"><a href="#forms">Forms</a></li>
				</ul>
			</div>
			<div id="ajax">
				<div class="toolbar">
					<h1>AJAX</h1>
					<a class="back" href="#home">Home</a>
				</div>
				<ul class="rounded">
					<li class="arrow"><a href="#ajax_post">POST Form Example</a></li>
					<li class="arrow"><a href="ajax.html">GET Example</a></li>
					<li class="arrow"><a href="#callback">With Callback</a></li>
				</ul>
			</div>
			<div id="animations">
				<div class="toolbar">
					<h1>Animations</h1>
					<a class="back" href="#">Home</a>
				</div>
				<ul class="rounded">
					<li><a href="#animdemo">Slide</a></li>
					<li><a class="slideup" href="#animdemo">Slide Up</a></li>
					<li><a class="dissolve" href="#animdemo">Dissolve</a></li>
					<li><a class="fade" href="#animdemo">Fade</a></li>
					<li><a class="flip" href="#animdemo">Flip</a></li>
					<li><a class="pop" href="#animdemo">Pop</a></li>
					<li><a class="swap" href="#animdemo">Swap</a></li>
					<li><a class="cube" href="#animdemo">Cube</a></li>
				</ul>
				<div class="info">
					Custom animations are also <a href="http://code.google.com/p/jqtouch/wiki/Animations" target="_blank">easy to write</a>. <br />View the source in <code>demos/customanimation</code> to see how.
				</div>
			</div>
			<div id="animdemo">
				<div style="font-size: 1.5em; text-align: center; margin: 160px 0 160px; font-family: Marker felt;">
					Pretty smooth, eh?            
				</div>
				<a style="margin:0 10px;color:rgba(0,0,0,.9)" href="#" class="whiteButton goback">Go back</a>
			</div>
			<div id="callback">
				<div class="toolbar">
					<h1>AJAX w/Callback</h1>
					<a class="back" href="#">Ajax</a>
				</div>
			</div>
			<div id="callbacks">
				<div class="toolbar">
					<h1>Events</h1>
					<a class="back" href="#home">Home</a>
				</div>
				<ul class="rounded">
					<li><a href="#pageevents">Page events</a></li>
					<li id="swipeme">Swipe me!</li>
					<li id="orient">Orientation: <strong>profile</strong></li>
				</ul>
			</div>
			<div id="demos">
				<div class="toolbar">
					<h1>Demos</h1>
					<a class="back" href="#home">Home</a>
				</div>
				<div class="info">
					These apps open in a new window. Don&#8217;t forget to save them to your home screen to enable full-screen mode.
				</div>
				<ul class="rounded">
					<li class="forward"><a target="_webapp" href="../todo/">To-Do app</a></li>
					<li class="forward"><a target="_webapp" href="../clock/">Clock app</a></li>
				</ul>
			</div>
			<!--------------------------------->
        <div id="edge">
            <div class="toolbar">
                <h1>Edge to Edge</h1>
                <a href="#" class="back">Back</a>
            </div>
            <ul class="edgetoedge">
                <li class="sep">F</li>
                <li><a href="#">Flintstone, <em>Fred</em></a></li>
                <li><a href="#">Flintstone, <em>Pebble</em></a></li>
                <li><a href="#">Flintstone, <em>Wilma</em></a></li>
                <li class="sep">J</li>
                <li><a href="#">Jetson, <em>Elroy</em></a></li>
                <li><a href="#">Jetson, <em>George</em></a></li>
                <li><a href="#">Jetson, <em>Jane</em></a></li>
                <li><a href="#">Jetson, <em>Judy</em></a></li>
                <li class="sep">R</li>
                <li><a href="#">Rubble, <em>Bambam</em></a></li>
                <li><a href="#">Rubble, <em>Barney</em></a></li>
                <li><a href="#">Rubble, <em>Betty</em></a></li>
            </ul>
        </div>
        <div id="extensions">
            <div class="toolbar">
                <h1>Extensions</h1>
                <a class="back" href="#home">Home</a>
            </div>
            <div class="info">
                These apps open in a new window. Don&#8217;t forget to save them to your home screen to enable full-screen mode.
            </div>
            <ul class="rounded">
                <li class="forward"><a target="_webapp" href="./demos/ext_location/">Geo Location</a></li>
                <li class="forward"><a target="_webapp" href="./demos/ext_offline/">Offline Utility</a></li>
                <li class="forward"><a target="_webapp" href="./demos/ext_floaty/">Floaty Bar</a></li>
                <li class="forward"><a target="_webapp" href="./demos/ext_autotitles/">Auto Titles</a></li>
            </ul>
        </div>
        <div id="forms">
            <div class="toolbar">
                <h1>Forms</h1>
                <a href="#" class="back">Back</a>
            </div>
            <form>
                <ul class="edit rounded">
                    <li><input type="text" name="name" placeholder="Text" id="some_name" /></li>
                    <li><input type="text" name="search" placeholder="Search" id="some_name" /></li>
                    <li><input type="text" name="phone" placeholder="Phone" id="some_name"  /></li>
                    <li><input type="text" name="zip" placeholder="Numbers" id="some_name" /></li>
                    <li><textarea placeholder="Textarea" ></textarea></li>
                    <li>Sample Toggle <span class="toggle"><input type="checkbox" /></span></li>
                    <li>
                        <select id="lol">
                            <optgroup label="Swedish Cars">
                                <option value ="volvo">Volvo</option>
                                <option value ="saab">Saab</option>
                            </optgroup>
                            <optgroup label="German Cars">
                                <option value ="mercedes">Mercedes</option>
                                <option value ="audi">Audi</option>
                            </optgroup>
                        </select>
                    </li>
                    <li><input type="password" name="some_name" value="iphonedelcopon" id="some_name" /></li>
                    <li><input type="checkbox" name="some_name" value="Hello" id="some_name" title="V8 Engine Type" /></li>
                    <li><input type="checkbox" name="some_name" value="Hello" checked="checked" id="some_name" title="V12 Engine Type" /></li>
                    <li><input type="radio" name="some_name" value="Hello" id="some_name" title="Only cars" /></li>
                    <li><input type="radio" name="some_name" value="Hello" id="some_name" title="Only motorbikes" /></li>
                </ul>
            </form>
        </div>
		
        <div id="metal">
            <div class="toolbar">
                <h1>Metal Lists</h1>
                <a href="#" class="back">Back</a>
            </div>
            <ul class="metal">
                <li class="arrow"><a href="#"><small>AM</small> 9:40 <em>Buenos Aires</em></a></li>
                <li class="arrow"><a href="#"><small>PM</small> 19:40 <em>Singapur</em></a></li>
                <li class="arrow"><a href="#"><small>PM</small> 22:40 <em>Japan</em></a></li>
                <li class="arrow"><a href="#"><small>PM</small> 11:40 <em>New York</em></a></li>
                <li class="arrow"><a href="#"><small>PM</small> 9:40 <em>Ontario</em></a></li>
            </ul>
        </div>
        <div id="pageevents">
            <div class="toolbar">
                <h1>Page Events</h1>
                <a class="back" href="#">Events</a>
            </div>
            <div class="info" style="font-weight: normal;">
            </div>
        </div>
        <div id="plastic">
            <div class="toolbar">
                <h1>Plastic Lists</h1>
                <a href="#" class="back">Back</a>
            </div>
            <ul class="plastic">
                <li class="arrow"><a href="#">Simple list</a></li>
                <li class="arrow"><a href="#">Contact list</a></li>
                <li class="arrow"><a href="#">Content List</a></li>
                <li class="arrow"><a href="#">Metal list</a></li>
            </ul>
            <div class="info">
                <p><strong>Best enjoyed on a real iPhone</strong></p>
            </div>
        </div>
       

        <form id="ajax_post" action="ajax_post.php" method="POST" class="form">
            <div class="toolbar">
                <h1>Post Demo</h1>
                <a class="back" href="#">Ajax</a>
            </div>
            <ul class="rounded">
                <li><input type="text" name="zip" value="" /></li>
            </ul>
            <a style="margin:0 10px;color:rgba(0,0,0,.9)" href="#" class="submit whiteButton">Submit</a>
        </form>
    </body>
</html>