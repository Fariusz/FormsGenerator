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
	<title>Projekt - formularz</title>
	<link rel="stylesheet" href="style.css" />
    <script src="script.js"></script>
</head>

<body>
	<a href="wybor_formularza.php" >
		<img border="0" alt="Cofnij" title="Cofnij do wyboru formularza" src="grafika/cofnij.png" width="50" height="50" name="powrot">
	</a>
	
	<div name="wyloguj">
		<b>
			<a href="logout.php">Wyloguj się!</a>
		</b>
	</div>
	<br>
	<br>
	
	<center>
		<div id="wiadomosc">
			<h1 name="powitanie">Czas wygenerować własny formularz!</h1>
		</div>
	</center>
	
	<form action="przechowywanie_zmiennych.php" method="post">
		<center>
			<b>Nazwa formularza:</b> 
			<img src="grafika/znak-zapytania.png" alt="?" width="25" height="25" title="Podaj nazwę formularza" />
			<br><br> <input type="text" name="tytul_formularz" />
			<input type="hidden" name="zmienna" value="1" />
			<input type="submit" value="Dalej" title="Przejdź do wypełniana danych"/>
		</center>
	</form>
	
</body>
</html>