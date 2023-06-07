<?php
  require 'PHP/conexao/banco.php';

  session_start();

  if (!isset($_SESSION['id_usuario'])) {
    header("Location: index.php");
    exit();
}

  $dataEntrega = date('d/m/Y');

  // Função para conectar ao banco de dados
  function conectarBancoDados() {
      $host = "localhost";
      $usuario = "root";
      $senha = "";
      $banco = "gestaoativ";
  
      $conexao = new mysqli($host, $usuario, $senha, $banco);
      if ($conexao->connect_error) {
          die("Falha na conexão com o banco de dados: " . $conexao->connect_error);
      }
  
      return $conexao;
  }
  
  // Obter as opções armazenadas no banco de dados
  function obterOpcoes() {
      $conexao = conectarBancoDados();
  
      $query = "SELECT nomeSetor FROM setor";
      $result = $conexao->query($query);
  
      $opcoes = array();
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              $opcoes[] = $row["nomeSetor"];
          }
      }
  
      $conexao->close();
  
      return $opcoes;
  }
  
  // Atualizar as opções no banco de dados
  function atualizarOpcoes($opcoes) {
      $conexao = conectarBancoDados();
      $conexao->query("TRUNCATE TABLE setor");
  
      // Inserir as novas opções na tabela
      $query = "INSERT INTO setor (nomeSetor) VALUES (?)";
      header('location: config.php');
      $stmt = $conexao->prepare($query);
      $stmt->bind_param("s", $nome);
  
      foreach ($opcoes as $opcao) {
          $nome = $opcao;
          $stmt->execute();
      }
  
      $conexao->close();
  }

  // Função para deletar opções do banco de dados
function deletarOpcoes($opcoes) {
  $conexao = conectarBancoDados();

  // Deletar as opções da tabela
  $query = "DELETE FROM setor WHERE nomeSetor IN (?)";
  $stmt = $conexao->prepare($query);
  $stmt->bind_param("s", $opcao);

  foreach ($opcoes as $opcao) {
      $stmt->execute();
  }

  $conexao->close();
}
  
  // Verificar se a requisição é para adicionar uma nova opção
  if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["nova_opcao"])) {
      $novaOpcao = $_POST["nova_opcao"];
  
      if (empty($novaOpcao)) {
          echo "Campo inválido";
          exit;
      }
  
      $opcoes = obterOpcoes();
      $opcoes[] = $novaOpcao;
      atualizarOpcoes($opcoes);
  }
  
  // Verificar se a requisição é para deletar opções selecionadas
  if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["deletar_opcao"])) {
    $selecionadas = $_POST["selecionadas"];

    $opcoes = obterOpcoes();
    $opcoes = array_intersect($opcoes, $selecionadas); // Filtrar apenas as opções selecionadas
    deletarOpcoes($opcoes);
}
  // Preencher o select com as opções do banco de dados
  $opcoes = obterOpcoes();
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
                  <img class="img-xs rounded-circle " src="assets/images/faces/logo.jpeg" alt="">
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
            <a class="nav-link" href="blank-page.php">
              <span class="menu-icon">
                <i class="mdi mdi-contacts"></i>
              </span>
              <span class="menu-title">Pagina em branco</span>
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
                    <img class="img-xs rounded-circle" src="assets/images/faces/logo.jpeg" alt="">
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

                    <h3>Configurações</h3>
                    
                    <h5>Setores</h5>
                    <select class="form-control col-2" id="select"></select>

                    <h6>Adicionar Setor</h6>
                    <input class="form-control col-2" type="text" id="nova-opcao">
                    <button id="adicionar-opcao">Adicionar</button>

                    <h6>Remover Setor</h6>
                    <button id="remover-opcao">Remover</button>

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
              var payload = "remover_opcao=true&selecionadas=";

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

                    <!-- <script>
                        // Obter as opções armazenadas no localStorage (ou sessionStorage)
                        var opcoes = JSON.parse(localStorage.getItem("opcoes")) || ["Selecione o setor" ];

                        document.addEventListener("DOMContentLoaded", function() {
                        var selectElement = document.getElementById("select");

                        // Função para atualizar as opções no select
                        function atualizarSelect() {
                            selectElement.innerHTML = "";
                              for (var i = 0; i < opcoes.length; i++) { 

                                var option = document.createElement("option");
                                option.value = opcoes[i];
                                option.text = opcoes[i];
                                selectElement.appendChild(option);
                            
                          }
                            
                        }

                        // Preencher o select com as opções iniciais
                        atualizarSelect();

                        // Adicionar opção ao array e atualizar o select
                        document.getElementById("adicionar-opcao").addEventListener("click", function() {
                          
                            var novaOpcao = document.getElementById("nova-opcao").value;
                                 
                            if( novaOpcao == ""){
                              alert("Campo inváido");
                              return;
                            }
                            else{
                              opcoes.push(novaOpcao);
                            atualizarSelect();
                            document.getElementById("nova-opcao").value = ""; // Limpar o campo de texto

                            // Armazenar o array atualizado no localStorage (ou sessionStorage)
                            localStorage.setItem("opcoes", JSON.stringify(opcoes));
                            }
                            
                        });

                        // Remover opções selecionadas do select e do array
                        document.getElementById("remover-opcao").addEventListener("click", function() {
                            var selecionadas = Array.from(selectElement.selectedOptions).map(function(option) {
                            return option.value;
                            });
                            opcoes = opcoes.filter(function(value) {
                            return selecionadas.indexOf(value) === -1;
                            });
                            atualizarSelect();

                            // Armazenar o array atualizado no localStorage (ou sessionStorage)
                            localStorage.setItem("opcoes", JSON.stringify(opcoes));
                        });
                        });
                    </script> -->

                    </div>
                  </div>
                </div>
            </div>
          </div>
        
          <!-- <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright <?php print $nome; ?></span>
            </div>
          </footer> -->
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