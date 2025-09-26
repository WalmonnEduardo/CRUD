<?php
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

require_once(__DIR__."/Turma.php");
require_once(__DIR__."/Robo.php");
require_once(__DIR__."/Equipe.php");

class Estudante
{
    private ?int $id;
    private ?string $nome;
    private ?string $dataNascimento;
    private ?Turma $turma;
    private ?Robo $robo;
    private ?Equipe $equipe;


    

    /**
     * Get the value of id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nome
     */
    public function getNome(): ?string
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     */
    public function setNome(?string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of dataNascimento
     */
    public function getDataNascimento(): ?string
    {
        return $this->dataNascimento;
    }

    /**
     * Set the value of dataNascimento
     */
    public function setDataNascimento(?string $dataNascimento): self
    {
        $this->dataNascimento = $dataNascimento;

        return $this;
    }

    /**
     * Get the value of turma
     */
    public function getTurma(): ?Turma
    {
        return $this->turma;
    }

    /**
     * Set the value of turma
     */
    public function setTurma(?Turma $turma): self
    {
        $this->turma = $turma;

        return $this;
    }

    /**
     * Get the value of robo
     */
    public function getRobo(): ?Robo
    {
        return $this->robo;
    }

    /**
     * Set the value of robo
     */
    public function setRobo(?Robo $robo): self
    {
        $this->robo = $robo;

        return $this;
    }

    /**
     * Get the value of equipe
     */
    public function getEquipe(): ?Equipe
    {
        return $this->equipe;
    }

    /**
     * Set the value of equipe
     */
    public function setEquipe(?Equipe $equipe): self
    {
        $this->equipe = $equipe;

        return $this;
    }
}
?>