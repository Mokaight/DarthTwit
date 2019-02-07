			<?php
				class Inscription {
					var $bdd;
					var $login;
					var $mdp;
					var $email;
					var $mdp2;
					public function __construct($l,$m,$m2,$e){
						 $this->login=$l;
						 $this->mdp=$m;
						 $this->email=$e;
						 $this->mdp2=$m2;
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
          			function testchamps(){
							if(!empty($this->login)){// D'abord,je teste si le champs login est non vide.  
								if(!empty($this->mdp)&&!empty($this->mdp2)){// Ensuite, je teste si le champs mdp est non vide.
									if($this->mdp === $this->mdp2){	
										if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
												return true;
										}
									}	
								}
							}
							return false;
					}
					function ajoutBDD(){				
							// Je vais crypter le mot de passe.
							$passecoder = md5($this->mdp);
							try {
								$this->bdd->beginTransaction();
								$this->bdd->query("INSERT INTO touitos(id, pseudonyme, email, motPasse, photo, statut) VALUES ( NULL, '$this->login', '$this->email','$passecoder','','')");
								$this->bdd->commit();
							}catch(Exception $e) {
								echo "<p>error</p>";
							}
									
					}
					function TestTouitos ()
					{	
							// Je me connecte à la base de données .
							$Touitos = $this->bdd ->prepare("SELECT pseudonyme, email from touitos");
							$Touitos->execute();

							$Touitos->setFetchMode(PDO::FETCH_OBJ);

							while($user = $Touitos->fetch()){
								if(strcmp($user->pseudonyme,$this->login)==0){
									if(strcmp($user->email,$this->email)==0){
										return 4;
									}
									else{
										return 2;
									}
								}
								else if(strcmp($user->email,$this->email)==0){
										return 3;
									}
							}
							return 1;
							
					}
				}
				$passe = $_POST['mdp'];
				$passe2 = $_POST['mdp2'];
				$pseudo = $_POST['pseudo'];
				$email = $_POST['email'];
				$i = new Inscription($pseudo,$passe,$passe2,$email);
				if($i->testchamps()){
					switch ($i->TestTouitos()){
						case 1 :
							$i->ajoutBDD();
							$reponse = array('error' => "Compte crée!<br/>",'inscrit' => "Y");
							echo json_encode($reponse);
							break;
						case 2 :
							$reponse = array('error' => "Ce pseudo est deja utilisé <br/>",'inscrit' => "N");
							echo json_encode($reponse);							
							break;
						case 3 :
							$reponse = array('error' => "Cette email est deja utilisé<br/>",'inscrit' => "N");
							echo json_encode($reponse);
							break;
						case 4 :
							$reponse = array('error' => "Pseudo et email sont deja utilisés<br/>",'inscrit' => "N"); 
							echo json_encode($reponse);
							break;
						default :
							$reponse = array('error' => "Unknow error <br/>",'inscrit' => "N");
							echo json_encode($reponse);
							break;
					}
				}
			?>
