<?php

	session_start();
	
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Projekt - login</title>
	<link rel="stylesheet" href="style.css" />
    <script src="script.js"></script>
</head>

<body>
	
    <form action="zaloguj.php" method="post">
     
        Login: <br /> <input type="text" name="login" /> <br />
        Hasło: <br /> <input type="password" name="haslo" /> <br /><br />
        <input type="submit" value="Zaloguj się" />
     
    </form>
	
<?php
	if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
?>

	<br>
	<br>
	<a href="index.php">Strona główna</a>
	
</body>
</html>