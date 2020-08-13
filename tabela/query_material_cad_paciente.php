<?php
    require_once("../validar/class/db.class.php");
    $sql = "SELECT * FROM `materiais` WHERE material_id > 0";
    $objDb = new db();
    $link = $objDb->conecta_mysql();
    $sql = mysqli_query($link, $sql)
?>
<select name="material1" class="form-control form-control-sm" tabindex="3" id="material1" > 
    <option value="">...</option>
    <?php
        while($res = mysqli_fetch_array($sql )) {
    ?>
    <option value="<?php echo $res['material_nome']; ?>"><?php echo $res['material_nome']; ?></option>  
    <?php  } ?>
    
</select>