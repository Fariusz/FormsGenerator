<?php

	session_start();
	
	if (!isset($_SESSION['udanyzapis'])) //jeżeli nie jesteś zalogowany to przeniesie cię na stronę główną
	{
		header('Location: index.php'); //przekierowanie do index.php
		exit(); //zatrzymanie wykonywania dalszego kodu jeżeli to co wyżej jest prawdziwe
	}
	else
	{
		unset($_SESSION['udanyzapis']);
	}
	
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Projekt - dwa</title>
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
	
	Gratulacje udało ci się stworzyć własną ankietę!!!

	Teraz możesz powrócić do strony wyboru formularzy
	
	<a href="wybor_formularza.php">Powrót do wyboru formularza</a>

<?php //wyświetlanie danych

	echo "<b>Tytuł</b>: ".$_SESSION['tytul_formularza'];
	
?>

</body>
</html>