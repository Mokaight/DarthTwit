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
                //Pour les test
    $_SESSION['ID'] = 2;
    $_SESSION['login'] = "Bernard";        
                // Affichage de l'annonce //////////////////////////////////////////	    
    if(isset($_SESSION['IDPageCourante'])){
	     $demande = "E";
	     $requeteProfil = $bdd->prepare("DELETE FROM suivre WHERE idDemandeur = :moi AND idReceveur = :idCourant");
		   $requeteProfil->bindParam(':moi', $_SESSION['ID'],PDO::PARAM_INT);
		   $requeteProfil->bindParam(':idCourant', $_SESSION['IDPageCourante'],PDO::PARAM_INT);
		   $requeteProfil->execute();
        //ON DOIT GERER LES DEUX CA SI A -> B alors dans notre table , B n'impliQue pas forcement A , on gere donc les deux cas              
      if($requeteProfil->rowCount() == 0){
         $requeteSuppression = $bdd->prepare("DELETE FROM suivre WHERE idDemandeur = :idCourant AND idReceveur = :moi");
         $requeteSuppression->bindParam(':moi', $_SESSION['ID'],PDO::PARAM_INT);
         $requeteSuppression->bindParam(':idCourant', $_SESSION['IDPageCourante'],PDO::PARAM_INT);
         $requeteSuppression->execute();  
      }
    }
    //test Bernard
    else{
                  $_SESSION['IDPageCourante'] = 2;
                         $demande = "E";
                         $requeteProfil = $bdd->prepare("DELETE FROM suivre WHERE idDemandeur = :moi AND idReceveur = :idCourant");
                         $requeteProfil->bindParam(':moi', $_SESSION['ID'],PDO::PARAM_INT);
                         $requeteProfil->bindParam(':idCourant', $_SESSION['IDPageCourante'],PDO::PARAM_INT);
                         $requeteProfil->execute();
                          //ON DOIT GERER LES DEUX CA SI A -> B alors dans notre table , B n'impliQue pas forcement A , on gere donc les deux cas              
                        if($requeteProfil->rowCount() == 0){
                           $requeteSuppression = $bdd->prepare("DELETE FROM suivre WHERE idDemandeur = :idCourant AND idReceveur = :moi");
                           $requeteSuppression->bindParam(':moi', $_SESSION['ID'],PDO::PARAM_INT);
                           $requeteSuppression->bindParam(':idCourant', $_SESSION['IDPageCourante'],PDO::PARAM_INT);
                           $requeteSuppression->execute();  
                        }
    }
?>
