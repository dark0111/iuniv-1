
<style>
#image_wrap {
	/* dimensions */
	width:630px;
	margin:15px 0 15px 40px;
	padding:15px 0;

	/* centered */
	text-align:center;

	/* some "skinning" */
	background-color:#efefef;
	border:2px solid #fff;
	outline:1px solid #ddd;
	-moz-ouline-radius:4px;
}
</style>



<!-- wrapper element for the large image -->
<div id="image_wrap">

	<!-- Initially the image is a simple 1x1 pixel transparent GIF -->
	<img src="http://static.flowplayer.org/tools/img/blank.gif"  height="375" />

</div>



<!-- HTML structures -->


<!-- "previous page" action -->
<a class="prevPage browse left"></a>

<!-- root element for scrollable -->
<div class="scrollable">
	<div class="items">
	<?
	$img_ck_sql = " select I_id, I_classify, I_classify_id, I_filename from room_imageinfo where I_classify_id='$view[h_cd]' order by I_id ";
	
	$result_img_ck_sql = sql_query($img_ck_sql);
	$result_img_ck_sql_count = mysql_num_rows($result_img_ck_sql);
	if($result_img_ck_sql_count!=0) 
	{
					
		include_once("thum_file.php");	//级弛老 积己 何盒
		?>
		
	<?
	}
	?>
	<!-- root element for the items -->
	
	
		
	</div>
	
</div>

<!-- "next page" action -->
<a class="nextPage browse right"></a>

<br clear="all" />

<!-- javascript coding -->


<script>
// execute your scripts when the DOM is ready. this is a good habit
$(function() {

	// initialize scrollable
	$("div.scrollable").scrollable();

});
</script>




<script>
$(function() {

$(".items img").click(function() {

	// calclulate large image's URL based on the thumbnail URL (flickr specific)
	var url = $(this).attr("src").replace("thumbOpen", "thumbOpen2");

	// get handle to element that wraps the image and make it semitransparent
	var wrap = $("#image_wrap").fadeTo("medium", 0.5);

	// the large image from flickr
	var img = new Image();

	// call this function after it's loaded
	img.onload = function() {

		// make wrapper fully visible
		wrap.fadeTo("fast", 1);

		// change the image
		wrap.find("img").attr("src", url);

	};

	// begin loading the image from flickr
	img.src = url;

// when page loads simulate a "click" on the first image
}).filter(":first").click();
});
</script>