<?php
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

require_once(__DIR__."/../util/Conectar.php");
require_once(__DIR__."/../model/Equipe.php");
    
class EquipeDAO
{
    private PDO $con;
    public function __construct()
    {
        $this->con = Conectar::getConexao();
    }
    public function cadastroEquipe(Equipe $equipe)
    {
        $sql = "INSERT INTO Equipe(nome) VALUES(?);";
        $stm = $this->con->prepare($sql);
        $stm->execute([$equipe->getNome()]);
    }
    public function selectEquipe(Equipe $equipe)
    {
        $sql = "SELECT * FROM Equipe WHERE id = ?;";
        $stm = $this->con->prepare($sql);
        $stm->execute([$equipe->getId()]);
        return $this->map($stm->fetchAll());
    }
    public function verificaNomeRep(Equipe $equipe)
    {
        $sql = "SELECT * FROM Equipe WHERE nome = ?;";
        $stm = $this->con->prepare($sql);
        $stm->execute([$equipe->getNome()]);
        return $this->map($stm->fetchAll());
    }
    public function updateEquipe(Equipe $equipe)
    {
        $sql = "UPDATE Equipe SET nome = ? WHERE id = ?;";
        $stm = $this->con->prepare($sql);
        $stm->execute([$equipe->getNome(),$equipe->getId()]);
        return $stm->rowCount();
    }
    public function selectAllEquipe()
    {
        $sql = "SELECT * FROM Equipe;";
        $stm = $this->con->prepare($sql);
        $stm->execute();
        return $this->map($stm->fetchAll());
    }
    public function deleteEquipe(Equipe $equipe)
    {
        $sql = "DELETE FROM Equipe WHERE id = ?";;
        $stm = $this->con->prepare($sql);
        $stm->execute([$equipe->getId()]);
    }
    public function validarId(Equipe $equipe)
    {
        $sql = "SELECT * FROM Equipe WHERE id = ?;";
        $stm = $this->con->prepare($sql);
        $stm->execute([$equipe->getId()]);
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
        $equipeOBJ = array();
        for($i = 0 ; $i < count($lista);$i++)
        {
            $equipeOBJ[$i] = new Equipe();
        	$equipeOBJ[$i]->setId($lista[$i]["id"]);
			$equipeOBJ[$i]->setNome($lista[$i]["nome"]);
		
        }
        return $equipeOBJ;
    }
}