<?php
	session_start();

  if(!isset($_SESSION['usuario'])){
    header('Location: index.php?erro=1');
  }
  require_once('db.class.php');
  $objDb = new db();
  $link = $objDb->conecta_mysql();
  $usuarioNome = $_SESSION['nome'];
  $usuarioUnidade = $_SESSION['unidade'];
  $id_usuario = $_SESSION['id_usuario'];;
  
  $adminAcesso = intval($_SESSION['adminReal']);
  $adminEstoque = intval($_SESSION['adm_estoque']);
  
  $sqlAtivoCadExtra = "SELECT * FROM `rh_data_extra_ativo` ORDER BY `id` DESC LIMIT 1";
  $ativoCadExtra = mysqli_fetch_array( mysqli_query( $link, $sqlAtivoCadExtra ) );

  //--Query Funcionario
  $sql = "SELECT * from cad_funcionario ORDER BY `nome`";
    $query_funcionario = mysqli_query($link, $sql);

  //--Query Funcionario substituído
  $sql = "SELECT * from cad_funcionario order by `nome`";
    $query_substituido = mysqli_query($link, $sql);
  
  //--Query Função do Extra
  $sql = "SELECT a.id_funcao as 'id_funcao', b.funcao as 'funcao' from valor_extras a 
    INNER JOIN cad_funcao b 
    where a.id_funcao = b.id";
    $query_funcaoextra = mysqli_query($link, $sql);

  //--Query Unidade do Extra
  $sql = "SELECT * from cad_unidade where tipo != 6";
    $query_unidadeextra = mysqli_query($link, $sql);

  //--Query Escala do Extra
  $sql = "SELECT id, escala, tipo from cad_escala";
    $query_escalaoextra = mysqli_query($link, $sql);
   
   
?>



