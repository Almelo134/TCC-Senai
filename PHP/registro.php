<?php
require "conexao/banco.php";

if(isset($_POST['Registrar'])){

    $username = $_POST['username'];
    $email = $_POST ['email'];
    $senha = $_POST['senha'];
    $confirSenha = $_POST['confirSenha'];

    // Verificar se todos os campos estão preenchidos
    if(empty($username) || empty($email) || empty($senha) || empty($confirSenha)){
        echo "erro";
    }
    else{
        // Verificar se as senhas são iguais
        if($senha != $confirSenha){
            echo "<script>alert('Certifique que as senhas são iguais')</script> ";
        } 
        else{
            $criptSenha = password_hash($senha, PASSWORD_DEFAULT);
            $criptConfirSenha = password_hash($confirSenha, PASSWORD_DEFAULT);

            $sql = "INSERT INTO usuario (username, email, senha, confirSenha) VALUES ('$username', '$email', '$criptSenha', '$criptConfirSenha')";
            $result = mysqli_query($conn, $sql);
        
            header("Location: ../index.php");
            exit();
        }
    }
}
