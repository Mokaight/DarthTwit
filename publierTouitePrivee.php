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
        $_SESSION['ID'] = 2 ;
       //Permet de supprimer le retour ligne pour l'insertion de la base de odnnée 
       $_POST['message'] = str_replace(array("\r", "\n"), '', $_POST['message']);   
       $requeteProfil = $bdd->prepare("INSERT INTO touites values(NULL, CURDATE() , :message )");
       $requeteProfil->bindParam(':message', $_POST['message'],PDO::PARAM_STR, 500);
       $requeteProfil->execute();
       $lastID =  $bdd->lastInsertId();
               $requete = $bdd->prepare("SELECT id FROM touitos WHERE pseudonyme = :pseudo ");
               $requete->bindParam(':pseudo', $_POST['contact'],PDO::PARAM_STR,20);
               $requete->execute();
               while($resultatTP = $requete->fetch(PDO::FETCH_OBJ)){
                       
                       $requeteAffiche = $bdd->prepare("INSERT INTO touitesprives values(NULL, :idAuteur , :idReceveur , :MsgSource )");
                       $requeteAffiche->bindParam(':MsgSource', $lastID,PDO::PARAM_INT);
                       $requeteAffiche->bindParam(':idAuteur', $_SESSION['ID'],PDO::PARAM_INT);
                       $requeteAffiche->bindParam(':idReceveur', $resultatTP->id,PDO::PARAM_INT);
                       $requeteAffiche->execute();
               
               }
              
?>
