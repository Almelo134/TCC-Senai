<?php
  if (!isset($_SESSION['id_usuario'])) {
    header("Location: index.php");
    exit();
}

// Lógica para identificar o perfil logado
$perfilLogado = "$id_usuario";
$imagemPadrao = 'assets/images/faces/face.jpg';
$extensaoPadrao = pathinfo($imagemPadrao, PATHINFO_EXTENSION);      
$path = 'assets/images/faces/'.$perfilLogado.'.jpg';

if (!file_exists($path)) {
  // Verifica se a imagem do perfil do usuário não existe
  if (copy($imagemPadrao, $path)) {
  }
}

if(isset($_POST['enviar'])){
  $arquivo = $_FILES['file'];
  $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
  $ex_permitidos = array('jpg', 'jpeg', 'png','svg');

  if(!in_array(strtolower($extensao), $ex_permitidos)) {
    die('Você não pode fazer upload desse tipo de arquivo');
  }
  else {
    // Movendo o arquivo para o diretório correto
    move_uploaded_file($arquivo['tmp_name'], 'assets/images/faces/'.$perfilLogado.'.jpg');
                  
    // Exibir mensagem de sucesso
    print '<script>alert("Upload efetuado com sucesso!!!")</script>';
      }
    }