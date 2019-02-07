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
        // Affichage de l'annonce //////////////////////////////////////////
       $_SESSION['ID'] = 2;
       $requeteProfil = $bdd->prepare("	SELECT pseudonyme, statut from touitos
			INNER JOIN(
			SELECT distinct suivre.idDemandeur as AMIS
			from suivre
			INNER JOIN (SELECT distinct * from suivre) as S
				on suivre.Demande='V'
				and suivre.Demande = S.demande
				and :nous = S.idreceveur
				and suivre.idreceveur = :nous) as Q
			on touitos.id  = Q.AMIS  ");
	   $requeteProfil->bindParam(':nous', $_SESSION['ID'],PDO::PARAM_INT);	   
	   $requeteProfil->execute();
	   while($resultat = $requeteProfil->fetch(PDO::FETCH_OBJ)) 
	   {
		echo "<div class=\"lesSuiveurs\" > <span class =\"Nom\">".$resultat->pseudonyme."</span> <br /> <span class =\"statut\" > Statut :".$resultat->statut."</span><div class=\"submit\"><input  class=\"Divorcer\" type=\"submit\"  value=\"Divorcer\"/> </div></div>";
	   }
	   
 ?>
