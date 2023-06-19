<?php
class Projeto {
    private $conn;

    public function __construct($conexao) {
        $this->conn = $conexao;
    }

    public function criarProjeto($nomeProj, $descricao, $categoria, $participantes, $calendario) {
        $sql = "INSERT INTO projeto (nomeProj, descricao, categoria, participantes, calendario) VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssss", $nomeProj, $descricao, $categoria, $participantes, $calendario);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

if (isset($_POST['Enviar'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gestaoativ";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }

    $projeto = new Projeto($conn);

    $nomeProj = $_POST['nomeProj'];
    $descricao = $_POST['descricao'];
    $categoria = $_POST['categoria'];
    $participantes = $_POST['participantes'];
    $calendario = $_POST['calendario'];

    // Chame o método criarProjeto() para criar o projeto no banco de dados
    if ($projeto->criarProjeto($nomeProj, $descricao, $categoria, $participantes, $calendario)) {
        echo "Projeto criado com sucesso.";
        header("Location: ../../home.php");
        exit();
    } else {
        echo "Erro ao criar o projeto.";
    }

    $conn->close();
}
?>
