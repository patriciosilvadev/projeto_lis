<?php
require_once("db.class.php");

class Paciente extends db{
    private $link;

    function __construct(){
        $objDb = new db();
        $this->link = $objDb->conecta_mysql();
    }

    function cadPaciente( $cal, $nome, $nasc, $cpf, $sexo, $posto, $convenio, $dt_atendimento, $exames, $rg, $solicitante, $hr_atendimento ){
        $sql = "INSERT INTO `cad_paciente`(`id`, `cal`, `nome`, `nasc`, `cpf`, `sexo`, `posto`, `convenio`, `dt_atendimento`, `rg`, `solicitante`, `hr_atendimento`, `dt_cad`) VALUES 
        (
            NULL,
            '$cal',
            '$nome',
            '$nasc',
            '$cpf',
            '$sexo',
            '$posto',
            '$convenio',
            '$dt_atendimento',
            '$rg',
            '$solicitante',
            '$hr_atendimento',
            NULL
        )";
        $resPaciente = mysqli_query($this->link,$sql);
        foreach ($exames as $key => $value) {
            $sql = "INSERT INTO `rel_cal_exames`(`id`, `cal`, `mne`, `id_mne`, `id_tb_convenio`, `procedimento`, `valor`) VALUES 
            (
                NULL,
                '$cal',
                '$value[mne]',
                '$value[id_mne]',
                '$value[id_tabela_convenio]',
                '$value[procedimento]',
                '$value[valor]'
            )";
            $resExames = mysqli_query($this->link,$sql);
        }
        if($resPaciente == true && $resExames == true){
            echo$cal;
        }else{
            echo"0";
        }
    }
}