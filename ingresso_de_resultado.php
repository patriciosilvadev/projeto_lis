<?php

    session_start();
    date_default_timezone_set('America/Sao_Paulo');
    unset($_SESSION['exame']);
    unset($_SESSION['convenio_busca_exame']);
 
    $token = md5(date("Y-m-d h:i:s"));
    $_SESSION['token'] = $token;
    require_once("validar/class/db.class.php");
    $objDb = new db();
    $link = $objDb->conecta_mysql();

    
?>
<!DOCTYPE HTML>
<html lang="pt-br">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Postos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="shortcut icon" href="img/laboratorio.svg" />
    <script src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

    <script type="text/javascript" src="js/jquery.mask.min.js"></script>
    <script src="http://jqueryvalidation.org/files/dist/jquery.validate.js"></script>
    

    <script type="text/javascript" src="js/ingresso_resultado.js"></script>
    <!--  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"></script>
    <script src="js/jquery.formtowizard.js"></script>
    <script src="js/validador.js"></script>

    <link rel="stylesheet" href="css/formToWizard.css">
</head>

<body>

    <?php
    	require_once('camada1.php');
    	
    	require_once('camada2.php');
    	?>


    <div class="container-fluid col-md-12">
        <div class="card">
            <div class="card-header">
                <strong>Cadastro de Pacientes</strong>
            </div>
            <div class="card-body">
            <div class="row wrap"><div class="col-lg-12">
            <div class="form-group col-md-6 " >
                            <label for="calIngresso">CAL</label>
                            <input type="text" class="form-control pula  form-control-sm" id="calIngresso"
                                placeholder="Posto de Atendimento" name="calIngresso" >
                        </div>
<div id="ingresso">
</div>
</div></div>
</body>
<script type="text/javascript" src="js/jquery.mask.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<!--   Core JS Files   -->






</html>