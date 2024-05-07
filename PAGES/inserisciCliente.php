<html>
    <head>
        <link rel="stylesheet" href="../CSS/style_inserisciCliente.css">
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script>

            $("document").ready(function(){

                $("#invia").click(function(){
                    inviaTicket();
                });

                $("#logout").click(function(){
                    logout();
                });

                controllaAutenticato();
            });


            function logout(){
                $.get("../AJAX/logout.php", {}, function(response){
                    alert("logout effettuato");
                    window.location.href = "loginCliente.php";
                });
            }


            function controllaAutenticato(){
                $.post("../AJAX/checkAutenticato.php", {}, function(response){
                    if(response["status"] == "200"){
                        visualizzaTutto();
                    }
                    else{
                        alert(response["status"] + ": " + response["message"]);
                    }
                });
            }

            function visualizzaTutto(){
                $("#all").show();
            }

            function inviaTicket(){
                let stato = $("#stato").val();
                let area = $("#area").val();
                let descBreve = $("#breveDescrizione").val();
                let descrizione = $("#descrizione").val();
                let data = $("#data").val();
                let ora = $("#ora").val();
                
                $.post("../AJAX/inserisciCliente.php", {stato: stato, area: area, descBreve: descBreve, descrizione: descrizione, data: data, ora: ora}, function(response){
                    if(response["status"] == "200"){
                        alert("ticket inserito correttamente");
                    }
                    else{
                        alert(response["status"] + ": " + response["message"]);
                    }
                });
            }
        </script>
    </head>
    <body>
        <div class="container">
            <div class="title-container">
                <h1>Inserimento Ticket</h1>
            </div>
            <div id="all">
                stato:<br>
                <select id="stato">
                    <option value="aperto" selected>aperto</option>
                    <option value="chiuso">chiuso</option>
                    <option value="sospeso">sospeso</option>
                    <option value="annullato">annullato</option>
                </select><br><br>


                richiesta assistenza per area:<br>
                <select id="area">
                    <option value="Area PC e reti">Area PC e reti</option>
                    <option value="AS400">AS400</option>
                    <option value="Java">Java</option>
                    <option value="Contabilita">Contabilità</option>
                    <option value="Formatori">Formatori</option>
                    <option value="Derma">Derma</option>
                    <option value="Terzisti">Terzisti</option>
                    <option value="Commerciali">Commerciali</option>
                </select><br><br>

                breve descrizione:<br>
                <input type="text" id="breveDescrizione"><br><br>

                descrizione:<br>
                <input type="text" id="descrizione"><br><br>

                data apertura:<br>
                <input type="date" id="data"><input type="time" id="ora"><br><br>

                <button id="invia">invia</button><br><br>
                <button id="logout">logout</button>
            </div>
        </div>
    </body>
</html>