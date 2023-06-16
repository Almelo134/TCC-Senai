<?php

    $host = "localhost";
    $user = "root";
    $pass = "";
    $database = "gestaoativ";

    $conn = new mysqli ($host , $user, $pass, $database);

    // class Conexao {
    //     private $host;
    //     private $user;
    //     private $pass;
    //     private $database;
    
    //     public function __construct($host, $user, $pass, $database) {
    //         $this->host = $host;
    //         $this->user = $user;
    //         $this->pass = $pass;
    //         $this->database = $database;
    //     }
    
    //     public function conectar() {
    //         $conn = new mysqli($this->host, $this->user, $this->pass, $this->database);
    
    //         if ($conn->connect_error) {
    //             die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    //         }
    
    //         return $conn;
    //     }
    // }
    
    // $host = "localhost";
    // $user = "root";
    // $pass = "";
    // $database = "gestaoativ";
    
    // $conexao = new Conexao($host, $user, $pass, $database);
    // $conn = $conexao->conectar();