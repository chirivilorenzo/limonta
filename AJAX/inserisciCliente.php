<?php
    header('Content-Type: application/json');
    include("CDatabase.php");

    if(!isset($_SESSION)){
        session_start();
    }

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        if(isset($_POST["stato"]) && isset($_POST["area"]) && isset($_POST["descBreve"]) && isset($_POST["descrizione"]) && isset($_POST["data"]) && isset($_POST["ora"]) && isset($_SESSION["IDcliente"])) {
            $stato = $_POST["stato"];
            $area = $_POST["area"];
            $descBreve = $_POST["descBreve"];
            $descrizione = $_POST["descrizione"];
            $data = $_POST["data"];
            $ora = $_POST["ora"];
            $datetime = $data . " " . $ora;
    
            $classeDB = new CDatabase();
            $classeDB->connessione();
    
            $query = "INSERT INTO aperturaticket (IDcliente, stato, area, breveDescrizione, descrizione, dataApertura) VALUES (?, ?, ?, ?, ?, ?)";
    
            
            if($classeDB->inserisci($query, $_SESSION["IDcliente"], $stato, $area, $descBreve, $descrizione, $datetime)){
                echo json_encode(array("status"=>"200"));
            }
            else{
                echo json_encode(array("status"=> "error", "message"=> "errore nell'inserimento del ticket"));
            }
        }
        else{
            echo json_encode(array("status"=> "error", "message"=> "una o più variabili non sono state impostate"));        
        }
    }
    else{
        echo json_encode(array("status"=> "error", "message"=> "non puoi visualizzare questa pagina"));        
    }

