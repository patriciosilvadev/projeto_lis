<?php 
    session_start();
    $cont = 1;
?>
<link href="fontawesome_5.11.2/css/all.css" rel="stylesheet">
<!--load all styles -->

<table class="table table-sm my-2">
    <thead>
        <tr class="text-center">
            <th scope="col">CONT</th>
            <th scope="col">MNE</th>
            <th scope="col">NOME</th>
            <th scope="col">MATERIAL</th>
            <th scope="col">PROCEDIMENTO</th>
            <th scope="col">VALOR</th>
            <th scope="col">DEL</th>

    </thead>
    <tbody>
        <?php
            foreach ( $_SESSION['exame'] as $key => $value ) {
        ?>
        <tr class="text-center">
            <th scope="row"> <?php echo $cont++; ?> </th>
            <td> <?php echo $value['mne']; ?> </td>
            <td> <?php echo $value['nome']; ?> </td>
            <td> <?php echo $value['material']; ?> </td>
            <td> <?php echo $value['procedimento']; ?> </td>
            <td> <?php echo $value['valor']; ?> </td>
            <td> <a class="btn"><i class="fas fa-trash-alt remover" style="color: red" id="<?php echo $key; ?>"></i></a>
            </td>
        </tr>
        <?php
            }
        ?>
    </tbody>
</table>