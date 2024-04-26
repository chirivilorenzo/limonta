<?php

    if(!isset($_SESSION)){
        session_start();
    }


    header('Content-Type: application/json');
    include("CDatabase.php");

    if($_SERVER["REQUEST_METHOD"] === "POST"){

        $classeDB = new CDatabase();
        $classeDB->connessione();

        //variabili prese in post
        $codiceCliente = $_POST["codiceCliente"];
        $stato = $_POST["stato"];
        $area = $_POST["area"];
        $breveDesc = $_POST["breveDescrizione"];
        $dataApertura = $_POST["dataApertura"]; //da gestire pk così non va
        $categoria = $_POST["categoria"];

        if(!isset($_SESSION["userDip"])){
            echo json_encode(array("status"=> "error", "message"=> "username non trovato nella sessione"));
        }
        else{
            $userDipendente = $_SESSION["userDip"];

            $query = "INSERT INTO ticket (codiceCliente, stato, area, breveDescrizione, dataApertura, categoria, userDipendente) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $result = $classeDB->inserisci($query);
    
            if($result != "errore" && $result != "vuoto"){
                echo json_encode(array("status"=> "200", "nome"=> $result[0]["nome"], "cognome"=> $result[0]["cognome"], "telefono"=> $result[0]["numTelefono"], "email"=> $result[0]["email"]));
            }
            else if($result == "errore"){
                echo json_encode(array("status"=> "vuoto", "message"=> "codice cliente non trovato"));
            }
            else{
                echo json_encode(array("status"=> "errore", "message"=> "ticket non inserito"));
            }
        }
    }
    else{
        echo json_encode(array("status"=> "error", "message"=> "non puoi accedere"));
    }