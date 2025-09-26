<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=isset($tabela) ? "CRUD ". ucfirst($tabela) : "Robótica"?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <header class="h-[7vh] w-[100vw] bg-black flex justify-center items-center">
        <h1 class="text-white text-3xl font-bold"><?=$titulo ?></h1>
        <?php if(isset($tabela)): ?>
            <a href="../../index.php" class="h-[5%] w-[80px] rounded-2xl bg-green-500 text-white flex justify-center items-center p-3 absolute right-2"><p>Início</p></a>
        <?php endif; ?>
    </header>
    <div class="h-[3vh] w-[100vw] bg-gray-800 flex justify-evenly items-center text-white">
        <?php if(isset($tabela)): ?>
            <ul class="w-full flex justify-evenly items-center text-white">
                <li><a href="inserir.php">Cadastro</a></li>
                <li><a href="listar.php">Lista</a></li>
            </ul>
        <?php endif; ?>
    </div>
