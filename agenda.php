<?php

  session_start();

  if (!isset($_SESSION['id_usuario'])) {
    header("Location: index.php");
    exit();
}
  $id_usuario = $_SESSION['id_usuario'];
  require 'PHP/conexao/banco.php';
  include 'PHP/POO/fotoUpload.php';
  include 'PHP/POO/addinfo.php';
  $dataEntrega = date('d/m/Y');

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <link rel="stylesheet" href="assets/css/agenda.css">

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
                  <img class="img-xs rounded-circle " src=<?php echo $perfilUsuario->getImagemPerfil();?> >
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
              <span class="menu-title">home</span>
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
                  </a>
              </li>


              <li class="nav-item dropdown">
                <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                  <div class="navbar-profile">
                    <img class="img-xs rounded-circle " src=<?php echo $perfilUsuario->getImagemPerfil();?> >
                    <p class="mb-0 d-none d-sm-block navbar-profile-name"><?php print $nome; ?></p>
                    <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                  <h6 class="p-3 mb-0">Profile</h6>
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
                 <div class = "logout" onclick="location.href='PHP/POO/logout.php'"> 
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
                  </a>
              </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-format-line-spacing"></span>
            </button>
          </div>
        </nav>

          <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <div id="monthDisplay"></div>

                        <div>
                          <button id="buttonBack">Voltar</button>
                          <button id="buttonNext">Próximo</button>
                        </div>
                          
                        </div>

                        <div id="weekdays">
                          <div></div>
                        <div>Domingo</div>
                        <div><br>Segunda-feira</br></div>
                        <div>Terça-feira</div>
                        <div>Quarta-feira</div>
                        <div>Quinta-feira</div>
                        <div>Sexta-feira</div>
                        <div>Sábado</div>
                        </div>


                        <!-- div dinamic -->
                        <div id="calendar" ></div>


                        </div>

                        <div id="newEventModal">
                        <h2>Novo Evento</h2>

                        <input id="eventTitleInput" placeholder="Evento"/>

                        <button id="saveButton" href="agenda.php"> Salvar</button>
                        <button id="cancelButton" href="agenda.php">Cancelar</button>
                        </div>

                        <div id="deleteEventModal">
                        <h2>Evento</h2>

                        <div id="eventText"></div><br>


                        <button id="deleteButton" href="agenda.php">Deletar</button>
                        <button id="closeButton" href="agenda.php">Fechar</button>
                        </div>                          
                        <style>
                        
                        body {
                          --body-color: rgb(7, 5, 5);
                          --header-color: #d36c6c;
                          --header-button: #92a1d1;
                          --color-weekdays: #247BA0;
                          --box-shadow: #CBD4C2;
                          --hover: #1a1f1a;
                          --current-day: #073a53;
                          --event-color: #58bae4;
                          --modal-event: #191c24;
                          --color-day: rgb(7, 5, 5);

                          display: flex;
                          flex-direction: column; /* Alteração para exibir a agenda em uma coluna */
                          align-items: center; /* Centralizar a agenda verticalmente */
                          justify-content: center; /* Centralizar a agenda horizontalmente */
                          min-height: 100vh; /* Definir uma altura mínima para a página inteira */
                          background-color: var(--body-color);
                        }

                        #calendar {
                          width: 50%;
                          max-width: 50%;
                          margin: 95px ; /* Define uma margem vertical de 20px e uma margem automática na horizontal */
                          display: flex;
                          flex-wrap: wrap;
                        }

                        #weekdays {
                          width: 50%;
                          display: inline-flex;
                          justify-content: space-between;
                          color: var(--color-weekdays);
                          font-weight: bold; /* Adiciona negrito aos dias da semana */
                          margin-bottom: -90px !important; /* Adiciona um espaçamento abaixo dos dias da semana */
                        }

                        #weekdays div {
                          width: calc(100% / 7) !important;
                          padding: 3px !important;
                          box-sizing: border-box !important;
                          text-align: center !important;
                        }

                        #calendar {
                          width: 100% !important;
                          display: flex !important;
                          flex-wrap: wrap !important;
                          margin-bottom: 100px !important; 
                        }
                      </style>
                      </div>
                  </div>
                </div>
          </div>
        </div>
    </div>
    
    <!-- plugins:js -->
    <script src="assets/js/agenda.js"></script>
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/dashboard.js"></script>

  </body>
</html>