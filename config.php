<?php
  require 'PHP/conexao/banco.php';

  session_start();

  if (!isset($_SESSION['id_usuario'])) {
    header("Location: index.php");
    exit();
}
  $id_usuario = $_SESSION['id_usuario'];
  $dataEntrega = date('d/m/Y');
  include 'PHP/fotoUpload.php';
  include 'PHP/setor.php';
  include 'PHP/cargo.php';
  include 'PHP/tipoProjeto.php';

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  </head>
  <body class="sidebar-icon-only">
    <adiv class="container-scroller">
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
                  <img class="img-xs rounded-circle " src=<?php echo 'assets/images/faces/'.$perfilLogado.'.jpg'?> >
                  <span class="count bg-success"></span>
                </div>
                <div class="profile-name">
                  <h5 class="mb-0 font-weight-normal"><?php include 'PHP/addInfo.php'; echo $nome;?></h5>
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
                  </a>
              </li>
            
            <ul class="navbar-nav navbar-nav-right">
              <li class="nav-item dropdown">
                <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                  <div class="navbar-profile">
                    <img class="img-xs rounded-circle " src=<?php echo 'assets/images/faces/'.$perfilLogado.'.jpg'?> >
                    <p class="mb-0 d-none d-sm-block navbar-profile-name"><?php print $nome; ?></p>
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
                  <div class = "logout" onclick="location.href='PHP/logout.php'"> 
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
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
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
                      <div class="border-bottom">                   
                        <h3 class="">Configurações</h3>
                        
                        <h5>Setores</h5>
                        <select class="form-control col-2 mt-3 mb-3" id="select"></select>
                        
                        <h6>Adicionar Setor</h6>
                        <input class="form-control col-2 mt-3" type="text" id="nova-opcao">
                        <button class="btn btn-primary mt-3 mb-3" id="adicionar-opcao">Adicionar</button>
                        
                        <h6>Remover Setor</h6>
                        <button class="btn btn-dark pr-3 mb-3" id="remover-opcao">Remover</button>
                      </div>

                      <div class="border-bottom mt-3">                   
                        <h5>Cargos</h5>
                        <select class="form-control col-2 mt-3 mb-3" id="select-cargo"></select>
                        
                        <h6>Adicionar Cargo</h6>
                        <input class="form-control col-2 mt-3" type="text" id="nova-opcao-cargo">
                        <button class="btn btn-primary mt-3 mb-3 " id="adicionar-opcao-cargo">Adicionar</button>
                        
                        <h6>Remover Cargo</h6>
                        <button class="btn btn-dark pr-3 mb-3 " id="remover-opcao-cargo">Remover</button>
                      </div>

                      <div class="border-bottom mt-3">
                        <h5>Tipo de Projeto</h5>
                        <select class="form-control col-2 mt-3 mb-3" id="select-tipo-projeto">
                          <?php foreach ($opcoesTipoProjeto as $opcao) : ?>
                            <option value="<?php echo $opcao; ?>"><?php echo $opcao; ?></option>
                          <?php endforeach; ?>
                        </select>

                        <h6>Adicionar Tipo de Projeto</h6>
                        <input class="form-control col-2 mt-3" type="text" id="nova-opcao-tipo-projeto">
                        <button class="btn btn-primary mt-3 mb-3" id="adicionar-opcao-tipo-projeto">Adicionar</button>

                        <h6>Remover Tipo de Projeto</h6>
                        <button class="btn btn-dark pr-3 mb-3" id="remover-opcao-tipo-projeto">Remover</button>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>

        <script>
          document.addEventListener("DOMContentLoaded", function() {
            var selectElement = document.getElementById("select");
            var adicionarOpcaoButton = document.getElementById("adicionar-opcao");
            var removerOpcaoButton = document.getElementById("remover-opcao");

            function atualizarSelect() {
              selectElement.innerHTML = "";
              <?php foreach ($opcoes as $opcao): ?>
                var option = document.createElement("option");
                option.value = "<?php echo $opcao; ?>";
                option.text = "<?php echo $opcao; ?>";
                selectElement.appendChild(option);
              <?php endforeach; ?>
            }

            atualizarSelect();

            adicionarOpcaoButton.addEventListener("click", function() {
              var novaOpcao = document.getElementById("nova-opcao").value;

              if (novaOpcao === "") {
                alert("Campo inválido");
                return;
              }

              var xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                  opcoes = JSON.parse(this.responseText);
                  atualizarSelect();
                  document.getElementById("nova-opcao").value = "";
                }
              };
              xhttp.open("POST", "<?php echo $_SERVER["PHP_SELF"]; ?>", true);
              xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
              xhttp.send("nova_opcao=" + novaOpcao);
            });

            removerOpcaoButton.addEventListener("click", function() {
              var selecionadas = Array.from(selectElement.selectedOptions).map(function(option) {
                return option.value;
              });

              var xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                  opcoes = JSON.parse(this.responseText);
                  atualizarSelect();
                }
              };
              xhttp.open("POST", "<?php echo $_SERVER["PHP_SELF"]; ?>", true);
              xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

              // Construindo o payload para envio
              var payload = "remover_opcao=true&select=";

              // Codificando o array de selecionadas como JSON
              var selecionadasJSON = JSON.stringify(selecionadas);

              // Codificando o JSON para que seja seguro como parâmetro da URL
              var selecionadasEncoded = encodeURIComponent(selecionadasJSON);

              // Concatenando o payload codificado com as selecionadas
              payload += selecionadasEncoded;

              xhttp.send(payload);
            });
          });

          document.addEventListener("DOMContentLoaded", function() {
            var selectElement = document.getElementById("select-cargo");
            var adicionarOpcaoButton = document.getElementById("adicionar-opcao-cargo");
            var removerOpcaoButton = document.getElementById("remover-opcao-cargo");

            function atualizarSelect() {
              selectElement.innerHTML = "";
              <?php foreach ($opcoesCargo as $opcao): ?>
                var option = document.createElement("option");
                option.value = "<?php echo $opcao; ?>";
                option.text = "<?php echo $opcao; ?>";
                selectElement.appendChild(option);
              <?php endforeach; ?>
            }

            atualizarSelect();

            adicionarOpcaoButton.addEventListener("click", function() {
              var novaOpcao = document.getElementById("nova-opcao-cargo").value;

              if (novaOpcao === "") {
                alert("Campo inválido");
                return;
              }

              var xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                  opcoesCargo = JSON.parse(this.responseText);
                  atualizarSelect();
                  document.getElementById("nova-opcao-cargo").value = "";
                }
              };
              xhttp.open("POST", "<?php echo $_SERVER["PHP_SELF"]; ?>", true);
              xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
              xhttp.send("nova_opcao_cargo=" + novaOpcao);
            });

            removerOpcaoButton.addEventListener("click", function() {
              var selecionadas = Array.from(selectElement.selectedOptions).map(function(option) {
                return option.value;
              });

              var xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                  opcoesCargo = JSON.parse(this.responseText);
                  atualizarSelect();
                }
              };
              xhttp.open("POST", "<?php echo $_SERVER["PHP_SELF"]; ?>", true);
              xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

              // Construindo o payload para envio
              var payload = "remover_opcao_cargo=true&select_cargo=";

              // Codificando o array de selecionadas como JSON
              var selecionadasJSON = JSON.stringify(selecionadas);

              // Codificando o JSON para que seja seguro como parâmetro da URL
              var selecionadasEncoded = encodeURIComponent(selecionadasJSON);

              // Concatenando o payload codificado com as selecionadas
              payload += selecionadasEncoded;

              xhttp.send(payload);
            });
          });
          </script>

          <script>
          document.addEventListener("DOMContentLoaded", function() {
            var selectTipoProjeto = document.getElementById("select-tipo-projeto");
            var adicionarOpcaoTipoProjetoButton = document.getElementById("adicionar-opcao-tipo-projeto");
            var removerOpcaoTipoProjetoButton = document.getElementById("remover-opcao-tipo-projeto");

            function atualizarSelectTipoProjeto() {
              selectTipoProjeto.innerHTML = "";
              <?php foreach ($opcoesTipoProjeto as $opcao) : ?>
                var option = document.createElement("option");
                option.value = "<?php echo $opcao; ?>";
                option.text = "<?php echo $opcao; ?>";
                selectTipoProjeto.appendChild(option);
              <?php endforeach; ?>
            }

            atualizarSelectTipoProjeto();

            adicionarOpcaoTipoProjetoButton.addEventListener("click", function() {
              var novaOpcaoTipoProjeto = document.getElementById("nova-opcao-tipo-projeto").value;

              if (novaOpcaoTipoProjeto === "") {
                alert("Campo inválido");
                return;
              }

              var xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                  opcoesTipoProjeto = JSON.parse(this.responseText);
                  atualizarSelectTipoProjeto();
                  document.getElementById("nova-opcao-tipo-projeto").value = "";
                }
              };
              xhttp.open("POST", "<?php echo $_SERVER["PHP_SELF"]; ?>", true);
              xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
              xhttp.send("nova_opcao_tipo_projeto=" + novaOpcaoTipoProjeto);
            });

            removerOpcaoTipoProjetoButton.addEventListener("click", function() {
              var selecionadasTipoProjeto = Array.from(selectTipoProjeto.selectedOptions).map(function(option) {
                return option.value;
              });

              var xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                  opcoesTipoProjeto = JSON.parse(this.responseText);
                  atualizarSelectTipoProjeto();
                }
              };
              xhttp.open("POST", "<?php echo $_SERVER["PHP_SELF"]; ?>", true);
              xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

              // Construindo o payload para envio
              var payload = "remover_opcao_tipo_projeto=true&select_tipo_projeto=";

              // Codificando o array de selecionadas como JSON
              var selecionadasTipoProjetoJSON = JSON.stringify(selecionadasTipoProjeto);

              // Codificando o JSON para que seja seguro como parâmetro da URL
              var selecionadasTipoProjetoEncoded = encodeURIComponent(selecionadasTipoProjetoJSON);

              // Concatenando o payload codificado com as selecionadas
              payload += selecionadasTipoProjetoEncoded;

              xhttp.send(payload);
            });
          });
        </script>


    
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