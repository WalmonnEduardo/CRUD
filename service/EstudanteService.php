<?php
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

require_once(__DIR__."/../dao/EquipeDAO.php");
require_once(__DIR__."/../dao/RoboDAO.php");
require_once(__DIR__."/../dao/TurmaDAO.php");

require_once(__DIR__."/ClassesService.php");

class EstudanteService extends ClassesService
{
    public function validar()
    {
        unset($_SESSION["erros"]);
        $this->verificarNome();
        $this->verificarDataNascimento();
        $this->verificarEquipe();
        $this->verificarTurma();
        $this->verificarRobo();
    }
    public function verificarDataNascimento()
    {
        if($this->entidade->getDataNascimento() == null)
        {
            $_SESSION["erros"][] = "Data de nascimento não pode ser nula";
        }
        else
        {
            $nascimento = new DateTime($this->entidade->getDataNascimento());
            $hoje = new DateTime(date("Y-m-d"));
    
            $idade = $hoje->diff($nascimento)->y;
            if($idade < 10)
            {
               $_SESSION["erros"][] = "Estudante menor que 10 anos";
            }
        }
    }
    public function verificarEquipe()
    {
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
    public function verificarTurma()
    {
        if($this->entidade->getTurma()->getId() == null)
        {
            $_SESSION["erros"][] = "Turma não pode ser nulo";
        }
        else
        {
            if(!(new TurmaDAO())->validarId($this->entidade->getTurma()))
            {
                $_SESSION["erros"][] = "Turma não existe";
            }
        }
    }
    public function verificarRobo()
    {
        if($this->entidade->getRobo()->getId() == null)
        {
            $_SESSION["erros"][] = "Robo não pode ser nulo";
        }
        else
        {
            $robo = (new RoboDAO())->selectRobo($this->entidade->getRobo())[0];
            if(!(new RoboDAO())->validarId($this->entidade->getRobo()))
            {
                $_SESSION["erros"][] = "Robo não existe";
            }
            if($robo->getEquipe()->getId() != $this->entidade->getEquipe()->getId())
            {
                $_SESSION["erros"][] = "Robo não pertence a equipe";
            }
        }
    }
}
?>