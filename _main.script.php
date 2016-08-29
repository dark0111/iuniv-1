<link rel="stylesheet" href="<?=$IU[url]?>/css/tools.css" type="text/css" media="screen" />
<link type="text/css" rel="stylesheet" href="<?=$IU[url]?>/css/jquery.boxen.css" />
<link type="text/css" rel="stylesheet" href="<?=$IU[url]?>/js/gallery/jq_style.css" />
<script type="text/javascript" src="<?=$IU[url]?>/js/gallery/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?=$IU[url]?>/js/gallery/jquery.galleryview-1.1.js"></script>
<script type="text/javascript" src="<?=$IU[url]?>/js/gallery/jquery.timers-1.1.2.js"></script>
<script type="text/javascript" src="<?=$IU[url]?>/js/jquery.boxen-1.4.js"></script>
<script type="text/javascript" src="<?=$IU[url]?>/dbo/dbo_main.js"></script>
<script type="text/javascript">
$(document).ready(function(){ 
	$('#photos').galleryView({//포토 겔러리
		panel_width: 520,
		panel_height: 300,
		frame_width: 30,
		frame_height: 30,
		overlay_color: '#222',
		overlay_text_color: 'white',
		caption_text_color: '#222',
		background_color: 'transparent',
		border: 'none',
		nav_theme: 'light',
		easing: 'easeInOutQuad',
		pause_on_hover: true
	});
	////////////////////////////////////////////////////////////////////////////////////////////////////
	$("img[rel]").overlay();  //오버레이 설정  ex). 아이폰 아이콘 클릭시..	
	////////////////////////////////////////////////////////////////////////////////////////////////////
	$("form.expose").bind("click keydown", function() { //로그인 input text 클릭시 실행 
		$(this).expose({
			maskId: 'mask_login',
			onLoad: function(){
				this.getExposed().css({backgroundColor: '#c7f8ff'});
			},
			onClose: function(){
				this.getExposed().css({backgroundColor: null});
			},
			api: true
		}).load();
	}); 
	////////////////////////////////////////////////////////////////////////////////////
	$("#iphone_flash").click(function() { //////////////////////////클릭시 해당 영상 실행 아이폰 설명 동영상 
		// same as in previous example
		flashembed(this, "<?=$IU[url]?>/css/img/i4.swf");
		//flashembed(this, "http://tech01.korea.ac.kr/i4.swf");
	});

	///////////////////////////////////////////////////////////////////////////////////////
	var api = $("#scroll").scrollable({			////////////////////////// IUNIV TOOLS 선언
	items: '#tools',
	size: 1,
	clickable: false

	// use the navigator plugin
	}).navigator({api: true});	
	// this callback does the special handling of our "intro page"
	api.onStart(function(e, i) {		
		// when on the first item: hide the intro
		if (i) {
			$("#intro").fadeOut("fast");
			
			// otherwise show the intro
		} else {			
			$("#intro").fadeIn(300);
		}		
		// toggle activity for the intro thumbnail
		$("#t4").toggleClass("active", i == 0);
	});
	// a dedicated click event for the intro thumbnail
	$("#t4").click(function() {		
		// seek to the beginning (the hidden first item)
		$("#scroll").scrollable().begin();		
		$("div.tools_com_house_tabs").tabs().stop();
		$("#tools_menu_items").show("slow");
		
	});
	$("#t1").click(function() {
		$("div.tools_com_house_tabs").tabs().play();
		$("#tools_menu_items").fadeOut("fast");
	});
	$("#t2").click(function() {
		$("div.tools_com_house_tabs").tabs().stop();
		$("#tools_menu_items").fadeOut("fast");
	});
	$("#t3").click(function() {
		$("div.tools_com_house_tabs").tabs().stop();
		$("#tools_menu_items").fadeOut("fast");
	});
	$("#t0").click(function() {
		$("div.tools_com_house_tabs").tabs().stop();
		$("#tools_menu_items").fadeOut("fast");
	});
	$("#jqt3").addClass("active");
	/////////////////////////////////////////////////////////////////////////////////
	$("div.tools_com_house_tabs").tabs(".tools_com_house > div", {/////////////TOOLS 안에서 추천주거 슬라이드 실행
	// enable "cross-fading" effect      
	effect: 'fade',         fadeOutSpeed: "slow",   
	// start from the beginning after the last tab    
	rotate: true    
	// use the slideshow plugin. It accepts its own configuration    
	
	})
	.slideshow();
	//////////////////////////////////////////////////////////////////////////////
	// select #flowplanes and make it scrollable. use circular and navigator plugins
	// initialize scrollable 
	$("div.talk_vertical").scrollable({/////////////////////////////helptalk 슬라이드
		vertical:true,
		size: 1		
	// use mousewheel plugin
	}).mousewheel(400);	
	////////////////////////////////////////
	$('.boxen').boxen();
			
	////////////////////////////////////////////////////////////////////////////////
	// main vertical scroll
	$("#tools_menu_main").scrollable({
	 
		// basic settings
		vertical: true,
		size: 1,
		clickable: false,
	 
		// up/down keys will always control this scrollable
		keyboard: 'static',
	 
		// assign left/right keys to the actively viewed scrollable
		onSeek: function(event, i) {
			horizontal.scrollable(i).focus();
		}
	 
	// main navigator (thumbnail images)
	}).navigator("#tools_menu_main_navi");
	 
	// horizontal scrollables. each one is circular and has its own navigator instance
	var horizontal = $(".tools_menu_scrollable").scrollable({size: 1}).circular().navigator(".tools_menu_navi"); 
	 
	// when page loads setup keyboard focus on the first horzontal scrollable
	horizontal.eq(0).scrollable().focus();
	////////////////////////////////////////////////////////////////////////////////////////
	$("ul.tabs").tabs("div.tab_panes > div");//방거래, 룸메이트, 문의사항 패널

});////ready(function() end

function getCookie(name){
 var tmp=document.cookie.split('; ');
 for (var i=0; i<tmp.length;i++){
  var c_name = tmp[i].split('=');
  if (c_name[0] == name) return unescape(c_name[1]);
 }
 return false;
}

function setCookie(name,value,expiredays)
{
 var todayDate = new Date();
 todayDate.setDate(todayDate.getDate() + expiredays);
 document.cookie = name + "=" + escape(value) + "; path=/; expires=" + todayDate.toGMTString() + ";"
}
</script>


<!-- Google Analytics Tracking by Google Analyticator 6.0.2: http://ronaldheft.com/code/analyticator/ -->
<script type="text/javascript"> 
	var analyticsFileTypes = [''];
	var analyticsEventTracking = 'enabled';
</script>
<script type="text/javascript"> 
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-11792865-19']);
	_gaq.push(['_trackPageview']);
 
	(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(ga);
	})();
</script>