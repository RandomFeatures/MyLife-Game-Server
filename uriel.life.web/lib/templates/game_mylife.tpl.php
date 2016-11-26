<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>My Christian Life</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" media="screen" href="/uriel.life.web/public/css/screen.css" />
	<script type="text/javascript" src="/uriel.life.web/public/scripts/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="/uriel.life.common/public/scripts/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="/uriel.life.common/public/scripts/swfobject.js"></script>
	<script type="text/javascript">

		function reloadGame(){
			window.location = "http://[var.myserver]";	
		}
	
		function loadSWF(gametype) {
		var flashvars = {
			baseurl: "http://[var.myserver]/charon2.life/"
		};
		var params = {
			menu: "false",
			scale: "noScale",
			allowFullscreen: "true",
			allowScriptAccess: "always",
			bgcolor: "#FFFFFF",
			wmode: "transparent"
			
		};
		var attributes = {
			id:"MyChristianLife"
		};
		
		swfobject.embedSWF("http://[var.myserver]/uriel.life.common/public/swfs/[var.currentclient]", "altContent", "760", "590", "9.0.0", "http://[var.myserver]/client.life.common/public/swfs/expressInstall.swf", flashvars, params, attributes);
		}
		
		loadSWF();
	</script>
	<style>
		html, body { height:100%; }
		body { margin:0; }
	</style>
	


</head>
<body>
	<div id="page2">

		<div id="header">
			<h1>My Christian Life</h1>
		</div>

		<div id="content">
			<div id="altContent">
				<h1>My Christian Life</h1>
				<p>Alternative content</p>
				<p> <a href="http://www.adobe.com/go/getflashplayer"><img 
					src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" 
					alt="Get Adobe Flash player" /></a></p>
			</div>
		</div>
	</div>
	
</body>
</html>