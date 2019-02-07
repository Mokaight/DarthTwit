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
        //Devra etre faite avec la page courante
        if(isset($_SESSION['IDPageCourante'])){
        $requetePseudo = $bdd->prepare("SELECT pseudonyme from touitos WHERE id = :id");
        $requeteAmis = $bdd->prepare("SELECT * from touites INNER JOIN((
                                      Select * from touitespublics INNER JOIN(
                                      SELECT idDemandeur FROM `suivre` WHERE idReceveur = :Page AND demande = \"V\"
                                      UNION
                                      SELECT idReceveur FROM suivre WHERE idDemandeur = :Page AND demande = \"V\")AS P
                                      ON touitespublics.idAuteur = P.idDemandeur)AS R)
                                      ON touites.idMsg = R.idMsg
                                      AND touites.idMsg > :IdLastMsg
                                      ORDER BY touites.idMsg DESC LIMIT 0,10 ");
       $requeteAmis->bindParam(':Page', $_SESSION['IDPageCourante'],PDO::PARAM_INT);
       $requeteAmis->bindParam(':IdLastMsg', $_POST['IdLastMsg'],PDO::PARAM_INT);
       $requeteAmis->execute();
       while($resultatTP = $requeteAmis->fetch(PDO::FETCH_OBJ)) 
        {
          $requetePseudo->bindParam(':id', $resultatTP->idAuteur,PDO::PARAM_INT);
          $requetePseudo->execute();
          while($resultat = $requetePseudo->fetch(PDO::FETCH_OBJ)){
	        echo "<div  id = \"".$resultatTP->idMsg."\"class=\"box-tweet ListTouitesAmis\" > <span id =\"Nom\">".$resultat->pseudonyme.
                   " dit :  </span> <br /> <div  id =\"MessageTouite\" class=\"box-tweet statut\">".$resultatTP->texte."</div> <br />"."<span id=\"DateMessage\"> ".$resultatTP->laDate."</span> </div>";
          }
        }
      }
      
?>
