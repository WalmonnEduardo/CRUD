<?php
require_once(__DIR__."/../../controller/CategoriaController.php");
require_once(__DIR__."/../../controller/EquipeController.php");

$categorias = (new CategoriaController)->buscarTodos();
$equipes = (new EquipeController)->buscarTodos();
$acao="insert";
$nomeTabela = "Robo";
$tabela = "robo";
$titulo = "Cadastrar robô";
include(__DIR__."/../components/header.php");
?>
<div class="w-full h-[80dvh] flex justify-evenly">
    <div class="h-[100%] w-1/2">
        <?php
            include_once(__DIR__."/components/form.php")
        ?>
    </div>
    <?php if(isset($_SESSION["erros"])): ?>
        <div class="h-[100%] w-1/2 bg-red-900 text-white">
            <?php foreach($_SESSION["erros"] as $e)
                print $e."<br>";    
            ?>
        </div>
    <?php endif; ?>
</div>
<?php
$rolagem = "Cadastrar de robôs";
include(__DIR__."/../components/footer.php");
?>