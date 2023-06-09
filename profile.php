<?php
  session_start();
  if (!isset($_SESSION['id_usuario'])) {
    header("Location: index.php");
    exit();
}
$id_usuario = $_SESSION['id_usuario'];
include 'PHP/POO/fotoUpload.php';
require 'PHP/conexao/banco.php';
include 'PHP/updateProfile.php';
include 'PHP/POO/addinfo.php';
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Perfil</title>

    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" />

  </head>
  <body class="sidebar-icon-only">

    <div class="container-scroller">

      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
          <a class="sidebar-brand brand-logo" href="home.php"><img src="assets/images/logo.svg" alt="logo" /></a>
          <a class="sidebar-brand brand-logo-mini" href="home.php"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
        </div>
        <ul class="nav">
          <li class="nav-item profile">
            <div class="profile-desc">
              <div class="profile-pic">
                <div class="count-indicator">
                  <img class="img-xs rounded-circle " src=<?php echo $perfilUsuario->getImagemPerfil(); ?>>
                  <span class="count bg-success"></span>
                </div>
                <div class="profile-name">
                  <h5 class="mb-0 font-weight-normal"><?php echo $nome;?></h5>
                </div>
              </div>
              <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
              <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
                <a href="config.php" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-settings text-primary"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">Configurações</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="profile.php" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-onepassword  text-info"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">Mudar senha</p>
                  </div>
                </a>
              </div>
            </div>
          </li>
          <li class="nav-item nav-category">
            <span class="nav-link">Navegação</span>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="home.php">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
              <span class="menu-title">Home</span>
            </a>
          </li>

          <li class="nav-item menu-items">
            <a class="nav-link" href="profile.php">
              <span class="menu-icon">
                <i class="mdi mdi-account-circle"></i>
              </span>
              <span class="menu-title">Perfil</span>
            </a>
          </li>

          <li class="nav-item menu-items">
            <a class="nav-link" href="funcionario.php">
              <span class="menu-icon">
                <i class="mdi mdi-account-group"></i>
              </span>
              <span class="menu-title">Funcionários</span>
            </a>
          </li>

          <li class="nav-item menu-items">
                    <a class="nav-link" href="addFuncionario.php">
                        <span class="menu-icon">
                            <i class="mdi mdi-account-multiple-plus"></i>
                        </span>
                        <span class="menu-title">Adicionar Funcionários</span>
                    </a>
                </li>

          <li class="nav-item menu-items">
                    <a class="nav-link" href="agenda.php">
                        <span class="menu-icon">
                            <i class="mdi mdi-calendar-month"></i>
                        </span>
                        <span class="menu-title">Agenda</span>
                    </a>
                </li>
        </ul>
      </nav>

      <div class="container-fluid page-body-wrapper">

        <nav class="navbar p-0 fixed-top d-flex flex-row">
          <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
            <a class="navbar-brand brand-logo-mini" href="home.php"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
          </div>
          <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-menu"></span>
            </button>
            
            <ul class="navbar-nav navbar-nav-right">
              <li class="nav-item dropdown d-none d-lg-block">
                <a class="nav-link btn btn-success create-new-button" id="createbuttonDropdown" href="devSoft.php">+ Criar novo projeto</a>
              </li>


              <li class="nav-item dropdown">
                <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                  <div class="navbar-profile">
                    <img class="img-xs rounded-circle "  src=<?php echo $perfilUsuario->getImagemPerfil(); ?>>
                    <p class="mb-0 d-none d-sm-block navbar-profile-name"><?php echo $nome;?></p>
                    <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                  <h6 class="p-3 mb-0">Perfil</h6>
                  <div class="dropdown-divider"></div>
                  <a href="config.php" class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-settings text-success"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Configurações</p>
                    </div>
                  </a>
                    <div class="logout" onclick="location.href='PHP/POO/logout.php'"> 
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-logout text-danger"></i>
                              </div>
                            </div>
                            <div class="preview-item-content">
                            <p class="preview-subject mb-1">Log out</p>
                            </div>
                        </div> 
                      </a>

              </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-format-line-spacing"></span>
            </button>
          </div>
        </nav>


        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row p-2">
              <div class="card col-sm-2 grid-margin pt-4">
                <style>
                  .image-wrapper {
                      position: relative;
                      overflow: hidden;
                  }

                  .card img {
                    display: block;
                    width: 100%;
                    height: auto;
                    max-width: 100%;
                  }

                  .card .overlay {
                      position: absolute;
                      top: 0;
                      left: 0;
                      width: 100%;
                      height: 100%;
                      background-color: rgba(0, 0, 0, 0.5);
                      opacity: 0;
                      transition: opacity 0.3s;
                      display: flex;
                      align-items: center;
                      justify-content: center;
                      color: #fff;
                      font-size: 14px;
                      cursor: pointer;
                      border-radius: 15px;
                  }

                  .card .image-wrapper:hover .overlay {
                      opacity: 1;
                  }
              </style>
              <form action="" method="POST" enctype="multipart/form-data">
                <div class="card col-sm-12 grid-margin pt-4">
                  <div class="image-wrapper">
                    <?php
                      $imagemPerfil = $perfilUsuario->getImagemPerfil();

                      if (file_exists($imagemPerfil)) {
                        echo '<img class="img-xs-12" id="perfil-img" src="' . $imagemPerfil . '">';
                      } else {
                        echo '<img class="img-xs-12" id="perfil-img" src="' . $imagemPadrao . '">';
                      }
                    ?>
                    <label for="file" class="overlay">Trocar foto de perfil</label>
                    <input type="file" id="file" name="file" style="display: none;" onchange="trocarImagem(event)">
                  </div>
                  <input type="submit" name="enviar" value="Enviar" id="enviar-btn" style="display: none;" class="btn btn-primary">
                </div>
              </form>

              <script>
                function trocarImagem(event) {
                  const input = event.target;
                  if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                      document.getElementById('perfil-img').setAttribute('src', e.target.result);
                      document.getElementById('enviar-btn').style.display = 'inline-block';
                    }
                    reader.readAsDataURL(input.files[0]);
                  }
                }
              </script>

              <div class="card align-items-buttom pr-5 ">
                <div class="card-body mb-6 ">
                  <div class="form-group">
                    <label for="Username">Nome:<?php print $nome; ?></label>

                  </div>
                  <div class="form-group">
                    <label for="Email">Email:<?php print $email; ?></label>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-10 grid-margin align-items-buttom">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Alterar dados da conta</h4>
                  <form action="" method="POST" class="forms-sample">
                    <div class="form-group">
                      <label for="Username">Username</label>
                      <input type="text" class="form-control" id="Username" name="username" placeholder="<?php print $nome; ?>">
                    </div>
                    <div class="form-group">
                      <label for="Email">Email</label>
                      <input type="email" class="form-control" id="Email" name="email" placeholder="<?php print $email; ?>">
                    </div>
                    <div class="form-group">
                      <label for="Password">Senha</label>
                      <input type="password" class="form-control" id="Password" name="senha" placeholder="Senha">
                    </div>
                    <div class="form-group">
                      <label for="ConfPassword">Confirmar senha</label>
                      <input type="password" class="form-control" id="ConfPassword" name="confirSenha" placeholder="Confirmar Senha">
                    </div>      
                    <button type="submit" name="update" id="update" class="btn btn-primary mr-2">Enviar</button>
                    <button class="btn btn-dark">Cancelar</button>
                  </form>
                </div>
              </div>
            </div>
       </div>
     </div>
   </div>

    
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <script src="assets/js/dashboard.js"></script>

  </body>
</html>