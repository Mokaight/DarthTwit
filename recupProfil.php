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
    $_SESSION['ID'] = 2;
    $_SESSION['login'] = "Bernard";
        // Affichage de l'annonce //////////////////////////////////////////
     $requeteProfil = $bdd->prepare("SELECT * from touitos where pseudonyme = :pseudo AND ID = :ID   ");
	   $requeteProfil->bindParam(':pseudo', $_SESSION['login'],PDO::PARAM_STR, 25);
	   $requeteProfil->bindParam(':ID', $_SESSION['ID'],PDO::PARAM_INT);
	   
	   $requeteProfil->execute();
	   while($resultat = $requeteProfil->fetch(PDO::FETCH_OBJ)) 
	   {
		echo "<p> Ton pseudo est : " . $resultat->pseudonyme . "<br/> Ton email est :  " . $resultat->email ."<br /> Ton statut : " .$resultat->statut ."</p>" ; 
	   }




?>
