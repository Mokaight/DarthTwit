$(document).ready(function(){
		var validation = 0;

	var accesProfil = $(".modifProfil");
	var envoyerModif = $(".changement");
	var popup = $(".popup");
	var information = $(".information");
	var hauteurW = $(window).height();
	var largW  = $(window).width();
	var formulaire = popup.children(".conteneurForm");
	var fondForm  = popup.children(".fondPopup");

	function sizeFormulaire(){
		formulaire.css({
			"width" : "50px",
			"height" : "50px",
			"top" : (hauteurW - 50)/2,
			"left" : (largW - 50)/2,
		});
		formulaire.children("form").css({
		"display" : "none"
		});
	}
	sizeFormulaire();

	fondForm.css({
		"width" : largW,
		"height" : hauteurW,

	});
	popup.css({
		"width" : largW,
		"height" : hauteurW,

	});
	fondForm.on("click", function(){
		popup.css({
			"display" : "none"
		});
		sizeFormulaire();
	});
	accesProfil.on("click", function(){
		popup.css({
			"display" : "block"
		});
		setTimeout(function(){
			formulaire.css({
				"width" : "50%",
				"height" : "50%",
				"top" : (hauteurW - (hauteurW/2))/2,
				"left" : (largW - (largW/2))/2,
				"position" : "absolute",
				"background-color" : "#f5f8fa"
			});
			setTimeout(function(){
				formulaire.children("form").css({
					"display" : "block",
					"background-color" : "#FFF",
				 //Ici géré la forme du formulaire, je le ferai demain
				});
			}, 1000);
		}, 500);
		//Récupère les informations sur l'utilisateur
		information.load("recupProfil.php");
		information.css({
		        "font-weight" : "bold",
		        "font-family" : "arial,sans-serif",
		});
	});
        var $mdp = $(".mdp");
        var $mdp2 = $(".mdp2");
        var $pseudo = $(".pseudo");
        var $email = $(".email");
	$mdp2.keyup(function(){
		if($(this).val() != $mdp.val()){ // si la confirmation est différente du mot de passe
			$(this).css({ // on rend le champ rouge
			borderColor : 'red'
			});
		validation = 0;
		}
		else{
			$(this).css({ // si tout est bon, on le rend vert
				borderColor : 'green'
			});
			$mdp.css({ // si tout est bon, on le rend vert
				borderColor : 'green'
		
			});
		validation = 1;
		}
	});
	//Envoie du formlaire pour 
	function changerTheme(e)
	{
		if (e== "Normal")
		{
				$(".box-tweet").css({
				"background-color"  : "#fff",
			});
			$(".titreDesBoxs").css({
				color : "#005cff",
			});
			$(".main").css({
				"background-color"  : "#f5f8fa",
			});
			$(".search-input").css({
				color: "#292f33",
			});
		}
		else if(e == "Blur")
		{
				$(".box-tweet").css({
				"background-color"  : "green",
			});
			$(".titreDesBoxs").css({
				color : "#005cff",
			});
			$(".main").css({
				"background-color"  : "#f5f8fa",
			});
			$(".search-input").css({
				color: "#292f33",
			});
		}
		else if(e == "Darky")
		{
				$(".box-tweet").css({
				"background-color"  : "#fff",
			});
			$(".titreDesBoxs").css({
				color : "#005cff",
			});
			$(".main").css({
				"background-color"  : "#f5f8fa",
			});
			$(".search-input").css({
				color: "#292f33",
			});
		}
		else if(e== "Moche")
		{
				$(".box-tweet").css({
				"background-color"  : "#fff",
			});
			$(".titreDesBoxs").css({
				color : "#005cff",
			});
			$(".main").css({
				"background-color"  : "#f5f8fa",
			});
			$(".search-input").css({
				color: "#292f33",
			});
		}
		else {
				alert("Le changement n'a pas marché");
				$(".box-tweet").css({
				"background-color"  : "#fff",
			});
			$(".titreDesBoxs").css({
				color : "#005cff",
			});
			$(".main").css({
				"background-color"  : "#f5f8fa",
			});
			$(".search-input").css({
				color: "#292f33",
			});

		}
	}


	envoyerModif.on("click",function(){
	        if (validation ==0)
	        {
	                alert("Veuillez remplir  correctement");
	        }
	        if (validation ==1)
			{
		        
				        $.post("changerProfil.php",{
					        pseudo : $pseudo.val(),
					        email : $email.val(),
					        mdp : $mdp.val(),
				        });
				        changerTheme($(".theme").val());
			        information.load("recupProfil.php");
					information.css({
				        "font-weight" : "bold",
				        "font-family" : "arial,sans-serif",
				
					});
		    }	
	});	






});
