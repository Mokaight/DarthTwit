<?php
	class Connexion {
		var $bdd;
		var $login;
		var $ID;
		var $mdp;
		public function __construct($l,$m){
			 $this->login=$l;
			 $this->mdp=$m;
		 }

		function connecter(){
			$_SESSION['connecte']=true;
			$_SESSION['login']=$this->login;
			$_SESSION['ID']=$this->ID;
			$_SESSION['PageCourange']=$this->ID;
			
			$num=1;
			if(isset($_COOKIE["number"])){
			  $num=$_COOKIE["number"]+1;
			}
			setcookie("number",$num,time()+3600);
		}

		function connexionBDD(){
			if(!empty($this->login))// D'abord,je teste si le champs login est non vide. 
			{ 
				if(!empty($this->mdp))// Ensuite, je teste si le champs mdp est non vide.
				{			
							$this->bdd = new PDO('mysql:host=localhost;dbname=bde11305124', 'root', '');		
							// Je me connecte à la base de données .
							session_start();	
							return true;
				}
				else
				{
						return false;
				}
				// et maintenant, fermez-la !
				
			}
			else
			{
					return false;
			}
		}

		function TestTouitos ()
		{
			$Touitos = $this->bdd->prepare("SELECT pseudonyme, motPasse, id from Touitos");
			$Touitos->execute();
			$Touitos->setFetchMode(PDO::FETCH_OBJ);
			while($user = $Touitos ->fetch() )
			{
				if (strcmp($user->pseudonyme, $this->login)==0 && strcmp($user->motPasse,md5($this->mdp))==0)
				{
					$this->ID = $user->id;
					return true;
				}
				else{
					return false;
				}
			}

		}
	}
	$c = new Connexion($_POST["pseudo"],$_POST["mdp"]);
	if($c->connexionBDD()){
					if($c->TestTouitos ()){
						$res = array('connecter' => "Y",'id'=> $c->ID,'login'=> $c->login);
						$c->connecter();
						echo json_encode($res);
					}
					else{
						$res = array('connecter' => "N",'error'=> "notExist");
						echo json_encode($res);
					}
				$c->bdd = null;						
			}
			else{
				$res = array('connecter' => "N",'error'=> "empty");
				echo json_encode($res);
			}
?>
