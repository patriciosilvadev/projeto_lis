<?php
require_once("db.class.php");

class Posto extends db{
    private $link;

    function __construct(){
        $objDb = new db();
        $this->link = $objDb->conecta_mysql();
    }

    function verificaConvenioDePosto( $posto ){ /* Verifica os convenios relacionados ao posto, caso não exista retorna NULL */
        $contConvenio = 0;
        $sql = "SELECT c.id AS id, c.nome AS nome 
        FROM re_posto_convenio p 
        INNER JOIN convenio c 
        ON p.convenio = c.id
        WHERE p.posto = $posto;";
        $sql = mysqli_query( $this->link, $sql );
         while( $res = mysqli_fetch_array( $sql ) ){
            $contConvenio++;
            $convenios[$res['id']] = array(
                "nome" => $res['nome']
                );
        } 
        if($contConvenio == 0){
            return NULL;
        }else{
            return $convenios;
        }
    }

    function getPosto( $posto ){
        $sql = "SELECT * FROM posto WHERE id = $posto";
        $res = mysqli_fetch_array( mysqli_query( $this->link, $sql ) );
        return $res['nome'];
    }
    
}

/* $posto = new Posto();
echo "<pre>";
echo var_dump( $posto->verificaConvenioDePosto(741) );  */