<?php
require_once(__DIR__."/../../controller/CategoriaController.php");
require_once(__DIR__."/../../dto/CategoriaDTO.php");

$categorias = (new CategoriaController(null))->buscarTodos();

$nomeTabela = "Categoria";
$tabela = "categoria";
$titulo = "Listar categorias";

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
        <?php foreach($categorias as $c): ?>
            <tr>
                <?=(new CategoriaDTO())->linha($c); ?>
            </tr>
        <?php endforeach; ?>
    </table>

</div>
<?php
$rolagem = "Listagem de categorias";
include(__DIR__."/../components/footer.php");
?>