<?php

class PerfilUsuario {
    private $idUsuario;
    private $imagemPadrao;
    
    public function __construct($idUsuario, $imagemPadrao) {
        $this->idUsuario = $idUsuario;
        $this->imagemPadrao = $imagemPadrao;
    }
    
    public function atualizarImagemPerfil($arquivo) {
        $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
        $exPermitidos = array('jpg', 'jpeg', 'png', 'svg');
        
        if (!in_array(strtolower($extensao), $exPermitidos)) {
            die('Você não pode fazer upload desse tipo de arquivo');
        } else {
            $destino = 'assets/images/faces/' . $this->idUsuario . '.jpg';
            
            if (move_uploaded_file($arquivo['tmp_name'], $destino)) {
                echo '<script>alert("Upload efetuado com sucesso!!!")</script>';
            } else {
                echo '<script>alert("Falha ao fazer upload do arquivo.")</script>';
            }
        }
    }
    
    public function verificarImagemPerfil() {
        $path = 'assets/images/faces/' . $this->idUsuario . '.jpg';
        
        if (!file_exists($path)) {
            if (copy($this->imagemPadrao, $path)) {
                // Cópia da imagem padrão bem-sucedida
            }
        }
    }
    
    public function getImagemPerfil() {
        return 'assets/images/faces/' . $this->idUsuario . '.jpg';
    }
}

// Verificar se o usuário está autenticado
if (!isset($_SESSION['id_usuario'])) {
    // Redirecionar para a página de login
    header("Location: login.php");
    exit();
}

$id_usuario = $_SESSION['id_usuario'];
$imagemPadrao = 'assets/images/faces/face.jpg';

$perfilUsuario = new PerfilUsuario($id_usuario, $imagemPadrao);
$perfilUsuario->verificarImagemPerfil();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enviar'])) {
    $arquivo = $_FILES['file'];
    $perfilUsuario->atualizarImagemPerfil($arquivo);
}

$imagemPerfil = $perfilUsuario->getImagemPerfil();

?>