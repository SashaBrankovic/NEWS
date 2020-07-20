<?php
	include_once "user.class.php";
	include_once "loginUser.class.php";

	class DisplayNews
	{
		public function HeroNews($news)
		{
			User::OpenConn();
			$newsResult = User::$conn->query($news);
			User::CloseConn();
			while($row = $newsResult->fetch_assoc())
			{
				$date = $row["date"];
				$heading = $row["heading"];
				$newsType = $row["news_type"];
				$news = $row["news"];
				$photo = $row["photo_name"];
				$fileName = str_replace("?","", $heading);
				$path = "news/" . $newsType . "." . $fileName . ".php";
				$headingMain = sprintf("<div><a href='%s' style = 'width: 1024; color: #701c1c; text-decoration: none;'><h2 style = 'margin: 0 10; padding: 5px;'>%s</h2></a></div>", 
									   $path, $heading);
				$photoMain = sprintf("<div style = 'margin: 5 15 15 15;'><a href = '$path'><img src = 'img/%s' height = '300px' width = '450px' style = 'margin: 5 0 20 0;'></a></div>", $photo);
				if(empty($photo))
				{
					printf("%s", $headingMain);
					printf("<div style = 'margin: 0 15;'>%s</div><br>", $date);
				}
				else
				{
					printf("%s", $headingMain);
					printf("<div style = 'margin: 0 15;'>%s</div>", $date);
					printf("%s", $photoMain);
				}
			}
		}
		
		public static function WriteNews()
		{	
			$news = "SELECT ID_NEWS, date, news_type, heading, news, photo_name FROM news ORDER BY date DESC LIMIT 1";
			User::OpenConn();
			$newsResult = User::$conn->query($news);
			User::CloseConn();
			$row = $newsResult->fetch_assoc();
			$idNews = $row["ID_NEWS"];
			$date = $row["date"];
			$heading = $row["heading"];
			$newsType = $row["news_type"];
			$news = $row["news"];
			$photoName = $row["photo_name"];
			$fileName = str_replace("?","", $heading);
			$path = "news/" . $newsType . "." . $fileName . ".php";
			if(!empty($photoName))
			{	
				$content = sprintf("<?php include_once '../newsLookTop.php'; ?>
									<div style = 'font-weight: 900; color: red;'>%s</div>			
									<div style = 'width: 1024; background-color: red; color: white; padding: 4px;'><h2 style = 'padding:4px;'>%s</h2></div><br>
									<div style = 'width: 1024; background-color: #666666; padding: 4px;'><p style = 'padding: 4px;'>%s</p></div><br>
									<div><img src = '../img/%s' height = '400px' width = '600px'></div>
									<div style = 'background-color:red; color:white; height:40px; width:180px; margin-top:5px;'><p style = 'padding:10px;'>Komentarisite ispod</p></div>
									<?php include_once '../newsLookBottom.php'; ?>
									<?php include_once '../class/displayNews.class.php'; DisplayNews::InsertComment($idNews); DisplayNews::WriteComment($idNews); ?>", $date, $heading, $news, $photoName);
									
			}
			else
			{
				$content = sprintf("<?php include_once '../newsLookTop.php'; ?>
									<div style = 'font-weight: 900; color: red;'>%s</div>			
									<div style = 'width: 1024; background-color: red; color: white; padding: 4px;'><h2 style = 'padding:4px;'>%s</h2></div><br>
									<div style = 'width: 1024; background-color: #666666; padding: 4px;'><p style = 'padding:4px;'>%s</p></div><br>
									<div style = 'background-color:red; color:white; height:40px; width:180px; margin-top:5px;'><p style = 'padding:10px;'>Komentarisite ispod</p></div>
									<?php include_once '../newsLookBottom.php'; ?>
									<?php include_once '../class/displayNews.class.php'; DisplayNews::InsertComment($idNews); DisplayNews::WriteComment($idNews);?>", $date, $heading, $news);
									
			}
			
			$handle = fopen($path, "w");
			if($handle !== false)
			{
				fwrite($handle, $content);
				fclose($handle);
			}	
		}
		
		private static function DeleteComment($idComent)
		{
			printf("<form action = '' method = 'POST'>
						<div>
							<input type = 'submit' name = '$idComent' value = 'Obrisi komentar' style = 'margin-bottom: 5px;'>
						</div>
					 </form><br><?php  ?>"
					);
			
			if(ISSET($_POST["$idComent"]))
			{
				$isLoggedIn = new LoginUser();
				$logged = $isLoggedIn->IsUserLoggedIn();
				if(!$logged)
				{
					echo "<a href = '../login.php' style = 'text-decoration:none;'><div style = 'background-color: red; color: white; height:40px; width:360px; margin-top: 5px;'>
					<p style = 'padding:10px;'>Morate biti ulogovani da bi ste obrisali komentar</p></div></a>";	
				}
				else
				{	
					$username = $_SESSION["user"];
					User::OpenConn();
					if($username === "admin")
					{
						$adminDeleteComment = "DELETE FROM comment WHERE ID_COMMENT = '$idComent'";
						User::$conn->query($adminDeleteComment);
						printf("<div><h4>Nakon sledece posete ovoj strani ili osvezavanja strane komentar vise nece biti vidljiv!</h4></div>");
					}
					else
					{
						$userDeleteComment = "DELETE FROM comment WHERE username = '$username' AND ID_COMMENT = '$idComent'";
						User::$conn->query($userDeleteComment);
						printf("<div><h4>Mozete obrisati samo onaj komentar koji ste vi postavili, a nakon sledece posete ovoj strani ili osvezavanja strane komentar vise nece biti vidljiv!</h4></div>");
					}
					User::CloseConn();
				}
			}	
		}
		
		public static function InsertComment($idNews)
		{
			$isLoggedIn = new LoginUser();
			$logged = $isLoggedIn->IsUserLoggedIn();
			if(!$logged)
			{
				echo "<a href = '../login.php' style = 'text-decoration:none;'><div style = 'background-color: red; color: white; height:40px; width:180px; margin-top: 5px;'>
				<p style = 'padding:10px;'>Ulogujte se za komentar</p></div></a>";	
			}
			else
			{
				$username = $_SESSION["user"];
				if(ISSET($_POST["submit"], $_POST["comm"]))
				{
					if(!empty($_POST["comm"]))
					{
						$comm = $_POST["comm"];
						$date = date("Y-m-d H:i:s");
						$insertComment = "INSERT INTO `comment` VALUES (null, '$date', '$username', '$comm')";
						User::OpenConn();
						User::$conn->query($insertComment);
						$idComment = "SELECT ID_COMMENT FROM comment ORDER BY date DESC LIMIT 1";
						$resultIdComment = User::$conn->query($idComment);
						$row = $resultIdComment->fetch_assoc();
						$idComment = $row["ID_COMMENT"];
						$insertNewsComment = "INSERT INTO `news_comment` VALUE ('$idNews', '$idComment')";
						User::$conn->query($insertNewsComment);
						User::CloseConn();
					}
					else
					{
						echo "<div style = 'background-color: red; color: white; height:40px; width:300px; margin-top: 5px;'><p style = 'padding:10px;'>Ne mozete poslati prazan komentar</p></div>";
					}
				}
			}
		}
			
		public static function WriteComment($idNews)
		{
			User::OpenConn();			
			$comment = "SELECT c.ID_COMMENT, c.date, c.username, c.comment FROM comment c 
								JOIN news_comment nc ON c.ID_COMMENT =  nc.ID_COMMENT 
								JOIN news n ON nc.ID_NEWS = n.ID_NEWS 
							  WHERE nc.ID_NEWS = '$idNews' ORDER BY date DESC";
			$result = User::$conn->query($comment);
			User::CloseConn();
			while($rowResult = $result->fetch_assoc())
			{	
				$idComent = $rowResult["ID_COMMENT"];
				$date = $rowResult["date"];
				$usernameOnComment = $rowResult["username"];
				$comment = $rowResult["comment"];
				printf("<div style = 'background-color: red; color: white; width:600px; margin-top: 5px;'>
							<p style = 'padding:10px;'>Korisnik: <b>%s</b><br> %s <br><br>Komentar:<br><b>%s</b>
							</p>
						</div>", $usernameOnComment, $date, $comment
					  );
				self::DeleteComment($idComent);
			}			
		}
	}	