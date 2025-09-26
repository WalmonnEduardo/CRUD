<?php
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

require_once (__DIR__."/../model/Estudante.php");
require_once (__DIR__."/../model/Turma.php");
require_once (__DIR__."/../model/Robo.php");
require_once (__DIR__."/../model/Equipe.php");
require_once (__DIR__."/../dao/EstudanteDAO.php");
require_once (__DIR__."/../service/EstudanteService.php");
class EstudanteController
{
    private $estudante;
    private $acao;
    private $dao;
    private $service;
    public function __construct()
    {
        $this->estudante=new Estudante();
    	$this->estudante->setId(isset($_POST["id"]) ? trim($_POST["id"]) : null);
		$this->estudante->setNome(isset($_POST["nome"]) ? trim($_POST["nome"]) : null);
		$this->estudante->setDataNascimento(isset($_POST["data_nascimento"]) ? trim($_POST["data_nascimento"]) : null);
		$turma = new Turma();
        $turma->setId(isset($_POST["id_turma"]) ? trim($_POST["id_turma"]) : null);
        $this->estudante->setTurma($turma);
        $robo = new Robo();
        $robo->setId(isset($_POST["id_robo"]) ? trim($_POST["id_robo"]) : null);
		$this->estudante->setRobo($robo);
        $equipe = new Equipe();
        $equipe->setId(isset($_POST["id_equipe"]) ? trim($_POST["id_equipe"]) : null);
		$this->estudante->setEquipe($equipe);
	
     
        $this->dao=new EstudanteDao();
        $this->service = new EstudanteService($this->estudante,$this->dao);
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
            case "findId":$this->buscarId($this->estudante);break;
            case "selectall":$this->buscarTodos();break;
            default : print "erro fatal";
        }    
    }
    function inserir()
    {
        $this->service->validar();
        if (session_status() === PHP_SESSION_NONE)
        {
            session_start();
        }
        if(!isset($_SESSION["erros"]))
        {
            unset($_SESSION["nome"]);
            unset($_SESSION["idEquipe"]);
            unset($_SESSION["idTurma"]);
            unset($_SESSION["idRobo"]);
            unset($_SESSION["data"]);
            $this->dao->cadastroEstudante($this->estudante);
        }
        else
        {
            $_SESSION["nome"] = $this->estudante->getNome();
            $_SESSION["idEquipe"] = $this->estudante->getEquipe()->getId();
            $_SESSION["idTurma"] = $this->estudante->getTurma()->getId();
            $_SESSION["idRobo"] = $this->estudante->getTurma()->getId();
            $_SESSION["data"] = $this->estudante->getDataNascimento();
        }
        header("Location: ../view/estudante/inserir.php");
        exit();
    }
    function excluir()
    {
        $this->dao->deleteEstudante($this->estudante);
        header("Location: ../view/estudante/listar.php");
        exit();
    }
    function alterar()
    {
        $this->service->validar();
        if (session_status() === PHP_SESSION_NONE)
        {
            session_start();
        }
        if(!isset($_SESSION["erros"]))
        {
            $this->dao->updateEstudante($this->estudante);
            unset($_SESSION["nome"]);
            unset($_SESSION["idEquipe"]);
            unset($_SESSION["idTurma"]);
            unset($_SESSION["idRobo"]);
            unset($_SESSION["data"]);
            header("Location: ../view/estudante/listar.php");
            exit();
        }
        else
        {
            $_SESSION["id"] = $this->estudante->getId();
            $_SESSION["nome"] = $this->estudante->getNome();
            $_SESSION["idEquipe"] = $this->estudante->getEquipe()->getId();
            $_SESSION["idTurma"] = $this->estudante->getTurma()->getId();
            $_SESSION["idRobo"] = $this->estudante->getTurma()->getId();
            $_SESSION["data"] = $this->estudante->getDataNascimento();
            header("Location: ../view/estudante/editar.php");
            exit();
        }
    }
    function buscarId()
    {
    	return $this->dao->selectEstudante($this->estudante);
        header("Location: ../view/estudante/editar.php");
    }
    function buscarTodos()
    {
        return $this->dao->selectAllEstudante();
    }
  
}
(new EstudanteController());