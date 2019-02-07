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
#          }    }
          catch (Exception $e)
          {
            die('Erreur : ' . $e->getMessage());
          }                                  
        if(!(isset($_SESSION['login'])) && !(isset($_SESSION['ID'])) && !(isset($_SESSION['connecter'])) && !(isset($_SESSION['PageCourante']))
        {
                session_destroy();
        }                         

?>
