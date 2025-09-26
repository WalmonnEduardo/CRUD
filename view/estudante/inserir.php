<?php
if (session_status() === PHP_SESSION_NONE)
{
    session_start();
}
require_once(__DIR__."/../../controller/TurmaController.php");
require_once(__DIR__."/../../controller/RoboController.php");
require_once(__DIR__."/../../controller/EquipeController.php");

$turmas = (new TurmaController)->buscarTodos();
$robos = (new RoboController)->buscarTodos();
$equipes = (new EquipeController)->buscarTodos();

$nomeTabela = "Estudante";
$tabela = "estudante";
$titulo = "Cadastrar estudante";
$acao = "insert";
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
$rolagem = "Cadastro de estudante";
include(__DIR__."/../components/footer.php");
?>