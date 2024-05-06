<?php
    if(!isset($_SESSION)){
        session_start();
    }

    header('Content-Type: application/json');

    if(isset($_SESSION["idCliente"])){
        echo json_encode(array("status"=> "200"));
    }
    else if(isset($_SESSION["idDipendente"])){
        echo json_encode(array("status"=> "200"));
    }
    else{
        echo json_encode(array("status"=> "error", "message"=> "utente non autenticato"));
        exit();
    }