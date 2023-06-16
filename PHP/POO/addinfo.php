<?php

require '../conexao/banco.php';

class Usuario {
    private $id;
    private $nome;
    private $email;
    
    public function __construct($id) {
        $this->id = $id;
    }
    
    public function carregarDados() {
        global $conn;
        
        $query = "SELECT * FROM usuario WHERE id = '{$this->id}'";
        $result = mysqli_query($conn, $query);
        
        if ($row = mysqli_fetch_assoc($result)) {
            $this->nome = $row['username'];
            $this->email = $row['email'];
        }
    }
    
    public function getNome() {
        return $this->nome;
    }
    
    public function getEmail() {
        return $this->email;
    }
}

// Uso:
session_start();

// Verificar se o usuário está autenticado
if (!isset($_SESSION['id_usuario'])) {
    // Redirecionar para a página de login
    header("Location: login.php");
    exit();
}

$id_usuario = $_SESSION['id_usuario'];

$usuario = new Usuario($id_usuario);
$usuario->carregarDados();

$nome = $usuario->getNome();
$email = $usuario->getEmail();
