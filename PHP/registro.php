<?php

    require "conexao/banco.php";

    if(isset($_POST['Registrar'])){

        $username = $_POST['username'];
        $email = $_POST ['email'];
        $senha = $_POST['senha'];
        $confirSenha = $_POST['confirSenha'];

        $criptSenha = password_hash($senha, PASSWORD_DEFAULT);
        $criptConfirSenha = password_hash($confirSenha, PASSWORD_DEFAULT);

        if(empty($username) || empty($email) || empty($criptSenha) || empty($criptConfirSenha)){
            echo "erro";
        }
        else{

            if($confirSenha != $criptConfirSenha){

            $sql = "INSERT INTO usuario(username, email, senha, confirSenha) VALUES ('$username', '$email','$criptSenha','$criptConfirSenha')";

            $result = mysqli_query($conn, $sql);
            
            header("Location: ../index.php");

            } 
            
            else{
                echo "<script>alert('Certifique que as senhas são iguais');</script>";
            }

        }
        
      
    }