<?php
 
    session_start();
     
    if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true)) //jeżeli jestemśmy zalogowanie to nastąpi przekierowanie do strony strona_glowna.php
    {
        header('Location: strona_glowna.php'); //przekierowanie
        exit(); //zatrzymanie wykonywania dalszej części kodu jeżeli warunek jest prawdziwy
    }
 
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <title>Projekt</title>
    <link rel="stylesheet" href="style.css" />
    <script src="script.js"></script>
</head>
 
<body>
    <input type="button" value="Login" name="logowanie" onclick=window.location.href='login.php'; /> <!--przekierowanie do nowego okna -->
	<center>
		<div id="wiadomosc">
			<h1 name="powitanie">Witaj na stronie do zarządzania formularzami!</h1>
			<br>
			<h3 name="tresc">Proszę się zalogować</h3>
		</div>
	</center>
	
	<footer>
		wersja strony: 1.0.3
	</footer>
</body>
</html>