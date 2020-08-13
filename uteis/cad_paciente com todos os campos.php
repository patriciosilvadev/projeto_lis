<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
    	 <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/interno.css">
    <!-- Fonts and icons -->
   
    <script type="text/javascript" src="js/jquery.mask.min.js"></script>
    
      <script
    src="https://code.jquery.com/jquery-3.3.1.js"
    integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
    crossorigin="anonymous"></script>

    <script src="http://jqueryvalidation.org/files/dist/jquery.validate.js"></script>
    <script type="text/javascript" src="js/validador.js"></script>

    <title>LABORATÓRIO BLESSING - COVID19</title>
    <script type="text/javascript">
    

    </script>
    <style>

    </style>
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
    			<div class="form-row">
                    <div class="form-group col-md-8">
                      <label for="nome">Paciente</label>
                      <input type="text" class="form-control pula  form-control-sm" id="nome" placeholder="Nome" name="nome" required="">
    </div>
    <div class="form-group col-md-2">
      <label for="tel">Telefone 01</label>
      <input type="text" class="form-control pula form-control-sm" id="tel1" placeholder="Contato 01" name="tel1">
    </div>
    <div class="form-group col-md-2">
      <label for="tel">Telefone 02</label>
      <input type="text" class="form-control pula form-control-sm" id="tel2" placeholder="Contato 02 " name="tel2">
    </div>
  </div>

<div class="form-row ">
    <div class="form-group col-md-2">
      <label for="cpf">CPF</label>
      <input type="text" class="form-control pula form-control-sm" id="cpf" placeholder="CPF" name="cpf">
    </div>
    <div class="form-group col-md-2">
      <label for="rg">RG</label>
      <input type="text" class="form-control pula form-control-sm" id="rg" placeholder="RG" name="rg">
    </div>
    <div class="form-group col-md-2">
      <label for="nascimento">Nascimento</label>
      <input type="text" class="form-control pula form-control-sm" id="nascimento" placeholder="___/___/_____" name="nascimento">
    </div>
    <div class="form-group col-md-6">
      <label for="profissao">Profissão</label>
      <input type="text" class="form-control pula form-control-sm" id="profissao" placeholder="Profissão" name="profissao">
    </div>
</div>
<div class="form-row ">
    <div class="form-group col-md-2">
      <label for="contato_data">Data Contato</label>
      <input type="text" class="form-control pula form-control-sm" id="contato_data" placeholder="___/___/_____" name="contato_data">
    </div>
    <div class="form-group col-md-6">
      <label for="contato_nome">Nome Contato</label>
      <input type="text" class="form-control pula form-control-sm" id="contato_nome" placeholder="Nome Contato" name="contato_nome">
    </div>
</div>
<div class="form-row ">
    <div class="form-group col-md-6">
      <label for="endereco">Endereço</label>
      <input type="text" class="form-control pula form-control-sm" id="endereco" placeholder="Endereço" name="endereco">
    </div>
    <div class="form-group col-md-2">
      <label for="bairro">Bairro</label>
      <input type="text" class="form-control pula form-control-sm" id="bairro" placeholder="Bairro" name="bairro">
    </div>
    <div class="form-group col-md-2">
      <label for="cidade">Cidade</label>
      <input type="text" class="form-control pula form-control-sm" id="cidade" placeholder="Cidade" name="cidade">
    </div>
    <div class="form-group col-md-2">
      <label for="cep">CEP</label>
      <input type="text" class="form-control pula form-control-sm" id="cep" placeholder="00000-000" name="cep">
    </div>
</div>

  <div class="form-row">
  <div class="form-group col-md-6">
      <label for="email">E-mail</label>
      <input type="email" class="form-control pula form-control-sm" id="email" placeholder="E-mail" name="email">
    </div>
  </div>

  <div class="form-row">
  <div class="form-group col-md-3">
      <label for="data_agendamento">Agendamento: Data e Hora</label>
      <input type="datetime-local" class="form-control pula form-control-sm" id="data_agendamento"  name="data_agendamento">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-12">
      <label for="obs">Observação</label>
    <textarea  class="form-control pula form-control-sm" id="obs" name="obs" rows="2" ></textarea>
    </div>
  </div>
  
   <button type="submit" id="enviaa" class="btn btn-primary col-md-12">AGENDAR</button>
</form>
  			</div>
		</div>
 	</div>  	
    	
   
    </body>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!--   Core JS Files   -->
  
  <script type="text/javascript" src="js/jquery.mask.min.js"></script>
  

   
</html>
