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
	<title>Projekt - edycja_tabela</title>
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
	
	ankieta<br>
	<table border = 1; style="border-collapse: collapse">
	<tr>
	<th>Id ankiety</th>
	<th>nazwa</th>
	<th>data_r</th>
	<th>data_k</th>
	<th>akcje</th>
	</tr>
	
	<?php
	
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
				//echo '<form action="edycja_tabela.php" method="POST">';
				while($wiersz = mysqli_fetch_array($rezultat))
				{
					echo '
						<tr>
							<td>'.$wiersz["Id_a"].'</td>
							<td>'.$wiersz["nazwa"].'</td>
							<td>'.$wiersz["data_r"].'</td>
							<td>'.$wiersz["data_k"].'</td>
							<td><a href="edit.php?edit='.$wiersz["Id_a"].'">edit</td>
						</tr> 
					';
					
					if(isset($_POST["zmien"]))
					{
						echo '<input type="text" name="zmienna" value="'.$wiersz["Id_a"].'" />';
						//header('Location: edit.php');
					}
				}
				//echo "</form>";
				echo "</table>";
			}
			else
			{
				echo "0 wyników";
			}
		}
		$polaczenie->close();
	
	?>
	
	<!--<?php //wyświetlanie danych
		/*
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
				echo '<form action="edycja_tabela.php" method="POST">';
				while($wiersz = mysqli_fetch_array($rezultat))
				{
					echo '
						<tr>
							<td>'.$wiersz["Id_a"].'</td>
							<td><input name="$nazwa" value='.$wiersz["nazwa"].'></td>
							<td><input name="$data_r" value='.$wiersz["data_r"].'></td>
							<td><input name="$data_k" value='.$wiersz["data_k"].'></td>
							<td><input type="submit" name="zmien" value="Edycja" ></td>
						</tr> 
					';
					
					
				}
				
				if(isset($_POST["zmien"]))
					{
						//echo "jesteś tu";
						/*
						$new_nazwa = $_POST['$nazwa'];
						$new_data_r = $_POST['$data_r'];
						$new_data_k = $_POST['$data_k'];
						$polaczenie->query("UPDATE ankieta SET nazwa='$new_nazwa' WHERE Id_a='".$wiersz['Id_a']."'");
						
						//header("Refresh:10");
					}
				echo "</form>";
				echo "</table>";
			}
			else
			{
				echo "0 wyników";
			}
		}
		$polaczenie->close();
		*/
	?>-->
	</table>
	
	<p> The download will begin in <span id="countdowntimer">10 </span> Seconds</p>

<script type="text/javascript">
    var timeleft = 10;
    var downloadTimer = setInterval(function(){
    timeleft--;
    document.getElementById("countdowntimer").textContent = timeleft;
    if(timeleft <= 0)
        clearInterval(downloadTimer);
    },1000);
</script>
	
</body>
</html>