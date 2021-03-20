<?php
try{
	$myPDO = new PDO('pgsql:host=localhost;port=5432;dbname=projet2', 'etu', 'A123456*');
}
catch(Exception $erreur)
{
	echo "Erreur de connxion avec la base de donnée </br> $erreur";
}
?>