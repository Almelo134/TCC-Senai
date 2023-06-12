<?php
// Função para obter a conexão com o banco de dados
function conectarBancoDadosProjeto() {
    $servidor = "localhost"; // endereço do servidor do banco de dados
    $usuario = "root"; // usuário do banco de dados
    $senha = ""; // senha do banco de dados
    $bancoDados = "gestaoativ"; // nome do banco de dados
  
    // Criar a conexão com o banco de dados
    $conexao = new mysqli($servidor, $usuario, $senha, $bancoDados);
  
    // Verificar se ocorreu algum erro na conexão
    if ($conexao->connect_error) {
      die("Falha na conexão com o banco de dados: " . $conexao->connect_error);
    }
  
    return $conexao;
  }
  
// Função para obter as opções armazenadas no banco de dados
function obterOpcoesTipoProjeto() {
  $conexao = conectarBancoDadosProjeto();

  $query = "SELECT tipoProjeto FROM tipoprojeto";
  $result = $conexao->query($query);

  $opcoesTipoProjeto = array();
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $opcoesTipoProjeto[] = $row["tipoProjeto"];
    }
  }

  $conexao->close();

  return $opcoesTipoProjeto;
}

// Função para atualizar as opções no banco de dados
function atualizarOpcoesTipoProjeto($opcoesTipoProjeto) {
  $conexao = conectarBancoDadosProjeto();
  $conexao->query("TRUNCATE TABLE tipoprojeto");

  // Inserir as novas opções na tabela
  $query = "INSERT INTO tipoprojeto (tipoProjeto) VALUES (?)";
  $stmt = $conexao->prepare($query);
  $stmt->bind_param("s", $tipoProjeto);

  foreach ($opcoesTipoProjeto as $opcao) {
    $tipoProjeto = $opcao;
    $stmt->execute();
  }

  $conexao->close();
}

// Função para deletar opções do banco de dados
function deletarOpcoesTipoProjeto($opcoesTipoProjeto) {
  $conexao = conectarBancoDadosProjeto();

  foreach ($opcoesTipoProjeto as $opcao) {
    $query = "DELETE FROM tipoprojeto WHERE tipoProjeto = ?";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("s", $opcao);
    $stmt->execute();
  }

  $conexao->close();
}

// Verificar se a requisição é para adicionar uma nova opção
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["nova_opcao_tipo_projeto"])) {
  $novaOpcao = $_POST["nova_opcao_tipo_projeto"];

  if (empty($novaOpcao)) {
    echo "Campo inválido";
    exit;
  }

  $opcoesTipoProjeto = obterOpcoesTipoProjeto();
  $opcoesTipoProjeto[] = $novaOpcao;
  atualizarOpcoesTipoProjeto($opcoesTipoProjeto);
}

// Verificar se a requisição é para deletar opções selecionadas
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["remover_opcao_tipo_projeto"]) && isset($_POST["select_tipo_projeto"])) {
  $selecionadasEncoded = $_POST["select_tipo_projeto"];

  // Decodificar o JSON das opções selecionadas
  $selecionadasJSON = urldecode($selecionadasEncoded);
  $selecionadas = json_decode($selecionadasJSON, true);

  $opcoesTipoProjeto = obterOpcoesTipoProjeto();
  $opcoesTipoProjeto = array_diff($opcoesTipoProjeto, $selecionadas); // Filtrar apenas as opções não selecionadas
  deletarOpcoesTipoProjeto($selecionadas);
}

// Preencher o select com as opções do banco de dados
$opcoesTipoProjeto = obterOpcoesTipoProjeto();
?>  