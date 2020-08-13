<?php
    session_start();
    require_once("../validar/class/db.class.php");
    $mne = $_POST['mne'];
    $convenio = $_SESSION['convenio_busca_exame'];
    function padronizaPesquisa($busca){
        $busca = trim($busca);
        $busca = str_replace(".", "", $busca);
        $busca = str_replace(",", "", $busca);
        $busca = str_replace("-", "", $busca);
        $busca = str_replace("/", "", $busca);
        $busca = str_replace("%", "", $busca);
        return $busca;
    }

    $mne = padronizaPesquisa($_POST['mne']);

    $sql = "CALL pcd_exames_vs_convenio($convenio,'$mne')";
    
    $objDb = new db();
    $link = $objDb->conecta_mysql();
    $sql = mysqli_query($link, $sql)
?>
<select name="mne1" class="form-control form-control-sm" tabindex="3" id="mne1" > 
    <option value="">...</option>
    <?php
        while($res = mysqli_fetch_array($sql )) {
            $res['mne'] != '*' ? $mneOption = $res['mne'] : $mneOption = "PROVISORIO";
    ?>
    <option value="<?php echo  $res['mne'].'_'.$res['id']; ?>"><?php echo $res['nome']; ?></option>  
    <?php  } ?>
    
</select>
