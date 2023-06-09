<?php

require "conexao/banco.php";
$id = $_SESSION['id_usuario'];

if (isset($_POST['update'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirSenha = $_POST['confirSenha'];
  
    // Verificar se todos os campos estão preenchidos
    if (empty($username) || empty($email) || empty($senha) || empty($confirSenha)) {
        echo "Erro: Todos os campos devem ser preenchidos.";
    } else {
        // Verificar se as senhas são iguais
        if ($senha != $confirSenha) {
            echo "Erro: Certifique-se de que as senhas são iguais.";
        } else {
            // Validar o formato do e-mail
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "Erro: O endereço de e-mail é inválido.";
            } else {
                // Criptografar a senha
                $criptSenha = password_hash($senha, PASSWORD_DEFAULT);
                $criptConfirSenha = password_hash($confirSenha, PASSWORD_DEFAULT);
  
                // Atualizar os dados no banco de dados usando declarações preparadas
                $sql = "UPDATE usuario SET username=?, email=?, senha=?, confirSenha=? WHERE id=?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "ssssi", $username, $email, $criptSenha, $criptConfirSenha, $id);
                $result = mysqli_stmt_execute($stmt);
  
                if ($result) {
                    header("Location: index.php");
                    exit();
                } else {
                    echo "Erro ao executar a consulta SQL: " . mysqli_error($conn);
                }
            }
        }
    }
  }
  ?>