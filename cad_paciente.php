<?php
    session_start();
    date_default_timezone_set('America/Sao_Paulo');
    unset($_SESSION['exame']);
    unset($_SESSION['convenio_busca_exame']);
 
    $token = md5(date("Y-m-d h:i:s"));
    $_SESSION['token'] = $token;


?>
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
    <script type="text/javascript" src="js/validador.js"></script>
    <link rel="stylesheet" href="css/cad_paciente.css">
</head>

<body>

    <?php
    	require_once('camada1.php');
    	
    	require_once('camada2.php');
    	?>


    <div class="container-fluid col-md-12">
        <div class="card">
            <div class="card-header">
                <strong>Cadastro de Pacientesd</strong>
            </div>

            <div class="" role="alert" id="report_sistem" style="display: none"></div>

            <div class="text-center">
                <!--  <div class="col-12" style="display: none" id="etiqueta"> -->
                <input type="hidden" id="cal_etx" name="cal_etx" value="">
            </div>
           
        <fieldset class="border m-2 ">
                <legend class="w-auto">Cadastro de Pacientes</legend>
        <div class="form-group col-md-3 my-3">

            <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                    <span class="input-group-text">CAL</span>
                </div>
                <input type="number" class="form-control" id="cal" name="cal"
                    placeholder="Código de Atendimento Laboratorial" required="">
            </div>
            </div>

  <div>
        <form id="form" class="hide">
            <!-- aplicar a class hide -->
            <fieldset class="border m-2 ">
                <legend class="w-auto">Dados de Paciente</legend>
                <div class="card-body">
                    <div class="form-row">




                    </div>

                    <div class="form-row  ">
                        <div class="form-group col-md-4 ">
                            <label for="nome_paciente">Paciente</label>
                            <input type="text" class="form-control pula  form-control-sm toUpperCase" id="nome_paciente"
                                placeholder="Nome" name="nome_paciente">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="rg">RG</label>
                            <input type="text" class="form-control pula form-control-sm" id="rg" placeholder="rg"
                                name="rg">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="cpf">CPF</label>
                            <input type="text" class="form-control pula form-control-sm" id="cpf" placeholder="CPF"
                                name="cpf">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="nascimento">Nascimento</label>
                            <input type="date" class="form-control form-control-sm pula" id="nascimento"
                                name="nascimento">

                        </div>


                        <div class="form-group col-md-2">
                            <label for="sexo">Sexo</label>
                            <select class="custom-select custom-select-sm pula" id="sexo" name="sexo">
                                <option value="">...</option>
                                <option value="M">MASCULINO</option>
                                <option value="F">FEMININO</option>
                            </select>
                        </div>
                    </div>


            </fieldset>
            <fieldset class="border m-2 ">
                <legend class="w-auto">Dados do Atendimento</legend>
                <div class="card-body">
                    <div class="form-row ">
                        <div class="form-group col-md-6">
                            <label for="posto">Posto</label>
                            <input type="text" class="form-control pula form-control-sm" id="posto"
                                placeholder="Posto de Atendimento" name="posto" readonly="">
                        </div>
                        <div class="form-group col-md-2 ">
                            <label for="dt_atendimento">Data do Atendimento</label>
                            <input type="date" class="form-control pula  form-control-sm" id="dt_atendimento"
                                placeholder="Posto de Atendimento" name="dt_atendimento">
                        </div>

                        <div class="form-group col-md-2">
                            <label for="hr_atendimento">Hora do Atendimento</label>
                            <input type="time" class="form-control pula  form-control-sm" id="hr_atendimento"
                                name="hr_atendimento">
                        </div>
                    </div>

                    <div class="form-row ">

                        <div class="form-group col-md-3">
                            <label for="convenio">Convênio</label>
                            <select class="custom-select pula  custom-select-sm" id="convenio" name="convenio">
                                <option value="NULL">...</option>
                            </select>
                        </div>
                        <div class="form-group col-md-9">
                            <label for="nome_convenio">Nome do Convênio</label>
                            <input type="text" class="form-control pula  form-control-sm " id="nome_convenio"
                                placeholder="Selecione o convênio!" name="nome_convenio" readonly="">
                        </div>

                    </div>
                    <div class="form-row ">

                        <div class="form-group col-md-2">
                            <label for="medico_id">COD Solicitante</label>
                            <input type="text" class="form-control form-control-sm " id="medico_id"
                                placeholder="NÃO INFORMADO" name="medico_id">
                            <p class="text-danger" id="erro_medico"></p>
                        </div>
                        <div class="form-group col-md-10">
                            <label for="medico_nome">Nome do Solicitante</label>
                            <input type="text" class="form-control form-control-sm " id="medico_nome"
                                placeholder="NÃO INFORMADO" name="medico_nome" readonly="">
                            <div id="getMedico"></div>
                        </div>

                    </div>
                </div>
            </fieldset>
            <fieldset class="border m-2 ">
                <legend class="w-auto">Cadastro de Exames</legend>
                <div class="card-body">
                    <div class="form-row my-3">
                        <div class="form-group col-md-3">
                            <label for="mne">MNE</label>
                            <input type="text" class="form-control form-control-sm toUpperCase" id="mne"
                                style="display: show">
                            <div class="text-danger" id="invalido" style="display: none"><strong>Exame não liberado ou
                                    não
                                    existe!!</strong></div>
                            <div id="get_exames"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mne_nome">Exame</label>
                            <input type="text" class="form-control form-control-sm " id="mne_nome" name="mne_nome"
                                readonly="">

                        </div>
                        <input type="hidden" id="id_tb" value="" name="id_tb">
                        <div class="form-group col-md-3 ">
                            <label for="material">Material</label>
                            <input type="text" class="form-control form-control-sm .material" id="material"
                                name="material" readonly="">
                            <div id="get_material"></div>
                        </div>
                    </div>
                    <input type="hidden" id="mne_id" name="mne_id">
                    <input type="hidden" id="idtabela" name="idtabela">
                    <input type="hidden" id="token" name="token" value="<?php echo$token; ?>">
                    <input type="hidden" id="cal_sistema" name="cal_sistema" value="">
                    <input type="hidden" id="id_posto" name="id_posto" value="">
                    <hr>
                    <div id="tabelaMne"></div>


        </form>
        
        
        

    </div>
    </div>

        <div id="button_form" class="button_form" style="display: none">
            <div class="d-flex flex-row-reverse">
                <div class="p-2 text-center btn "  id="enviaf">
                    <img src="img/save.png" alt="..." class="img-thumbnail "  style="height: 55px"><br>Salvar
                </div>
                <div class="p-2 text-center btn" id="cancelar"><img src="img/cancel.png" alt="..." class="img-thumbnail "  style="height: 55px"><br>Cancelar</div>
            </div>
            

            <div id="carregamento" style="display: none">
                <div class="d-flex flex-row-reverse" >
                    <div class="p-2 text-center ">
                    <button class="btn btn-primary" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Cadastrando Paciente ...
                    </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalEtq" tabindex="-1" role="dialog" aria-labelledby="modalEtqLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEtqLabel">
                        <div id="modalEtqLabelMsg"></div>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-12" id="etiqueta">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                    
                </div>
            </div>
        </div>
       
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