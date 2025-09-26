<?php
class ClassesService
{
    protected object $entidade;
    protected object $dao;

    public function __construct(object $entidade,object $dao)
    {
        if (session_status() === PHP_SESSION_NONE)
        {
            session_start();
        }
        $this->entidade = $entidade;
        $this->dao = $dao;
    }
    public function validar()
    {
        unset($_SESSION["erros"]);
        $this->verificarNome();
    }
    public function verificarNome()
    {
        if($this->entidade->getNome() == null)
        {
            $_SESSION["erros"][] = "Nome não pode ser nulo";
        }
        else
        {
            if(strlen($this->entidade->getNome()) > 50)
            {
                $_SESSION["erros"][] = "Nome maior que 255 caracteres";
            }
            if(strlen($this->entidade->getNome()) < 3)
            {
                $_SESSION["erros"][] = "Nome maior que 3 caracteres";
            }
            if($_SESSION["nomeAtual"]!=$this->entidade->getNome())
            {
                if(count($this->dao->verificaNomeRep($this->entidade)) > 0)
                {
                    $_SESSION["erros"][] = "Nome repetido";
                }
            }
        }
    }
}
?>