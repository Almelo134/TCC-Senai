<?php

require 'PHP/conexao/banco.php';

$query = "SELECT * FROM projeto WHERE id = '1'";
$result = mysqli_query($conn, $query);

if ($row = mysqli_fetch_assoc($result)) {
  
    $nomeProj = $row['nomeProj'];
    $descricao = $row['descricao'];
    $categoria = $row['categoria'];
    $participantes = $row['participantes'];
    $calendario = $row['calendario'];
    
}
