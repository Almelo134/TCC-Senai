<?php

require 'PHP/conexao/banco.php';

    $nomeProj = $_POST['nomeProj'];
    $descricao = $_POST ['descricao'];
    $tipoD = $_POST['tipoD'];
    $categoria = $_POST['categoria'];

    $sql = "INSERT INTO projeto(nomeProj, descricao, tipoD, categoria)
            VALUES('$nomeProj','$descricao','$tipoD','$categoria')";
        if(mysqli_query($conn, $sql)){
            echo"Projeto cadastrado";
        }else{
            echo"Erro no sql" .mysqli_connect_error($conn);
        }
        mysqli_close($conn);
?>