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
	//Juste pour les test
	$_SESSION['ID'] = 2;
        // Affichage de l'annonce //////////////////////////////////////////
       $requeteProfil = $bdd->prepare("	SELECT pseudonyme from touitos
       									INNER JOIN(SELECT idDemandeur from suivre WHERE demande = \"E\" AND idReceveur = :nous) as Q
       									on Q.idDemandeur = touitos.id
                                        ");
	   $requeteProfil->bindParam(':nous', $_SESSION['ID'],PDO::PARAM_INT);	   
	   $requeteProfil->execute();
	   while($resultat = $requeteProfil->fetch(PDO::FETCH_OBJ)) 
	   {
		echo "<div class=\"box-tweet\" > 
		        <span class=\"Nom\">".$resultat->pseudonyme."</span>
		       <p class= \"statut\">vous demande en ami</p>  
		        <div class=\"ReponseDemande\">
		                <input  class=\"AccepterDemande\" type=\"submit\"  value=\"Accepter\"/>
		                <input  class=\"RefuserDemande\" type=\"submit\"  value=\"Refuser\"/>
		        </div>
		     </div>";
	   }
	   
 ?>
