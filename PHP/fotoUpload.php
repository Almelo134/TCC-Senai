<?php
$id_usuario = $_SESSION['id_usuario'];

// Lógica para identificar o perfil logado
$perfilLogado = "$id_usuario";
$imagemPadrao = 'assets/images/faces/face.jpg';
$extensaoPadrao = pathinfo($imagemPadrao, PATHINFO_EXTENSION);
$path = 'assets/images/faces/' . $perfilLogado . '.jpg';

if (!file_exists($path)) {
  // Verifica se a imagem do perfil do usuário não existe
  if (copy($imagemPadrao, $path)) {
    // Cópia da imagem padrão bem-sucedida
  }
}

if (isset($_POST['enviar'])) {
  $arquivo = $_FILES['file'];
  $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
  $ex_permitidos = array('jpg', 'jpeg', 'png', 'svg');

  if (!in_array(strtolower($extensao), $ex_permitidos)) {
    die('Você não pode fazer upload desse tipo de arquivo');
  } else {
    $destino = 'assets/images/faces/' . $perfilLogado . '.jpg';
    if (move_uploaded_file($arquivo['tmp_name'], $destino)) {
      // Upload do arquivo bem-sucedido
      echo '<script>alert("Upload efetuado com sucesso!!!")</script>';
    } else {
      // O upload do arquivo falhou
      echo '<script>alert("Falha ao fazer upload do arquivo.")</script>';
    }
  }
}
?>
