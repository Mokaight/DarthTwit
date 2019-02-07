<?php
try {
                $bdd = new PDO('mysql:host=localhost;dbname=touiter','root','');
    }
    catch(PDOException $e) {
                      $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
                      die($msg);
                }
        // Affichage de l'annonce //////////////////////////////////////////
       $requete = $bdd->prepare("SELECT * from touites order by idMsg DESC");
	   $requete->execute();
	   while($resultat = $requete->fetch(PDO::FETCH_OBJ)) 
	   {
		echo "ID = " . $resultat->idMsg . " Msg = " . $resultat->texte ."<br />" ; 
	   }
?>

