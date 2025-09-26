<a href="view/<?=$tabela?>/listar.php" class="h-[90%] w-[18%] bg-gray-700 hover:bg-gray-900 rounded-2xl">
    <div class="h-full w-full flex flex-col">
        <div class="h-1/2 w-full overflow-hidden flex justify-center items-center">
            <img src="img/<?=$tabela?>.png" alt="<?=$tabela?>" class="w-[70%]">
        </div>
        <div class="h-1/2 w-full text-white px-5 py-3 flex flex-col items-center justify-center">
            <b>
                <h3><?=ucfirst($tabela)?></h3>
            </b>
            <p>Aqui você editará a tabela <?=$tabela?></p>
        </div>
    </div>
</a>