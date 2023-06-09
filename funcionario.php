<?php

session_start();

if (!isset($_SESSION['id_usuario'])) {
  header("Location: index.php");
  exit();
}
$id_usuario = $_SESSION['id_usuario'];
include 'PHP/fotoUpload.php';
require 'PHP/conexao/banco.php';
$dataEntrega = date('d/m/Y');

// Configurações do banco de dados
$servername = "localhost";  // substitua pelo nome do servidor do seu banco de dados
$username = "root"; // substitua pelo seu nome de usuário do banco de dados
$password = "";   // substitua pela sua senha do banco de dados
$dbname = "gestaoativ";     // substitua pelo nome do seu banco de dados

$conn = new mysqli($servername, $username, $password, $dbname);

// Query para selecionar os nomes das categorias
$query = 'SELECT nomeSetor FROM setor';

// Executa a query
$result = $conn->query($query);

// Verifica se a query retornou resultados
if ($result->num_rows > 0) {
    // Array para armazenar os nomes das categorias
    $categorias = array();

    // Loop pelos resultados e armazena os nomes das categorias no array
    while ($row = $result->fetch_assoc()) {
        $categorias[] = $row['nomeSetor'];
    }
}
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
    <link rel="stylesheet" href="assets/css/modal.css">

</head>

