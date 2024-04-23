<?php

    header('Content-Type: application/json');
    include("CDatabase.php");

    if($_SERVER["REQUEST_METHOD"] === "POST"){

        $classeDB = new CDatabase();
        $classeDB->connessione();

        $codiceCliente = $_POST["codCliente"];

        $query = "SELECT * FROM cliente WHERE codice = ?";
        $result = $classeDB->seleziona($query, $codiceCliente);

        if($result != "errore" && $result != "vuoto"){
            echo json_encode(array("status"=> "200", "nome"=> $result[0]["nome"], "cognome"=> $result[0]["cognome"], "telefono"=> $result[0]["numTelefono"], "email"=> $result[0]["email"]));
        }
        else if($result == "errore"){
            echo json_encode(array("status"=> "vuoto", "message"=> "codice cliente non trovato"));
        }
        else{
            echo json_encode(array("status"=> "errore", "message"=> "errore nel db"));
        }

    }
    else{
        echo json_encode(array("status"=> "error", "message"=> "non puoi accedere"));
    }