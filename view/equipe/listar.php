<?php
require_once(__DIR__."/../../controller/EquipeController.php");
require_once(__DIR__."/../../dto/EquipeDTO.php");

$equipes = (new EquipeController())->buscarTodos();

$nomeTabela = "Equipe";
$tabela = "equipe";
$titulo = "Listar equipes";

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
        <?php foreach($equipes as $e): ?>
            
                <?=(new EquipeDTO())->linha($e); ?>
            
        <?php endforeach; ?>
    </table>

</div>
<?php
$rolagem = "Listagem de equipes";
include(__DIR__."/../components/footer.php");
?>
