<?php
    session_start();
    date_default_timezone_set('America/Sao_Paulo');

    require_once("class/class.exame.php");
    $exame = new Exame();

    require_once("class/class.formExame.php");
    $formExame = new FormExame();

    require_once("class/class.cal.php");
    $objCal = new Cal();

    require_once("class/class.posto.php");
    $objPosto = new Posto();

    require_once("class/class.paciente.php");
    $objPaciente = new Paciente();

    require_once("class/class.ingressoResult.php");
    $objIngressoResult = new IngressoResult();

    require_once("class/class.medico.php");
    $objMedico = new Medico();

    switch ( intval( $_GET['validar'] ) ) { /* PENDENTE: criptografar a requisição.  */
        case 1:
            $cont       = 0;
            $mne        = $_POST["mne"];
            $nome       = $_POST["nome"];
            $prazo      = $_POST["prazo"];
            $ml         = $_POST["ml"];
            $metodo     = $_POST["metodo"];
            $material   = $_POST["material"];
            $setor      = $_POST["setor"];
            $recipiente = $_POST["recipiente"];
            !empty( $_POST["laudo_sozinho"] ) ? $laudoSozinho = 1 : $laudoSozinho = 0;
            !empty( $_POST["dum_obrigatorio"] ) ? $dumObrigatorio = 1 : $dumObrigatorio = 0;

            unset( $_POST["laudo_sozinho"] );
            unset( $_POST["dum_obrigatorio"] );
            foreach ($_POST as $key => $value) {
                if ( empty($value) ) {
                    $cont++;
                }
            }
            if( $cont == 0){
                echo $exame->cadExame($mne, $nome, $prazo, $ml, $metodo, $material, $laudoSozinho, $dumObrigatorio, $setor, $recipiente);
            }else{
                echo 0;
            }
            
           
            break;
        case 2:
            $mne = $_POST['mne'];
            echo $exame->verificaMneSeExiste( $mne );
            break;
        case 3:
            var_dump($_POST);

            $turma = $_POST['mne'];

            $aluno = array(
            "mne" => $turma,
            "nome" => 'nome',
            );
            $_SESSION['exame'][$turma] = $aluno;
            break;
        case 4:
           
            unset(  $_SESSION['exame'][$_POST['mne']] );
            
            break;
        case 5:
            $idTb = $_POST['id_tb'];
            $mne = $_POST['mne'];
         
             if($mne == "*"){
                $formExame->getExame($_SESSION['convenio_busca_exame'], $idTb );
            }else{
                $formExame->getExame($_SESSION['convenio_busca_exame'], $mne);
            }  

            break;
        case 6:
           
            $material   = $_POST["material"];
            $mneId      = $_POST["mne"];
            $idTb       = $_POST["id_tb"];
            $convenio   = $_SESSION['convenio_busca_exame'];

            $formExame->insertExameArrayGrid( $convenio, $idTb, $material );

            
            break;
        case 7: 
            $cal = $_POST['cal'];
            $posto = substr($cal, 0, 3); /* Codigo posto. */
            if( strlen( $cal ) == 10 ){ /* CAL com 10 digitos. */

            }else
            if( strlen( $cal ) == 12 ){ /* CAL com 12 digitos. */

            }else
            if( strlen( $cal ) == 3 ){/* CAL AUTOMATICO */
                $conveioPosto['conveio'] = $objPosto->verificaConvenioDePosto($posto);
                if($conveioPosto['conveio'] == NULL){ /* Posto sem convenio ou não existe  */
                    $conveioPosto["cal"] = NULL;
                    $conveioPosto["nome_posto"] = NULL;
                    $conveioPosto["valido"] = "0";
                    $conveioPosto["erro"] = "erro_posto_invalido_02";
                    $conveioPosto["obs_erro"] = "Posto sem convenio ou não existe";
                    echo json_encode($conveioPosto);
                }else{
                    $conveioPosto["valido"] = "1";
                    $conveioPosto["nome_posto"] = $objPosto->getPosto($posto);;
                    $conveioPosto["erro"] = NULL;
                    $conveioPosto["obs_erro"] = NULL;
                    $conveioPosto["id_posto"] = $posto;
                    $conveioPosto["data_atual"] = date("Y-m-d");
                    $conveioPosto["hora_atual"] = date('h:i');
                    $conveioPosto["cal"] = intval($objCal->retornaCalValida($posto));
                    echo json_encode($conveioPosto);
                }
    
            }else{ /* CAL diferente de 10 OU 12 digitos. */
                $conveioPosto["cal"] = NULL;
                $conveioPosto['convenio'] = null;
                $conveioPosto["valido"] = "0";
                $conveioPosto["erro"] = "erro_posto_invalido_01";
                $conveioPosto["obs_erro"] = "Quantidade de caracteres inválido.";
                echo json_encode($conveioPosto);
            }
        
            break;
        case 8: /* Salvar convenio em session */
            $_SESSION['convenio_busca_exame'] = $_POST['convenio'];
            
           
            break;
        case 9:  /* Cadastrop de paciente */
            /* 
                Refatorar: Antes de cadastrar verificar se já tem a mesma CAL cadastrada
            */
            $posto          = $_POST["id_posto"];
            $dtAtendimento  = $_POST["dt_atendimento"];
            $nome           = strtoupper($_POST["nome_paciente"]);
            $cpf            = $_POST["cpf"];
            $nasc           = $_POST["nascimento"];   
            $convenio       = explode( '*',$_POST["convenio"]);
            $nomeConvenio   = $_POST["nome_convenio"];
            $calSistema     = $_POST["cal_sistema"];
            $sexo           = $_POST["sexo"];
            $rg             = $_POST["rg"];
            $solicitante    = $_POST["medico_id"];
            $hr_atendimento = $_POST["hr_atendimento"];
            if($_SESSION['token'] == $_POST['token']){/* Verificação do token para cadastro */
                if(!isset($_SESSION['exame'])){/* Sem exames cadastrado */
                    echo "erro_sem_exames";
                }else{
                    echo$objPaciente->cadPaciente( $calSistema, $nome, $nasc, $cpf, $sexo, $posto, $convenio[0], $dtAtendimento, $_SESSION['exame'], $rg, $solicitante, $hr_atendimento );
                    $objIngressoResult->geraTabelaResult($calSistema,$_SESSION['exame']);
                    
                }
            }else{
                
            }
            break;
        case 10: 
            echo 
            $objIngressoResult->ingressoRsult($_POST);
            break;
        case 11: /* Valida medico tela cad_paciente */
         
            echo $objMedico->buscaMedicoComCodigo($_POST['id_medico']);
        break;
        case 12: /* Cancelar ou excluir CAL */
            echo var_dump($_POST);
            unset($_SESSION['exame']);
            unset($_SESSION['convenio_busca_exame']);
            break;
        
        
        
        default:
            break;
    
        
        }
    