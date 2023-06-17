<?php
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

  foreach ($opcoes as $opcao) {
    $query = "DELETE FROM setor WHERE nomeSetor = ?";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("s", $opcao);
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
  if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["remover_opcao"]) && isset($_POST["select"])) {
    $selecionadasEncoded = $_POST["select"];
  
    // Decodificar o JSON das opções selecionadas
    $selecionadasJSON = urldecode($selecionadasEncoded);
    $selecionadas = json_decode($selecionadasJSON, true);
  
    $opcoes = obterOpcoes();
    $opcoes = array_diff($opcoes, $selecionadas); // Filtrar apenas as opções não selecionadas
    deletarOpcoes($selecionadas);
  }
  
  // Preencher o select com as opções do banco de dados
  $opcoes = obterOpcoes();