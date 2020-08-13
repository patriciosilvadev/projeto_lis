<?php
require_once("db.class.php");

class Medico extends db{
    private $link;
    private $codCalInicial = "0000000";

    function __construct(){
        $objDb = new db();
        $this->link = $objDb->conecta_mysql();
    }

    function buscaMedicoComCodigo($codigo){
        $sql = "SELECT *  FROM medico WHERE cod = '$codigo'";
        $sql = mysqli_fetch_array( mysqli_query( $this->link, $sql ) );
  
        if(!isset($sql['id']) == false){
            return '{
                "id": "'.$sql['id'].'",
                "cod": "'.$sql['cod'].'",
                "nome": "'.$sql['nome'].'",
                "valido": 1
            }';
        }else{
            return '{
                "id": "NULL",
                "cod": "NULL",
                "nome": "NULL",
                "valido": 0
            }';
        }
        
    }

  
}
/* 
$medico = new Medico();
echo $medico->buscaMedicoComCodigo('52-9444-9'); */