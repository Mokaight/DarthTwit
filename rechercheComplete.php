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
                                $searchTerm = $_GET["value"];
                                $value  = 0;
                                $requete = $bdd->prepare("SELECT pseudonyme FROM touitos WHERE pseudonyme = :pseudo");
                                $requete->bindParam(':pseudo',$searchTerm,PDO::PARAM_STR,25);
                                $requete->execute();
                                if($requete->rowCount() == 0){
                                        echo ($value); 
                                }
                                while($resultat = $requete->fetch(PDO::FETCH_OBJ)){
                                          $requeteProfil = $bdd->prepare("SELECT id from touitos where pseudonyme = :pseudonyme   ");
                                          $requeteProfil->bindParam(':pseudonyme',$resultat->pseudonyme,PDO::PARAM_STR,25);
                                          $requeteProfil->execute();      
                                          $value = 1;
                                          while($resultatProfil = $requeteProfil->fetch(PDO::FETCH_OBJ)){
                                                  $_SESSION['IDPageCourante'] = $resultatProfil->id;
                                                  echo($value); 
                                         }
                                }
                        
?>
