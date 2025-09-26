<?php
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

require_once (__DIR__."/../model/Categoria.php");
require_once (__DIR__."/../dao/CategoriaDAO.php");
require_once (__DIR__."/../service/CategoriaService.php");
class CategoriaController
{
    private Categoria $categoria;
    private $acao;
    private CategoriaDAO $dao;
    private CategoriaService $service;
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE)
        {
            session_start();
        }
        $this->categoria=new Categoria();
        $this->categoria->setId(isset($_POST["id"]) ? trim($_POST["id"]) : null);
		$this->categoria->setNome(isset($_POST["nome"]) ? trim($_POST["nome"]) : null);
        $this->dao=new CategoriaDao();
        $this->acao= $_POST["acao"]??null;
        if($this->acao != null)
        {
            $this->service=new CategoriaService($this->categoria,$this->dao);
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
            case "findId":$this->buscarId($this->categoria);break;
            case "selectall":$this->buscarTodos();break;

        }    
    }
    function inserir()
    {
        $this->service->validar();
        if(!isset($_SESSION["erros"]))
        {
            unset($_SESSION["nome"]);
            $this->dao->cadastroCategoria($this->categoria);
        }
        else
        {
            $_SESSION["nome"] = $this->categoria->getNome();
        }
        header("Location: ../view/categoria/inserir.php");
        exit();
    }
    function excluir()
    {
        $this->dao->deleteCategoria($this->categoria);
        header("Location: ../view/categoria/listar.php");
        exit();
    }
    function alterar()
    {
        $this->service->validar();
        if(!isset($_SESSION["erros"]))
        {
            unset($_SESSION["nome"]);
            $this->dao->updateCategoria($this->categoria);
            header("Location: ../view/categoria/listar.php");
            exit();
        }
        else
        {
            $_SESSION["id"] = $this->categoria->getId();
            $_SESSION["nome"] = $this->categoria->getNome();
            header("Location: ../view/categoria/editar.php");
            exit();
        }

    }
    function buscarId()
    {
        return $this->dao->selectCategoria($this->categoria);
        if($this->acao != "delete")
        {
            header("Location: ../view/categoria/editar.php");
        }
        
    }
    function buscarTodos()
    {
        return $this->dao->selectAllCategoria();
    }
}
(new CategoriaController());