<?php

session_start();
    //CONNEXION FAC
                  try {
                                  $bdd = new PDO("mysql:host=marseille;dbname=BDE11202152", "E11202152", "2505059912J");
                      }
                 catch(PDOException $e) {
                                 $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
                                 die($msg);
                                 }
#    //CONNEXION MAISON
#               try{
#            $bdd = new PDO('mysql:host=localhost;dbname=touiter;charset=utf8', 'root', '');
#          }
#          catch (Exception $e)
#          {
#            die('Erreur : ' . $e->getMessage());
#          }     
$_SESSION["connecter"] = true;
if(!isset($_SESSION["counter"]))
	if($_SESSION["connecter"] === true)
	{
	   $requete = $bdd->prepare("SELECT * from touitos 
									where pseudonyme = :pseudonyme");
		
	   $requete->bindParam(':pseudonyme', $_SESSION["login"], PDO::PARAM_STR,20);
	   $requete->execute();
	   while($resultat = $requete->fetch(PDO::FETCH_OBJ)) 
	   {
		echo "Votre Pseudonyme actuel est : ".$resultat->pseudonyme."<br/>".
			 "Votre email actuel est : ".$resultat->email."<br />";
	   }
	}
?>
