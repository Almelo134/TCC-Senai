<?php

require 'conexao/banco.php';

if(isset($_POST['Enviar'])){

    $nomeProj = $_POST['nomeProj'];
    $descricao = $_POST ['descricao'];
    $categoria = $_POST['categoria'];
    $participantes = $_POST['participantes'];
    $calendario = $_POST['calendario'];
    


    $sql = "INSERT INTO projeto(nomeProj, descricao, categoria, participantes, calendario ) VALUES('$nomeProj','$descricao','$categoria', '$participantes', '$calendario')";

    $resultado = mysqli_query($conn, $sql);

        if(mysqli_insert_id($conn)){

            print"<script>alert('Projeto criado com sucesso');</script>";
            print"<script>location.href='../devSoft.php';</script>";

        }else{
            die ("Erro no sql" .mysqli_connect_error($conn));
        }
        mysqli_close($conn);

}
    
?>  