<?php

require 'conexao/banco.php';

if(isset($_POST['enviarFuncionario'])){

    $nomeFunc = $_POST['username'];
    $email = $_POST ['email'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $setor = $_POST['setor'];
    $cargo = $_POST['cargo'];
    $cargaHoraria = $_POST['carga_horaria'];
    
    $sql = "INSERT INTO funcionario(username, email, telefone, endereco, setor, cargo, carga_horaria ) VALUES('$nomeFunc','$email','$telefone', '$endereco', '$setor','$cargo','$cargaHoraria')";

    $resultado = mysqli_query($conn, $sql);

        if(mysqli_insert_id($conn)){

            print"<script>alert('Funcionario ADD com sucesso');</script>";
            print"<script>location.href='../funcionario.php';</script>";

        }else{

            die ("Erro no sql" .mysqli_connect_error($conn));
        }
        mysqli_close($conn);
    }