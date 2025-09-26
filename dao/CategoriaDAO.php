<?php
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

require_once(__DIR__."/../util/Conectar.php");
require_once(__DIR__."/../model/Categoria.php");
    
class CategoriaDAO
{
    private PDO $con;
    public function __construct()
    {
        $this->con = Conectar::getConexao();
    }
    public function cadastroCategoria(Categoria $categoria)
    {
        $sql = "INSERT INTO Categoria(nome) VALUES(?);";
        $stm = $this->con->prepare($sql);
        $stm->execute([$categoria->getNome()]);
    }
    public function selectCategoria(Categoria $categoria)
    {
        $sql = "SELECT * FROM Categoria WHERE id = ?;";
        $stm = $this->con->prepare($sql);
        $stm->execute([$categoria->getId()]);
        return $this->map($stm->fetchAll());
    }
    public function verificaNomeRep(Categoria $categoria)
    {
        $sql = "SELECT * FROM Categoria WHERE nome = ?;";
        $stm = $this->con->prepare($sql);
        $stm->execute([$categoria->getNome()]);
        return $this->map($stm->fetchAll());
    }
    public function updateCategoria(Categoria $categoria)
    {
        $sql = "UPDATE Categoria SET nome = ? WHERE id = ?;";
        $stm = $this->con->prepare($sql);
        $stm->execute([$categoria->getNome(),$categoria->getId()]);
        return $stm->rowCount();
    }
    public function selectAllCategoria()
    {
        $sql = "SELECT * FROM Categoria;";
        $stm = $this->con->prepare($sql);
        $stm->execute();
        return $this->map($stm->fetchAll());
    }
    public function deleteCategoria(Categoria $categoria)
    {
        $sql = "DELETE FROM Categoria WHERE id = ?";;
        $stm = $this->con->prepare($sql);
        $stm->execute([$categoria->getId()]);
    }
    public function validarId(Categoria $categoria)
    {
        $sql = "SELECT * FROM Categoria WHERE id = ?;";
        $stm = $this->con->prepare($sql);
        $stm->execute([$categoria->getId()]);
        if(count($this->map($stm->fetchAll())) > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function map($lista)
    {
        $categoriaOBJ = array();
        for($i = 0 ; $i < count($lista);$i++)
        {
            $categoriaOBJ[$i] = new Categoria();
        	$categoriaOBJ[$i]->setId($lista[$i]["id"]);
			$categoriaOBJ[$i]->setNome($lista[$i]["nome"]);
		
        }
        return $categoriaOBJ;
    }
}