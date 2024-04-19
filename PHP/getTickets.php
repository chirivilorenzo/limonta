<?php

    header('Content-Type: application/json');
    include("CDatabase.php");

    if($_SERVER["REQUEST_METHOD"] === "GET"){

        $classeDB = new CDatabase();
        $classeDB->connessione();

        $query = "SELECT * FROM tickets";
        $result = $classeDB->seleziona($query);

        if($result != "errore" && $result != "vuoto"){
            $tickets = [];
            foreach($result as $elemento){
                $tickets[] = $elemento;
            }
        }

        echo json_encode($tickets);
    }
    else{
        echo json_encode(array("status"=> "error"), "message"=> "non abilitato");
    }