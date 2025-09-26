<?php
if (session_status() === PHP_SESSION_NONE)
{
    session_start();
}
unset($_SESSION["nome"]);
unset($_SESSION["nomeAtual"]);
unset($_SESSION["idEquipe"]);
unset($_SESSION["idTurma"]);
unset($_SESSION["idRobo"]);
require_once(__DIR__."/../../controller/EstudanteController.php");
require_once(__DIR__."/../../dto/EstudanteDTO.php");
unset($_SESSION["data"]);
$estudantes = (new EstudanteController())->buscarTodos();
$nomeTabela = "Estudante";
$tabela = "estudante";
$titulo = "Listar Estudantes";
include(__DIR__."/../components/header.php");
?>
<div class="w-full h-[80dvh]">
    <table class="w-full">
        <tr>
            <th class="border-4 bg-gray-700 text-white">Id</th>
            <th class="border-4 bg-gray-600 text-white">Nome</th>
            <th class="border-4 bg-gray-700 text-white">Data de Nascimento</th>
            <th class="border-4 bg-gray-600 text-white">Turma</th>
            <th class="border-4 bg-gray-700 text-white">Robô</th>
            <th class="border-4 bg-gray-600 text-white">Equipe</th>
            <th class="border-4 bg-gray-700 text-white">Editar</th>
            <th class="border-4 bg-gray-600 text-white">Excluir</th>
        </tr>
        <?php foreach($estudantes as $e): ?>
            
            <?=(new EstudanteDTO())->linha($e); ?>
            
        <?php endforeach; ?>
    </table>

</div>
<?php
$rolagem = "Listagem de estudantes";
include(__DIR__."/../components/footer.php");
?>