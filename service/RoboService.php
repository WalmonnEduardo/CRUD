<?php
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

require_once(__DIR__."/../dao/CategoriaDAO.php");
require_once(__DIR__."/../dao/EquipeDAO.php");
require_once(__DIR__."/ClassesService.php");

class RoboService extends ClassesService
{
    public function validar()
    {
        unset($_SESSION["erros"]);
        $this->verificarNome();
        $this->verificarCategoria();
        $this->verificarEquipe();
    }
    public function verificarCategoria()
    {
        if($this->entidade->getCategoria()->getId() == null)
        {
            $_SESSION["erros"][] = "Categoria não pode ser nulo";
        }
        else
        {
            if(!(new CategoriaDAO)->validarId($this->entidade->getCategoria()))
            {
                $_SESSION["erros"][] = "Categoria não existe";
            }
        }

    }
    public function verificarEquipe()
    {
        $_POST["acao"];
        if($this->entidade->getEquipe()->getId() == null)
        {
            $_SESSION["erros"][] = "Equipe não pode ser nulo";
        }
        else
        {
            if(!(new EquipeDAO())->validarId($this->entidade->getEquipe()))
            {
                $_SESSION["erros"][] = "Equipe não existe";
            }
        }

    }
}
?>