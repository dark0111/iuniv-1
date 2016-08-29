<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="utf-8" lang="utf-8">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name = "viewport" content = "user-scalable=no, width=device-width">
	<title>virtual light table</title>
	<script type="text/javascript" charset="utf-8" src="multitouch-fake.js"></script>
	<script type="text/javascript" charset="utf-8">
	
		var zIndexCount = 1;
		var moving = {};
		function touchHandler(e) {
			if (e.type == "touchstart") {
				for (var i = 0; i < e.touches.length; i++) {
				    // for each "movable" touch event:
					if (e.touches[i].target.className == "movable") {
						var id = e.touches[i].identifier;
						
						// record initial data in the "moving" hash
						moving[id] = {
							identifier: id,
							target:   	e.touches[i].target,
							mouse:		{ x: e.touches[i].clientX, y: e.touches[i].clientY },
							position:	{ x: e.touches[i].target.xfmTX, y: e.touches[i].target.xfmTY },
							rotation: 	e.touches[i].target.xfmR,
							scale: 		e.touches[i].target.xfmS
						};
						
						// move to the front
						moving[id].target.style.zIndex = zIndexCount++;
						
						// reset rotate/scale mode to off
						moving[id].rotateScaleMode = false;
					}
				}
			}
			else if (e.type == "touchmove") {
			    // if there are two touchs and both are on the *same* element, we're in rotate/scale mode
				if (e.touches.length == 2 && e.touches[0].target == e.touches[1].target) {
					var idA = e.touches[0].identifier,
						idB = e.touches[1].identifier;
					
					// if we've previously recorded initial rotate/scale mode data:
					if (moving[idA].rotateScaleMode && moving[idB].rotateScaleMode) {
					    // calculate translation, rotation, and scale
						moving[idA].target.xfmTX = ((moving[idA].positionCenter.x - moving[idA].mouseCenter.x) + ((e.touches[0].clientX + e.touches[1].clientX) / 2));
						moving[idA].target.xfmTY = ((moving[idA].positionCenter.y - moving[idA].mouseCenter.y) + ((e.touches[0].clientY + e.touches[1].clientY) / 2));
						moving[idA].target.xfmR = moving[idA].rotation + e.rotation;
						moving[idA].target.xfmS = moving[idA].scale * e.scale;
						
						updateTransform(moving[idA].target);
					}
					else {
						// set rotate/scale mode to on
						moving[idA].rotateScaleMode	= moving[idB].rotateScaleMode	= true;
						// record initial rotate/scale mode data
						moving[idA].mouseCenter		= moving[idB].mouseCenter		= {
							x: (e.touches[0].clientX + e.touches[1].clientX) / 2,
							y: (e.touches[0].clientY + e.touches[1].clientY) / 2,
						}
						moving[idA].positionCenter	= moving[idB].positionCenter	= {
							x: moving[idA].target.xfmTX,
							y: moving[idA].target.xfmTY
						}
					}
				}
				else {
					for (var i = 0; i < e.touches.length; i++) {
						var id = e.touches[i].identifier;
						
						// for each touch event:
						if (moving[id]) {
							// reset rotate/scale mode to off
							moving[id].rotateScaleMode = false;
							// calculate translation, leave rotation and scale alone
							moving[id].target.xfmTX = ((moving[id].position.x - moving[id].mouse.x) + e.touches[i].clientX);
							moving[id].target.xfmTY = ((moving[id].position.y - moving[id].mouse.y) + e.touches[i].clientY);
							updateTransform(moving[id].target);
						}
					}
				}
			}
			else if (e.type == "touchend" || e.type == "touchcancel") {
			    // clear each from the "moving" hash
				for (var i = 0; i < e.touches.length; i++)
					delete moving[e.touches[i].identifier];
			}
			
			e.preventDefault();
		}
		
		// set the transform style property based on xfm element properties
		function updateTransform(element) {
			element.style['-webkit-transform'] =
				'translate('+element.xfmTX+'px,'+element.xfmTY+'px) '+
				'scale('+element.xfmS+') '+
				'rotate('+element.xfmR+'deg)';
		}
		
		// callback for json Flickr API:
		function jsonFlickrApi(data) {
			for (var i = 0; i < data.photos.photo.length; i++) {
				var p = data.photos.photo[i],
					img = document.createElement("img");
				img.src = 'http://farm'+p.farm+'.static.flickr.com/'+p.server+'/'+p.id+'_'+p.secret+'_m.jpg';
				img.className = "movable";
				img.xfmTX = Math.random()*(window.innerWidth-240);
				img.xfmTY = Math.random()*(window.innerHeight-240);
				img.xfmR = Math.random()*180-90;
				img.xfmS = Math.random()/2+0.5;
				img.setAttribute("style", "position: absolute; top: 0px; left: 0px;");
				document.body.appendChild(img);
				updateTransform(img);
			}
		}
		
		function init() {
			// touch event listeners
			document.addEventListener("touchstart", touchHandler, false);
			document.addEventListener("touchmove", touchHandler, false);
			document.addEventListener("touchend", touchHandler, false);
			document.addEventListener("touchcancel", touchHandler, false);
			
			// get the 10 latest "interesting images" from Flickr
			var flickrApiCall = document.createElement("script");
			document.body.appendChild(flickrApiCall);
			flickrApiCall.src = 'http://api.flickr.com/services/rest/?method=flickr.interestingness.getList&api_key=856affa07586845de6fcbfb82520aa3e&per_page='+10+'&format=json';
		}
	</script>
</head>
 
<body onload="init();" style="width: 100%; height: 100%; background-color: black;">
	
	<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
		</script>
		<script type="text/javascript">
			_uacct = "UA-1520701-1";
			urchinTracker();
		</script>
</body>
</html>

