<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0014)about:internet -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>WiFiCam</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">td img {display: block;}</style>

<script type="text/javascript" language="JavaScript">
	newImage = new Image();
	
	function LoadNewImage()
	{
		var unique = new Date();
		document.images["WiFiCam"].src = newImage.src;
		newImage.src = "wificam.jpg?time=" + unique.getTime();
	}

	function InitialImage()
	{
		var unique = new Date();
		newImage.onload = LoadNewImage;
		newImage.src = "wificam.jpg?time=" + unique.getTime();
		document.images["WiFiCam"].onload="";
	}
</script>

</head>
<body bgcolor="#ffffff" onLoad="holdUp()">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td>
<table width="627" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
   <td><img src="spacer.gif" width="83" height="1" border="0" alt="" /></td>
   <td><img src="spacer.gif" width="480" height="1" border="0" alt="" /></td>
   <td><img src="spacer.gif" width="63" height="1" border="0" alt="" /></td>
   <td><img src="spacer.gif" width="1" height="1" border="0" alt="" /></td>
  </tr>

  <tr>
   <td colspan="3" style="background-image:url(BackgroundTop.jpg)">&nbsp;</td>
   <td><img src="spacer.gif" width="1" height="61" border="0" alt="" /></td>
  </tr>
  <tr>
   <td rowspan="2" style="background-image:url(BackgroundLeft.jpg)">&nbsp;</td>
   <td><img name="WiFiCam" src="BackgroundContent.jpg" width="480" height="320" border="0" id="WiFiCam" alt="" onload="InitialImage()" /></td>
   <td rowspan="2" style="background-image:url(BackgroundRight.jpg)">&nbsp;</td>
   <td><img src="spacer.gif" width="1" height="320" border="0" alt="" /></td>
  </tr>
  <tr>
   <td style="background-image:url(BackgroundBottom.jpg)">&nbsp;</td>
   <td><img src="spacer.gif" width="1" height="256" border="0" alt="" /></td>
  </tr>
</table>
</td></tr>
</table>
</body>
</html>