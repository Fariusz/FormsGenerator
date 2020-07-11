<?php
	
	session_start(); //start sesji
	
	$_SESSION['tytul_formularza'];
	
	if($zmienna=$_POST['zmienna']==1)
	{		
		$tytul_formularza = $_POST['tytul_formularz'];

		$tytul_formularza = htmlentities($tytul_formularza, ENT_QUOTES, "UTF-8");

		echo $tytul_formularza;

		$_SESSION['tytul_formularza'] = $tytul_formularza;
		header('Location: pytania.php');
	}
	else if($zmienna=$_POST['zmienna']==2)
	{		
		$wszystko_OK=true;
		
		$pyt1 = $_POST['pyt1'];
		$pyt2 = $_POST['pyt2'];
		$pyt3 = $_POST['pyt3'];

		$pyt1 = htmlentities($pyt1, ENT_QUOTES, "UTF-8");
		$pyt2 = htmlentities($pyt2, ENT_QUOTES, "UTF-8");
		$pyt3 = htmlentities($pyt3, ENT_QUOTES, "UTF-8");
		
		echo $pyt1;
		echo $pyt2;
		echo $pyt3;
		echo $_SESSION['tytul_formularza'];
		echo "<br><br>";
		
		if($pyt1==NULL || $pyt2==NULL || $pyt3==NULL )
		{
			$wszystko_OK=false;
			echo '<span style="color:red;">Błąd serwera! Wszystkie pola muszą być wypełnone!</span>'; 
		}

		//zapamiętanie zmiennych
		$_SESSION['pyt1'] = $pyt1;
		$_SESSION['pyt2'] = $pyt2;
		$_SESSION['pyt3'] = $pyt3;
		
		require_once "connect.php"; //podpięcie|wstrzyknięcie zawartośći pliku
		mysqli_report(MYSQLI_REPORT_STRICT); //to sprawia że na stronie internetowej nie pojawiają się "Warning!" tylko od teraz wszystkie wyjątki
											//będziemy obsługiwać za pomocą wyjątków
		
		try 
		{
			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			
			if ($polaczenie->connect_errno!=0)//jeżeli nie udało się połączyć za bazą danych
			{
				throw new Exception(mysqli_connect_errno()); //rzuć nowym wujątkiem które przychwytuje pole catch w zmiennej .$e
															//mysqli_connect_errno() zgłasza dokładny komunikat błedu
			}
			else
			{				
				//Czy podana nazwa formularza już istnieje? //jeżeli istnieje zwraca 1 lub 0
				$rezultat = $polaczenie->query("SELECT Id_a FROM ankieta WHERE nazwa='".$_SESSION['tytul_formularza']."'");
				//$rezultat = $polaczenie->query("SELECT count(Id_a) FROM ankieta WHERE nazwa='$_SESSION['tytul_formularza']'");
				
				if (!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_nazw = $rezultat->num_rows; //sprawdzamy ile takich już istnieje
				if($ile_takich_nazw>0)
				{
					$wszystko_OK=false;
					echo 'Istnieje już taka ankieta!';
				}	
								
				if ($wszystko_OK==true)
				{
					$p_tytul = false;
					$p_pierwsze = false;
					$p_drugie = false;
					$p_trzecie = false;
					
					if($polaczenie->query("INSERT INTO ankieta VALUES (NULL, '".$_SESSION['tytul_formularza']."', '2000-01-01 00:00:00', '2050-01-01 00:00:00','".$_SESSION['id']."')"))
					{
						$p_tytul=true;
					}
					else
					{
						throw new Exception($polaczenie->error);
					}
					
					if($p_tytul==true)
					{
						$ID_ankiety = $polaczenie->query("SELECT Id_a FROM ankieta WHERE nazwa='".$_SESSION['tytul_formularza']."'");
						
						$wiersz = $ID_ankiety->fetch_assoc();
						$_SESSION['id_ankiety'] = $wiersz['Id_a'];
						$ID_ankiety->free_result();
						
						if ($polaczenie->query("INSERT INTO pytanie VALUES (NULL, '".$_SESSION['id_ankiety']."', '".$_SESSION['pyt1']."')"))
						{
							$p_pierwsze = true;
						}
						else
						{
							throw new Exception($polaczenie->error);
						}
						
						if ($polaczenie->query("INSERT INTO pytanie VALUES (NULL, '".$_SESSION['id_ankiety']."', '".$_SESSION['pyt2']."')"))
						{
							$p_drugie = true;
						}
						else
						{
							throw new Exception($polaczenie->error);
						}
						
						if ($polaczenie->query("INSERT INTO pytanie VALUES (NULL, '".$_SESSION['id_ankiety']."', '".$_SESSION['pyt3']."')"))
						{
							$p_trzecie = true;
						}
						else
						{
							throw new Exception($polaczenie->error);
						}
						
						if($p_tytul==true && $p_pierwsze==true && $p_drugie==true && $p_trzecie==true)
						{
							$_SESSION['udanyzapis']=true;
							header('Location: dwa.php');
						}
					}
				}
				
				$polaczenie->close();
			}
			
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
			echo '<br />Informacja developerska: '.$e;
		}
	}
	else if($zmienna=$_POST['zmienna']==3)
	{		
		$wszystko_OK=true;
	
		$odp1 = $_POST['odp1'];
		$odp2 = $_POST['odp2'];
		$odp3 = $_POST['odp3'];

		$odp1 = htmlentities($odp1, ENT_QUOTES, "UTF-8");
		$odp2 = htmlentities($odp2, ENT_QUOTES, "UTF-8");
		$odp3 = htmlentities($odp3, ENT_QUOTES, "UTF-8");
		
		echo $odp1;
		echo $odp2;
		echo $odp3;
		echo $_SESSION['tytul_formularza'];
		echo "<br><br>";
		
		if($odp1==NULL || $odp2==NULL || $odp3==NULL )
		{
			$wszystko_OK=false;
			echo '<span style="color:red;">Błąd serwera! Wszystkie pola muszą być wypełnone!</span>'; 
		}

		//zapamiętanie zmiennych
		$_SESSION['odp1'] = $odp1;
		$_SESSION['odp2'] = $odp2;
		$_SESSION['odp3'] = $odp3;
		
		require_once "connect.php"; //podpięcie|wstrzyknięcie zawartośći pliku
		mysqli_report(MYSQLI_REPORT_STRICT); //to sprawia że na stronie internetowej nie pojawiają się "Warning!" tylko od teraz wszystkie wyjątki
		
		try 
		{
			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			
			if ($polaczenie->connect_errno!=0)//jeżeli nie udało się połączyć za bazą danych
			{
				throw new Exception(mysqli_connect_errno()); //rzuć nowym wujątkiem które przychwytuje pole catch w zmiennej .$e
															//mysqli_connect_errno() zgłasza dokładny komunikat błedu
			}
			else
			{				
				//Czy podana nazwa formularza już istnieje? //jeżeli istnieje zwraca 1 lub 0
				$rezultat = $polaczenie->query("SELECT Id_p FROM pytanie WHERE Treść_pytania='".$_SESSION['pyt1']."'");
				
				$ID_pytania = $polaczenie->query("SELECT Id_p FROM pytanie WHERE Treść_pytania='".$_SESSION['pyt1']."'");
						
				$wiersz = $ID_pytania->fetch_assoc();
				$_SESSION['id_pytania'] = $wiersz['Id_p'];
				$ID_pytania->free_result();
				
				$rezultat = $polaczenie->query("SELECT Id_p FROM pytanie WHERE Treść_pytania='".$_SESSION['pyt2']."'");
				
				$ID_pytania1 = $polaczenie->query("SELECT Id_p FROM pytanie WHERE Treść_pytania='".$_SESSION['pyt2']."'");
						
				$wiersz1 = $ID_pytania1->fetch_assoc();
				$_SESSION['id_pytania1'] = $wiersz1['Id_p'];
				$ID_pytania1->free_result();
				
				$rezultat = $polaczenie->query("SELECT Id_p FROM pytanie WHERE Treść_pytania='".$_SESSION['pyt3']."'");
				
				$ID_pytania2 = $polaczenie->query("SELECT Id_p FROM pytanie WHERE Treść_pytania='".$_SESSION['pyt3']."'");
						
				$wiersz2 = $ID_pytania2->fetch_assoc();
				$_SESSION['id_pytania2'] = $wiersz2['Id_p'];
				$ID_pytania2->free_result();
				
				if (!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_nazw = $rezultat->num_rows; //sprawdzamy ile takich już istnieje
				if($ile_takich_nazw==0)
				{
					$wszystko_OK=true;
					echo 'Istnieje już takie pytanie!';
				}	
								
				if ($wszystko_OK==true)
				{
					$p_pierwsze = false;
					$p_drugie = false;
					$p_trzecie = false;
					
						
					if($polaczenie->query("INSERT INTO odpowiedź VALUES ('".$_SESSION['id_pytania']."', '".$_SESSION['odp1']."', '00:00:00', '".$_SESSION['id']."')"))
					{
						$p_pierwsze = true;
					}
					else
					{
						throw new Exception($polaczenie->error);
					}
					
					if($polaczenie->query("INSERT INTO odpowiedź VALUES ('".$_SESSION['id_pytania1']."', '".$_SESSION['odp2']."', '00:00:00', '".$_SESSION['id']."')"))
					{
						$p_drugie = true;
					}
					else
					{
						throw new Exception($polaczenie->error);
					}
					
					if($polaczenie->query("INSERT INTO odpowiedź VALUES ('".$_SESSION['id_pytania2']."', '".$_SESSION['odp3']."', '00:00:00', '".$_SESSION['id']."')"))
					{
						$p_trzecie = true;
					}
					else
					{
						throw new Exception($polaczenie->error);
					}
					
					if($p_pierwsze==true && $p_drugie==true && $p_trzecie==true)
					{
						$_SESSION['udanyzapis']=true;
						header('Location: trzy.php');
					}
				}
				
				$polaczenie->close();
			}
			
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
			echo '<br />Informacja developerska: '.$e;
		}
	}
	
?>