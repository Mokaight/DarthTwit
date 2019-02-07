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
	       $requeteProfil = $bdd->prepare("UPDATE touitos SET statut = :newStatut WHERE id = :ID  ");
		   $requeteProfil->bindParam(':newStatut', $_GET['message'],PDO::PARAM_STR, 500);
		   $requeteProfil->bindParam(':ID', $_SESSION['ID'],PDO::PARAM_INT);
		   
		   $requeteProfil->execute();




?>
