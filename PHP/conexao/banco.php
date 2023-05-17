<?php

    $host = "localhost";
    $user = "root";
    $pass = "";
    $database = "gestaoativ";

    $conn = new mysqli ($host , $user, $pass, $database);

    // if( $conn -> connect_error){

    //     die('Database Connect Error' . $conn -> connect_error);

    // }
    // else{

    //     echo "Conexão bem sucedida";
    // }