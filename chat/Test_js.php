<?php

try {
                       $bdd = new PDO('mysql:host=localhost;dbname=touiter','root','');
                }
                catch(PDOException $e) {
                      $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
                      die($msg);
                }
 if(isset($_POST['message']))
        {
                if((!empty($_POST['pseudo'])) AND (!empty($_POST['message']))){
                                              $message = $_POST['message'];
                                              $rec = $bdd->query("INSERT INTO touites(idMsg, laDate, texte) VALUES (NULL,CURDATE(),'$message')");
                }
        }
?>
