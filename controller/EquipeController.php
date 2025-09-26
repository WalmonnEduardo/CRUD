<?php
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

require_once (__DIR__."/../model/Equipe.php");
require_once (__DIR__."/../dao/EquipeDAO.php");
require_once (__DIR__."/../service/EquipeService.php");
class EquipeController
{
    private $equipe;
    private $service;
    private $acao;
    private $dao;
    public function __construct()
    {
        $this->equipe=new Equipe();
        $this->equipe->setId(isset($_POST["id"]) ? trim($_POST["id"]) : null);
		$this->equipe->setNome(isset($_POST["nome"]) ? trim($_POST["nome"]) : null);
        $this->dao=new EquipeDao();
        $this->service = new EquipeService($this->equipe,$this->dao);
        $this->acao= isset($_POST["acao"]) ? $_POST["acao"] : null;
        if($this->acao != null)
        {
            $this->verificaAcao();
        }
    }
    function verificaAcao()
    {
        switch($this->acao)
        {
            case "insert":$this->inserir(); break;
            case "delete":$this->excluir(); break;
            case "change":$this->alterar(); break;
            case "findId":$this->buscarId($this->equipe);break;
            case "selectall":$this->buscarTodos();break;
            default : print "erro fatal";
        }    
    }
    function inserir()
    {
        $this->service->validar();
        if(!isset($_SESSION["erros"]))
        {
            unset($_SESSION["nome"]);
            $this->dao->cadastroEquipe($this->equipe);
        }
        else
        {
            $_SESSION["nome"] = $this->equipe->getNome();
        }
        header("Location: ../view/equipe/inserir.php");
        exit();
    }
    function excluir()
    {	
        $this->dao->deleteEquipe($this->equipe);
        header("Location: ../view/equipe/listar.php");
        exit();
    }
    function alterar()
    {
        $this->service->validar();
        if(!isset($_SESSION["erros"]))
        {
            unset($_SESSION["nome"]);
            $this->dao->updateEquipe($this->equipe);
            header("Location: ../view/equipe/listar.php");
            exit();
        }
        else
        {
            $_SESSION["id"] = $this->equipe->getId();
            $_SESSION["nome"] = $this->equipe->getNome();
            header("Location: ../view/equipe/editar.php");
            exit();
        }
    }
    function buscarId()
    {
        return $this->dao->selectEquipe($this->equipe);
        header("Location: ../view/equipe/editar.php");
    }
    function buscarTodos()
    {
        return $this->dao->selectAllEquipe();
    }
}
(new EquipeController());