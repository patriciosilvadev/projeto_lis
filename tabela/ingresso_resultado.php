<?php
    require_once("../db.class.php");
    $objDb = new db();
    $link = $objDb->conecta_mysql();
    $cal = $_POST['cal'];
?>

 


    <script type="text/javascript" src="js/jquery.mask.min.js"></script>
    <script src="http://jqueryvalidation.org/files/dist/jquery.validate.js"></script>
    

    <script type="text/javascript" src="js/ingresso_resultado.js"></script>
    <!--  -->

    <script src="js/jquery.formtowizard.js"></script>
    <script src="js/validador.js"></script>

    <link rel="stylesheet" href="css/formToWizard.css">

    

    
    <!--  -->
<div class="container">
<div class="container">
<div id='progress'><div id='progress-complete'></div></div>
<form id="SignupForm" action="">
    <?php
        $sql = "SELECT DISTINCT(tb.descricao) AS nome, cal.mne AS mne
        FROM tabela_convenio AS tb
        INNER JOIN exame AS exa 
        ON tb.mne = exa.id
        INNER JOIN rel_cal_exames AS cal
        ON exa.mne = cal.mne
        WHERE cal.cal = $cal";
        $sql = mysqli_query($link,$sql);
        while ( $exame = mysqli_fetch_array($sql)) {
    ?>
    <fieldset>
        <legend><?php echo $exame['nome'];?></legend>
        <?php
            $sqlmne = "SELECT * from cal_res WHERE cal = $cal AND mne = '$exame[mne]' ORDER BY seq asc";
            $sqlmne = mysqli_query($link,$sqlmne);
            while ( $mne = mysqli_fetch_array($sqlmne)) {
                if($mne['tipo_res'] == "TITULO"){
                    $type = "text";
                    $campo_texto = "none";
                }else
                if($mne['tipo_res'] == "NUMERICO"){
                    $type = "number";
                    $campo_texto = "show";
                }
        ?>  

  
            <div class="form-group">
                <label for="Name"><?php echo $mne['nome_filho'];?></label>
                <input id="Name" type="<?php echo$type?>" class="pula"  name="ok" style="display: <?php echo$campo_texto;?>" /> <div style="display:  <?php echo$campo_texto;?>">Referencia:</div>
            </div>




        <?php } ?>
    </fieldset>
        <?php } ?>
        
    <fieldset>
                Não existe mais exames
    </fieldset>
    <p>
        <div id="SaveAccount">
            <div  class="btn button" id="finalizar">Finalizar</div>
        </div>
    </p>
</form>

</div></div>
</div></div>