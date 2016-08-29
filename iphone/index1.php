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
		<script type="text/javascript" src="js/jquery.tools.js" charset="utf-8"></script>        
        <script src="./jqtouch/jqtouch.js" type="application/x-javascript" charset="utf-8"></script>
        <script type="text/javascript" charset="utf-8">
            var jQT = new $.jQTouch({
                icon: 'iphone_icon.png',
                addGlossToIcon: false,
                startupScreen: 'iuniv_startup.png',
                statusBar: 'white',
                preloadImages: [
                    './themes/apple/img/back_button.png',
                    './themes/apple/img/back_button_clicked.png',
                    './themes/apple/img/button_clicked.png',
                    './themes/apple/img/grayButton.png',
                    './themes/apple/img/whiteButton.png',
                    './themes/apple/img/loading.gif'
                    ]
            });
            // ------------------------------------------------------------------------------------------- jQuery 함수 호출 세팅
            $(function(){
                // Show a swipe event on swipe test
                $('#swipeme').swipe(function(evt, data) {                
                    $(this).html('You swiped <strong>' + data.direction + '</strong>!');
                });
                $('a[target="_blank"]').click(function() {
                    if (confirm('This link opens in a new window.')) {
                        return true;
                    } else {
                        $(this).removeClass('active');
                        return false;
                    }
                });
                // Page animation callback events
                $('#pageevents').
                    bind('pageAnimationStart', function(e, info){ 
                        $(this).find('.info').append('Started animating ' + info.direction + '&hellip; ');
                    }).
                    bind('pageAnimationEnd', function(e, info){
                        $(this).find('.info').append(' finished animating ' + info.direction + '.<br /><br />');
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
			  // ------------------------------------------------------------------------------------------- /jQuery 함수 호출 세팅
        </script>


    </head>
	<?
	include_once("../common/dbcon.php");
	include_once("./lib/common.lib.php");	
	include_once("./lib/dbo_list.php");
	
	?>
    <body>
<!--------------------------------- HOME -------------------------------------------------------------------------------- HOME -------------------------->
<div id="home" class="current">
	<div class="toolbar">
		<h1><img src="iphone_small_icon.png" valign='middle'/> IUNIV 지역정보</h1>
		<a class="button slideup" id="infoButton" href="#about">About</a>
	</div>
	<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
	
	<!-- root element for everything -->
	<div id="scroll">
	 
		<!-- scrollable items -->
		<div id="tools"> 
	 
			<!-- empty slot -->
			<div class="tool">&nbsp;</div>
	 
			<!-- tabs -->
			<div class="tool" style="background:url(./img/bg_house.png) 0px 0px no-repeat">	 
				<div class="details">
					<strong>Tabs</strong> isght way.
				</div>	 
				<div class="demos">	 
					<h2>Demos</h2>				
						<p><a  href="#House">Minimal setup for tabs</a></p>				
						<p><a href="/tools/demos/tabs/anchors.html#second">Naming the tabs</a></p>				
						<p><a href="/tools/demos/tabs/skins.html">4 different skins with CSS</a></p>						
				</div> 
			</div>
			
			<!-- tooltip -->
			<div class="tool" style="background:url(./img/bg_house.png) 0px 0px no-repeat"> 
				<div class="details">
					<strong>Tooltip</strong> helpial tool.
				</div> 
				<div class="demos" style="width:225px"> 
					<h2>Demos</h2> 
						<p><a href="/tools/demos/tooltip/index.html">Basics of using the tooltip</a></p>				
						<p><a href="/tools/demos/tooltip/any-html.html">Using any HTML inside the tooltip</a></p>	
				</div> 
			</div>
	 
			<!-- overlay -->
			<div class="tool" style="background-image:url(./img/bg_house.png) -40px -30px no-repeat">
	 
				<div class="details">
					<strong>Overlay</strong> is a sigodal dialogs.
				</div>
	 
				<div class="demos"> 
					<h2>Demos</h2>				
						<p><a href="/tools/demos/overlay/index.html">Minimal setup for overlay</a></p>				
						<p><a href="/tools/demos/overlay/apple.html">The Apple effect for overlay</a></p>				
						<p><a href="/tools/demos/overlay/modal-dialog.html">Creating modal dialogs with overlay</a></p>
				</div> 
			</div>
	 
			<!-- expose -->
			<div class="tool" style="background-image:url(./img/bg_house.png) -40px -30px no-repeat"> 
				<div class="details">
					Make your HTML elements.
				</div> 
				<div class="demos"> 
					<h2>Demos</h2>
						<p><a href="/tools/demos/expose/index.html">Minimal setup for expose</a></p>				
						<p><a href="/tools/demos/expose/styling.html">Styling the mask with a background image</a></p>				
						<p><a href="/tools/demos/expose/form.html">Exposing a form</a></p>
				</div> 
			</div>
	 
			<!-- scrollable -->
			<div class="tool" style="background:url(./img/bg_house.png) -40px -30px no-repeat"> 
				<div class="details">
					<strong>Scrollable</strong> is the mllable.
				</div> 
				<div class="demos"> 
					<h2>Demos</h2>				
						<p><a href="/tools/demos/scrollable/index.html">Minimal setuable</a></p>				
						<p><a href="/tools/demos/scrollable/vertical.html">A vertical scrollable</a></p>				
						<p><a href="/tools/demos/scrollable/gallery.html">A simple scrollable image gallery</a></p>
				</div> 
			</div>
	 
			<!-- flashembed -->
			<div class="tool" style="background-image:url(./img/bg_house.png) 0px 0px no-repeat"> 
				<div class="details">
					The role of JavaScript is risinedding.
				</div> 
				<div class="demos"> 
					<h2>Demos</h2>			
						<p><a href="/tools/demos/flashembed/index.html">Basics of Flash embedding</a></p>				
						<p><a href="/tools/demos/flashembed/jquery.html">Flashembed and jQuery</a></p>				
						<p><a href="/tools/demos/flashembed/onclick.html">Loading Flash on mouse click</a></p>			
				</div>
			</div>
		</div>

	<!-- intro "page" -->
	<div id="intro" class="tool" style="background:url(./img/bg_house.png) 0px 0px no-repeat"> 
		<div class="details">
			<strong>jQuery Tools</strong> isKb</span>
		</div> 
		<div class="cube" style="position:relative;z-index:1"> 
			<h2>Demos</h2> 
				<a class="slide" href="#House">주거정보</a>
            </ul>		
		</div> 
	</div>
 
	<!-- required for IE6/IE7 -->
	<br clear="all" /> 
	<!-- thumbnails -->
	<div id="thumbs" class="t"> <!--------------------------------------------- intro page navi button -->		
		<a id="t0" class="active"></a> 
		<!-- scrollable navigator root element -->
		<div class="navi">
			<a style="display:none"></a>
			<a id="t1"></a>
			<a id="t2"></a>
			<a id="t3"></a>
			<a id="t4"></a>
			<a id="t5"></a>
			<a id="t6"></a>
		</div> 
	</div> <!----------------------------------------------------------------- /intro page navi button -->
</div><!------------------------------------------------------------ /END  ------------>




<script> 
// initialize scrollable and return the programming API
var api = $("#scroll").scrollable({
	items: '#tools',
	size: 1,
	clickable: false
 
// use the navigator plugin
}).navigator({api: true});
 
 
// this callback does the special handling of our "intro page"
api.onStart(function(e, i) {
 
	// when on the first item: hide the intro
	if (i) {
		$("#intro").fadeOut("slow");
 
	// otherwise show the intro
	} else {
		$("#intro").fadeIn(1000);
	}
 
	// toggle activity for the intro thumbnail
	$("#t0").toggleClass("active", i == 0);
});
 
// a dedicated click event for the intro thumbnail
$("#t0").click(function() {
 
	// seek to the beginning (the hidden first item)
	$("#scroll").scrollable().begin();
 
});
 
</script>



	

			<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
            <ul class="rounded">
				<li class="arrow"><a href="#House">주거정보</a> <small class="counter">4</small></li>
                <li class="arrow"><a href="#ui">User Interface</a> <small class="counter">4</small></li>
                <li class="arrow"><a href="#animations">Animations</a> <small class="counter">8</small></li>
                <li class="arrow"><a href="#ajax">AJAX</a> <small class="counter">3</small></li>
                <li class="arrow"><a href="#callbacks">Callback Events</a> <small class="counter">3</small></li>
                <li class="arrow"><a href="#extensions">Extensions위치정보</a> <small class="counter">4</small></li>
                <li class="arrow"><a href="#demos">Demos</a> <small class="counter">2</small></li>
            </ul>
            <h2>External Links</h2>
            <ul class="rounded">
                <li class="forward"><a href="http://www.jqtouch.com/" target="_blank">Homepage</a></li>
                <li class="forward"><a href="http://www.twitter.com/jqtouch" target="_blank">Twitter</a></li>
                <li class="forward"><a href="http://code.google.com/p/jqtouch/w/list" target="_blank">Google Code</a></li>
            </ul>
            <ul class="individual">
                <li><a href="&#109;&#097;&#105;&#108;&#116;&#111;:&#100;&#107;&#064;&#109;&#111;&#114;&#102;&#117;&#110;&#107;&#046;&#099;&#111;&#109;" target="_blank">Email</a></li>
                <li><a href="http://tinyurl.com/support-jqt" target="_blank">Donate</a></li>
            </ul>
            <div class="info">
                <p>Add this page to your home screen to view the custom icon, startup screen, and full screen mode.</p>
            </div>
        </div>
		<!-------------------------------- /HOME -------------------------------------------------------------------------------- /HOME -------------------------->
		<!-------------------------------- About -------------------------------------------------------------------------------- About -------------------------->
		<div id="about" class="selectable">
				<p><img src="iphone_icon.png" /></p>
				<p><strong>Iuniv Touch</strong><br />Version 1.0 beta<br />
							By Nam Gyu, Park<br/><br/>
					<a href="mailto:batssal5@gmail.com?subject=문의 메일" target="_blank">batssal5@gmail.com</a><br />
					<br> 
					<a href="sms:010-7942-5165" target="_blank">SMS:010-7942-5165</a></p>
					
				<p><em>Create powerful mobile apps with<br /> just HTML, CSS, and jQuery.</em></p>
				<p><br /><br /><a href="#" class="whiteButton goback">Close</a></p>				
		</div>
		<!-------------------------------- /About -------------------------------------------------------------------------------- /About -------------------------->
		<!-------------------------------- House -------------------------------------------------------------------------------- House -------------------------->
		 <div id="House">
			<div class="toolbar">
				<h1>주거정보</h1>
				<a class="back" href="#">Home</a>
			</div>

			<h2>Lists</h2>
			<ul class="rounded">
				<li class="arrow"><a href="#HouseList">전체 목록</a></li>
				<li class="arrow"><a href="#plastic">Plastic</a></li>
				<li class="arrow"><a href="#metal">Metal</a></li>
			</ul>
			<h2>Forms</h2>
			<ul class="rounded">
				<li class="arrow"><a href="#forms">Forms</a></li>
			</ul>
		</div>	
			<!-------------------------------- House > HouseList -------------------------------------------------------------------------------- House > HouseList ---------->
			<div id="HouseList">
				<div class="toolbar">
					<h1>주거정보 전체 목록</h1>
					<a href="#" class="back">Back</a>
				</div>
				<ul class="edgetoedge">
					<?=$st_house_list?> <!----------목록 출력---->
				</ul>
			</div>
			<!-------------------------------- /House > HouseList -------------------------------------------------------------------------------- /House > HouseList -------------------------->
		<!-------------------------------- /House -------------------------------------------------------------------------------- /House -------------------------->
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
                <li><input type="text" name="zip" value="" placeholder="Zip Code" /></li>
            </ul>
            <a style="margin:0 10px;color:rgba(0,0,0,.9)" href="#" class="submit whiteButton">Submit</a>
        </form>
    </body>
</html>