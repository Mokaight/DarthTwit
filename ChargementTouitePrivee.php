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
    $requeteNOM = $bdd->prepare("SELECT id from touitos where pseudonyme = :pseudo ");
    $requeteNOM->bindParam(':pseudo', $_POST['contact'],PDO::PARAM_STR,20);
    $requeteNOM->execute();
    while($resultatNOM = $requeteNOM->fetch(PDO::FETCH_OBJ)) 
    {    

        $requeteTouitPriv = $bdd->prepare("
                 SELECT * FROM touites 
                 INNER JOIN(select * FROM touitesprives 
                              WHERE ( (((idAuteur = :IDcontact) AND (idReceveur = :IDnous))
                              OR ((idAuteur = :IDnous) AND (idReceveur = :IDcontact)) )) AND (idMsg > :IDLMsg) ) as TP
                 ON touites.idMsg = TP.idMsgSource ORDER BY touites.idMsg ASC LIMIT 0,10"

                 );
       $requete = $bdd->prepare("SELECT pseudonyme from touitos where id = :id ");

       $requeteTouitPriv->bindParam(':IDcontact', $resultatNOM->id,PDO::PARAM_INT);
       $requeteTouitPriv->bindParam(':IDnous', $_SESSION['ID'],PDO::PARAM_INT);
       $requeteTouitPriv->bindParam(':IDLMsg', $_POST['IdLastMsg'],PDO::PARAM_INT);
       $requeteTouitPriv->execute();
           while($resultatTP = $requeteTouitPriv->fetch(PDO::FETCH_OBJ)) 
        {

           $requete->bindParam(':id', $resultatTP->idAuteur,PDO::PARAM_INT);
           $requete->execute();
                  while($resultat = $requete->fetch(PDO::FETCH_OBJ)) 
                  {
                      echo "<div  id = \"".$resultatTP->idMsg."\"class=\"box-tweet ListTouitesPrive\" > <span id =\"Nom\">".$resultat->pseudonyme.
                   " dit :  </span> <br /> <div  id =\"MessageTouite\" class=\"box-tweet statut\">".$resultatTP->texte."</div> <br />"."<span id=\"DateMessage\"> ".$resultatTP->laDate."</span> </div>";
                  }
        }
    }
?>
