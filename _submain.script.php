<link type="text/css" rel="stylesheet" href="<?=$IU[url]?>/css/jquery.boxen.css" />
<link type="text/css" rel="stylesheet" href="<?=$IU[url]?>/js/gallery/jq_style.css" />
<script type="text/javascript" src="<?=$IU[url]?>/js/gallery/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?=$IU[url]?>/js/gallery/jquery.galleryview-1.1.js"></script>
<script type="text/javascript" src="<?=$IU[url]?>/js/gallery/jquery.timers-1.1.2.js"></script>
<script type="text/javascript" src="<?=$IU[url]?>/js/jquery.boxen-1.4.js"></script>
<script type="text/javascript">
$(document).ready(function(){ 
	$('#photos').galleryView({//포토 겔러리
		panel_width: 650,
		panel_height: 300,
		frame_width: 30,
		frame_height: 30,
		overlay_color: '#222',
		overlay_text_color: '#fff',
		caption_text_color: '#fff',
		background_color: 'transparent',
		border: 'none',
		nav_theme: 'light',
		easing: 'easeInOutQuad',
		pause_on_hover: true
	});
	////////////////////////////////////////////////////////////////////////////////////////////////////
	$("img[rel]").overlay();  //오버레이 설정  ex). 아이폰 아이콘 클릭시..	
	


});////ready(function() end

</script>

