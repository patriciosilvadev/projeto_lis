<?php
 require_once("db.class.php");

class IngressoResult extends db{
    private $link;
  

    function __construct(){
        $objDb = new db();
        $this->link = $objDb->conecta_mysql();
    }

    function geraTabelaResult($cal, $exames){

        foreach ($exames as $key => $value) {
            $sql = "SELECT exa.mne AS mne, exa.prazo AS prazo, exa.ml AS ml, met.nome AS metodo, mat.material_nome AS material, exa.ls AS ls,
            exa.dum AS dum, se.nome AS setor, rec.recipiente_nome AS recipiente, mf.mne_filho AS filho, mf.nome AS nome, ts.nome AS tipo_res,
            uni.nome AS uni, rm.seq AS seq, tcv.id AS tb_convenio, ts.linha_result AS linha_result
            from rel_cal_exames AS rce
            INNER JOIN exame AS exa 
            ON rce.mne = exa.mne
            INNER JOIN materiais AS mat
            ON exa.material = mat.material_id
            INNER JOIN recipientes AS rec 
            ON exa.recipiente = rec.recipiente_id
            INNER JOIN metodo AS met
            ON exa.metodo = met.id
            INNER JOIN setor AS se
            ON exa.setor = se.id
            INNER JOIN rel_mne_filho as rm
            ON exa.id = rm.exame
            INNER JOIN mne_filho AS mf 
            ON rm.filho = mf.id
            INNER JOIN tipo_result AS ts 
            ON mf.res = ts.id
            INNER JOIN tabela_convenio tcv
            ON rce.id_mne = tcv.mne
            INNER JOIN uni_medida as uni
            ON mf.uni = uni.id
            WHERE rce.cal = '$cal' AND exa.mne = '$value[mne]';";
            $result = mysqli_query( $this->link, $sql );
            while ($row = mysqli_fetch_array($result)) {
                if($row['linha_result'] == 1){
                    $sql1 = "INSERT INTO `cal_res`(`id`, `cal`, `mne`, `prazo`, `ml`, `metodo`, `material`, `ls`, `dum`, `setor`, `recipiente`, `mne_filho`, `nome_filho`, `tipo_res`, `seq`, `uni`, `status`, `linha_result`) VALUES 
                    (
                        NULL,
                        '$cal',
                        '$row[mne]',
                        '$row[prazo]',
                        '$row[ml]',
                        '$row[metodo]',
                        '$value[material]',
                        '$row[ls]',
                        '$row[dum]',
                        '$row[setor]',
                        '$row[recipiente]',
                        '$row[filho]',
                        '$row[nome]',
                        '$row[tipo_res]',
                        '$row[seq]',
                        '$row[uni]',
                        'CADASTRADO',
                        '$row[linha_result]'
                     )";
                }else{
                    $sql1 = "INSERT INTO `cal_res`(`id`, `cal`, `mne`, `prazo`, `ml`, `metodo`, `material`, `ls`, `dum`, `setor`, `recipiente`, `mne_filho`, `nome_filho`, `tipo_res`, `seq`, `uni`, `status`, `linha_result`) VALUES 
                    (
                        NULL,
                        '$cal',
                        '$row[mne]',
                        '$row[prazo]',
                        '$row[ml]',
                        '$row[metodo]',
                        '$value[material]',
                        '$row[ls]',
                        '$row[dum]',
                        '$row[setor]',
                        '$row[recipiente]',
                        '$row[filho]',
                        '$row[nome]',
                        '$row[tipo_res]',
                        '$row[seq]',
                        '$row[uni]',
                        'DIGITADO',
                        '$row[linha_result]'
                     )";
                }
              
               mysqli_query( $this->link, $sql1 );
            }
           
        }
        
    }

    function ingressoRsult($result){
        foreach ($result as $key => $value) {
           /*  if(!empty($value)){ */
                $sql = "UPDATE cal_res SET `res` = '$value', `status` = 'DIGITADO' WHERE id = $key";
                mysqli_query( $this->link, $sql );
           /*  } */
            //
        }
        return 1;
       
    }

   
}
/* session_start();
$caIngressoResultl = new IngressoResult();
echo $caIngressoResultl->geraTabelaResult('8880000010',$_SESSION['exame']);  */