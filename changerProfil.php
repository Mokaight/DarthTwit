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
                //Test
		          $_SESSION['ID'] = 2;
		//Pu test
		$passecoder = md5($_POST["mdp"]);
        // Affichage de l'annonce //////////////////////////////////////////
                $requeteProfil = $bdd->prepare("UPDATE Touitos SET pseudonyme = :newPseudo , email = :newEmail , motPasse = :newMdp WHERE id = :ID ");
	   $requeteProfil->bindParam(":newPseudo", htmlentities($_POST["pseudo"]),PDO::PARAM_STR, 25);
	   $requeteProfil->bindParam(":newEmail", $_POST["email"],PDO::PARAM_STR,50);
	   $requeteProfil->bindParam(":newMdp", $passecoder,PDO::PARAM_STR,32);
	   $requeteProfil->bindParam(":ID", $_SESSION['ID'],PDO::PARAM_INT);
	   $requeteProfil->execute();
	        //test
	        $_SESSION['login'] = $_POST["pseudo"];

         
		
		
?>
