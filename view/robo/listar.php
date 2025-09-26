<?php
if (session_status() === PHP_SESSION_NONE)
{
    session_start();
}
unset($_SESSION["erros"]);
unset($_SESSION["nome"]);
unset($_SESSION["id"]);
require_once(__DIR__."/../../controller/RoboController.php");
require_once(__DIR__."/../../dto/RoboDTO.php");

$robos = (new RoboController(null))->buscarTodos();
$nomeTabela = "Robô";
$tabela = "robo";
$titulo = "Listar robôs";
include(__DIR__."/../components/header.php");
?>
<div class="w-full h-[80dvh]">
    <table class="w-full">
        <tr>
            <th class="border-4 bg-gray-700 text-white">Id</th>
            <th class="border-4 bg-gray-600 text-white">Nome</th>
            <th class="border-4 bg-gray-700 text-white">Categoria</th>
            <th class="border-4 bg-gray-600 text-white">Equipe</th>
            <th class="border-4 bg-gray-700 text-white">Editar</th>
            <th class="border-4 bg-gray-600 text-white">Excluir</th>
        </tr>
        <?php foreach($robos as $r): ?>
            
            <?=(new RoboDTO())->linha($r); ?>
            
        <?php endforeach; ?>
    </table>

</div>
<?php
$rolagem = "Listagem de robôs";
include(__DIR__."/../components/footer.php");
?>