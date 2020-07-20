<?php
	include_once "loginUser.class.php";
	
	class Logout
	{
		public function LogoutUser()
		{
			$userLogout = new LoginUser();
			$userOut = $userLogout->IsUserLoggedIn();
			 if($userOut)
			 {
				 UNSET($_SESSION["username"]);
				 session_destroy();
			 }
			
			header("Location: login.php");
			exit;
		}	
	}
?> 
