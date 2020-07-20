
<?php	
    include_once "class/loginUser.class.php";
    include_once "class/addNews.class.php";
	include_once "class/displayNews.class.php";

    session_start();
    $loginUser = new LoginUser();
    $loginUser->RedirectToLoginPage();
    
    $username = $_SESSION["user"];
    printf("<p style = 'display:inline; color:navy;'><b>Dobrodosli, %s</b></p>&nbsp; &nbsp;", $username);
    printf("<div style = 'float: right; margin: 0 50 0 0;'><a href = index.php><img src = 'img/.icon/home_button.png'></a></div>");
    printf("<a href = 'logout.php' style = 'color:red;'><b>Logout</b></a>");
    
	if(ISSET($_POST["submit"], $_POST["newsType"], $_POST["heading"], $_POST["news"], $_FILES["photo"]) && ($_FILES["photo"]["size"] == 0))
	{	
		if(!empty($_POST["heading"] && $_POST["news"]))
		{
			$addNews = new AddNews();
			$addNews->InsertNews();
			DisplayNews::WriteNews();
			header("Refresh: 2; URL=index.php");
			
		}
		else
		{
			echo "<div style = 'color:red;'>Obavezna polja su naslov i vesti.</div><br>";
		}
	}
	else
	{	
		if(ISSET($_POST["submit"], $_POST["newsType"], $_POST["heading"], $_POST["news"], $_FILES["photo"]))
		{
			if(!empty($_POST["heading"] && $_POST["news"] && $_FILES["photo"]["name"]))
			{
				$addNews = new AddNews();
				$addNews->InsertNewsWithPhoto();		
				DisplayNews::WriteNews();
				header("Refresh: 2; URL=index.php");
			
			}
			else
			{
				echo "<div style = 'color:red;'>Obavezna polja su naslov i vesti.</div><br>";
			}
		}
	}	
?>
<html>
    <head><title>Dodaj vest</title></head>
    <body style = "background-color:#E1DACB;">
	<h4>Dodajte vest i odaberite kategoriju kojoj pripada. Slika mora biti velicine izmedju 10 KB i 10 MB, a dozvoljene ekstenzije su: JPEG, JPG, PNG, GIF.</h4>
	<h4>U pisanju naslova i vesti izbegavajte znak (' - jednostruki navodnik) jer nece biti prihvacen. </h4>
	<form method = "POST" action = "" enctype = "multipart/form-data">
	    <div style = "padding:5px;">
		<select name = "newsType">
		    <option value= "biznis">Biznis</option>
		    <option value= "sport">Sport</option>
		    <option value= "politika">Politika</option>
		</select>
	    </div>
	    <div style = "padding:5px;">
		<textarea name="heading" cols="50" maxlength="120" placeholder = "Naslov..." autofocus></textarea>
	    </div>
	    <div style = "padding:5px;">
		<textarea name="news" rows="14" cols="120" placeholder = "Vest..."></textarea>
	    </div>
	    <div style = "padding:5px;">
		<input type = "file" name = "photo" size = "80" accept = "image/png, image/gif, image/jpeg, image/jpg">
	    </div>
	    <div style = "padding:5px;">
		<input type = "submit" name = "submit" value = "Send news">
	    </div>
	</form>
    </body>
</html>
