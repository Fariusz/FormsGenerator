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
	<title>Projekt - baza_danych</title>
	<link rel="stylesheet" href="style.css" />
    <script src="script.js"></script>
	
</head>

<body>
	<a href="strona_glowna.php" >
		<img border="0" alt="Cofnij" title="Cofnij do podawania nazwy formularza" src="grafika/cofnij.png" width="50" height="50" name="powrot">
	</a>
	
	<div name="wyloguj">
		<b>
			<a href="logout.php">Wyloguj się!</a>
		</b>
	</div>
	<br>
	<br>
	
	Użytkownik<br>
	<table border = 1; style="border-collapse: collapse">
	<tr>
	<th>Id</th>
	<th>Nazwa Użytkownika</th>
	<th>Login</th>
	</tr>
	<?php //wyświetlanie danych
		
		require_once "connect.php";
		$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
		if ($polaczenie->connect_errno!=0)//jeżeli nie udało się połączyć za bazą danych
		{
			throw new Exception(mysqli_connect_errno()); //rzuć nowym wujątkiem które przychwytuje pole catch w zmiennej .$e
														//mysqli_connect_errno() zgłasza dokładny komunikat błedu
		}
		else
		{
			$rezultat = $polaczenie->query("SELECT id_u, nazwa_użytkownika, login FROM użytkownik");
			
			if (!$rezultat) throw new Exception($polaczenie->error);
			
			$ilu_userow = $rezultat->num_rows;
			if($ilu_userow>0)
			{
				while($wiersz = mysqli_fetch_array($rezultat))
				{
					echo '
						<tr>
							<td>'.$wiersz["id_u"].'</td>
							<td>'.$wiersz["nazwa_użytkownika"].'</td>
							<td>'.$wiersz["login"].'</td>
						</tr> 
					';
				}
				echo "</table>";
			}
			else
			{
				echo "0 wyników";
			}
		}
		$polaczenie->close();
		
	?>
	</table>
	
	<br>
	
	pytanie<br>
	<table border = 1; style="border-collapse: collapse">
	<tr>
	<th>Id pytania</th>
	<th>Id ankiety</th>
	<th>Treść pytania</th>
	</tr>
	<?php //wyświetlanie danych
		
		require_once "connect.php";
		$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
		if ($polaczenie->connect_errno!=0)//jeżeli nie udało się połączyć za bazą danych
		{
			throw new Exception(mysqli_connect_errno()); //rzuć nowym wujątkiem które przychwytuje pole catch w zmiennej .$e
														//mysqli_connect_errno() zgłasza dokładny komunikat błedu
		}
		else
		{
			$rezultat = $polaczenie->query("SELECT Id_p, Id_a, Treść_pytania FROM pytanie");
			
			if (!$rezultat) throw new Exception($polaczenie->error);
			
			$ilu_userow = $rezultat->num_rows;
			if($ilu_userow>0)
			{
				while($wiersz = mysqli_fetch_array($rezultat))
				{
					echo '
						<tr>
							<td>'.$wiersz["Id_a"].'</td>
							<td>'.$wiersz["Id_a"].'</td>
							<td>'.$wiersz["Treść_pytania"].'</td>
						</tr> 
					';
				}
				echo "</table>";
			}
			else
			{
				echo "0 wyników";
			}
		}
		$polaczenie->close();
		
	?>
	</table>
	
		<br>
	
	odpowiedzi<br>
	<table border = 1; style="border-collapse: collapse">
	<tr>
	<th>Id pytania</th>
	<th>Treść odpowiedzi</th>
	<th>Czas</th>
	<th>Id użytkownika</th>
	</tr>
	<?php //wyświetlanie danych
		
		require_once "connect.php";
		$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
		if ($polaczenie->connect_errno!=0)//jeżeli nie udało się połączyć za bazą danych
		{
			throw new Exception(mysqli_connect_errno()); //rzuć nowym wujątkiem które przychwytuje pole catch w zmiennej .$e
														//mysqli_connect_errno() zgłasza dokładny komunikat błedu
		}
		else
		{
			$rezultat = $polaczenie->query("SELECT Id_p, Treść_odpowiedzi, Czas, Id_u FROM odpowiedź");
			
			if (!$rezultat) throw new Exception($polaczenie->error);
			
			$ilu_userow = $rezultat->num_rows;
			if($ilu_userow>0)
			{
				while($wiersz = mysqli_fetch_array($rezultat))
				{
					echo '
						<tr>
							<td>'.$wiersz["Id_p"].'</td>
							<td>'.$wiersz["Treść_odpowiedzi"].'</td>
							<td>'.$wiersz["Czas"].'</td>
							<td>'.$wiersz["Id_u"].'</td>
						</tr> 
					';
				}
				echo "</table>";
			}
			else
			{
				echo "0 wyników";
			}
		}
		$polaczenie->close();
		
	?>
	</table>
	
		<br>
	
	ankieta<br>
	<table border = 1; style="border-collapse: collapse">
	<tr>
	<th>Id ankiety</th>
	<th>nazwa</th>
	<th>data_r</th>
	<th>data_k</th>
	<th>Id użytkownika</th>
	</tr>
	<?php //wyświetlanie danych
		
		require_once "connect.php";
		$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
		if ($polaczenie->connect_errno!=0)//jeżeli nie udało się połączyć za bazą danych
		{
			throw new Exception(mysqli_connect_errno()); //rzuć nowym wujątkiem które przychwytuje pole catch w zmiennej .$e
														//mysqli_connect_errno() zgłasza dokładny komunikat błedu
		}
		else
		{
			$rezultat = $polaczenie->query("SELECT Id_a, nazwa, data_r, data_k, id_u FROM ankieta");
			
			if (!$rezultat) throw new Exception($polaczenie->error);
			
			$ilu_userow = $rezultat->num_rows;
			if($ilu_userow>0)
			{
				while($wiersz = mysqli_fetch_array($rezultat))
				{
					echo '
						<tr>
							<td>'.$wiersz["Id_a"].'</td>
							<td>'.$wiersz["nazwa"].'</td>
							<td>'.$wiersz["data_r"].'</td>
							<td>'.$wiersz["data_k"].'</td>
							<td>'.$wiersz["id_u"].'</td>
						</tr> 
					';
				}
				echo "</table>";
			}
			else
			{
				echo "0 wyników";
			}
		}
		$polaczenie->close();
		
	?>
	</table>
	
</body>
</html>