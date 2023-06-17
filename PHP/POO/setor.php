<?php
// Classe de conexão com o banco de dados
class ConexaoBancoDados {
    private $host = "localhost";
    private $usuario = "root";
    private $senha = "";
    private $banco = "gestaoativ";
    private $conexao;

    public function __construct() {
        $this->conectar();
    }

    private function conectar() {
        $this->conexao = new mysqli($this->host, $this->usuario, $this->senha, $this->banco);
        if ($this->conexao->connect_error) {
            die("Falha na conexão com o banco de dados: " . $this->conexao->connect_error);
        }
    }

    public function getConexao() {
        return $this->conexao;
    }

    public function fecharConexao() {
        $this->conexao->close();
    }
}

// Classe para gerenciar as opções no banco de dados
class OpcoesManager {
    private $conexao;

    public function __construct() {
        $this->conexao = new ConexaoBancoDados();
    }

    public function obterOpcoes() {
        $conexao = $this->conexao->getConexao();

        $query = "SELECT nomeSetor FROM setor";
        $result = $conexao->query($query);

        $opcoes = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $opcoes[] = $row["nomeSetor"];
            }
        }

        return $opcoes;
    }

    public function atualizarOpcoes($opcoes) {
        $conexao = $this->conexao->getConexao();
        $conexao->query("TRUNCATE TABLE setor");

        // Inserir as novas opções na tabela
        $query = "INSERT INTO setor (nomeSetor) VALUES (?)";
        $stmt = $conexao->prepare($query);
        $stmt->bind_param("s", $nome);

        foreach ($opcoes as $opcao) {
            $nome = $opcao;
            $stmt->execute();
        }
    }

    public function deletarOpcoes($opcoes) {
        $conexao = $this->conexao->getConexao();

        foreach ($opcoes as $opcao) {
            $query = "DELETE FROM setor WHERE nomeSetor = ?";
            $stmt = $conexao->prepare($query);
            $stmt->bind_param("s", $opcao);
            $stmt->execute();
        }
    }

    public function fecharConexao() {
        $this->conexao->fecharConexao();
    }
}

// Verificar se a requisição é para adicionar uma nova opção
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["nova_opcao"])) {
    $novaOpcao = $_POST["nova_opcao"];

    if (empty($novaOpcao)) {
        echo "Campo inválido";
        exit;
    }

    $opcoesManager = new OpcoesManager();
    $opcoes = $opcoesManager->obterOpcoes();
    $opcoes[] = $novaOpcao;
    $opcoesManager->atualizarOpcoes($opcoes);
    $opcoesManager->fecharConexao();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["remover_opcao"]) && isset($_POST["opcoes_selecionadas"])) {
    $opcoesSelecionadas = $_POST["opcoes_selecionadas"];

    $opcoesManager = new OpcoesManager();
    $opcoes = $opcoesManager->obterOpcoes();
    $opcoesRestantes = array_diff($opcoes, $opcoesSelecionadas);
    $opcoesManager->atualizarOpcoes($opcoesRestantes);
    $opcoesManager->fecharConexao();
}
?>