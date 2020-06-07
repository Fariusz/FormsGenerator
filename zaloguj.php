<?php

	session_start(); //start sesji
	
	if ((!isset($_POST['login'])) || (!isset($_POST['haslo']))) //jeżeli się nie zalogowano to następuje przekierowanie do index.php
	{
		header('Location: index.php'); //przekierowanie do index.php
		exit(); //przekierowanie wykonywania dalszego kodu
	}

	require_once "connect.php"; //wklejenie zawartości pliku connect.php to to miejsce + słowo _once sprawdza czy plik nie został 
								//już wcześniej użyty w kodzie programu a funckji require wymaga pliku w kodzie czy jeżeli brak 
								//pliku dalsza czść kodu się nie wykona

	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name); //zmienna + zebranie zmiennych w jednym miejscu
	
	if ($polaczenie->connect_errno!=0) //jeżeli nie udało się połaczyć pokaże się błąd
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{
		$login = $_POST['login'];
		$haslo = $_POST['haslo'];
		
		$login = htmlentities($login, ENT_QUOTES, "UTF-8"); //metoda ENT_QUOTES sprawia że zabezpieczyliśmy się przed wstrzyknięciem SQLa do zapytania
		$haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8"); //czyli ciężej będzie teraz włamać się do naszej bazy danych
	
		if ($rezultat = @$polaczenie->query(
		sprintf("SELECT * FROM użytkownik WHERE login='%s' AND hasło='%s'",
		mysqli_real_escape_string($polaczenie,$login),
		mysqli_real_escape_string($polaczenie,$haslo))))
		{
			$ilu_userow = $rezultat->num_rows;
			if($ilu_userow>0)
			{
				$_SESSION['zalogowany'] = true; //ustawiliśmy sobie tu flage
				
				$wiersz = $rezultat->fetch_assoc();
				$_SESSION['id'] = $wiersz['id_u'];
				$_SESSION['nazwa_uz'] = $wiersz['nazwa_użytkownika'];
				$_SESSION['login'] = $wiersz['login'];
				$_SESSION['haslo'] = $wiersz['hasło'];

				unset($_SESSION['blad']);
				$rezultat->free_result();
				header('Location: strona_glowna.php');
				
			} else {
				
				$_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
				header('Location: index.php');
				
			}
			
		}
		
		$polaczenie->close(); //zamknięcie połączenia
	}
	
?>