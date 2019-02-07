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
     // CHANGE LA VARIABLE SESSION IDPAGE COURANTE
       $requeteAmis = $bdd->prepare("SELECT id from touitos WHERE pseudonyme = :pseudonyme");
       $requeteAmis->bindParam(':pseudonyme', $_POST['idPage'],PDO::PARAM_INT);
       $requeteAmis->execute();
       while($resultatTP = $requeteAmis->fetch(PDO::FETCH_OBJ)) 
        {
          $_SESSION['IDPageCourante'] = $resultatTP->id;
        }
?>
