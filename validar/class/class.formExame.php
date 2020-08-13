<?php
require_once("db.class.php");

class FormExame extends db {
    private $link;

    function __construct(){
        $objDb = new db();
        $this->link = $objDb->conecta_mysql();
    }

    function getExame( $convenio, $id_tabela_convenio ){
       $sql = "call pcr_get_exame_convenio_id($convenio,'$id_tabela_convenio');";
        $res = mysqli_fetch_array( mysqli_query( $this->link, $sql ) );

        if(!empty( $res['id'] )){
            echo $return = '{
                "id":"'.$res['id'].'",
                "mne":"'.$res['mne'].'",
                "id_mne":"'.$res['id_mne'].'",
                "nome":"'.$res['nome'].'",
                "material":"'.$res['material'].'",
                "valor":"'.$res['valor'].'",
                "valid": "1"
            }';
        }else{
            echo $return = '{
                "id":"NULL",
                "mne":"NULL",
                "id_mne":"NULL",
                "nome":"NULL",
                "material":"NULL",
                "valor":"NULL",
                "valid": "0"
            }';
        }
        
    }

    function queryExame( $mne ){
        $sql = "SELECT * FROM `exame` WHERE nome like '%$mne%'";
      
        while ( $res = mysqli_fetch_array( mysqli_query( $this->link, $sql ) )) {
            # code...
            $exame[] =  array(
                "nome"=> $res['nome']
            );
        }
        return $exame;

    }

    function insertExameArrayGrid( $convenio, $idMne, $material){
        
        $sql = "CALL pcr_get_exame_convenio_id($convenio, $idMne)";
        $res = mysqli_fetch_array( mysqli_query($this->link,$sql));
        $aluno = array(
            "mne" => $res['mne'],
            "id_mne" => $res['id_mne'],
            "nome" => $res['nome'],
            "material" => $material,
            "id_tabela_convenio" => $res['id'],
            "procedimento" => $res['procedimento'],
            "valor" => $res['valor']
            );
        $_SESSION['exame'][$res['id']] = $aluno;
        echo 1;
    }

}