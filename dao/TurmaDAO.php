<?php
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

require_once(__DIR__."/../util/Conectar.php");
require_once(__DIR__."/../model/Turma.php");
    
class TurmaDAO
{
    private PDO $con;
    public function __construct()
    {
        $this->con = Conectar::getConexao();
    }
    public function cadastroTurma(Turma $turma)
    {
        $sql = "INSERT INTO Turma(nome) VALUES(?);";
        $stm = $this->con->prepare($sql);
        $stm->execute([$turma->getNome()]);
    }
    public function selectTurma(Turma $turma)
    {
        $sql = "SELECT * FROM Turma WHERE id = ?;";
        $stm = $this->con->prepare($sql);
        $stm->execute([$turma->getId()]);
        return $this->map($stm->fetchAll());
    }
    public function verificaNomeRep(Turma $turma)
    {
        $sql = "SELECT * FROM Turma WHERE nome = ?;";
        $stm = $this->con->prepare($sql);
        $stm->execute([$turma->getNome()]);
        return $this->map($stm->fetchAll());
    }
    public function updateTurma(Turma $turma)
    {
        $sql = "UPDATE Turma SET nome = ? WHERE id = ?;";
        $stm = $this->con->prepare($sql);
        $stm->execute([$turma->getNome(),$turma->getId()]);
        return $stm->rowCount();
    }
    public function selectAllTurma()
    {
        $sql = "SELECT * FROM Turma;";
        $stm = $this->con->prepare($sql);
        $stm->execute();
        return $this->map($stm->fetchAll());
    }
    public function deleteTurma(Turma $turma)
    {
        $sql = "DELETE FROM Turma WHERE id = ?";;
        $stm = $this->con->prepare($sql);
        $stm->execute([$turma->getId()]);
    }
    public function validarId(Turma $turma)
    {
        $sql = "SELECT * FROM Turma WHERE id = ?;";
        $stm = $this->con->prepare($sql);
        $stm->execute([$turma->getId()]);
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
        $turmaOBJ = array();
        for($i = 0 ; $i < count($lista);$i++)
        {
            $turmaOBJ[$i] = new Turma();
        	$turmaOBJ[$i]->setId($lista[$i]["id"]);
			$turmaOBJ[$i]->setNome($lista[$i]["nome"]);
		
        }
        return $turmaOBJ;
    }
}