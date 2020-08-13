<?php
    require_once("../validar/class/db.class.php");
    $objDb = new db();
    $link = $objDb->conecta_mysql();

    $sql = "SELECT *  FROM medico WHERE nome LIKE '%$_POST[buscaMEdico]%'";
    $sql = mysqli_query($link, $sql);
    
?>
<div class="form-group col-md-8">
    <select class="custom-select custom-select-sm" id="codGetMedico" name="codGetMedico">
    <option value="">...</option>
        <?php 
            while ( $medicos = mysqli_fetch_array($sql) ) {

        ?>
        <option value="<?php echo$medicos['cod'];?>"><?php echo$medicos['cod'].': '.$medicos['nome'];?></option>
            <?php } ?>
    </select>
</div>