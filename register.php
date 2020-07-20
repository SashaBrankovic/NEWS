<?php
  include_once "class/user.class.php";
  
  if(ISSET($_POST["submit"])) 
  {
    $addUser = new User();
    $addUser->NewUser();
  }  
?>

<html>
    <head>
	<title>Register</title>
    </head>
    <body style = "width:1024px; background-color:RGB(42,42,42); color:white; margin:auto; padding:10px;">
		<form method = "POST" action = "">
			<div style = "float: right; margin: 0 50 0 0;"><a href = index.php><img src = "img/.icon/home_button.png"></a></div>
			<div  style = "width:320px; float:left; padding:2px;">
			<div style = "float:left; padding:2px;">
				Username
			</div>
			<div style = "float:right; padding:2px;">
				<input type = "text" name = "user" autocomplete = "off">
			</div>
			<div style = "clear:both;">
			</div>
			<br>
			<div style = "float:left; padding:2px;">
				Email
			</div>
			<div style = "float:right; padding:2px;">
				<input type = "text" name = "email" autocomplete = "off">
			</div>
			<div style = "clear:both;">
			</div>
			<br>
			<div style = "float:left; padding:2px;">
				Password
			</div>
			<div style = "float:right; padding:2px;">
				<input type = "password" name = "pass">
			</div>
			<div style = "clear:both;">
			</div>
			<br>
			<div style = "float:left; padding:2px;">
				Retype Password
			</div>
			<div style = "float:right; padding:2px;">
				<input type = "password" name = "repass">
			</div>
			<div style = "clear:both;">
			</div>
			<br>
			<div style = "float:left; padding:4px;">
				<input type = "submit" name = "submit" value = "Submit">
			</div>
			<div style = "float:left; padding:4px;">
				<input type = "reset" name = "reset" value = "Reset">
			</div>
			</div>
		</form>	
    </body>
</html>
