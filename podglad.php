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
	<title>Dane formularzu</title>
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
			<h1 name="powitanie">Podgląd danych zamieszczonych w formularzu</h1>
		</div>
	</center>
	
<?php //wyświetlanie danych

	echo "<center> <b>Tytuł formularza</b>: ".$_SESSION['tytul_formularza'].'</center><br /><br />';
	echo "<center> <b>Treść pytania pierwszego</b>: ".$_SESSION['pyt1']. '</center><br />';
	echo "<center> <b>Udzielona odpowiedź</b>: ".$_SESSION['odp1']. '</center><br /><br />';
	echo "<center> <b>Treść pytania drugiego</b>: ".$_SESSION['pyt2']. '</center><br />';
	echo "<center> <b>Udzielona odpowiedź</b>: ".$_SESSION['odp2']. '</center><br /><br />';
	echo "<center> <b>Treść pytania trzeciego</b>: ".$_SESSION['pyt3']. '</center><br />';
	echo "<center> <b>Udzielona odpowiedź</b>: ".$_SESSION['odp3']. '</center><br />';
?>

</body>
</html>