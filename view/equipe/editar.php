<?php
if (session_status() === PHP_SESSION_NONE)
{
    session_start();
}
if((!isset($_POST["id"])) && (!isset($_SESSION["id"])))
{
    header("Location: listar.php");
}
$_POST["id"] = $_POST["id"] ?? $_SESSION["id"];

require_once(__DIR__."/../../controller/EquipeController.php");
$equipe = (new EquipeController())->buscarId()[0];
$_SESSION["nomeAtual"] = $equipe->getNome();

$nomeTabela = "Equipe";
$tabela = "equipe";
$titulo = "Editar equipe";
$acao="change";
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
$rolagem = "Edição de equipes";
include(__DIR__."/../components/footer.php");
?>