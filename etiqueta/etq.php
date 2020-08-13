<?php

require('rotation.php');
require_once('barcode.inc.php');

require_once('db.class.php');
  $objDb = new db();
  $link = $objDb->conecta_mysql();

class PDF extends PDF_Rotate
{
function Header()
{
}

function RotatedText($x,$y,$txt,$angle)
{
	//Text rotated around its origin
	$this->Rotate($angle,$x,$y);
	$this->Text($x,$y,$txt);
	$this->Rotate(0);
}

function RotatedImage($file,$x,$y,$w,$h,$angle)
{
	//Image rotated around its upper-left corner
	$this->Rotate($angle,$x,$y);
	$this->Image($file,$x,$y,$w,$h);
	$this->Rotate(0);
}
}

$cal = $_GET['cal'];
$pdf=new PDF();


$sql = "SELECT cal,dt_atendimento,pos.nome as posto,pac.nome,cpf,sexo,nasc,con.nome as convenio
FROM cad_paciente pac inner join posto pos on pac.posto = pos.id
inner join convenio con on con.id = pac.convenio
where cal = '$cal'";
$sql = mysqli_query( $link, $sql );
$sqlDadosPaciente = mysqli_fetch_array( $sql );


//--Qtd de Etiquetas
$sql = "SELECT count(*) as qtd from (
SELECT concat(material,recipiente) as mat_rec FROM `rel_cal_exames` exm
inner join rel_exame_tabela tb
on exm.procedimento = tb.procedimento
INNER JOIN exame mnes
on tb.mne = mnes.id
WHERE cal = '$cal' group by concat(material,recipiente)) qtdetq";
$sql = mysqli_query( $link, $sql );
$qtdetq1 = mysqli_fetch_array( $sql );


//--Separando exames por etiquetas
$sql = "SELECT concat(material,recipiente) as mat_rec FROM `rel_cal_exames` exm
inner join rel_exame_tabela tb
on exm.procedimento = tb.procedimento
INNER JOIN exame mnes
on tb.mne = mnes.id
WHERE cal = '$cal' group by concat(material,recipiente)";
$sql = mysqli_query( $link, $sql );
        while ( $dado = mysqli_fetch_array( $sql ) ) {
        	$idEtq[] = $dado['mat_rec'];

        }


for ($i=0; $i < $qtdetq1['qtd']; $i++) { 
	$sql = "SELECT mnes.mne as nomeExame FROM `rel_cal_exames` exm
	inner join rel_exame_tabela tb
	on exm.procedimento = tb.procedimento
	INNER JOIN exame mnes
	on tb.mne = mnes.id
	WHERE cal = '$cal' AND concat(material,recipiente) = $idEtq[$i]";

	$sql = mysqli_query( $link, $sql ) or die( mysqli_error($link));




	$pdf->AddPage();

	$code_number = $sqlDadosPaciente['cal'].$idEtq[$i];
	new barCodeGenrator($code_number ,1, "img/$code_number.gif", 140, 70, true);
	$vNome = array();
	$contExame = 1;
	while ( $dado = mysqli_fetch_array( $sql ) ) {
   		if ($contExame >= 3){
   			$vNome[] = $dado['nomeExame'].';';
   			$contExame = 1;
   		}else{
			$vNome[] = $dado['nomeExame'].',';
   		}
		$contExame++;
   		//echo $vNome;
	}	
	$arrayexame = implode("",$vNome); //array->string
	$arrayexame2 = explode(";",$arrayexame); //string->array
//echo count($arrayexame2);
	$vcont = 0;
   	$vcont2 = 16;
	for ($j=0; $j < count($arrayexame2); $j++) { 
   		//echo $arrayexame2[$j];
   		$pdf->SetFont('Arial','B',4);
		$pdf->Text(30, $vcont2,$arrayexame2[$vcont]);
		$vcont++;
		$vcont2 = $vcont2 + 2;
	}

	$pdf->SetFont('Arial','B',5);
	$pdf->Text(2, 2,$sqlDadosPaciente['nome']);

	$pdf->SetFont('Arial','B',5);
	$pdf->Text(2, 4,'NASCIMENTO:');

	$pdf->SetFont('Arial','',5);
	$pdf->Text(15, 4,$sqlDadosPaciente['nasc'] .' | ');

	$pdf->SetFont('Arial','B',5);
	$pdf->Text(25, 4,' SEXO:');

	$pdf->SetFont('Arial','',5);
	$pdf->Text(31, 4,$sqlDadosPaciente['sexo']);

	$pdf->SetFont('Arial','B',5);
	$pdf->Text(2, 6,'CPF:');

	$pdf->SetFont('Arial','',5);
	$pdf->Text(7, 6,$sqlDadosPaciente['cpf']. ' |');
	
	$pdf->SetFont('Arial','',5);
	$pdf->Text(21, 6,$sqlDadosPaciente['convenio']);

	$pdf->line(2,7,45,7);

	$pdf->SetFont('Arial','B',5);
	$pdf->Text(2, 9,'POSTO:');
	$pdf->SetFont('Arial','',5);
	$pdf->Text(14.5, 9,$sqlDadosPaciente['posto']);

	$pdf->SetFont('Arial','B',5);
	$pdf->Text(2, 11,'ATENDIMENTO:');
	$pdf->SetFont('Arial','',5);
	$pdf->Text(16, 11,$sqlDadosPaciente['dt_atendimento']);
	
	$pdf->SetFont('Arial','B',5);
	$pdf->RotatedText(3,21,'URGENTE',90);


	$pdf->Image("img/$code_number.gif",4,12,26,13);
	


	$pdf->SetFont('Arial','',4);
	$pdf->Text(2, 26,' | SETOR');

	unlink("img/$code_number.gif");
	
}

$pdf->Output();


?>
