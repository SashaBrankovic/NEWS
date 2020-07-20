<?php
    include_once "user.class.php";

    class LoginUser
    {
        public function CheckUser()
        {
            if(ISSET($_POST["user"], $_POST["pass"]) && (!empty($_POST["user"] && $_POST["pass"])))
			{
				$user = trim($_POST["user"]);
				$pass = md5(trim($_POST["pass"]));
				
				User::OpenConn();
				$existUser = User::IsUserExist($user);
				$existPass = User::FetchPass($user, $pass);
		
				if($existUser && $existPass)
				{
					$_SESSION["user"] = $user;
					header("Location: index.php");
					exit;
				}
				else
				{
					echo "<div style = 'color:red;'>Neodgovarajuci user ili password</div><br>";
				}
				User::CloseConn();
			}
		}
	
		public function IsUserLoggedIn()
		{
			$userStatus = false;
			if(ISSET($_SESSION["user"]))
			{
				$userStatus = true;
			}
			return $userStatus;
		}
		
		public function RedirectToLoginPage()
		{
			$isLogged = $this->IsUserLoggedIn();
			if(!$isLogged)
			{
				header("Location: login.php");
				exit;
			}
		}
		
		public function RedirectToHomePage()
		{
			$isLogged = $this->IsUserLoggedIn();
			if($isLogged)
			{
				header("Location: addNews.php");
				exit;
			}
		}
	
    }
?>
