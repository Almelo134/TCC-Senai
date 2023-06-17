<?php
class Projeto {
    private $id;
    private $nomeProj;
    private $descricao;
    private $categoria;
    private $participantes;
    private $calendario;

    public function __construct($id, $nomeProj, $descricao, $categoria, $participantes, $calendario) {
        $this->id = $id;
        $this->nomeProj = $nomeProj;
        $this->descricao = $descricao;
        $this->categoria = $categoria;
        $this->participantes = $participantes;
        $this->calendario = $calendario;
    }

    // Métodos getter para acessar as propriedades do projeto
    public function getId() {
        return $this->id;
    }

    public function getNomeProj() {
        return $this->nomeProj;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function getParticipantes() {
        return $this->participantes;
    }

    public function getCalendario() {
        return $this->calendario;
    }
}
