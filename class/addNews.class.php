<?php
	include_once "user.class.php";
	class AddNews
	{
		public function InsertNews()
		{	
			$timestamp = date("Y-m-d H:i:s");
			$newsType = $_POST["newsType"];
			$heading = trim($_POST["heading"]);
			$news = trim($_POST["news"]);
			$newsInsert = "INSERT INTO `news` VALUES (null, '$timestamp', '$newsType', '$heading', '$news', '')";
			User::OpenConn();
			User::$conn->query($newsInsert);
			User::GetError();
			User::CloseConn();
		}
		
		public function InsertNewsWithPhoto()
		{	
			$timestamp = date("Y-m-d H:i:s");
			$time = microtime();
			$newsType = $_POST["newsType"];
			$heading = trim($_POST["heading"]);
			$news = trim($_POST["news"]);
			$photoName = $_FILES["photo"]["name"];
			$extension = pathinfo($photoName, PATHINFO_EXTENSION);
			$photoName = $newsType . "." . $heading . "." . $extension;
			$photoSize = $_FILES["photo"]["size"];
			$photoType = $_FILES["photo"]["type"];
			$photoTemp = $_FILES["photo"]["tmp_name"];
			$imgLocation = "../NEWS/img/" . $photoName;
			$allowedExt = array("jpeg", "jpg", "png", "gif");
			$checkExt = in_array($extension, $allowedExt);

			if(($checkExt) && ($photoSize >= 10*1024 && $photoSize <= 10*1024*1024))
			{	
				move_uploaded_file($photoTemp, $imgLocation);
				User::OpenConn();
				$photoInsert = "INSERT INTO `news` VALUES (null, '$timestamp', '$newsType', '$heading', '$news', '$photoName')";
				User::$conn->query($photoInsert);
				User::GetError();
			}
			else
			{
				echo "<div style = 'color:red;'>Odabrali ste neodgovarajucu velicinu ili ekstenziju fajla.</div><br>";
			}			
		}
	}
?>
