<?php
    /* cass.examesDoInputCadPaciente.php */
    require_once("db.class.php");

class ExamesDoInputCadPaciente  extends db{
    private $link;

    function __construct(){
        $objDb = new db();
        $this->link = $objDb->conecta_mysql();
    }

    function carregaExamesDoConvenio( $conveio ){
        $sql = "CALL pcd_exames_vs_convenio($conveio)";
        $sql = mysqli_query( $this->link, $sql );
        while ( $res = mysqli_fetch_array( $sql ) ) {
            $exames[] = array(
                "id" => intval($res['id']),
                "mne" => $res['mne'],
                "nome" => $res['nome'],
                "procedimento" => $res['procedimento'],
                "material" => $res['material'],
                "valor" => number_format($res['valor'], 2, ',', '.'),
                "nome_ref" => $res['exame_referencia']
            );
        }
        return $exames;
    }
}

$examesDoInputCadPaciente = new ExamesDoInputCadPaciente();
$res = $examesDoInputCadPaciente->carregaExamesDoConvenio(1);
echo "<pre>";
var_dump( $res );