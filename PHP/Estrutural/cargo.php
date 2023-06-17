<?php
// Obter as opções armazenadas no banco de dados
function obterOpcoesCargo() {
  $conexao = conectarBancoDados();

  $query = "SELECT nomeCargo FROM cargo";
  $result = $conexao->query($query);

  $opcoesCargo = array();
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $opcoesCargo[] = $row["nomeCargo"];
    }
  }

  $conexao->close();

  return $opcoesCargo;
}

// Atualizar as opções no banco de dados
function atualizarOpcoesCargo($opcoesCargo) {
  $conexao = conectarBancoDados();
  $conexao->query("TRUNCATE TABLE cargo");

  // Inserir as novas opções na tabela
  $query = "INSERT INTO cargo (nomeCargo) VALUES (?)";
  $stmt = $conexao->prepare($query);
  $stmt->bind_param("s", $nome);

  foreach ($opcoesCargo as $opcao) {
    $nome = $opcao;
    $stmt->execute();
  }

  $conexao->close();
}

// Função para deletar opções do banco de dados
function deletarOpcoesCargo($opcoesCargo) {
  $conexao = conectarBancoDados();

  foreach ($opcoesCargo as $opcao) {
    $query = "DELETE FROM cargo WHERE nomeCargo = ?";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("s", $opcao);
    $stmt->execute();
  }

  $conexao->close();
}

// Verificar se a requisição é para adicionar uma nova opção
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["nova_opcao_cargo"])) {
  $novaOpcao = $_POST["nova_opcao_cargo"];

  if (empty($novaOpcao)) {
    echo "Campo inválido";
    exit;
  }

  $opcoesCargo = obterOpcoesCargo();
  $opcoesCargo[] = $novaOpcao;
  atualizarOpcoesCargo($opcoesCargo);
}

// Verificar se a requisição é para deletar opções selecionadas
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["remover_opcao_cargo"]) && isset($_POST["select_cargo"])) {
  $selecionadasEncoded = $_POST["select_cargo"];

  // Decodificar o JSON das opções selecionadas
  $selecionadasJSON = urldecode($selecionadasEncoded);
  $selecionadas = json_decode($selecionadasJSON, true);

  $opcoesCargo = obterOpcoesCargo();
  $opcoesCargo = array_diff($opcoesCargo, $selecionadas); // Filtrar apenas as opções não selecionadas
  deletarOpcoesCargo($selecionadas);
}

// Preencher o select com as opções do banco de dados
$opcoesCargo = obterOpcoesCargo();
