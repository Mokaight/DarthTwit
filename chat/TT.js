$("#submit").click(function(){
    var pseudo1 = $("#pseudo").val();
    var message1 = $("#message").val();
    
    if((pseudo1 ==undefined || message1 == undefined) || (pseudo1 =="" || message1 == ""))
    {
        alert('Les champs sont vides');
    }
  $.post("Test_js.php",{
      pseudo : pseudo1,
      message : message1}
      );
});

var Charger =  function(){
			// on lance une requête AJAX
			$("#touites_publie").load('Test_js_2.php',function(){
					$("#touites_publie").prepend(res);
			});
			
};
setInterval(Charger,500);

