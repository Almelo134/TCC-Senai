<?php

class Logout {
    public function __construct() {
        session_start();
    }

    public function destroySession() {
        session_destroy();
    }

    public function redirectToIndex() {
        header("location: ../../index.php");
        exit;
    }
}

$logout = new Logout();
$logout->destroySession();
$logout->redirectToIndex();

