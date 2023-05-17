<?php

require 'PHP/conexao/banco.php';

 $id_usuario = $_SESSION['id_usuario'];


$query = "SELECT * FROM usuario WHERE id = '{$id_usuario}'";
$result = mysqli_query($conn, $query);

if ($row = mysqli_fetch_assoc($result)) {
  
    $nome = $row['username'];
    $email = $row['email'];
    
}

