<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Account Register</title>

<link rel="stylesheet" type="text/css" href="/uriel.life.web/public/css/captcha.css" />
<link rel="stylesheet" type="text/css" media="screen" href="/uriel.life.web/public/css/screen.css" />

<script type="text/javascript" src="/uriel.life.common/public/scripts/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="/uriel.life.web/public/scripts/jquery.ui.all.js"></script>
<script type="text/javascript" src="/uriel.life.web/public/scripts/jquery.captcha.js"></script>
<script type="text/javascript" src="/uriel.life.web/public/scripts/jquery.validate.js"></script>
<script type="text/javascript" charset="utf-8"> 
		var borderColor = "#fff"; 
		var captchaDir = "/uriel.life.web/public"; 
		var formId = "register"; 
		var item = "[var.item;noerror]"; 
		var start = "[var.start;noerror]"; 
		
		$(function() {
			
			$("#register").validate({
				rules: {
					firstname: "required",
					lastname: "required",
					username: {
						required: true,
						minlength: 2
					},
					password: {
						required: true,
						minlength: 5
					},
					confirm_password: {
						required: true,
						minlength: 5,
						equalTo: "#password"
					},
					email: {
						required: true,
						email: true
					},
					agree: "required"
				},
				messages: {
					firstname: "Please enter your firstname",
					lastname: "Please enter your lastname",
					username: {
						required: "Please enter a username",
						minlength: "Your username must consist of at least 2 characters"
					},
					password: {
						required: "Please provide a password",
						minlength: "Your password must be at least 5 characters long"
					},
					confirm_password: {
						required: "Please provide a password",
						minlength: "Your password must be at least 5 characters long",
						equalTo: "Please enter the same password as above"
					},
					email: "Please enter a valid email address name@domain.com"
				}
			});
			
			var elements = $("input[type!='submit'], textarea, select");
			elements.focus(function(){
					$(this).parents('p').addClass('highlight');
				});
			elements.blur(function(){
					$(this).parents('p').removeClass('highlight');
				});
			
			// propose username by combining first- and lastname
			$("#username").focus(function() {
				var firstname = $("#firstname").val();
				var lastname = $("#lastname").val();
				if(firstname && lastname && !this.value) {
					this.value = firstname + "." + lastname;
				}
			});
			
			// check if confirm password is still valid after password changed
			$("#password").blur(function() {
				$("#confirm_password").valid();
			});
 			$(".ajax-fc-container").captcha();

		});
	</script>

</head>
<body>
	<div id="page">

		<div id="header">
			<h1>Register</h1>
		</div>

		<div id="content">
			<p id="status"></p>
			
			

			<form action="/uriel.life.web/lib/system/web_register.php" method="post" id="register">
				<fieldset>
					<legend>User details</legend>
						<p>
							<label for="firstname">Firstname</label>
							<input id="firstname" name="firstname" type="text" />
						</p>
						
						<p>
							<label for="lastname">Lastname</label>
							<input id="lastname" name="lastname" type="text" />
						</p>
						<p>
							<label for="email">Email</label>
							<input id="email" name="email" type="text" />
						</p>
						<p>
							<label for="username">Username</label>
							<input id="username" name="username" type="text"/>
						</p>
						
						<p>
							<label for="password">Password</label>
							<input id="password" name="password" type="password" />
						</p>
						
						<p>
							<label for="confirm_password">Confirm password</label>
							<input id="confirm_password" name="confirm_password" type="password" />
						</p>
						<p>
						<!-- Begin of captcha -->	
							<div id="captcha" class="ajax-fc-container"></div>
						<!-- End of captcha -->
						</p>
						<p>
							<input class="submit" type="submit" value="Register"/>
						</p>
						<div class="clear"></div>
				</fieldset>
			</form>
		</div>
	</div>
				
	
</body>
</html>
