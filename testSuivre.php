<?php

			// $sqlSelectLastTioutPub="SELECT * FROM touitespublics WHERE idAuteur = :id ORDER BY DESC ";
			// $reqSelectLastTioutPub=$bdd->prepare($sqlSelectLastTioutPub);
			// $requete->bindParam(':id', $_SESSION['PageCourante'], PDO::PARAM_STR,20);
	   		// $requete->execute();
	   		// $i=0;
			// while($data = $reqSelectLastTioutPub->fetch(PDO::FETCH_ASSOC) && $i<10 ){
				// echo '<div class="milieu box-tweet"><p> '.$data->.'</p> </div>'; //A CONTINUER ET VOIR SI JOIN OU PLUSIEUR REQUETE ??
				// $i++; 
			// }
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
				$lolilol = 1;
        // Affichage de l'annonce //////////////////////////////////////////
       $requeteProfil = $bdd->prepare("	SELECT pseudonyme, statut from touitos
			INNER JOIN(
			SELECT distinct Suivre.idReceveur as AMIS
			from suivre
			INNER JOIN (SELECT distinct * from suivre) as S
				on Suivre.Demande='V'
				and Suivre.Demande = S.demande
				and :nous = S.idreceveur
				and suivre.idreceveur = :nous) as Q
			on touitos.id  = Q.AMIS  ");
	   $requeteProfil->bindParam(':nous', $lolilol,PDO::PARAM_INT);	   
	   $requeteProfil->execute();
	   while($resultat = $requeteProfil->fetch(PDO::FETCH_OBJ)) 
	   {
		echo "<p>".$resultat->pseudonyme."<br /> dit :".$resultat->statut."</p>";
	   }
	   
 ?>
