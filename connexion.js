$(document).ready(function(){
    var $pseudo = $('#pseudo'),
        $mdp = $('#mdp'),
		$erreur=$('#erreur'),
		$champ=$('.champ');

    function verifier(champ){
        if(champ.val() == ""){ // si le champ est vide
			$erreur.empty();
			$erreur.html("Veuillez remplire tous les champs pour vous conecter")
    	    $erreur.css('display', 'block'); // on affiche le message d'erreur
			return 0;
        }
		else
		{
			$erreur.empty();
			return 1;
		}
    }
	
	$("#submit").click(function(e){
			e.preventDefault()
			console.log ( "prêt!" );
			if(verifier($pseudo) + verifier($mdp) ==2){
			console.log ( "prêt!" );
				$.post("connexion.php",
					{pseudo: $pseudo.val(),mdp: $mdp.val()},function(res){
					   if(res.connecter === "Y"){
							document.location = "index.html";
						}
					   else{
							$erreur.empty();
							if(res.error ==="notExist"){
								$erreur.append("Le mot de passe ou/et l'identifiant est incorrecte.");
								$erreur.css('display', 'block');
							}
							else{
								
							}
						}
					},"json");
			}
			
	});

});