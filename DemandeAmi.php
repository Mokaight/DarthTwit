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
    if(isset($_SESSION['IDPageCourante'])){
    $_SESSION['ID'] = 2;
    $_SESSION['login'] = "Bernard";      
                // Affichage de l'annonce //////////////////////////////////////////	     
	           $demande = "E";
	           $requeteProfil = $bdd->prepare("INSERT INTO suivre values(:moi, :idCourant,'E')");
		         $requeteProfil->bindParam(':moi', $_SESSION['ID'],PDO::PARAM_INT);
		         $requeteProfil->bindParam(':idCourant', $_SESSION['IDPageCourante'],PDO::PARAM_INT);
		         $requeteProfil->execute();                           
    }
?>
