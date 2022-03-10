<!DOCTYPE html>
<!-- saved from url=(0057)http://colorpowered.com/colorbox/core/example1/index.html -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>ColorBox Examples</title>
	<style type="text/css">
		body{font:12px/1.2 Verdana, sans-serif; padding:0 10px;}
		a:link, a:visited{text-decoration:none; color:#416CE5; }
		h2{font-size:13px; margin:15px 0 0 0;}
	</style>
	<link media="screen" rel="stylesheet" href="css/colorbox.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery.colorbox.js"></script>
	<script>
		$(document).ready(function(){
			//Examples of how to assign the ColorBox event to elements
			$("a[rel='example1']").colorbox();
			$("a[rel='example2']").colorbox({transition:"fade", width:"850", height:"75%"});
			$("a[rel='example3']").colorbox({transition:"none", width:"750", height:"75%"});
			$("a[rel='example4']").colorbox({slideshow:true});
			$(".example5").colorbox();
			$(".example6").colorbox({iframe:true, innerWidth:425, innerHeight:344});
			$(".example7").colorbox({width:"80%", height:"80%", iframe:true});
			$(".example8").colorbox({width:"50%", inline:true, href:"#inline_example1"});
			$(".example9").colorbox({
				onOpen:function(){ alert('onOpen: colorbox is about to open'); },
				onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
				onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
				onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
				onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
			});
			
			//Example of preserving a JavaScript event for inline calls.
			$("#click").click(function(){ 
				$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
				return false;
			});
		});
	</script>
</head>
<body><div id="cboxOverlay" style="opacity: 1; cursor: auto; display: none; "></div><div style="padding-bottom: 42px; padding-right: 42px; position: absolute; width: 590px; height: 220px; top: 211.5px; left: 315.5px; opacity: 1; cursor: auto; display: none; " id="colorbox" class=""><div id="cboxWrapper" style="width: 632px; height: 262px; "><div style=""><div id="cboxTopLeft" style="float: left; "></div><div id="cboxTopCenter" style="float: left; width: 590px; "></div><div id="cboxTopRight" style="float: left; "></div></div><div style="clear: left; "><div id="cboxMiddleLeft" style="float: left; height: 220px; "></div><div id="cboxContent" style="float: left; width: 590px; height: 220px; "><div id="cboxLoadingOverlay" style="height: 220px; display: none; " class=""></div><div id="cboxLoadingGraphic" style="height: 220px; display: none; " class=""></div><div id="cboxTitle" style="display: block; " class=""></div><div id="cboxCurrent" style="display: none; " class="">image 2 of 3</div><div id="cboxNext" style="display: none; " class="">next</div><div id="cboxPrevious" style="display: none; " class="">previous</div><div id="cboxSlideshow" style="display: none; " class=""></div><div id="cboxClose" style="" class="">close</div></div><div id="cboxMiddleRight" style="float: left; height: 220px; "></div></div><div style="clear: left; "><div id="cboxBottomLeft" style="float: left; "></div><div id="cboxBottomCenter" style="float: left; width: 590px; "></div><div id="cboxBottomRight" style="float: left; "></div></div></div><div style="position: absolute; width: 9999px; visibility: hidden; display: none; "></div></div>
	<h1>ColorBox Demonstration</h1>
	
	<h2>Elastic Transition</h2>
	<p><a href="picture/images.jpg" rel="example1" title="Me and my grandfather on the Ohoopee."><img src='picture/images.jpg'></a></p>
	<p><a href="picture/18270PZD.jpg" rel="example1" title="On the Ohoopee as a child" class="cboxElement"><img src='picture/18270PZD.jpg'></a></p>
	<p><a href="http://colorpowered.com/colorbox/core/content/ohoopee3.jpg" rel="example1" title="On the Ohoopee as an adult" class="cboxElement">Grouped Photo 3</a></p>
	
	<h2>Fade Transition</h2>
	<p><a href="http://colorpowered.com/colorbox/core/content/ohoopee1.jpg" rel="example2" title="Me and my grandfather on the Ohoopee" class="cboxElement">Grouped Photo 1</a></p>
	<p><a href="http://colorpowered.com/colorbox/core/content/ohoopee2.jpg" rel="example2" title="On the Ohoopee as a child" class="cboxElement">Grouped Photo 2</a></p>
	<p><a href="http://colorpowered.com/colorbox/core/content/ohoopee3.jpg" rel="example2" title="On the Ohoopee as an adult" class="cboxElement">Grouped Photo 3</a></p>
	
	<h2>No Transition + fixed width and height (75% of screen size)</h2>
	<p><a href="http://colorpowered.com/colorbox/core/content/ohoopee1.jpg" rel="example3" title="Me and my grandfather on the Ohoopee." class="cboxElement">Grouped Photo 1</a></p>
	<p><a href="http://colorpowered.com/colorbox/core/content/ohoopee2.jpg" rel="example3" title="On the Ohoopee as a child" class="cboxElement">Grouped Photo 2</a></p>
	<p><a href="http://colorpowered.com/colorbox/core/content/ohoopee3.jpg" rel="example3" title="On the Ohoopee as an adult" class="cboxElement">Grouped Photo 3</a></p>
	
	<h2>Slideshow</h2>
	<p><a href="http://colorpowered.com/colorbox/core/content/ohoopee1.jpg" rel="example4" title="Me and my grandfather on the Ohoopee." class="cboxElement">Grouped Photo 1</a></p>
	<p><a href="http://colorpowered.com/colorbox/core/content/ohoopee2.jpg" rel="example4" title="On the Ohoopee as a child" class="cboxElement">Grouped Photo 2</a></p>
	<p><a href="http://colorpowered.com/colorbox/core/content/ohoopee3.jpg" rel="example4" title="On the Ohoopee as an adult" class="cboxElement">Grouped Photo 3</a></p>
	
	<h2>Other Content Types</h2>
	<p><a class="example5 cboxElement" href="http://colorpowered.com/colorbox/core/content/ajax.html" title="Homer Defined">Outside HTML (Ajax)</a></p>
	<p><a class="example5 cboxElement" href="http://colorpowered.com/colorbox/core/content/flash.html" title="Royksopp: Remind Me">Flash / Video (Ajax/Embedded)</a></p>
	<p><a class="example6 cboxElement" href="http://www.youtube.com/embed/617ANIA5Rqs?rel=0" title="The Knife: We Share Our Mother&#39;s Health">Flash / Video (Iframe/Direct Link To YouTube)</a></p>
	<p><a class="example7 cboxElement" href="showdata.php?pic=images.jpg"><img src='picture/18270PZD.jpg'></a></p>
	<p><a class="example8 cboxElement" href="http://colorpowered.com/colorbox/core/example1/index.html#">Inline HTML</a></p>
	
	<h2>Demonstration of using callbacks</h2>
	<p><a class="example9 cboxElement" href="http://colorpowered.com/colorbox/core/content/marylou.jpg" title="Marylou on Cumberland Island">Example with alerts</a>. Callbacks and event-hooks allow users to extend functionality without having to rewrite parts of the plugin.</p>
	
	<!-- This contains the hidden content for inline calls -->
	<div style="display:none">
		<div id="inline_example1" style="padding:10px; background:#fff;">
		<p><strong>This content comes from a hidden element on this page.</strong></p>
		<p>The inline option preserves bound JavaScript events and changes, and it puts the content back where it came from when it is closed.<br>
		<a id="click" href="http://colorpowered.com/colorbox/core/example1/index.html#" style="padding:5px; background:#ccc;">Click me, it will be preserved!</a></p>
		
		<p><strong>If you try to open a new ColorBox while it is already open, it will update itself with the new content.</strong></p>
		<p>Updating Content Example:<br>
		<a class="example5 cboxElement" href="http://colorpowered.com/colorbox/core/content/flash.html">Click here to load new content</a></p>
		</div>
	</div>

</body></html>