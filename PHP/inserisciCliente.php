<?php
    header('Content-Type: application/json');
    include("CDatabase.php");

    if(!isset($_SESSION)){
        session_start();
    }

    //codice cliente lo si prende dalla sessione
    //il resto dalla chiamata ajax

    if($_SERVER["REQUEST_METHOD"] === "POST"){

        $stato = $_POST["stato"];
        $area = $_POST["area"];
        $descBreve = $_POST["descBreve"];
        $descrizione = $_POST["descrizione"];
        $data = $_POST["data"];
        $ora = $_POST["ora"];
        $datetime = $data . " " . $ora;

        $classeDB = new CDatabase();
        $classeDB->connessione();

        $query = "INSERT INTO aperturaticket (codiceCliente, stato, area, breveDescrizione, descrizione, dataApertura) VALUES (?, ?, ?, ?, ?, ?)";

        
        if($classeDB->inserisci($query, $_SESSION["codCliente"], $stato, $area, $descBreve, $descrizione, $datetime)){
            echo json_encode(array("status"=>"200"));
        }
        else{
            echo json_encode(array("status"=> "error", "message"=> "errore nell'inserimento del ticket"));
        }
    }
    else{
        echo json_encode(array("status"=> "error", "message"=> "non puoi visualizzare questa pagina"));        
    }

