<?php

class ConexaoBancoDados {
    private $host;
    private $usuario;
    private $senha;
    private $banco;
    private $conexao;

    public function __construct($host, $usuario, $senha, $banco) {
        $this->host = $host;
        $this->usuario = $usuario;
        $this->senha = $senha;
        $this->banco = $banco;
    }

    public function conectar() {
        $this->conexao = new mysqli($this->host, $this->usuario, $this->senha, $this->banco);

        if ($this->conexao->connect_errno) {
            echo "Falha ao conectar ao banco de dados: " . $this->conexao->connect_error;
            exit;
        }
    }

    public function desconectar() {
        $this->conexao->close();
    }

    public function executarQuery($query) {
        $result = $this->conexao->query($query);

        if (!$result) {
            echo "Erro na execução da consulta: " . $this->conexao->error;
            exit;
        }

        return $result;
    }

    public function prepararConsulta($query) {
        return $this->conexao->prepare($query);
    }
}

class Cargo {
    private $conexao;

    public function __construct($conexao) {
        $this->conexao = $conexao;
    }

    public function obterOpcoesCargo() {
        $query = "SELECT nomeCargo FROM cargo";
        $result = $this->conexao->executarQuery($query);

        $opcoesCargo = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $opcoesCargo[] = $row["nomeCargo"];
            }
        }

        return $opcoesCargo;
    }

    public function atualizarOpcoesCargo($opcoesCargo) {
        $this->conexao->executarQuery("TRUNCATE TABLE cargo");

        // Inserir as novas opções na tabela
        $query = "INSERT INTO cargo (nomeCargo) VALUES (?)";
        $stmt = $this->conexao->prepararConsulta($query);

        // Argumentos variáveis para passar os valores por referência
        $tipos = str_repeat('s', count($opcoesCargo));
        $valores = array_merge([$tipos], $opcoesCargo);
        $stmt->bind_param(...$valores);

        $stmt->execute();
    }

    public function deletarOpcoesCargo($opcoesCargo) {
        foreach ($opcoesCargo as $opcao) {
            $query = "DELETE FROM cargo WHERE nomeCargo = ?";
            $stmt = $this->conexao->prepararConsulta($query);
            $stmt->bind_param("s", $opcao);
            $stmt->execute();
        }
    }
}

$conexao = new ConexaoBancoDados('localhost', 'usuario', 'senha', 'banco');
$conexao->conectar();

$cargo = new Cargo($conexao);

// Verificar se a requisição é para adicionar uma nova opção
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["nova_opcao_cargo"])) {
    $novaOpcao = $_POST["nova_opcao_cargo"];

    if (empty($novaOpcao)) {
        echo "Campo inválido";
        exit;
    }

    $opcoesCargo = $cargo->obterOpcoesCargo();
    $opcoesCargo[] = $novaOpcao;
    $cargo->atualizarOpcoesCargo($opcoesCargo);
}

// Verificar se a requisição é para deletar opções selecionadas
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["remover_opcao_cargo"]) && isset($_POST["select_cargo"])) {
    $selecionadasEncoded = $_POST["select_cargo"];

    // Decodificar o JSON das opções selecionadas
    $selecionadasJSON = urldecode($selecionadasEncoded);
    $selecionadas = json_decode($selecionadasJSON, true);

    $opcoesCargo = $cargo->obterOpcoesCargo();
    $opcoesCargo = array_diff($opcoesCargo, $selecionadas); // Filtrar apenas as opções não selecionadas
    $cargo->deletarOpcoesCargo($selecionadas);
}

// Preencher o select com as opções do banco de dados
$opcoesCargo = $cargo->obterOpcoesCargo();

// Resto do código...

$conexao->desconectar();
