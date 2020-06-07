<?php

	session_start(); //uruchomienie sesji
	
	session_unset(); //zatrzymanie sesji
	
	header('Location: index.php'); //przekierowanie do index.php

?>