<body class="sidebar-icon-only">
    <div class="container-scroller">
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
                <a class="sidebar-brand brand-logo" href="home.php"><img src="assets/images/logo.svg" alt="logo" /></a>
                <a class="sidebar-brand brand-logo-mini" href="home.php"><img src="assets/images/logo-mini.svg"
                        alt="logo" /></a>
            </div>
            <ul class="nav">
                <li class="nav-item profile">
                    <div class="profile-desc">
                        <div class="profile-pic">
                            <div class="count-indicator">
                                <img class="img-xs rounded-circle "
                                    src=<?php echo 'assets/images/faces/'.$perfilLogado.'.jpg'?>>
                                <span class="count bg-success"></span>
                            </div>
                            <div class="profile-name">
                                <h5 class="mb-0 font-weight-normal"><?php include 'PHP/addInfo.php'; echo $nome;?></h5>
                            </div>
                        </div>
                        <a href="#" id="profile-dropdown" data-toggle="dropdown"><i
                                class="mdi mdi-dots-vertical"></i></a>
                        <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list"
                            aria-labelledby="profile-dropdown">
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
                            <a href="#" class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-dark rounded-circle">
                                        <i class="mdi mdi-onepassword  text-info"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <p class="preview-subject ellipsis mb-1 text-small">Mudar senha</p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-dark rounded-circle">
                                        <i class="mdi mdi-calendar-today text-success"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <p class="preview-subject ellipsis mb-1 text-small">Lista de afazeres</p>
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
                            <i class="mdi mdi-account-outline"></i>
                        </span>
                        <span class="menu-title">Perfil</span>
                    </a>
                </li>

                <li class="nav-item menu-items">
                    <a class="nav-link" href="funcionario.php">
                        <span class="menu-icon">
                            <i class="mdi mdi-account-outline"></i>
                        </span>
                        <span class="menu-title">Funcionários</span>
                    </a>
                </li>



                <li class="nav-item menu-items">
                    <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                        <span class="menu-icon">
                            <i class="mdi mdi-security"></i>
                        </span>
                        <span class="menu-title">User Pages</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="auth">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="blank-page.html"> Pagina em branco </a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404 </a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500 </a></li>
                            <li class="nav-item"> <a class="nav-link" href="index.php"> login </a></li>
                            <li class="nav-item"> <a class="nav-link" href="register.php"> Registrar </a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>

        <div class="container-fluid page-body-wrapper">

            <nav class="navbar p-0 fixed-top d-flex flex-row">
                <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo-mini" href="home.php"><img src="assets/images/logo-mini.svg"
                            alt="logo" /></a>
                </div>
                <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-toggle="minimize">
                        <span class="mdi mdi-menu"></span>
                    </button>
                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item dropdown d-none d-lg-block">
                            <a class="nav-link btn btn-success create-new-button" id="createbuttonDropdown"
                                href="devSoft.php">+ Criar novo projeto</a>
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                                <div class="navbar-profile">
                                    <img class="img-xs rounded-circle "
                                        src=<?php echo 'assets/images/faces/'.$perfilLogado.'.jpg'?>>
                                    <p class="mb-0 d-none d-sm-block navbar-profile-name"><?php print $nome; ?></p>
                                    <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                                aria-labelledby="profileDropdown">
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
                                <div class="logout" onclick="location.href='PHP/logout.php'">
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
                                </div>
                        </li>
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                        data-toggle="offcanvas">
                        <span class="mdi mdi-format-line-spacing"></span>
                    </button>
                </div>
            </nav>

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class=" border-bottom ">
                                        <div class="title">
                                            <h3>Funcionários</h3>
                                            <select class="form-control col-2" id="categoria">
                                                <?php
                                                // Loop pelo array de categorias e gera as opções do select
                                                foreach ($categorias as $categoria) {
                                                    echo '<option value="' . $categoria . '">' . $categoria . '</option>';
                                                }
                                                ?>
                                             </select>
                                             <div class="row">
                                                 <div class="col-12">
                                                    <!-- projetos em aberto -->
                                                    <div class="preview-list">
                                                                     <?php
                                                                        $query = 'SELECT * FROM funcionario';
                                                                        $result = $conn->query($query);
                                                                        if ($result->num_rows > 0) {
                                                                            while ($row = $result->fetch_assoc()) {
                                                                            
                                                                                $id = $row['id'];
                                                                                $username = $row['username'];
                                                                                $email = $row['email'];
                                                                                $telefone = $row['telefone'];
                                                                                $endereco = $row['endereco'];
                                                                                $setor = $row['setor'];
                                                                                $cargo = $row['cargo'];
                                                                                $carga_horaria = $row['carga_horaria'];
                                                                                echo '<div class="preview-item border-bottom" onclick="openModal(' . $id . ')">';
                                                                                echo '  <div class="preview-thumbnail">';
                                                                                echo '    <div class="preview-icon bg-primary align-left">';
                                                                                echo '      <i class="mdi mdi-account"></i>';
                                                                                echo '    </div>';
                                                                                echo '  </div>';
                                                                                echo '  <div class="preview-item-content d-sm-flex flex-grow">';
                                                                                echo '    <div class="flex-grow">';
                                                                                echo '      <h6 class="preview-subject">' . $username . '</h6>';
                                                                                echo '      <p class="text-muted mb-0">' . $email . '</p>';
                                                                                echo '    </div>';
                                                                                echo '  <div class="preview-item-content d-sm-flex flex-grow">';
                                                                                echo '    <div class="flex-grow">';
                                                                                echo '      <p class="text-muted mb-0">' . $setor . '</p>';
                                                                                echo '    <div class="mr-auto text-sm-center pt-2 pt-sm-0">';
                                                                                echo '      <p class="text-muted mb-0">' . $telefone . '</p>';
                                                                                echo '      <div id="myModal-' . $id . '" class="modal">';
                                                                                echo '        <div class="modal-content">';
                                                                                echo '          <span class="close" onclick="closeModal(' . $id . ')">&times;</span>';
                                                                                echo '          <h3>Dados do Projeto</h3>';
                                                                                echo '          <p class="modalText"><strong>Nome:</strong> ' . $username . '</p>';
                                                                                echo '          <p><strong>Email:</strong> ' . $email . '</p>';
                                                                                echo '          <p><strong>Telefone:</strong> ' . $telefone . '</p>';
                                                                                echo '          <p><strong>Endereço:</strong> ' . $endereco . '</p>';
                                                                                echo '          <p><strong>Setor:</strong> ' . $setor . '</p>';
                                                                                echo '          <p><strong>Cargo:</strong> ' . $cargo . '</p>';
                                                                                echo '          <p><strong>Caga horária:</strong> ' . $carga_horaria . '</p>';
                                                                                echo '        </div>';
                                                                                echo '      </div>';
                                                                                echo '      <script>';
                                                                                echo '        function openModal(id) {';
                                                                                echo '          document.getElementById("myModal-" + id).style.display = "block";';
                                                                                echo '        }';
                                                                                echo '        function closeModal(id) {';
                                                                                echo '          document.getElementById("myModal-" + id).style.display = "none";';
                                                                                echo '        }';
                                                                                echo '      </script>';
                                                                                echo '    </div>';
                                                                                echo '  </div>';
                                                                                echo '</div>';
                                                                                    }
                                                                                } else {
                                                                                    echo "Nenhum resultado encontrado.";
                                                                                }
                                                                                $conn->close();
                                                                            ?>
                                                    </div>
                                                 </div>
                                             </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- plugins:js -->

    <script src="assets/js/calendar.js"></script>
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/dashboard.js"></script>

</body>

</html>