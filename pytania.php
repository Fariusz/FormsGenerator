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
	<title>Projekt - pytania</title>
	<link rel="stylesheet" href="style.css" />
    <script src="script.js"></script>
</head>

<body>
	<a href="formularz.php" >
		<img border="0" alt="Cofnij" title="Cofnij do podawania nazwy formularza" src="grafika/cofnij.png" width="50" height="50" name="powrot">
	</a>
	
	<div name="wyloguj">
		<b>
			<a href="logout.php">Wyloguj się!</a>
		</b>
	</div>
	<br>
	<br>
	
	<center>
		<img src="grafika/znak-zapytania.png" alt="?" width="50" height="50" title="Wypełnij teraz poniższe pola" />
	</center>
	
	<form action="przechowywanie_zmiennych.php" method="post">
	
		<div name="odsuniecie">
			<input type="hidden" name="zmienna" value="2" />
			<b>Pytanie pierwsze:</b><img src="grafika/znak-zapytania.png" alt="?" width="25" height="20" title="Pytanie tekstowe" /> 
			<br> <input type="text" name="pyt1" />
			<br><br>
			<b>Pytanie drugie:</b><img src="grafika/znak-zapytania.png" alt="?" width="25" height="20" title="Pytanie tekstowe" /> 
			<br> <input type="text" name="pyt2" />
			<br><br>
			<b>Pytanie trzecie:</b><img src="grafika/znak-zapytania.png" alt="?" width="25" height="20" title="Pytanie wyboru" /> 
			<br> <input type="text" name="pyt3" />
			<br><br>
			<input type="submit" value="Wyślij" title="Naciśnięcie tego guzika spowoduje potwierdzenie wysłania formularza"/>
		</div>
		
	</form>

<?php //wyświetlanie danych

	echo "<b>Tytuł</b>: ".$_SESSION['tytul_formularza']
	
?>

</body>
</html>