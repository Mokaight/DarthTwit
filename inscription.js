$(document).ready(function(){
    var $pseudo = $('#pseudo'),
        $mdp = $('#mdp'),
        $confirmation = $('#mdp2'),
        $email = $('#email'),
        $envoi = $('#submit'),
		$erreur=$('#erreur'),
		$champ=$('.champ');

	console.log ( "prêt!" );
	$confirmation.keyup(function(){
		if($(this).val() != $mdp.val()){ // si la confirmation est différente du mot de passe
			$(this).css({ // on rend le champ rouge
			borderColor : 'red'
			});
		}
		else{
			$(this).css({ // si tout est bon, on le rend vert
				borderColor : 'green'
			});
			$mdp.css({ // si tout est bon, on le rend vert
				borderColor : 'green'
			});
		}
	});

    function verifier(champ){
        if(champ.val() == ""){ // si le champ est vide
    	    $erreur.css('display', 'block'); // on affiche le message d'erreur
            champ.css({borderColor : 'red'});
			return 0;
        }
		else
		{
			champ.css({borderColor : 'green'});
			return 1;
		}
    }
	
	$("#submit").click(function(e){
			e.preventDefault()
			console.log ( "prêt!" );
			if(verifier($pseudo) + verifier($mdp) + verifier($confirmation) + verifier($email)==4){
				console.log ( "prêt!" );
				$.post("inscription.php",
					{pseudo: $pseudo.val(),mdp: $mdp.val(),mdp2: $confirmation.val(),email: $email.val()
					},function(res){
						console.log ( "prêt!" );
						$erreur.css('display', 'block');
						$erreur.empty();
						$erreur.html(res.error);
						console.log (res.inscrit);
					   if(res.inscrit === "Y"){
							$champ.remove();
							$erreur.append("Vous pouvez vous connectez");	
						}
					   else{
							$erreur.append("Veuillez modifiez cette erreur et recommencez...");
						}
					},"json");
			}
			
	});

});