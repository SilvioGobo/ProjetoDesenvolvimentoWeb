<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Veículos</title>
</head>
<body>
    <header>
        <h1>Gestão de Veículos</h1>
        <p>Olá, <strong><?php echo $_SESSION['usuario_nome']; ?></strong> | 
           <a href="/logout" style="color: red;">Sair</a>
        </p>
    </header>

    <hr>

    <a href="/veiculos/criar">
        <button>+ Novo Veículo</button>
    </a>

    <br><br>

    <table border="1" width="100%" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Ano</th>
                <th>Condição</th>
                <th>KM</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($veiculos)): ?>
                <tr>
                    <td colspan="7" align="center">Nenhum veículo cadastrado.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($veiculos as $veiculo): ?>
                    <tr>
                        <td><?php echo $veiculo->getId(); ?></td>
                        <td><?php echo $veiculo->getMarca(); ?></td>
                        <td><?php echo $veiculo->getModelo(); ?></td>
                        <td><?php echo $veiculo->getAno(); ?></td>
                        <td><?php echo $veiculo->getCondicao(); ?></td>
                        <td><?php echo number_format($veiculo->getKm(), 0, ',', '.'); ?> km</td>
                        <td>
                            <a href="/veiculos/atualizar?id=<?php echo $veiculo->getId(); ?>">Editar</a>
                            |
                            <a href="/veiculos/deletar?id=<?php echo $veiculo->getId(); ?>" 
                               onclick="return confirm('Tem certeza que deseja excluir?');">
                               Excluir
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
    </table>
</body>
</html>