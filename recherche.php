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

                                 //get search term
                                $searchTerm = $_GET["query"];


                                // Requête SQL
                               $requete = $bdd->prepare("SELECT pseudonyme FROM touitos WHERE pseudonyme LIKE :term ");
                               $requete->execute(array(':term' => $searchTerm . '%'));
                              //$suggestions['suggestions'][] = "LOL";
                                // On parcourt les résultats de la requête SQL
                                while ($row = $requete->fetch(PDO::FETCH_OBJ)) {
                                    $suggestions['suggestions'][] = $row->pseudonyme;
                                 }
   
                                // On renvoie le données au format JSON pour le plugin
                                echo json_encode($suggestions);
                        
?>

