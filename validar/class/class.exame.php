<?php
 require_once("db.class.php");

class Exame extends db {
    private $link;

    function __construct(){
        $objDb = new db();
        $this->link = $objDb->conecta_mysql();
    }

    function cadExame($mne, $nome, $prazo, $ml, $metodo, $material, $laudoSozinho, $dum, $setor, $recipiente){
        $sqlExame = "INSERT INTO `exame`(`mne`, `nome`, `prazo`, `ml`, `metodo`, `material`, `ls`, `dum`, `setor`, `recipiente`) VALUES 
        (
            '$mne',
            '$nome',
            '$prazo',
            '$ml',
            '$metodo',
            '$material',
            '$laudoSozinho',
            '$dum',
            '$setor',
            '$recipiente'
        )";
        if( mysqli_query( $this->link , $sqlExame) ){
            return 1;
        }else{
            return 0;
        }
        
    }

    function verificaMneSeExiste( $mne ){
        $sql = "SELECT COUNT(id) as cont from exame WHERE mne = '$mne'";
        $res = mysqli_fetch_array( mysqli_query($this->link, $sql) );
        if( intval( $res['cont'])  ){
            return 1;
        }else{
            return 0;
        }
    }
}