$(document).ready(function(){
	$profilActuel = $("#InfoPerso");
	$listeSuiveur = $("#NomSuiveur");
	$MessagePrive = $("#MessagePrive");
  $profilVisite = $("#InfoPage");
	//Pour le profil de la personne
	console.log("Premier log");
	$profilActuel.load("recupProfil.php");


	console.log("Deuxieme LOg");



    //La div qui nous interesse "conteneur " est NomSuiveur
    //Dans Nom suiveur on insert des p de class "lesSuiveurs"
    //Contenant une <span class ="Nom"> </span> 
    // On veut rendre tout les p clickable et quand je clic , je récupère le nom de <span id="nom">

   
   //Envoyer un message
        $('#TouitePrive').bind("enterKey",function(e){
                    if (!$.trim($("#TouitePrive").val())){
                        alert("Vous ne pouvez pas publier un Message vide");
	                  $("#TouitePrive").val('');
                   	$("#TouitePrive")[0].focus();
                    }
                    else if( $('#DestinataireMess').text()=="Personne" )
                    {
                        alert("Vous n'avez pas choisi de copain avec qui discuter ! ");
                    
                    }
                    else{
                        $.post("publierTouitePrivee.php",{
                   		message : $("#TouitePrive").val(),
                   		contact : $('#DestinataireMess').text(),
                                idLastMsg : 1,
                        },function(res){alert(res);});
                      $("#TouitePrive").val('');
                      $("#TouitePrive")[0].focus();
                   }
        });
        $('#TouitePrive').keyup(function(e){
            if(e.keyCode == 13)
            {
                $(this).trigger("enterKey");
            }
        });
  //FIN envoyer message
  //Actualisation de la liste des messages

        //FIN actualisation




});
