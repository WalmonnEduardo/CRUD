<?php
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

require_once(__DIR__."/../util/Conectar.php");
require_once(__DIR__."/../model/Estudante.php");
require_once(__DIR__."/../model/Turma.php");
require_once(__DIR__."/../model/Robo.php");
require_once(__DIR__."/../model/Equipe.php");
require_once(__DIR__."/../model/Categoria.php");
    
class EstudanteDAO
{
    private PDO $con;
    public function __construct()
    {
        $this->con = Conectar::getConexao();
    }
    public function cadastroEstudante(Estudante $estudante)
    {
        $sql = "INSERT INTO Estudante(nome,data_nascimento,id_turma,id_robo,id_equipe) VALUES(?,?,?,?,?);";
        $stm = $this->con->prepare($sql);
        $stm->execute([
            $estudante->getNome(),
            $estudante->getDataNascimento(),
            $estudante->getTurma()->getId(),
            $estudante->getRobo()->getId(),
            $estudante->getEquipe()->getId()
        ]);
    }
    public function selectEstudante(Estudante $estudante)
    {
        $sql = "SELECT e.id, e.nome, e.data_nascimento,
                   t.id AS id_turma, t.nome AS nome_turma,
                   r.id AS id_robo, r.nome AS nome_robo,
                   eq.id AS id_equipe, eq.nome AS nome_equipe,
                   c.id AS id_categoria, c.nome AS nome_categoria
            FROM Estudante e
            LEFT JOIN Turma t ON e.id_turma = t.id
            LEFT JOIN Robo r ON e.id_robo = r.id
            LEFT JOIN Equipe eq ON e.id_equipe = eq.id
            LEFT JOIN Categoria c ON r.id_categoria = c.id 
            WHERE e.id = ?;";
        $stm = $this->con->prepare($sql);
        $stm->execute([$estudante->getId()]);
        return $this->map($stm->fetchAll());
    }
    public function updateEstudante(Estudante $estudante)
    {
        $sql = "UPDATE Estudante SET 
        nome = ?,
        data_nascimento = ?,
        id_turma = ?, 
        id_robo = ?,
        id_equipe = ? 
        WHERE id = ?;";
        $stm = $this->con->prepare($sql);
        $stm->execute([
            $estudante->getNome(),
            $estudante->getDataNascimento(),
            $estudante->getTurma()->getId(),
            $estudante->getRobo()->getId(),
            $estudante->getEquipe()->getId(),
            $estudante->getId()
        ]);
        return $stm->rowCount();
    }
    public function selectAllEstudante()
    {
        $sql = "SELECT e.id, e.nome, e.data_nascimento,
                   t.id AS id_turma, t.nome AS nome_turma,
                   r.id AS id_robo, r.nome AS nome_robo,
                   eq.id AS id_equipe, eq.nome AS nome_equipe,
                   c.id AS id_categoria, c.nome AS nome_categoria
            FROM Estudante e
            LEFT JOIN Turma t ON e.id_turma = t.id
            LEFT JOIN Robo r ON e.id_robo = r.id
            LEFT JOIN Equipe eq ON e.id_equipe = eq.id
            LEFT JOIN Categoria c ON r.id_categoria = c.id;";
        $stm = $this->con->prepare($sql);
        $stm->execute();
        return $this->map($stm->fetchAll());
    }
    public function deleteEstudante(Estudante $estudante)
    {
        $sql = "DELETE FROM Estudante WHERE id = ?";;
        $stm = $this->con->prepare($sql);
        $stm->execute([$estudante->getId()]);
    }
    public function verificaNomeRep(Estudante $estudante)
    {
        $sql = "SELECT * FROM Estudante WHERE nome = ?;";
        $stm = $this->con->prepare($sql);
        $stm->execute([$estudante->getNome()]);
        return $this->map($stm->fetchAll());
    }
    public function map($lista)
    {
        $estudanteOBJ = array();
        for ($i = 0; $i < count($lista); $i++)
        {
            $estudanteOBJ[$i] = new Estudante();
            $estudanteOBJ[$i]->setId($lista[$i]["id"]);
            $estudanteOBJ[$i]->setNome($lista[$i]["nome"]);
            $estudanteOBJ[$i]->setDataNascimento($lista[$i]["data_nascimento"]);

            $turma = new Turma();
            $turma->setId($lista[$i]["id_turma"]);
            $turma->setNome($lista[$i]["nome_turma"] ?? null);
            $estudanteOBJ[$i]->setTurma($turma);

            $robo = new Robo();
            $robo->setId($lista[$i]["id_robo"]);
            $robo->setNome($lista[$i]["nome_robo"] ?? null);

            $categoria = new Categoria();
            $categoria->setId($lista[$i]["id_categoria"]);
            $categoria->setNome($lista[$i]["nome_categoria"] ?? null);
            $robo->setCategoria($categoria);

            $estudanteOBJ[$i]->setRobo($robo);

            $equipe = new Equipe();
            $equipe->setId($lista[$i]["id_equipe"]);
            $equipe->setNome($lista[$i]["nome_equipe"] ?? null);
            $estudanteOBJ[$i]->setEquipe($equipe);
        }
        return $estudanteOBJ;
    }
}