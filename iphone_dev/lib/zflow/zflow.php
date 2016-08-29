<!DOCTYPE html>
<?
include_once("../../../common/dbcon.php");	//db 커넥션
include_once("../../lib/common.function.php");	//공통 함수
include_once("../../lib/common.vars.php");	//공통 변수
?>
<html>
<head>
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <title>CSS VFX Example - 3D Coverflow | Flickr</title>
    
    <link rel="stylesheet" type="text/css" href="./zflow_style.css" />

    <style type="text/css">

    body
    {
        background-color: black;
        color: white;
        margin: 0;
        padding: 0;
        font-family: Helvetica;
    }

    .portrait { width: 320px; height: 416px; }
    .landscape { width: 480px; height: 270px; }

    </style>

    <script type="text/javascript" src="../../js/jquery.tools.js"></script>
    <script type="text/javascript" src="./zflow.js"></script>
</head>

<body class="zflow">
<div class="toolbar">
	<h1>2222222</h1>
	<a href="#" class="button back">Back</a>
</div>
<div class="centering">
    <div id="tray" class="tray"></div>
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

function flickr(callback)
{
    var url = "http://api.flickr.com/services/rest/?method=flickr.interestingness.getList&api_key=60746a125b4a901f2dbb6fc902d9a716&per_page=20&format=json&jsoncallback=?";
    
	jQuery.getJSON(url, function(data) 
	{
        var images = jQuery.map(data.photos.photo, function (item)
        {
            return 'http://farm' + item.farm + '.static.flickr.com/' + item.server + '/' + item.id + '_' + item.secret + '_m.jpg';
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