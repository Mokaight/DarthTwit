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
    //Pour le test
    $_SESSION['ID'] = 2;
    $_SESSION['login'] = "Bernard";
    $_SESSION['IDPageCourante'] = 2;
    if ($_SESSION['IDPageCourante'] === $_SESSION['ID'])
    {
      echo "<p class=\"NOUS\">Vous êtes sur votre page l'ami !</p>";
    }
    else{
           $requeteProfil = $bdd->prepare("SELECT * from touitos where ID = :ID   ");
           $requeteProfil->bindParam(':ID', $_SESSION['IDPageCourante'],PDO::PARAM_INT);
           
           $requeteProfil->execute();                
           $requeteAmis = $bdd->prepare("SELECT demande from suivre where idDemandeur = :moi AND idReceveur = :ID");
           $requeteDemande = $bdd->prepare("SELECT demande from suivre where idDemandeur = :ID AND idReceveur = :moi");
           while($resultat = $requeteProfil->fetch(PDO::FETCH_OBJ)) 
           {

                $requeteAmis->bindParam(':moi',$_SESSION['ID']);
                $requeteAmis->bindParam(':ID',$_SESSION['IDPageCourante']);
                $requeteDemande->bindParam(':moi',$_SESSION['ID']);
                $requeteDemande->bindParam(':ID',$_SESSION['IDPageCourante']);
                $requeteAmis->execute();
                $requeteDemande->execute();
                if($requeteAmis->rowCount() == 0 && $requeteDemande->rowCount() == 0){
                    echo "<p title=\"1\"> Vous êtes sur la page de : " . $resultat->pseudonyme . "<br /> Son statut  est : " .$resultat->statut ."<br /> <span> Vous n'avez aucun lien, voulez vous effectuer une demande d'ami ? </span></p>" ;
                }
                while($resultat2 = $requeteAmis->fetch(PDO::FETCH_OBJ)) 
                {
                  if($resultat2->demande === "V"){
                  echo "<p title=\"2\"> Vous êtes sur la page de : " . $resultat->pseudonyme . "<br /> Son statut  est : " .$resultat->statut ."<br /> <span> Vous êtes déjà amis ! </span></p>" ; 

                  }
                  elseif($resultat2->demande === "E"){
                  echo "<p title=\"0\"> Vous êtes sur la page de : " . $resultat->pseudonyme . "<br /> Son statut  est : " .$resultat->statut ."<br /> <span> Vous avez déjà effectué votre demande d'amitié ! </span></p>" ; 
                  }
                  elseif($resultat2->demande === "R"){
                  echo "<p title=\"3\"> Vous êtes sur la page de : " . $resultat->pseudonyme . "<br /> Son statut  est : " .$resultat->statut ."<br /> <span>".$resultat->pseudonyme." a refusé d'être votre ami  !</span></p>" ; 
                  }

                }
                //ON DOIT GERER LES DEUX CA SI A -> B alors dans notre table , B n'impliQue pas forcement A , on gere donc les deux cas
                while($resultat3 = $requeteDemande->fetch(PDO::FETCH_OBJ)) 
                {
                  if($resultat3->demande === "V"){
                  echo "<p title=\"2\"> Vous êtes sur la page de : " . $resultat->pseudonyme . "<br /> Son statut  est : " .$resultat->statut ."<br /> <span> Vous êtes déjà amis ! </span></p>" ; 

                  }
                  elseif($resultat3->demande === "E"){
                  echo "<p title=\"0\"> Vous êtes sur la page de : " . $resultat->pseudonyme . "<br /> Son statut  est : " .$resultat->statut ."<br /> <span> vous a envoyé une demande d'amitié ! </span></p>" ; 
                  }
                  elseif($resultat3->demande === "R"){
                  echo "<p title=\"3\"> Vous êtes sur la page de : " . $resultat->pseudonyme . "<br /> Son statut  est : " .$resultat->statut ."<br /> <span>".$resultat->pseudonyme." a refusé d'être votre ami  !</span></p>" ; 
                  }

                } 
           }

    }





?>
