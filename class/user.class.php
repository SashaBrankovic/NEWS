<?php
    class User
    {
		public static $conn;
		public function NewUser()
		{
			if(ISSET($_POST["user"], $_POST["pass"], $_POST["repass"], $_POST["email"]) && (!empty($_POST["user"] && $_POST["pass"] && $_POST["repass"] && $_POST["email"])))
			{
				$user = trim($_POST["user"]);
				$pass = md5(trim($_POST["pass"]));
				$repass = md5(trim($_POST["repass"]));
				$email = trim($_POST["email"]);

				if($pass!==$repass)
				{
					echo "<div style = 'color:red;'>Ponovljeni password nije isti sa prvo unetim</div><br>";
				}
				else
				{
					self::OpenConn();
					$isExist = self::IsUserExist($user);

					if($isExist)
					{
						echo "<div style = 'color:red;'>Username vec postoji</div><br>";
					}
					else
					{
						$listOfEmails = "SELECT email FROM user";
						$emailResults = self::$conn->query($listOfEmails);
						$resultEmail = null;
						while($rowEmail = $emailResults->fetch_assoc())
						{
							$resultEmail[] = $rowEmail["email"];
						}

						if($resultEmail != []){
							if(in_array($email, $resultEmail)){
								echo "<div style = 'color:red;'>Email vec postoji</div><br>";
							}else{
								$newUser = "INSERT INTO `user` VALUES (null, '$user', '$pass', '$email')";
								self::$conn->query($newUser);
								self::GetError();
								self::CloseConn();
							}
						}else{
							$newUser = "INSERT INTO `user` VALUES (null, '$user', '$pass', '$email')";
							self::$conn->query($newUser);
							self::GetError();
							self::CloseConn();
						}
					}
				}
			}else
			{
				echo "<div style = 'color:red;'>Niste pravilno popunili formu</div><br>";
			}
		}
		public static function OpenConn()
		{
			self::$conn = new mysqli("localhost", "root", "", "NEWS");
			if(self::$conn->connect_errno)
			{
				printf("Greska prilikom konekcije: %d -- %s", self::$conn->connect_errno, self::$conn->connect_error);
			}
		}

		public static function CloseConn()
		{
			self::$conn->close();
		}
		
		public static function GetError()
		{
			if(self::$conn->errno)
			{
				printf("<div style = 'color:red;'>Greska prilikom upisa u bazu: %d -- %s</div><br>", self::$conn->errno, self::$conn->error);
			}
			else
			{
				echo "<div style = 'color:#00D7FF;'>Uspesno ste sacuvali podatke.</div><br>";
				header("Refresh: 2; URL=login.php");
			}
		}

		public static function IsUserExist($user)
		{
			$listOfUsers = "SELECT username FROM user";
			$userResults = self::$conn->query($listOfUsers);
			$resultUser = null;
			while($rowUser = $userResults->fetch_assoc())
			{
				$resultUser[] = $rowUser["username"];
			}
			$existUser = false;
			if($resultUser != []){
				if(in_array($user, $resultUser)){
					printf("%s", $rowUser["username"]);
					$existUser = true;
				}
				return $existUser;
			}
		}
		public static function FetchPass($user, $pass)
		{
			$checkPass = "SELECT password FROM user WHERE username = '$user'";
			$passResults = self::$conn->query($checkPass);
			$rowPass = $passResults->fetch_assoc();
			$resultPass = $rowPass["password"];
			
			$passInDB = false;
			if($resultPass === $pass)
			{
				$passInDB = true;
			}
			return $passInDB;
		}
    }
?>
