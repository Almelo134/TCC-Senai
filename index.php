<?php

class Login {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function autenticarUsuario($email, $senha) {
        $email = $this->conn->real_escape_string($email);
        $query = "SELECT * FROM usuario WHERE email = '$email'";
        $result = $this->conn->query($query);

        if ($result->num_rows == 1) {
            $usuario = $result->fetch_assoc();
            if (password_verify($senha, $usuario['senha'])) {
                session_start();
                $_SESSION['id_usuario'] = $usuario['id'];
                header("Location: home.php");
                exit();
            } elseif (empty($email) || empty($senha)) {
                echo "<script>alert('Certifique-se de que todas as informações foram inseridas corretamente')</script>";
                echo "<script>location.href='index.php';</script>";
            } else {
                $mensagem_erro = "Email ou senha incorretos.";
            }
        } else {
            $mensagem_erro = "Email ou senha incorretos.";
        }

        $this->conn->close();
    }
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $conn = new mysqli("localhost", "root", "", "gestaoativ");

    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    $login = new Login($conn);
    $login->autenticarUsuario($email, $senha);
}

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>

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
                    <label>Email *</label>
                    <input type="text" name = "email" class="form-control p_input">
                  </div>
                  <div class="form-group">
                    <label>Senha *</label>
                    <input type="password" name = "senha" class="form-control p_input">
                  </div>
                  <div class="text-center">
                    <button type="submit" name = "login" class="btn btn-primary btn-block enter-btn">Logar</button>
                  </div>
                  <p class="sign-up">Não tem uma conta?<a href="register.php"> Cadastre-se</a></p>
                  <div>

                  </div>
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