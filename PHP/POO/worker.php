<?php

require 'conexao/banco.php';

class Funcionario {
    private $conn;
    private $perfilFuncionario;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    public function getUltimoPerfil() {
        $sql = "SELECT id FROM funcionario ORDER BY id DESC LIMIT 1";
        $result = $this->conn->query($sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $ultimoId = $row['id'];
            $this->perfilFuncionario = $ultimoId + 1;
        } else {
            $this->perfilFuncionario = 1;
        }
    }
    
    public function fazerUpload($arquivo) {
        $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
        $ex_permitidos = array('jpg', 'jpeg', 'png', 'svg');

        if (!in_array(strtolower($extensao), $ex_permitidos)) {
            die('Você não pode fazer upload desse tipo de arquivo');
        } else {
            $destino = '../assets/images/Funcionarios/' . $this->perfilFuncionario . '.' . $extensao;
            if (move_uploaded_file($arquivo['tmp_name'], $destino)) {
                echo '<script>alert("Upload efetuado com sucesso!!!")</script>';
            } else {
                echo '<script>alert("Falha ao fazer upload do arquivo.")</script>';
            }
        }
    }
    
    public function adicionarFuncionario($nome, $email, $telefone, $endereco, $setor, $cargo, $cargaHoraria) {
        $sql = "INSERT INTO funcionario(username, email, telefone, endereco, setor, cargo, carga_horaria) VALUES ('$nome', '$email', '$telefone', '$endereco', '$setor', '$cargo', '$cargaHoraria')";
        $resultado = mysqli_query($this->conn, $sql);

        if (mysqli_insert_id($this->conn)) {
            print "<script>alert('Funcionario ADD com sucesso');</script>";
            print "<script>location.href='../funcionario.php';</script>";
        } else {
            die("Erro no SQL" . mysqli_connect_error($this->conn));
        }
    }
}

// Cria a conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestaoativ";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

$funcionario = new Funcionario($conn);
$funcionario->getUltimoPerfil();

if (isset($_POST['enviarFuncionario'])) {
    $arquivo = $_FILES['file'];
    $funcionario->fazerUpload($arquivo);
}

if (isset($_POST['enviarFuncionario'])) {
    $nomeFunc = $_POST['username'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $setor = $_POST['setor'];
    $cargo = $_POST['cargo'];
    $cargaHoraria = $_POST['carga_horaria'];
    
    $funcionario->adicionarFuncionario($nomeFunc, $email, $telefone, $endereco, $setor, $cargo, $cargaHoraria);
}

mysqli_close($conn);
?>
