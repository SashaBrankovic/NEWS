<?php
	session_start();
?>

<html>
    <head>
	<meta charset='UTF-8'>
	<title>VESTI</title>
    </head>
    <body style = "width:1024px; background-color:RGB(42,42,42); color:white; margin: 15 auto;">
	<div style = "width:250px; height:50px; float:right; background-color:#00D7FF; position:relative; margin-right: 50px;">  
		<a href = ../bussiness.php style = "color:black; text-decoration:none;">
			<div style = "float:left; margin:auto; position:absolute; left:10px;"><p>BIZNIS</p>
			</div>
		</a>
		<a href = ../sport.php style = "color:black; text-decoration:none;">
			<div style = "float:left; margin:auto; position:absolute; left:80px;"><p>SPORT</p>
			</div>
		</a>
		<a href = ../politika.php style = "color:black; text-decoration:none;">
			<div style = "float:left; margin:auto; position:absolute; left:140px;"><p>POLITIKA</p>
			</div>
		</a>
	    <a href = ../addNews.php style = "color:white; text-decoration:none; font-weight: bold;">
			<div style = "float:left; width:80px; height:50px; margin: 0 0 0 40; background-color:red; position:absolute; left:182px;"><p style = "padding: 2px;">Dodaj vest</p>
			</div>
		</a>
	</div>
		<a href = "../index.php" style = "text-decoration:none; color: white;">
			<div style = "width:710px; height:50px; background-color:#FF5C94; margin: 0 0 15 0;">
				<h1 style = "margin: 15px; font-size: 280%;">NAJNOVIJE VESTI</h1>
			</div>
		</a>  
    </body>
</html>
