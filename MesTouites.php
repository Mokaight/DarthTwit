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
//TEST
        $_SESSION['IDPageCourante'] = 2;    
      if(isset($_SESSION['IDPageCourante'])){
      $requeteNOM = $bdd->prepare("SELECT pseudonyme from touitos where id = :id ");
      $requeteNOM->bindParam(':id', $_SESSION['IDPageCourante'],PDO::PARAM_INT);
      $requeteNOM->execute();
      while($resultatNOM = $requeteNOM->fetch(PDO::FETCH_OBJ)) 
      {    

          $requeteTouitPriv = $bdd->prepare("
                   SELECT * FROM touites 
                   INNER JOIN(select * FROM touitespublics 
                                WHERE idAuteur = :IDnous) as TP
                   ON touites.idMsg = TP.idMsg 
                   AND touites.idMsg > :IdLastMsg
                   ORDER BY touites.idMsg DESC LIMIT 0,10"

                   );
         $requete = $bdd->prepare("SELECT pseudonyme from touitos where id = :id ");

         $requeteTouitPriv->bindParam(':IDnous', $_SESSION['IDPageCourante'],PDO::PARAM_INT);
         $requeteTouitPriv->bindParam(':IdLastMsg', $_POST['IdLastMsg'],PDO::PARAM_INT);
         $requeteTouitPriv->execute();
             while($resultatTP = $requeteTouitPriv->fetch(PDO::FETCH_OBJ)) 
          {

             $requete->bindParam(':id', $resultatTP->idAuteur,PDO::PARAM_INT);
             $requete->execute();
                    while($resultat = $requete->fetch(PDO::FETCH_OBJ)) 
                    {
                        echo "<div  id = \"".$resultatTP->idMsg."\"class=\"box-tweet ListTouites\" > <span id =\"Nom\">".$resultat->pseudonyme.
                     " dit :  </span> <br /> <div  id =\"MessageTouite\" class=\"box-tweet statut\">".$resultatTP->texte."</div> <br />"."<span id=\"DateMessage\"> ".$resultatTP->laDate."</span> </div>";
                    }
          }
      }
    }

?>
