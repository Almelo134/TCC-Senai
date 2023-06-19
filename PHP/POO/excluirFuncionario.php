<?php
    // Verifique se o ID do funcionário foi enviado
    if (isset($_POST['idFuncionario'])) {
        $idFuncionario = $_POST['idFuncionario'];


        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "gestaoativ";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Falha na conexão com o banco de dados: " . $conn->connect_error);
        }

        // Execute a consulta SQL para excluir o funcionário com o ID fornecido
        $query = "DELETE FROM funcionario WHERE id = $idFuncionario";

        if ($conn->query($query) === TRUE) {
            echo "Funcionário excluído com sucesso.";
            header('location: ../../funcionario.php');
        } else {
            echo "Erro ao excluir o funcionário: " . $conn->error;
        }

        $conn->close();
    } else {
        echo "ID do funcionário não fornecido.";
    }
?>
