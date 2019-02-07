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
        if(isset($_SESSION['ID'])){
			    $requete = $bdd->prepare("SELECT id from touitos where pseudonyme = :pseudo ");
          		$requete->bindParam(':pseudo', $_GET['nom'],PDO::PARAM_STR,20);
          		$requete->execute();
          		while($resultat = $requete->fetch(PDO::FETCH_OBJ)) 
				{
					if(isset($_GET['accepter']))
						   {
								$demande = "V";
						   }

		  			if(isset($_GET['refuser']))
						   {
						   		$demande = "R";
						   }
				    $requeteProfil = $bdd->prepare("UPDATE suivre SET demande =  :demande WHERE ( idDemandeur = :eux AND idReceveur = :nous ) ");
		            $requeteProfil->bindParam(':demande', $demande,PDO::PARAM_STR,7);
				    $requeteProfil->bindParam(':nous', $_SESSION['ID'],PDO::PARAM_INT);
				    $requeteProfil->bindParam(':eux', $resultat->id,PDO::PARAM_INT);   
				    $requeteProfil->execute();

				}

	   }
	   
 ?>
