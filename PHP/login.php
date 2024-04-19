<?php
    if(!isset($_SESSION)){
        session_start();
    }

    include("classi/CDatabase.php");

    
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        
        //prendo le info in post
        $user = $_POST["username"];
        $psw = md5($_POST["password"]);


        //mi collego al db e cerco l'utente
        $classeDB = new CDatabase();
        $classeDB->connessione();

        $query = "SELECT * FROM utente WHERE username = ? AND password = ?";
        $row = $classeDB->seleziona($query, $user, $psw);


        if($row != "errore" && $row != "vuoto"){
            if($row[0]["admin"] == 1){
                $_SESSION["admin"] = true; 
                echo json_encode(array("status" => "admin"));   //se l'utente è un amministratore
            }
            else{
                $_SESSION["username"] = $user;
                echo json_encode(array("status" => "200"));   //se l'utente è un amministratore
            }     
        }
        else{
            echo json_encode(array("status" => "300", "message" => "errore nel db"));   //se l'utente è un amministratore
        }

        $classeDB->chiudiConnessione();
    }
    else{
        echo json_encode(array("status" => "301", "message" => "errore nel db"));
    }