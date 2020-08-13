<?php


?>
<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
    	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">   
        
        <title>Postos</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<link rel="shortcut icon" href="img/laboratorio.svg"/>
		<script
		src="https://code.jquery.com/jquery-3.3.1.js"
		integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
		crossorigin="anonymous"></script>
		<script type="text/javascript" src="js/jquery.mask.min.js"></script>
		<script src="http://jqueryvalidation.org/files/dist/jquery.validate.js"></script>
		<script type="text/javascript" src="js/validador.js"></script>
    </head>
    <body>
    	
    	<?php
    	require_once('camada1.php');
    	
    	require_once('camada2.php');
    	?>
    	
    	
	<div class="container-fluid col-md-12">
    	<div class="card">
  			<div class="card-header">
    			<strong>Cadastro de Exames</strong>
  			</div>
  			<div class="card-body">

	<form id="form" style="display: show" action="email/sac.php" method="post">
		<div class="form-row my-1" style="background: #FFFAFA">
			<div class="form-group col-md-2">
			<label for="mne">MNE</label>
			<input type="text" class="form-control pula  form-control-sm" id="mne" placeholder="mne" name="mne" >
			</div>
			<div class="form-group col-md-10">
			<label for="nome">NOME</label>
			<input type="text" class="form-control pula form-control-sm" id="nome" placeholder="nome" name="nome">
			</div>
		</div>
		<div id="corpo_form" style="background: #FFFAFA">
			<div class="form-row">
				<div class="form-group col-md-2">
					<label for="prazo">Prazo</label>
					<input type="text" class="form-control pula  form-control-sm" id="prazo" placeholder="prazo" name="prazo" >
				</div>
				<div class="form-group col-md-5">
					<label for="ml">Ml</label>
						<select class="form-control pula form-control-sm" name="ml" id="ml">
							<option value="1">1</option>
					</select>
				</div>
			</div>
			

			<div class="form-row">
				<div class="form-group col-md-2">
				<label for="metodo">Metodo</label>
					<select class="form-control pula form-control-sm" name="metodo" id="metodo">
						<option value="1">1</option>
					</select>
				</div>
				<div class="form-group col-md-4">
				<label for="material">Material</label>
					<select class="form-control pula form-control-sm" name="material" id="material">
						<option value="1">1</option>
					</select>
				</div>
			</div> 

			<div class="form-row">
				<div class="form-group col-md-2">
				<div class="custom-control custom-checkbox mr-sm-2">
					<input type="checkbox" class="custom-control-input pula" id="laudo_sozinho" name="laudo_sozinho">
					<label class="custom-control-label" for="laudo_sozinho">Laudo Sozinho</label>
				</div>
				</div>

				<div class="form-group col-md-2">
				<div class="custom-control custom-checkbox mr-sm-2">
					<input type="checkbox" class="custom-control-input pula" id="dum_obrigatorio" name="dum_obrigatorio">
					<label class="custom-control-label" for="dum_obrigatorio">DUM Obrigatório</label>
				</div>
				</div>
			</div> 

			<div class="form-row">
				<div class="form-group col-md-3">
				<label for="setor">Setor</label>
					<select class="form-control pula form-control-sm" name="setor" id="setor">
						<option value="1">1</option>
					</select>
				</div>
				<div class="form-group col-md-3">
				<label for="recipiente">Recipiente</label>
					<select class="form-control pula form-control-sm" name="recipiente" id="recipiente">
						<option value="1">1</option>
					</select>
				</div>
			</div> 

			<div class="form-row">
				<div class="form-group col-md-3">
				<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bd-example-modal-xl">Extra large modal</button>
				</div>
			</div> 

		</div>
		<button type="submit" id="enviaa" class="btn btn-primary col-md-12" style="display: show">CADASTRAR</button>
	</form>
    	</div>
    		
  			</div>
		</div>
 	</div>  	
    	
	
	 <!-- modal filhos -->
	 <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
			...
			</div>
		</div>
	</div>

    </body>

    
	
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <!--   Core JS Files   -->
  
  <script type="text/javascript" src="js/jquery.mask.min.js"></script>
    
</html>
