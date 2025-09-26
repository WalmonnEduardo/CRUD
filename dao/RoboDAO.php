<?php
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

require_once(__DIR__."/../util/Conectar.php");
require_once(__DIR__."/../model/Robo.php");
    
class RoboDAO
{
    private PDO $con;
    public function __construct()
    {
        $this->con = Conectar::getConexao();
    }
    public function cadastroRobo(Robo $robo)
    {
        $sql = "INSERT INTO Robo(nome,id_categoria,id_equipe) VALUES(?,?,?);";
        $stm = $this->con->prepare($sql);
        $stm->execute([
            $robo->getNome(),
            $robo->getCategoria()->getId(),
            $robo->getEquipe()->getId()
        ]);
    }
    public function selectRobo(Robo $robo)
    {
        $sql = "SELECT r.id, r.nome,
                   c.id AS id_categoria, c.nome AS nome_categoria,
                   e.id AS id_equipe, e.nome AS nome_equipe
            FROM Robo r
            LEFT JOIN Categoria c ON r.id_categoria = c.id
            LEFT JOIN Equipe e ON r.id_equipe = e.id
            WHERE r.id = ?;";
        $stm = $this->con->prepare($sql);
        $stm->execute([$robo->getId()]);
        return $this->map($stm->fetchAll());
    }
    public function updateRobo(Robo $robo)
    {
        $sql = "UPDATE Robo SET 
        nome = ?,
        id_categoria = ?,
        id_equipe = ?
        WHERE id = ?;";
        $stm = $this->con->prepare($sql);
        $stm->execute([
            $robo->getNome(),
            $robo->getCategoria()->getId(),
            $robo->getEquipe()->getId(),
            $robo->getId()
            
        ]);
        return $stm->rowCount();
    }
    public function verificaNomeRep(Robo $robo)
    {
        $sql = "SELECT * FROM Turma WHERE nome = ?;";
        $stm = $this->con->prepare($sql);
        $stm->execute([$robo->getNome()]);
        return $this->map($stm->fetchAll());
    }
    public function selectAllRobo()
    {
        $sql = "SELECT r.id, r.nome,
                   c.id AS id_categoria, c.nome AS nome_categoria,
                   e.id AS id_equipe, e.nome AS nome_equipe
            FROM Robo r
            LEFT JOIN Categoria c ON r.id_categoria = c.id
            LEFT JOIN Equipe e ON r.id_equipe = e.id;";
        $stm = $this->con->prepare($sql);
        $stm->execute();
        return $this->map($stm->fetchAll());
    }
    public function deleteRobo(Robo $robo)
    {
        $sql = "DELETE FROM Robo WHERE id = ?";;
        $stm = $this->con->prepare($sql);
        $stm->execute([$robo->getId()]);
    }
    public function validarId(Robo $robo)
    {
        $sql = "SELECT * FROM Robo WHERE id = ?;";
        $stm = $this->con->prepare($sql);
        $stm->execute([$robo->getId()]);
        if(count($this->map($stm->fetchAll())) > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function selectRoboEquipe(Robo $robo)
    {
        $sql = "SELECT * FROM Robo WHERE id_equipe = ?;";
        $stm = $this->con->prepare($sql);
        $stm->execute([$robo->getEquipe()->getId()]);
        return $this->map($stm->fetchAll());
    }
    public function map($lista)
    {
        $roboOBJ = array();
        for ($i = 0; $i < count($lista); $i++)
        {
            $roboOBJ[$i] = new Robo();
            $roboOBJ[$i]->setId($lista[$i]["id"]);
            $roboOBJ[$i]->setNome($lista[$i]["nome"]);

            $categoria = new Categoria();
            $categoria->setId($lista[$i]["id_categoria"]);
            $categoria->setNome($lista[$i]["nome_categoria"]);
            $roboOBJ[$i]->setCategoria($categoria);

            $equipe = new Equipe();
            $equipe->setId($lista[$i]["id_equipe"]);
            $equipe->setNome($lista[$i]["nome_equipe"]);
            $roboOBJ[$i]->setEquipe($equipe);
        }
        return $roboOBJ;
    }
}