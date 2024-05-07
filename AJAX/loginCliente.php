<?php
    if(!isset($_SESSION)){
        session_start();
    }

    include("CDatabase.php");
    header('Content-Type: application/json');

    
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        
        //prendo le info in post
        $user = $_POST["username"];
        $psw = $_POST["password"];


        //mi collego al db e cerco l'utente
        $classeDB = new CDatabase();
        $classeDB->connessione();

        $query = "SELECT * FROM cliente WHERE username = ? AND password = ?";
        $result = $classeDB->seleziona($query, $user, $psw);


        if($result != "errore" && $result != "vuoto"){
            $_SESSION["IDcliente"] = $result[0]["ID"];
            echo json_encode(array("status" => "200"));    
        }
        else if($result == "vuoto"){
            echo json_encode(array("status" => "404", "message" => "utente non trovato"));
        }
        else{
            echo json_encode(array("status" => "300", "message" => "errore nel db"));   //se l'utente è un amministratore
        }

        $classeDB->chiudiConnessione();
    }
    else{
        echo json_encode(array("status" => "301", "message" => "errore nel db"));
    }