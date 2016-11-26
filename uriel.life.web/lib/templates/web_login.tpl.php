<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Account Login</title>
	<link rel="stylesheet" type="text/css" media="screen" href="/uriel.life.web/public/css/screen.css" />
	
	<script type="text/javascript" src="/uriel.life.common/public/scripts/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="/uriel.life.web/public/scripts/jquery.validate.js"></script>

	<script type="text/javascript">
		
	$(function() {
		// highlight 
		var elements = $("input[type!='submit'], textarea, select");
		elements.focus(function(){
			$(this).parents('p').addClass('highlight');
		});
		elements.blur(function(){
			$(this).parents('p').removeClass('highlight');
		});
		
		/*$("#forgotpassword").click(function() {
			$("#password").removeClass("required");
			$("#login").submit();
			$("#password").addClass("required");
			return false;
		});*/
		
		$("#login").validate()
	});
	</script>
	
</head>
<body>
	<div id="page">

		<div id="header">
			<h1>Login</h1>
		</div>

		<div id="content">
			<p id="status"></p>
			<form action="/uriel.life.web/lib/system/web_login.php" method="post" id="login">
				<fieldset>
					<legend>Login details</legend>
						<p>
							<label for="username"><span class="required">User Name</span></label>
							<input id="username" name="username" class="text required" type="text" />
							<label for="username" class="error">This must be a valid user name</label>
						</p>
						
						<p>
							<label for="password"><span class="required">Password</span></label>
							<input name="password" type="password" class="text required" id="password" minlength="4" maxlength="20" />
						</p>

						<p>
							<input type="submit" class="submit" value="Login..." />
						</p>
				</fieldset>
				
				<div class="clear"></div>
			</form>
			
			</div>
			<br/><br/>
			
			<a href="http://[var.myserver]/uriel.life.web/?register" ><h1><p>Click here to register a New User</p></h1></a>
	</div>
	
</body>
</html>
