<?php

    class CDatabase{
        public $servername;
        public $username;
        public $password;
        public $dbname;
        public $mysqli;

        public function __construct(){
            $this->servername = "localhost";
            $this->username = "root";
            $this->password = "";
            $this->dbname = "limonta";
        }

        public function connessione(){
            $this->mysqli = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
            $this->mysqli->set_charset('utf8mb4');
        }

        public function getLastID(){
            return $this->mysqli->insert_id;
        }

        public function getTipoParametri(...$params){
            $tipoParametri = "";
            foreach($params as $elemento){
                if(gettype($elemento) == "integer") $tipoParametri .= "i";
                else if(gettype($elemento) == "string") $tipoParametri .= "s";
                else if(gettype($elemento) == "boolean") $tipoParametri .= "b";
                else if(gettype($elemento) == "double") $tipoParametri .= "f";    //float
            }

            return $tipoParametri;
        }

        public function inserisci($query, ...$parametri){
            $stmt = $this->mysqli->prepare($query);

            $tipoParametri = $this->getTipoParametri(...$parametri);

            $stmt->bind_param($tipoParametri, ...$parametri);

            if($stmt->execute()){
                $stmt->close();
                return true;
            }
            else{
                echo $stmt->error;
                $stmt->close();
                return false;
            }
        }

        public function seleziona($query, ...$parametri){
            $stmt = $this->mysqli->prepare($query);

            $tipoParametri = $this->getTipoParametri(...$parametri);

            if($tipoParametri != ""){
                $stmt->bind_param($tipoParametri, ...$parametri);
            }

            if($stmt->execute()){
                $result = $stmt->get_result();

                if($result->num_rows > 0){
                    $rows = array();
                    while($row = $result->fetch_assoc()){
                        $rows[] = $row;
                    }
    
                    $stmt->close();
                    return $rows;
                }
                else{
                    return "vuoto";
                }
            }
            else{
                return "errore";
            }
        }

        public function elimina($query, ...$parametri){
            $stmt = $this->mysqli->prepare($query);

            $tipoParametri = $this->getTipoParametri(...$parametri);

            $stmt->bind_param($tipoParametri, ...$parametri);

            if($stmt->execute()){
                $stmt->close();
                return true;
            }
            else{
                $stmt->close();
                return false;
            }
        }

        public function aggiorna($query, ...$parametri){
            $stmt = $this->mysqli->prepare($query);

            $tipoParametri = $this->getTipoParametri(...$parametri);
            
            $stmt->bind_param($tipoParametri, ...$parametri);

            if($stmt->execute()){
                $stmt->close();
                return true;
            }
            else{
                $stmt->close();
                return false;
            }
        }

        public function chiudiConnessione(){
            $this->mysqli->close();
        }
    }