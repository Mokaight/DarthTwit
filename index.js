$(document).ready(function(){
	$monprofil = $(".InfoPerso");
	$listeSuiveur = $(".NomSuiveur");
	$listeDemande = $(".NomDemande");
	$profilVisite = $(".InfoPage");
	$MyTouite = $("#MyTouite");
	$ThereTouite = $("#ThereTouite");

	$filDeMesTouites = $("#Mes-touites-fil .filDesTouites");
	$filDeMesAmis = $("#Les-touites-fil .filDesTouites");
	$Notify = $(".Notification");
	var ValeurDuContact = "Personne";
	var ValeurClickSuiveur = " ";
	var maxTP = 0;
	var maxTPublics = 0;
	var maxTPublicsAmis = 0;
        var flagsforTP = 0;
        $monprofil.load("recupProfil.php");

	//Pour le profil de la personne
	 ClickableSuivreForMessage();
    
    function Spawnify(text){
    //faire un truc pour pas la lancer 2 fois en mm temps pls
    	$Notify.append(text);
    	$Notify.fadeIn(1500);
    	$Notify.fadeOut(3000);	
    	$Notify.html('');
    }	

        ///////////////////////////////////////TEST CLIC /////////////////////////////////////////////////////
        $('#statut1rie').on("click",function(){
  
        });
        
        
        
	// ////////////////////////////// SEARCH BAR//////////////////////////////////////////////////////////


             // Initialize ajax autocomplete:
             $('#autocomplete-ajax').autocomplete({
                         serviceUrl: './recherche.php',
                         dataType : 'json',

             });

     $('#autocomplete-ajax').bind("enterKey",function(e){
         if (!$.trim($("#autocomplete-ajax").val())){
                        alert("Vous ne pouvez pas faire une recherche vide");
                        $("#autocomplete-ajax").val('');
                	$("#autocomplete-ajax")[0].focus();
         }
         else{
                        $.get('rechercheComplete.php',{
                                recherche : 1,
                                value  : $('#autocomplete-ajax').val(),
                        
                        },function(res){
                                if(res ==0)
                                {
                                 Spawnify("Cette personne n'existe pas !");        
                                }
                                if(res==1){
                                Spawnify("Vous avez fait une recherche fructueuse :)");
                                $("#autocomplete-ajax").val('');
                        	$("#autocomplete-ajax")[0].focus();
                        	location.reload();
                                }
                        });
        }
     });
    $('#autocomplete-ajax').keyup(function(e){
            if(e.keyCode == 13)
            {
                $(this).trigger("enterKey");
            }
        });
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//Fonction de chargement des messages public a mes POTO

	function ChargementTouitepublicAmis(){
            
				$('.ListTouitesAmis').each(function() {
				    maxTPublicsAmis = Math.max(this.id, maxTPublicsAmis);
				});
			// on lance une requête AJAX
			$.post('TouitesAmis.php',{
				IdLastMsg : maxTPublicsAmis,
			},function(res){
					//alert(res);
					$filDeMesAmis.prepend(res);
			});
			
	}
	setInterval(ChargementTouitepublicAmis(),1500);
    //Fonction de chargement des messages public a MOI
    function ChargementTouitepublic(){
            
				$('.ListTouites').each(function() {
				    maxTPublics = Math.max(this.id, maxTPublics);
				});
			// on lance une requête AJAX
			$.post('MesTouites.php',{
				IdLastMsg : maxTPublics,
			},function(res){
					//alert(res);
					$filDeMesTouites.prepend(res);
			});
			
	};
        setInterval(ChargementTouitepublic(),1500);
	///////////////////////////////////////////////////
	//Liste des Demandes , fonction a load , car AJAX est asynchrone
	function ActualiserLesDemandes(){
	        $listeDemande.load("listeDemande.php",function(){
	        	ClickableSuivreForMessage();
		        $(".AccepterDemande").on("click",function(){
		        	$.get("GererDemande.php",{
		        		nom : $(this).closest(".box-tweet").find(".Nom").text(),
		        		accepter : 1,
		        	},function(){
		        	    Spawnify("Vous avez accepté la demande !");
		        		ActualiserLesDemandes();
		        	});
		        });

		        $(".RefuserDemande").on("click",function(){
		        	$.get("GererDemande.php",{
		        		nom : $(this).closest(".box-tweet").find(".Nom").text(),
		        		refuser : 1,
		        	},function(){
		        	        Spawnify("Vous avez refusé la demande !");
		        		ActualiserLesDemandes();
		        	});
		        
		        });

	        });	
	}
     ActualiserLesDemandes();

    function ClickableSuivreForMessage (){
   

    		$listeSuiveur.load("Suivre.php",function(){

            	$(".lesSuiveurs").click(function(){
             	if($("#DestinataireMess").length == 0){
             		//Nothing here cuz i suck
             		Spawnify("Pour changer de page, utilise la barre de recherche :)");
             	}
             	else{
             	        if($("#DestinataireMess").text() != ($(this).find(".Nom").text())){
                                console.log($("#DestinataireMess").text());
             	                console.log($(this).find(".Nom").text());
             	        }
  
             	        // $("#filDesMessages").remove();
	            	 $("#DestinataireMess").remove();
	            	 ValeurDuContact = $(this).find(".Nom").text();
	            	 $("<span id=\"DestinataireMess\">"+$(this).find(".Nom").text()+"</span>").insertAfter("#DestinataireID");
	            	 var Notif = "Vous êtes en conversation avec : "+ValeurDuContact+" :)";
	            	 Spawnify(Notif);
                         flagsforTP = 1;
	        }
           		 });
                });
                if(flagsforTP === 1)
                {
                         setInterval(ChargerTP(),1200);
                }
   
    }
        //Fonction de chargement des messages privées
     function ChargerTP(){
    	    if($("#DestinataireMess").length == 0){
             		
             }
            else{
				$('.ListTouitesPrive').each(function() {
				     console.log(this.id);    
				     maxTP = Math.max(this.id, maxTP);
				});
			}
			// on lance une requête AJAX
			$.post('ChargementTouitePrivee.php',{
				contact : ValeurDuContact,
				IdLastMsg : maxTP
			},function(res){
					//$("#filDesMessages").animate({ scrollTop: $(document).height() }, "slow");
					$("#filDesMessages").append(res);
					console.log("Execution fonction");
			});
	  
			
	};

	//Déconnexion
	$("#Deco").on("click",function(){
			//Spawnify("Vous allez être déconnecté");
	        $("#Deco").load("Deconnexion.php");
	});
	
	$ThereTouite.on("click",function(){
	        $("#Mes-touites-fil").css({"display" : "none"});
                $("#Les-touites-fil").css({"display" : "inline"});
	});
	$MyTouite.on("click",function(){
	        $("#Les-touites-fil").css({"display" : "none"});
                $("#Mes-touites-fil").css({"display" : "inline"});
	});



	function ProfilActuel(){
	        $profilVisite.load("ProfilActuel.php",function(){
		        var $idActuel =  $(this).find('p').attr("title");
            	ActualiserLesDemandes();
            	if ($idActuel == 1)
            	{
            	    $('#DemandeAmi').attr('value', 'Je veux être ton ami !');
            		$("#DemandeAmi").fadeIn(1000);
            	}
            	if($idActuel == 0){
            	        $("#DeleteDemande").fadeIn(1000);
            	        
            	}
            	if($idActuel == 2){
            	        $("#DeleteAmi").fadeIn(1000);
            	}
            	if($idActuel == 3){
            	        $('#DemandeAmi').attr('value', 'Forcer l\'amitier');
            	        $("#DemandeAmi").fadeIn(1000);
            	}        
				$("#DemandeAmi").on("click",function(){
					$(this).fadeOut(200);
					$(this).load("DemandeAmi.php");
					Spawnify("Demande Envoyée copain :D");
					ProfilActuel();

				});
				
				$("#DeleteDemande").on("click",function(){
					$(this).fadeOut(200);
					$(this).load("DeleteAmi.php");
					Spawnify("Demande Annulée copain :D");
					ProfilActuel();

				});
				
				$("#DeleteAmi").on("click",function(){
					$(this).fadeOut(200);
					$(this).load("DeleteAmi.php");
					Spawnify("Vous n'êtes plus copain :D");
					ProfilActuel();

				});

	        });
	}
	ProfilActuel();


	//Publier un statut
        $('.statut1').bind("enterKey",function(e){
                    if (!$.trim($(".statut1").val())){
                        alert("Vous ne pouvez pas publier un statut vide");
	                $(".statut1").val('');
                   	$(".statut1")[0].focus();
                    }
                    else{
                        $.get("publierStatut.php",{
                   		message : $(".statut1").val(),
                        },function(){
				       		 $monprofil.load("recupProfil.php");
				       		 $(".statut1").val('');
                   			 $(".statut1")[0].focus();

                       		 });
                        Spawnify("Vous avez publié votre nouveau statut :)");
                   }
        });
        $('.statut1').keyup(function(e){
            if(e.keyCode == 13)
            {
                $(this).trigger("enterKey");
            }
        });
        $('.statut2').bind("enterKey",function(e){
                    if (!$.trim($(".statut2").val())){
                        alert("Vous ne pouvez pas publier un statut vide");
	                $(".statut2").val('');
                   	$(".statut2")[0].focus();
                    }
                    else{
                        $.get("publierStatut.php",{
                   		message : $(".statut2").val(),
                        },function(){
				       		 $monprofil.load("recupProfil.php");
				       		 $(".statut2").val('');
                   			 $(".statut2")[0].focus();

                       		 });
                        Spawnify("Vous avez publié votre nouveau statut :)");
                   }
        });
        $('.statut2').keyup(function(e){
            if(e.keyCode == 13)
            {
                $(this).trigger("enterKey");

            }
        });
        
    //Fin de publier un statut      
    //Fin de publier un statut

	//Publier un Touite
                $('#Touite').bind("enterKey",function(e){
                    if (!$.trim($("#Touite").val())){
                        alert("Vous ne pouvez pas publier un statut vide");
	                $("#Touite").val('');
                   	$("#Touite")[0].focus();
                    }
                    else{
                        $.get("publierTouite.php",{
                   		message : $("#Touite").val(),
                        },function(){
                        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				        $("#Touite").val('');
                   		$("#Touite")[0].focus();

                        });
                        Spawnify("Vous avez publié votre nouveau tweet :)");
                   }
        });
        $('#Touite').keyup(function(e){
            if(e.keyCode == 13)
            {
                $(this).trigger("enterKey");
            }
        });
    //Fin de publier un statut


/*
	alert($(window).height());

	var fil= $('#fil');
	var waza= fil.find('#waza');
	var hScroll=0;
	fil.on('mouseenter',function(){

		fil.on('mousewheel',function(e){

			var wayScroll = e.originalEvent.deltaY;
			var speedScroll= 25;
			var posTopWaza= waza.position().top;

			console.log(posTopWaza-speedScroll);

			
				if(wayScroll > 0){
					if(posTopWaza-speedScroll >= 0){
						hScroll-=speedScroll;
						waza.css({"top":hScroll});
					}
				}else{

					hScroll+=speedScroll;
					waza.css({"top":hScroll});
				}
		

		});
	});
	fil.on('mouseleave',function(){

		console.log('leave');

	});
*/
/*

	//A Revoir
	function infiniteScroll() {	
        // cette variable contient notre offset
                var offset = 20;
         // on initialise ajaxready à true au premier chargement de la fonction
          $(window).data('ajaxready', true);
       // ici on ajoute un petit loader gif qui fera patienter pendant le chargement
       ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         $('#filDesTouites').append('<div id="loader"><img src="./style/loader.gif" alt="loader ajax"></div>');
      // on déclence une fonction lorsque l'utilisateur utilise sa molette 

	    $(window).scroll(function() {		
	         alert("LOL");
		         if ($(window).data('ajaxready') == false) 
		         		return;
		        // cette condition vaut true lorsque le visiteur atteint le bas de page
		        
                        alert("LOL");
		        if(($(window).scrollTop() + $(window).height()) == $(document).height()) {
		          // on effectue nos traitements
		          $(window).data('ajaxready', false);
		           // on affiche donc loader
		          $('#filDesTouites #loader').fadeIn(400);
		 
		          //On récupère l'id du dernier lesSuiveurs affiché
		          var last_id = $('.ListToutitesAmis:last').attr('id');




		           // puis on fait la requête pour demander les nouveaux éléments
		            $.get("TouitesAmis.php",{value:last_id}, function(data){
			            // s'il y a des données
			            if (data != '') {
			           
			                    $('.ListToutitesAmis:last').after(data);
			                    // on les affiche avec un fadeIn
			                    $('#filDesTouites .ListToutitesAmis').fadeIn(400);

			                    offset = $('.ListToutitesAmis:last').offset();
			                    $(window).data('ajaxready', true);
			            }
			                
				        // le chargement est terminé, on fait disparaitre notre loader
				        $('#filDesTouites #loader').fadeOut(400);
			        });
		    };	
		});
	};
	//A revoir
	infiniteScroll();
*/

});
