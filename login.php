<?php
    session_start();
    include_once "class/loginUser.class.php";

    if(ISSET($_POST["submit"]))
    {
		$loginUser = new LoginUser();
		$loginUser->CheckUser();
    }
?>
<html>
    <head>
		<title>Login</title>
    </head>
    <body style = "width:1024px; background-color:RGB(42,42,42); color:white; margin:auto;">
		<form method = "POST" action = "">
			<div  style = "width:690px; float:right; padding:2px;">
			<div style = "float: right; margin: 0 50 0 0;"><a href = index.php><img src = "img/.icon/home_button.png"></a></div>
			<div>
				<div style = "float:left; padding:2px;">
				Username
				</div>
				<div style = "float:left; padding:2px; margin-right:10px">
				<input type = "text" name = "user" autocomplete = "off">
				</div>
			</div>
			<div>
				<div style = "float:left; padding:2px;">
				Password
				</div>
				<div style = "float:left; padding:2px;">
				<input type = "password" name = "pass">
				</div>
			</div>
			<div style = "float:left; padding:2px; margin-left:6px;">
				<input type = "submit" name = "submit" value = "Login">
			</div>
			<div style = "float:left; padding:6px;">
				<a href = "register.php" style = "color:red;">Register</a>
			</div>
			</div>
		</form>
    </body>
</html>