<html lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>Novo Extra</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>
         $(document).ready(function(){

          $("#nome").change(function() {
            validar();
          });
          $("#escala_extra").change(function() {
            validar();
          });
          $("#data_extra").change(function() {
            validar();
          });
          
          function validar() {
            var nome    = $("#nome").val();
            var plantao = $("#escala_extra").val();
            var data    = $("#data_extra").val();
             $.ajax({
               url: 'class/class.verifica_duplicidade_extra.php',
               method: 'post',
               data: { nomeExtra: nome, plantaoExtra: plantao, dataExtra: data },
               success: function(data){
                  if( data == 1 ){
                      $("#salvar").hide();
                      $("#alerta").show();
                  }else{
                      $("#salvar").show();
                      $("#alerta").hide();
                  }
               }
             })  
          };
            
          $('#motivo_extra').on('change', function(){
            var selectValor = $(this).val();
            if(selectValor == 'aumento quadro' || selectValor == 'Outros'){

                $('#substituido').css({'display': 'none'});
                 $("#1substituido").removeAttr('required');
                 

              }else{
                   
              $("#1substituido").attr("required", "");
             
                $('#substituido').css({'display': ''});
             
            }
          

          });

         });

         
        </script>
        <link rel="stylesheet" href="chosen.css">
    </head>
    <body class="bg-light" >
       
       <!-- Static navbar - Inicio -->
       <!--Início do Menu-->
	    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          <div class="container">
            <a class="nav-link active text-white" href="home.php"><strong>Wise</strong></a>
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse collapse" id="navbarsExample07" style="">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                  <a class="nav-link" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="alterar_senha.php">Mudar Senha</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="modal" data-target="#modalSair">Sair</a>
                </li>
                 <li class="nav-item">
                  <a class="nav-link" href=""></a>
                </li>
                 <li class="nav-item">
                  <a class="nav-link" href=""></a>
                </li>
                 <li class="nav-item">
                  <a class="nav-link" href=""></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href=""></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href=""></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-light" data-toggle="modal" data-target="#modalGic" ><strong>GIC - Abertura de Chamados</strong></a>
                </li>
              </ul>
              
            </div>
          </div>
        </nav><!--Fim do Menu-->
        <!-- Modal sair -->
            <div class="modal fade" id="modalSair" tabindex="-1" role="dialog" aria-labelledby="modalSair" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Encerrar Sessão</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    Clique em "Sair" para encerrar sua sessão.
                    Esperamos vê-lo novamente!

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
                    <a class="btn btn-primary" href="sair.php">Sair</a>
                  </div>
                </div>
              </div>
            </div><!--Fim Modal Sair-->
             <!-- Modal GIC -->
            <div class="modal fade" id="modalGic" tabindex="-1" role="dialog" aria-labelledby="modalGic" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">GIC - Gerenciamento Interno de Chamados</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    Você será redirecionado para o GIC.
                    Utilize seu usuário e senha para logar e abrir um chamado com a TI.

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
                    <a class="btn btn-primary alert-link" href="http://laboratorioblessing.dyndns.org:8181/GCI/" target="_blank">Confirmar</a>
                  </div>
                </div>
              </div>
            </div><!--Fim Modal GIC-->
        </nav><!--Fim do Menu-->
        <!--Static navbar - Fim -->
        
        <!--Barra status - Inicio-->
            <div class="alert alert-secondary bg-dark border-info rounded-0" >
        <div class="container">
            
            <div class="row">
                <div class="col-md-3">
                    <div class="text-primary"><strong> Usuario:</strong> <h5> <span class="badge badge-primary badge-pill"><?php echo $usuarioNome; ?></span></h5></div>
                </div>
                <div class="col-md-6">
                    <div class="text-primary"><strong>Unidade:</strong> <h5> <span class="badge badge-primary badge-pill"><?php echo $usuarioUnidade; ?></span></h5></div>
                </div>
                
                             
            </div>
            </div>
        </div>
        <!--Barra status - Fim-->
         <!--Corpo - Inicio-->
        <div class="container ">
            <div class="card">
                <div class="card-header">
                    <p class="text-light bg-success text-center py-2 rounded border border-success"><strong>Novo Extra</strong></p>
                </div>
                <div class="card-body">
                   <div id="main" class="container-fluid">
                        <h3 class="page-header"></h3>
                        <div class="panel panel-primary">
            <div class="panel-heading">
            
            </div><!-- fim .panel-heading -->
            <div class="panel-body">
  <div id="alerta" style="display: none">
    <div class="alert alert-info" role="alert">
      <h4 class="alert-heading text-center">** ALERTA **</h4>
      <hr>
      <p class="text-center">Já existe registro para os parâmetros informados!</p>
      <hr>
      <p class="mb-0"></p>
    </div>
  </div>
           <form class="form" action="validar/validar_novo_extra.php" method="post" accept-charset="utf-8">
               
              <!-- area de campos do form -->
              
              <div class="row"> 
                <div class="form-group col-md-6"> 
                    <label for="nome">Nome</label> 
                     <select name="nome" class="chosen-select form-control" tabindex="3" id="nome" required="">
                      
                      <?php while($row = mysqli_fetch_array($query_funcionario)) { ?>
                        <option value="<?php echo $row['cpf'] ?>"> <?php echo $row['nome'] ?> </option>
                     <?php } ?>
                    </select> 
                  </div>
                  <div class="form-group col-md-6"> 
                    <label for="funcao_extra">Função do Extra</label> 
                      <select name="funcao_extra" class="chosen-select form-control" tabindex="3" id="funcao_extra" required>
                      
                      <?php while($row = mysqli_fetch_array($query_funcaoextra)) { ?>
                        <option value="<?php echo $row['id_funcao'] ?>"> <?php echo $row['funcao'] ?> </option>
                     <?php } ?>
                    </select>
                  </div>
                  <div class="form-group col-md-8"> 
                    <label for="unidade_extra">Unidade do Extra</label> 
                      <select name="unidade_extra" class="chosen-select form-control" tabindex="3" id="unidade_extra" required>
                      
                      <?php while($row = mysqli_fetch_array($query_unidadeextra)) { ?>
                        <option value="<?php echo $row['id'] ?>"> <?php echo $row['nome'] ?> </option>
                     <?php } ?>
                    </select>
                  </div>
                  <div class="form-group col-md-4"> 
                    <label for="escala_extra">Escala do Extra</label> 
                      <select name="escala_extra" class="chosen-select form-control" tabindex="3" id="escala_extra" required>
                      
                      <?php while($row = mysqli_fetch_array($query_escalaoextra)) { ?>
                        <option value="<?php echo $row['id'] ?>"> <?php echo $row['escala'] ." - ". $row['tipo'] ?> </option>
                     <?php } ?>
                    </select>
                  </div>
                  <div class="form-group col-md-3"> 
                    <label for="data_extra">Data do Extra</label> 
                    <input type="date" class="form-control" name="data_extra" id="data_extra" min="<?php echo$ativoCadExtra['data']; ?>" value=""  required> 
                  </div>
                  <div class="form-group col-md-2"> 
                    <label for="hora_ent">Hora Entrada</label> 
                    <input type="time" class="form-control" name="hora_ent" id="hora_ent" value="" required> 
                  </div>
                  <div class="form-group col-md-2"> 
                    <label for="hora_sai">Hora Saída</label> 
                    <input type="time" class="form-control" name="hora_sai" id="hora_sai" value="" required> 
                  </div>
                  <div class="form-group col-md-5"> 
                    <label for="motivo_extra">Motivo do Extra</label> 
                      <select name="motivo_extra" class="chosen-select form-control" tabindex="3" id="motivo_extra" required>
                        <option value="Atestado medico">Atestado Médico</option>
                        <option value="Atraso">Atraso</option>
                        <option value="Falta">Falta</option>
                        <option value="Licenca">Licença</option>
                        <option value="Licenca maternidade">Licença Maternidade</option>
                        <option value="Ferias">Cobertura de Férias</option>
                        <option value="Demissão">Demissão</option>
                        <option value="Folga">Folga</option>
                        <option value="Falecimento">Falecimento</option>
                        <option value="aumento quadro">Aumento de Quadro</option>
                        <option value="Transferencia">Transferencia</option>
                        <option value="Outros">Outros</option>
                      </select>
                  </div>
                  <div class="form-group col-md-6" id="substituido" > 
                    <label for="substituido">Funcionário substituído</label> 
                    <select id="1substituido" class="chosen-select form-control substituido"  tabindex="3" name="substituido" required>
                      <option value="">...</option>
                      <?php while($row = mysqli_fetch_array($query_substituido)) { ?>
                        <option value="<?php echo $row['cpf'] ?>"> <?php echo $row['nome'] ?> </option>
                     <?php } ?>
                    </select>
                  </div>
                  <div class="form-group col-md-12"> 
                    <label for="obs_extra">Observação:</label>
                    <textarea type="text-area" rows="3" class="form-control" name="obs_extra" id="obs_extra" value="" ></textarea>
                  </div>
                
             </div>

             
              
             </div>          
               

              <hr /> 
              <div class="row"> 
                <div class="col-md-12"> 
                  <button type="submit" class="btn btn-primary" id="salvar">Salvar</button> 
                <a href="home.php" class="btn btn-default">Cancelar</a> 
              </div> 
            </div> 
           
          </form> 
                        
        <!--Copor - Fim-->
        <!--Rodape - Fim-->
        <!--Radape - Fim-->
      </div>
    </footer>   
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="docsupport/jquery-3.2.1.min.js" type="text/javascript"></script>

  <script src="chosen.jquery.js" type="text/javascript"></script>
  <script src="docsupport/init.js" type="text/javascript" charset="utf-8"></script>
    </body>
</html>
