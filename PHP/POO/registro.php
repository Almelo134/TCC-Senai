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
        if (empty($this->username) || empty($this->email) || empty($this->senha) || empty($this->confirSenha)) {
            return "Preencha todos os campos.";
        } else {
            // Verificar se as senhas são iguais
            if ($this->senha != $this->confirSenha) {
                return "Certifique-se de que as senhas são iguais.";
            } else {
                $criptSenha = password_hash($this->senha, PASSWORD_DEFAULT);

                $sql = "INSERT INTO usuario (username, email, senha) VALUES (?, ?, ?)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param("sss", $this->username, $this->email, $criptSenha);
                $result = $stmt->execute();

                if ($result) {
                    return true;
                } else {
                    return "Erro ao registrar o usuário.";
                }
            }
        }
    }
}
