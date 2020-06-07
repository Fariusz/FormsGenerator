<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany'])) //jeżeli nie jesteś zalogowany to przeniesie cię na stronę główną
	{
		header('Location: index.php'); //przekierowanie do index.php
		exit(); //zatrzymanie wykonywania dalszego kodu jeżeli to co wyżej jest prawdziwe
	}
	
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Projekt - wybór formularza</title>
	<link rel="stylesheet" href="style.css" />
    <script src="script.js"></script>
</head>

<body>
	<a href="strona_glowna.php" >
		<img border="0" alt="Strona Główna" src="grafika/domek.png" width="50" height="50" name="domek">
	</a>
	<input type="submit" value="Generator Formularzy" name="genfor" onclick=window.location.href='#'; />
	
<div class="dropdown">
	<button class="dropbtn">Historia</button>
	<div class="dropdown-content">
		<a href="#">Podgląd</a>
		<a href="#">Edycja</a>
	</div>
</div>

	<input type="button" value="Zebrane Dane" name="zebdan" onclick=window.location.href='#'; />
	
	<div name="wyloguj">
		<b>
			<a href="logout.php">Wyloguj się!</a>
		</b>
	</div>
	<br>
	<br>
	
	<center>
		<div id="wiadomosc">
			<h1 name="powitanie">Witaj na stronie do zarządzania formularzami!</h1>
		</div>
	</center>
<?php //wyświetlanie danych

	echo "<p name='dane'><b>Id</b>: ".$_SESSION['id'];
	echo " | <b>Nazwa</b>: ".$_SESSION['nazwa_uz'];
	echo " | <b>Login</b>: ".$_SESSION['login']."</p>";
	
?>

</body>
</html>