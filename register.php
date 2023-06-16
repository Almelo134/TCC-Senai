<?php
require_once "PHP/conexao/banco.php";
require_once "PHP/POO/registro.php";
require_once "PHP/POO/registro.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $senha = $_POST['senha'];
  $confirSenha = $_POST['confirSenha'];

  $conn = new mysqli("localhost", "root", "", "gestaoativ");
  if ($conn->connect_error) {
      die("Falha na conexão com o banco de dados: " . $conn->connect_error);
  }

  $usuario = new Usuario($conn);
  $usuario->setDados($username, $email, $senha, $confirSenha);
  $resultado = $usuario->registrar();

  if ($resultado === true) {
      $conn->close();
      header("Location: index.php");
      exit();
  } else {
      $conn->close();
      $erro = $resultado;
  }
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Registro</title>
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
                <h3 class="card-title text-left mb-3">Registre-se</h3>

                <form action = "register.php" method = "POST">
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" name = "username" class="form-control p_input">
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" name = "email" class="form-control p_input">
                  </div>
                  <div class="form-group">
                    <label>Senha</label>
                    <input type="password" name = "senha" class="form-control p_input">
                  </div>
                  <div class="form-group">
                    <label>Confirmar Senha</label>
                    <input type="password" name = "confirSenha" class="form-control p_input">
                  </div>
                  <div class="form-group d-flex align-items-center justify-content-between">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input"> Lembre-se de mim </label>
                    </div>
                    <a href="#" class="forgot-pass">Esqueceu a senha</a>
                  </div>
                  <div class="text-center">
                    <button type="submit" name = "Registrar" class="btn btn-primary btn-block enter-btn">Registrar</button>
                  </div>
                  <div class="d-flex">
                    <button class="btn btn-facebook col mr-2">
                      <i class="mdi mdi-facebook"></i> Facebook </button>
                    <button class="btn btn-google col">
                      <i class="mdi mdi-google-plus"></i> Google </button>
                  </div>
                  <p class="sign-up text-center">Já tem uma conta?<a href="index.php"> Logar </a></p>
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