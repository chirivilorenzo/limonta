<?php
    if(!isset($_SESSION)){
        session_start();
    }

    header('Content-Type: application/json');

    if(isset($_SESSION["IDcliente"])){
        echo json_encode(array("status"=> "200"));
    }
    else if(isset($_SESSION["IDdipendente"])){
        echo json_encode(array("status"=> "200"));
    }
    else{
        echo json_encode(array("status"=> "error", "message"=> "utente non autenticato"));
        exit();
    }