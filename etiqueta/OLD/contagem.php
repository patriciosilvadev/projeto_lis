<?php


require_once('db.class.php');
  $objDb = new db();
  $link = $objDb->conecta_mysql();




$sql = "SELECT concat(material,recipiente) as mat_rec FROM `rel_cal_exames` exm
inner join rel_exame_tabela tb
on exm.procedimento = tb.procedimento
INNER JOIN exame mnes
on tb.mne = mnes.id
WHERE cal = '8880000008' group by concat(material,recipiente)";
$sql = mysqli_query( $link, $sql );
        while ( $dado = mysqli_fetch_array( $sql ) ) {
        	$idEtq[] = $dado['mat_rec'];

        }



for ($i=0; $i < 1; $i++) { 

//$xxx2 = str_replace("\n","","'".$idEtq[$i]."'");
//echo $xxx2;

$sql = "SELECT mnes.mne as nomeExame FROM `rel_cal_exames` exm
inner join rel_exame_tabela tb
on exm.procedimento = tb.procedimento
INNER JOIN exame mnes
on tb.mne = mnes.id
WHERE cal = '8880000008' AND concat(material,recipiente) = $idEtq[0]";

//echo $sql;

//$sql = mysqli_query( $link, $sql );
//if (!$sql) {
 //   printf("Error: %s\n", mysqli_error($link));
  //  exit();
//}

//while ( $nomexm = mysqli_fetch_array( $sql ) ) {
        	
 // echo $nomExmEtq[] = $nomexm['nomeExame'].', ';

 //       }
$sql = mysqli_query( $link, $sql ) or die( mysqli_error($link));

while ( $dado = mysqli_fetch_array( $sql ) ) {
   $vNome      = $dado["nomeExame"]."<br>";
   echo $vNome;
}	

}
?>

