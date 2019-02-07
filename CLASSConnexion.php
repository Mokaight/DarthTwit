<?php
        class ConnexionRoot {
        
        
			     public function __construct($bdd,$l){
			     if ($l==="fac")
			     {
                                try {
                                      $bdd = new PDO("mysql:host=marseille;dbname=BDE11202152", "E11202152", "2505059912J");
                                }
                                catch(PDOException $e) {
                                      $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
                                      die($msg);
                                }
                             }
                             if($l =="home"){
                                try {
                                                $bdd = new PDO('mysql:host=localhost;dbname=touiter','root','');
                                    }
                                    catch(PDOException $e) {
                                                      $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
                                                      die($msg);
                                                }
                             }
		             }
        }
?>
