<?php

require 'conexao/banco.php';
// Conexão com o banco de dados (substitua com suas próprias credenciais)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestaoativ";

// Cria a conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi estabelecida com sucesso
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Consulta SQL para obter o último ID registrado
$sql = "SELECT id FROM funcionario ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Se houver registros, obtenha o último ID e adicione +1 a ele
    $row = $result->fetch_assoc();
    $ultimoId = $row['id'];
    $perfilFuncionario = $ultimoId + 1;
} else {
    // Caso não haja registros, defina o perfilFuncionario como 1 (caso seja o primeiro registro)
    $perfilFuncionario = 1;
}

// Resto do código para salvar a imagem e processar o upload
$imagemPadrao = '../assets/images/Funcionarios/face.jpg';
$extensaoPadrao = pathinfo($imagemPadrao, PATHINFO_EXTENSION);
$path = '../assets/images/Funcionarios/' . $perfilFuncionario . '.' . $extensaoPadrao;

if (isset($_POST['enviarFuncionario'])) {
    $arquivo = $_FILES['file'];
    $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
    $ex_permitidos = array('jpg', 'jpeg', 'png', 'svg');

    if (!in_array(strtolower($extensao), $ex_permitidos)) {
        die('Você não pode fazer upload desse tipo de arquivo');
    } else {
        $destino = '../assets/images/Funcionarios/' . $perfilFuncionario . '.' . $extensao;
        if (move_uploaded_file($arquivo['tmp_name'], $destino)) {
            // Upload do arquivo bem-sucedido
            echo '<script>alert("Upload efetuado com sucesso!!!")</script>';
        } else {
            // O upload do arquivo falhou
            echo '<script>alert("Falha ao fazer upload do arquivo.")</script>';
        }
    }
}

if(isset($_POST['enviarFuncionario'])){

    $nomeFunc = $_POST['username'];
    $email = $_POST ['email'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $setor = $_POST['setor'];
    $cargo = $_POST['cargo'];
    $cargaHoraria = $_POST['carga_horaria'];
    
    $sql = "INSERT INTO funcionario(username, email, telefone, endereco, setor, cargo, carga_horaria ) VALUES('$nomeFunc','$email','$telefone', '$endereco', '$setor','$cargo','$cargaHoraria')";

    $resultado = mysqli_query($conn, $sql);

        if(mysqli_insert_id($conn)){

            print"<script>alert('Funcionario ADD com sucesso');</script>";
            print"<script>location.href='../funcionario.php';</script>";

        }else{

            die ("Erro no sql" .mysqli_connect_error($conn));
        }
        mysqli_close($conn);
    } 
