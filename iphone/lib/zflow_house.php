<!DOCTYPE html>
<?
$h_cd = str_replace("\'","",$_REQUEST['h_cd']);
$h_nm = str_replace("\'","",$_REQUEST['h_nm']);
?>
<html>
<head>
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>IUNIV 주거정보 사진보기</title>
	<script type="text/javascript" src="../../js/jquery.1.3.2.js"></script>
	<script type="text/javascript" src="../js/zflow.js"></script>
	<style type="text/css" media="screen">@import "../themes/apple/theme.css";</style>
	<link rel="stylesheet" type="text/css" href="../css/zflow_style.css" />
	<script src="../jqtouch/jqtouch.js" type="application/x-javascript" charset="utf-8"></script>
</head>
<div id="zflow_house">
	<div class="toolbar">
			<h1><?=$h_nm?></h1>
			<a href="javascript:history.back();" class="button back" target="_webapp">Back</a>
	</div>
	<div class="zflow">
		<div class="centering">
			<div id="tray" class="tray"></div>
		</div>
	</div>
</div>
<script type="text/javascript">

jQuery(window).load(function ()
{
    window.onorientationchange(null);

    flickr(function (images)
    {
        zflow(images, "#tray");
    });
});

function flickr(callback){
    //var url = "http://api.flickr.com/services/rest/?method=flickr.interestingness.getList&api_key=60746a125b4a901f2dbb6fc902d9a716&per_page=20&format=json&jsoncallback=?";
	var h_cd = '<?=$h_cd?>';
    var url = "./zflow_house_json.php?h_cd=<?=$h_cd?>";
	jQuery.getJSON(url,h_cd, function(data){  
        var images=jQuery.map(data.photo, function (item)
        {	//alert(item.img_url);
            return item.img_url;
        });
		
        callback(images);
    });
}

window.onorientationchange = function (event)
{
    if (window.orientation == 0)
    {
        jQuery("div.centering").attr("class", "centering portrait");
    }
    else
    {
        jQuery("div.centering").attr("class", "centering landscape");
    }

    window.setTimeout( function() { window.scrollTo(0, 0); }, 100 );
}

</script>

</body>
</html>