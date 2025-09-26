<?php
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

require_once(__DIR__."/Categoria.php");
require_once(__DIR__."/Equipe.php");

class Robo
{
    private ?int $id;
    private ?string $nome;
    private ?Categoria $categoria;
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
     * Get the value of categoria
     */
    public function getCategoria(): ?Categoria
    {
        return $this->categoria;
    }

    /**
     * Set the value of categoria
     */
    public function setCategoria(?Categoria $categoria): self
    {
        $this->categoria = $categoria;

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