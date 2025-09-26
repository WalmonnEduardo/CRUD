<form action="../../controller/EquipeController.php" method="post" class="bg-gray-700 h-[100%] w-full flex flex-col justify-center items-center">
    <div class="w-full px-5 flex items-center flex-col">
        <label for="nome" class="font-bold text-white">Nome:</label>
        <input type="text" name="nome" class="px-5 rounded-2xl w-3/4" value="<?=isset($_SESSION["nome"]) ? $_SESSION["nome"] : (isset($equipe) ? $equipe->getNome() : "") ?>">
    </div>
    <?php if(isset($equipe) && $equipe->getId() != null):?>
        <input type="hidden" name="id" class="px-5 rounded-2xl w-3/4" value="<?=isset($equipe) ? $equipe->getId() : ""?>"> 
    <?php endif;?>
    <input type="hidden" name="acao" value="<?=$acao?>">
    <button type="submit" class="mt-5 bg-green-800 px-4 py-2 rounded-2xl text-white">Enviar</button>
</form>