<?php
require_once(__DIR__."/../../controller/TurmaController.php");
require_once(__DIR__."/../../dto/TurmaDTO.php");

$turmas = (new TurmaController())->buscarTodos();
$nomeTabela = "Turma";
$tabela = "turma";
$titulo = "Listar turmas";

unset($_SESSION["erros"]);
unset($_SESSION["nome"]);
unset($_SESSION["id"]);

include(__DIR__."/../components/header.php");
?>
<div class="w-full h-[80dvh]">
    <table class="w-full">
        <tr>
            <th class="border-4 bg-gray-700 text-white">Id</th>
            <th class="border-4 bg-gray-600 text-white">Nome</th>
            <th class="border-4 bg-gray-700 text-white">Editar</th>
            <th class="border-4 bg-gray-600 text-white">Excluir</th>
        </tr>
        <?php foreach($turmas as $t): ?>
            
                <?=(new TurmaDTO())->linha($t); ?>
            
        <?php endforeach; ?>
    </table>

</div>
<?php
$rolagem = "Listagem de turmas";
include(__DIR__."/../components/footer.php");
?>