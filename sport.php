<?php
	include_once "class/user.class.php";
	include_once "class/displayNews.class.php";
?>
<html>
    <head>
	<title>VESTI</title>
    </head>
    <body style = "width:1024px; background-color:RGB(42,42,42); color:white; margin: 20 auto;">
	<div style = "width:215px; height:50px; float:right; background-color:#00D7FF; position:relative; margin-right: 60px;">
		<a href = bussiness.php style = "color:black; text-decoration:none;">
			<div style = "float:left; margin:auto; position:absolute; left:10px;"><p>BIZNIS</p></div></a>
		<a href = sport.php style = "color:black; text-decoration:none;"><div style = "float:left; margin:auto; position:absolute; left:70px;"><p>SPORT</p></div></a>
		<a href = politika.php style = "color:black; text-decoration:none;"><div style = "float:left; margin:auto; position:absolute; left:130px;"><p>POLITIKA</p></div></a>
	    <a href = addNews.php style = "color:white; text-decoration:none; font-weight: bold;">
			<div style = "float:left; width:80px; height:50px; margin: 0 0 0 15; background-color:red; position:absolute; left:210px;"><p style = "padding: 2px;">Dodaj vest</p>
			</div>
		</a> 
	</div>
		<a href = "index.php" style = " text-decoration:none; color: white;"><div style = "width:740px; height:50px; background-color:#FF5C94; margin: 0 0 10 0;">
			<h1 style = "margin: 15px; font-size: 280%;">NAJNOVIJE VESTI</h1>
		</div></a>  
		<div style = "width: 1054; background-color: #666666">
			<?php
				$news = "SELECT date, news_type, heading, news, photo_name FROM news WHERE news_type = 'sport' ORDER BY date DESC";
				$displayNews = new DisplayNews();
				$displayNews->HeroNews($news);
			?>
		</div>
		<div style = "float: right; margin: 0 460 50 0;">
			<a href="#top" style = "color: white;">Idi na vrh strane</a>
		</div>
    </body>
</html>

