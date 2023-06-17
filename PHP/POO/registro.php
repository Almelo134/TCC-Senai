<?php
class Usuario {
    private $username;
    private $email;
    private $senha;
    private $confirSenha;
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function setDados($username, $email, $senha, $confirSenha) {
        $this->username = $username;
        $this->email = $email;
        $this->senha = $senha;
        $this->confirSenha = $confirSenha;
    }

    public function registrar() {
        // Verificar se todos os campos estão preenchidos
        if (empty($this->username)  || empty($this->email) || empty($this->senha) || empty($this->confirSenha)) {
            echo "<script>alert('Preencha todos os campos.')</script>";
        } else {
            // Verificar se as senhas são iguais
            if ($this->senha != $this->confirSenha) {
                echo "<script>alert('Certifique-se de que as senhas são iguais.')</script>";
            } else {
                // Verificar tamanho mínimo da senha
                if (strlen($this->senha) < 6) {
                    echo "<script>alert('A senha deve ter no mínimo 6 caracteres.')</script>";
                } else {
                    $criptSenha = password_hash($this->senha, PASSWORD_DEFAULT);

                    $sql = "INSERT INTO usuario (username, email, senha) VALUES (?, ?, ?)";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->bind_param("sss", $this->username, $this->email, $criptSenha);
                    $result = $stmt->execute();

                    if ($result) {
                        return true;
                    } else {
                        echo "<script>alert('Erro ao registrar o usuário.')</script>";
                    }
                }
            }
        }
    }
}
?>