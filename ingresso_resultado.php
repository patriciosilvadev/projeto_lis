<?php
    require_once("db.class.php");
    $objDb = new db();
    $link = $objDb->conecta_mysql();
    $cal = $_POST['cal'];
    $sqls = "SELECT COUNT(cal) AS total FROM cal_res WHERE CAL = $cal AND `STATUS` IN('digitado')";
    @$resCont = mysqli_fetch_array( mysqli_query($link, $sqls) );
    if( $resCont['total'] > 0){
?>

    
    <!--  -->
<script>
    $( function() {
        var $signupForm = $( '#SignupForm' );
      
        $signupForm.validate({errorElement: 'em'});
      
        $signupForm.formToWizard({
          submitButton: 'SaveAccount',
          nextBtnClass: 'btn btn-primary next',
          prevBtnClass: 'btn  prev',
          buttonTag:    'button',
          validateBeforeNext: function(form, step) {
            var stepIsValid = true;
            var validator = form.validate();
            $(':input', step).each( function(index) {
              var xy = validator.element(this);
              stepIsValid = stepIsValid && (typeof xy == 'undefined' || xy);
            });
            return stepIsValid;
          },
          progress: function (i, count) {
            $('#progress-complete').width(''+(i/count*100)+'%');
          }
        });
      });
</script>
<div id='progress'><div id='progress-complete'></div></div>
<form id="SignupForm" action="">
    <?php
        $sql = "SELECT DISTINCT(tb.descricao) AS nome, cal.mne AS mne
        FROM tabela_convenio AS tb
        INNER JOIN exame AS exa 
        ON tb.mne = exa.id
        INNER JOIN rel_cal_exames AS cal
        ON exa.mne = cal.mne
        WHERE cal.cal = $cal ";
        $sql = mysqli_query($link,$sql);
        while ( $exame = mysqli_fetch_array($sql)) {
    ?>
    <fieldset>
        <legend><?php echo $exame['nome'];?></legend>
        <?php
            $sqlmne = "SELECT * from cal_res WHERE cal = $cal  AND mne = '$exame[mne]' ORDER BY seq asc";
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
                <input id="Name" type="<?php echo$type?>" class="pula"  name="<?php echo$mne['id']?>" style="display: <?php echo$campo_texto;?>" value="<?php echo$mne['res']?>"/> <div style="display:  <?php echo$campo_texto;?>">Referencia:</div>
            </div>




        <?php } ?>
    </fieldset>
        <?php } ?>
        
    <fieldset>
            <div class="alert alert-danger text-center" role="alert">
                Não existe mais exames
            </div>
    </fieldset>
    <p>
        <div id="SaveAccount">
            <div  class="btn button" id="finalizar">Ingressar</div>
        </div>
    </p>
</form>

</div>
<?php

            }
            else{
?>



<div class="alert alert-danger" role="alert">
  Sem exames para liberação!
</div>

<?php } ?>