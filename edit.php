<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany'])) //jeżeli nie jesteś zalogowany to przeniesie cię na stronę główną
	{
		header('Location: index.php'); //przekierowanie do index.php
		exit(); //zatrzymanie wykonywania dalszego kodu jeżeli to co wyżej jest prawdziwe
	}
	
	require_once "connect.php";
	$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
		
	if ($polaczenie->connect_errno!=0)//jeżeli nie udało się połączyć za bazą danych
	{
		throw new Exception(mysqli_connect_errno()); //rzuć nowym wujątkiem które przychwytuje pole catch w zmiennej .$e
													//mysqli_connect_errno() zgłasza dokładny komunikat błedu
	}
	else
	{
		$rezultat = $polaczenie->query("SELECT Id_a, nazwa, data_r, data_k FROM ankieta WHERE id_u='".$_SESSION['id']."'");
		
		if (!$rezultat) throw new Exception($polaczenie->error);
		
		$ilu_userow = $rezultat->num_rows;
		if($ilu_userow>0)
		{
			if( isset($_GET['edit']))
			{
				$id = $_GET['edit'];
				//$rezultat = $polaczenie->query("SELECT Id_a, nazwa, data_r, data_k FROM ankieta WHERE id_u='$id'");
				$row= mysqli_fetch_array($rezultat);
			}
			
			if( isset($_POST['newName']) )
			{
				$newName = $_POST['newName'];
				$id  	 = $_POST['id'];
				$polaczenie->query("UPDATE ankieta SET nazwa='$newName' WHERE id_a='$id'");
				//$rezultat 	 = mysqli_query($polaczenie,$sql) or die("Could not update".mysql_error());
				echo "<meta http-equiv='refresh' content='0;url=edycja_tabela.php'>";
			}
		}
		else
		{
			echo "0 wyników";
		}
	}
	$polaczenie->close();
	
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Projekt - edit</title>
	<link rel="stylesheet" href="style.css" />
    <script src="script.js"></script>
</head>

<body>
	<form action="edit.php" method="POST">
	Name: <input type="text" name="newName" value="<?php echo $row[1]; ?>"><br />
	<input type="hidden" name="id" value="<?php echo $row[0]; ?>">
	<input type="submit" value=" Update "/>
	</form>
</body>
</html>