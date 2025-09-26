<form action="../../controller/EstudanteController.php" method="post" class="bg-gray-700 h-[100%] w-full flex flex-col justify-center items-center">
    <div class="w-full px-5 flex items-center flex-col">
        <label for="nome" class="font-bold text-white">Nome:</label>
        <input type="text" name="nome" class="px-5 rounded-2xl w-3/4"
            value="<?= isset($_SESSION['nome']) ? $_SESSION['nome'] : (isset($estudante) ? $estudante->getNome() : '') ?>">
    </div>
    <div class="w-full px-5 flex items-center flex-col">
        <label for="data_nascimento" class="font-bold text-white">Data de nascimento:</label>
        <input type="date" name="data_nascimento" class="px-5 rounded-2xl w-3/4"
            value="<?= isset($_SESSION['data']) ? $_SESSION['data'] : (isset($estudante) ? $estudante->getDataNascimento() : '') ?>">
    </div>
    <div class="w-full px-5 flex items-center flex-col">
        <label for="id_turma" class="font-bold text-white">Turma:</label>
        <select name="id_turma" class="px-5 rounded-2xl w-3/4">
            <option value="0">Selecione</option>
            <?php foreach($turmas as $t): ?>
                <option value="<?=$t->getId()?>"
                    <?= (isset($_SESSION['idTurma']) && $_SESSION['idTurma'] == $t->getId() ? 'selected' : '') ?>
                    <?= (isset($estudante) && $estudante->getTurma()->getId() == $t->getId() ? 'selected' : '') ?>>
                    <?=$t->getNome()?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="w-full px-5 flex items-center flex-col">
        <label for="id_equipe" class="font-bold text-white">Equipe:</label>
        <select name="id_equipe" class="px-5 rounded-2xl w-3/4">
            <option value="0">Selecione</option>
            <?php foreach($equipes as $e): ?>
                <option value="<?=$e->getId()?>"
                    <?= (isset($_SESSION['idEquipe']) && $_SESSION['idEquipe'] == $e->getId() ? 'selected' : '') ?>
                    <?= (isset($estudante) && $estudante->getEquipe()->getId() == $e->getId() ? 'selected' : '') ?>>
                    <?=$e->getNome()?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="w-full px-5 flex items-center flex-col">
        <label for="id_robo" class="font-bold text-white">Robô:</label>
        <select name="id_robo" id="id_robo" class="px-5 rounded-2xl w-3/4">
            <option value="0">Selecione</option>
            <?php foreach($robos as $r): ?>
                <option value="<?=$r->getId()?>"
                    data-equipe="<?=$r->getEquipe()->getId()?>"
                    <?php if(isset($_SESSION["idRobo"])):?>
                        <?= (isset($_SESSION['idRobo']) && $_SESSION['idRobo'] == $r->getId() ? 'selected' : '') ?>
                    <?php else:?>
                        <?= (isset($estudante) && $estudante->getRobo()->getId() == $r->getId() ? 'selected' : '') ?>
                    <?php endif;?>
                    >
                    <?=$r->getNome()?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <?php if ((isset($estudante) && $estudante->getId() != null) || (isset($_SESSION['id']) && $_SESSION['id'] != null)): ?>
        <input type="hidden" name="id" value="<?= isset($estudante) ? $estudante->getId() : $_SESSION['id'] ?>">
    <?php endif; ?>
    <input type="hidden" name="acao" value="<?=$acao?>">

    <button type="submit" class="mt-5 bg-green-800 px-4 py-2 rounded-2xl text-white">Enviar</button>
</form>
