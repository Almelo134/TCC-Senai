<?php
  session_start();
  if (!isset($_SESSION['id_usuario'])) {
    header("Location: index.php");
    exit();
}
$id_usuario = $_SESSION['id_usuario'];
require 'PHP/conexao/banco.php';
include 'PHP/POO/projectInfo.php';
include 'PHP/POO/fotoUpload.php';
include 'PHP/POO/addinfo.php';

// Verifica se o ID do projeto a ser excluído foi enviado via POST
if (isset($_POST['projeto_id'])) {
    $projeto_id = $_POST['projeto_id'];

    // Conecte-se ao banco de dados (substitua as informações de conexão com o seu próprio)
    $conn = new mysqli('localhost', 'root', '', 'gestaoativ');

    // Verifique se a conexão foi estabelecida corretamente
    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Crie a consulta SQL para excluir o projeto
    $sql = "DELETE FROM projeto WHERE id = $projeto_id";

    // // Execute a consulta SQL
    if ($conn->query($sql) === TRUE) {
        // A exclusão foi bem-sucedida
        echo "<script>alert(Projeto excluído com sucesso!);</script>";
    } else {
        // Ocorreu um erro ao excluir o projeto
        print "Erro ao excluir o projeto: " . $conn->error;
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


    <!-- <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css"> -->
    <!-- <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css"> -->

    <link rel="stylesheet" href="assets/css/modal.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
</head>

<body class="sidebar-icon-only">
    <div class="container-scroller">

        <nav class="sidebar sidebar-offcanvas" id="sidebar">

            <!-- Adicionar Logo -->
            <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
                <a class="sidebar-brand brand-logo" href="home.php"><img src="assets/images/logo.png" alt="logo" /></a>
                <a class="sidebar-brand brand-logo-mini" href="home.php"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
            </div>

            <ul class="nav">
                <li class="nav-item profile">
                    <div class="profile-desc">
                        <div class="profile-pic">
                            <div class="count-indicator">
                                <img class="img-xs rounded-circle "
                                    src=<?php echo $perfilUsuario->getImagemPerfil(); ?>>
                                <span class="count bg-success"></span>
                            </div>
                            <div class="profile-name">
                                <h5 class="mb-0 font-weight-normal"><?php echo $nome;?></h5>
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
                                        src=<?php echo $perfilUsuario->getImagemPerfil(); ?>>
                                    <p class="mb-0 d-none d-sm-block navbar-profile-name"><?php print $nome; ?></p>
                                    <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                                aria-labelledby="profileDropdown">
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
                                    </a>
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
                                    <div class="d-flex flex-row justify-content-between">
                                        <h4 class="card-title mb-1">Projetos abertos</h4>
                                        <p class="text-muted mb-1">Data de entrega</p>
                                    </div>


                                    <!-- projetos em aberto -->
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="preview-list">
                                                <!-- único item -->
                                                <?php
                                                // Consulta SQL para buscar todos os itens na tabela
                                                $sql = "SELECT * FROM projeto";

                                                // Executa a consulta SQL
                                                $result = $conn->query($sql);

                                                // Verifica se a consulta retornou resultados
                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        $id = $row['id'];
                                                        $nomeProj = $row['nomeProj'];
                                                        $descricao = $row['descricao'];
                                                        $categoria = $row['categoria'];
                                                        $participantes = $row['participantes'];
                                                        $calendario = $row['calendario'];

                                                        $projeto = new Projeto($id, $nomeProj, $descricao, $categoria, $participantes, $calendario);

                                                        echo '<div class="preview-item border-bottom" onclick="openModal(' . $id . ')">';
                                                        echo '  <div class="preview-thumbnail">';
                                                        echo '    <div class="preview-icon bg-primary">';
                                                        echo '      <i class="mdi mdi-file-document"></i>';
                                                        echo '    </div>';
                                                        echo '  </div>';
                                                        echo '  <div class="preview-item-content d-sm-flex flex-grow">';
                                                        echo '    <div class="flex-grow">';
                                                        echo '      <h6 class="preview-subject">' . $projeto->getNomeProj() . '</h6>';
                                                        echo '      <p class="text-muted mb-0">' . $projeto->getDescricao() . '</p>';
                                                        echo '    </div>';
                                                        echo '    <div class="mr-auto text-sm-center pt-2 pt-sm-0">';
                                                        echo '      <p class="text-muted mb-0">' .  $projeto->getCalendario() . '</p>';
                                                        echo '    </div>';
                                                        echo '  </div>';
                                                        echo '</div>';
                                                        echo '<div id="myModal-' . $id . '" class="modal">';
                                                        echo '  <div class="modal-content">';
                                                        echo '    <h3>Dados do Projeto</h3>';
                                                        echo '    <p class="modalText"><strong>Nome do Projeto:</strong> ' . $projeto->getNomeProj() . '</p>';
                                                        echo '    <p><strong>Descrição:</strong> ' . $projeto->getDescricao() . '</p>';
                                                        echo '    <p><strong>Categoria:</strong> ' . $projeto->getCategoria()  . '</p>';
                                                        echo '    <p><strong>Setor responsável:</strong> ' . $projeto->getParticipantes() . '</p>';
                                                        echo '    <p><strong>Data de entrega:</strong> ' .  $projeto->getCalendario() . '</p>';
                                                        echo '    <div class="modal-buttons">';
                                                        echo '      <form method="post">';
                                                        echo '        <input type="hidden" name="projeto_id" value="' . $id . '">';
                                                        echo '        <button class="btn btn-primary btn-concluir-projeto" type="submit">Projeto Concluído</button>';
                                                        echo '      </form>';
                                                        echo '    </div>';
                                                        echo '  </div>';
                                                        echo '</div>';
                                                    }
                                                    echo '</div>';
                                                    echo '<script>';
                                                    echo 'function openModal(id) {';
                                                    echo '  var modal = document.getElementById("myModal-" + id);';
                                                    echo '  modal.style.display = "block";';
                                                    echo '}';
                                                    echo 'window.addEventListener("click", function(event) {';
                                                    echo '  var modals = document.getElementsByClassName("modal");';
                                                    echo '  for (var i = 0; i < modals.length; i++) {';
                                                    echo '    var modal = modals[i];';
                                                    echo '    if (event.target === modal) {';
                                                    echo '      modal.style.display = "none";';
                                                    echo '    }';
                                                    echo '  }';
                                                    echo '});';
                                                    echo '</script>';
                                                } else {
                                                    echo "Nenhum resultado encontrado.";
                                                }
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
    <style>
       .preview-item:hover {
        background-color: #000;
       } 
    </style>

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