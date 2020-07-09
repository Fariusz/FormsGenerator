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
	<title>Projekt - strona główna</title>
	<link rel="stylesheet" href="style.css" />
    <script src="script.js"></script>
</head>

<body>
	<input type="submit" value="Baza danych" name="bdlog" onclick=window.location.href='#'; />
	<input type="button" value="Formularze" name="formul" onclick=window.location.href='wybor_formularza.php'; />
	<div name="wyloguj">
		<b>
			<a href="logout.php">Wyloguj się!</a>
		</b>
	</div>
	<br>
	<br>
	
<?php //wyświetlanie danych

	echo "<center><p name='powitanie'>Witaj <b>".$_SESSION['nazwa_uz'].'</b>! </p></center>'; //wylogowanie się
	
?>	

	<center>
		<div id="wiadomosc">
			<h1 name="powitanie">Witaj na stronie do zarządzania formularzami!</h1>
		</div>
	</center>

</body>
</html>