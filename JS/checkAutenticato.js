function controllaAutenticato(){
    $.ajax({
        type: "POST",
        url: "../PHP/checkAutenticato.php",
        success: function(response){
            if(response["status"] == "admin"){
                visualizzaTuttoAdmin();
            }
            else if(response["status"] == "200"){
                visualizzaTutto();
            }
            else{
                alert(response["status"] + ": " + response["message"]);
            }
        }
    }); 
}