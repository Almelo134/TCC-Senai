<?php

require 'PHP/conexao/banco.php';
require 'PHP/registro.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Escapa caracteres especiais para evitar injeção de SQL
    $email = $conn->real_escape_string($email);

    // Busca no banco de dados pelo email informado
    $query = "SELECT * FROM usuario WHERE email = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $usuario = $result->fetch_assoc();
        // Verifica se a senha corresponde
        if (password_verify($senha, $usuario['senha'])) {
            // Login bem sucedido - redireciona para a página de perfil do usuário
            session_start();
            $_SESSION['id_usuario'] = $usuario['id'];
            header("Location: home.php");
            exit();
        } else if(empty($email) or empty($senha))
        {
            print "<script>alert('certifique-se que todas as informacoes foram inseridas corretamente')</script>";
            print "<script>location.href='index.php';</script>";
        } else {
            // Login falhou - exibe uma mensagem de erro
            $mensagem_erro = "Email ou senha incorretos.";
        }
    } else {
        // Login falhou - exibe uma mensagem de erro
        $mensagem_erro = "Email ou senha incorretos.";
    }

    // Fecha a conexão mysqli
    $conn->close();
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>

    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" />

  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
          <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <div class="card col-lg-4 mx-auto">
              <div class="card-body px-5 py-5">
                <h3 class="card-title text-left mb-3">Login</h3>
                <form method = "POST">
                  <div class="form-group">
                    <label>Username ou email *</label>
                    <input type="text" name = "email" class="form-control p_input">
                  </div>
                  <div class="form-group">
                    <label>Senha *</label>
                    <input type="password" name = "senha" class="form-control p_input">
                  </div>
                  <div class="form-group d-flex align-items-center justify-content-between">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input"> Lembrar de mim </label>
                    </div>
                    <a href="#" class="forgot-pass">Esqueceu a Senha</a>
                  </div>
                  <div class="text-center">
                    <button type="submit" name = "login" class="btn btn-primary btn-block enter-btn">Logar</button>
                  </div>
                  <div class="d-flex">
                    <button class="btn btn-facebook mr-2 col">
                      <i class="mdi mdi-facebook"></i> Facebook </button>
                    <button class="btn btn-google col">
                      <i class="mdi mdi-google-plus"></i> Google </button>
                  </div>
                  <p class="sign-up">Não tem uma conta?<a href="register.php"> Cadastre-se</a></p>

                  <?php if (isset($mensagem_erro)): ?>
                  <p><?php echo $mensagem_erro; ?></p>
                  <?php endif; ?>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    
  </body>
</html>