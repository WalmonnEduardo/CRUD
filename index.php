<?php
$itens = ["turma","equipe","categoria","robo","estudante"];
$titulo = "Página incial";
if (session_status() === PHP_SESSION_NONE)
{
    session_start();
}
unset($_SESSION["erros"]);
include_once(__DIR__."/view/components/header.php");
?>
<main class="h-[80dvh] w-full flex items-center justify-evenly">
    <?php 
        foreach($itens as $tabela)
        {
            include(__DIR__."/view/components/card.php");
        }
    ?>
</main>
<?php
$rolagem = "Feito por Walmonn Eduardo";
include_once(__DIR__."/view/components/footer.php");
?>
 