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
	       $requeteProfil = $bdd->prepare("INSERT INTO touites values(NULL, CURDATE() , :message )");
		   $requeteProfil->bindParam(':message', $_GET['message'],PDO::PARAM_STR, 500);
		   $requeteProfil->execute();
	   	   $lastID = $bdd->lastInsertID("touites");
		   $requeteAffiche = $bdd->prepare("INSERT INTO touitespublics values ( :idMsg , :idAuteur )");
		   $requeteAffiche->bindParam(':idMsg', $lastID,PDO::PARAM_INT);
		   $requeteAffiche->bindParam(':idAuteur', $_SESSION['ID'],PDO::PARAM_INT);
		   $requeteAffiche->execute();


?>
