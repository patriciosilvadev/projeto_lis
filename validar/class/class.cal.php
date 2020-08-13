<?php
 require_once("db.class.php");

class Cal extends db{
    private $link;
    private $codCalInicial = "0000000";

    function __construct(){
        $objDb = new db();
        $this->link = $objDb->conecta_mysql();
    }

    function retornaCalValida( $posto ){ /* Função que retorna uma CAL valida para cadastro automatico.  */
        $sql = "SELECT cal FROM CAD_PACIENTE WHERE cal LIKE '$posto%' ORDER BY cal DESC  LIMIT 1";
        $res = mysqli_fetch_array( mysqli_query($this->link, $sql) );
        if( empty($res['cal']) ){ /* Verifica se existe CAL cadastrada: Se não houver cadastro inicia a primeira CAL POST + 0000000 */
            return $posto.$this->codCalInicial;
        }else{ /* Caso já exista CAL iniciada acrescenta mais 1 */
            return intval($res['cal']) + 1; /* Refatorar o código: Verificar se já existe a CAL antes de entregar */
        }
    }
}

/*  $cal = new Cal();
echo $cal->retornaCalValida(777);  */