<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Veículo</title>
</head>
<body>

    <h1>Editar Veículo #<?php echo $veiculo->getId(); ?></h1>
    <a href="/veiculos">Cancelar e Voltar</a>
    <hr>

    <form action="/veiculos/atualizar" method="POST">
        
        <input type="hidden" name="id" value="<?php echo $veiculo->getId(); ?>">

        <label>Marca:</label><br>
        <input type="text" name="marca" required 
               value="<?php echo $veiculo->getMarca(); ?>">
        <br><br>

        <label>Modelo:</label><br>
        <input type="text" name="modelo" required 
               value="<?php echo $veiculo->getModelo(); ?>">
        <br><br>

        <label>Ano:</label><br>
        <input type="number" name="ano" required min="1900" max="2099" 
               value="<?php echo $veiculo->getAno(); ?>">
        <br><br>

        <label>Quilometragem (KM):</label><br>
        <input type="number" name="km" required 
               value="<?php echo $veiculo->getKm(); ?>">
        <br><br>

        <label>Condição:</label><br>
        <select name="condicao">
            <option value="novo" <?php echo ($veiculo->getCondicao() == 'novo') ? 'selected' : ''; ?>>
                Novo
            </option>
            <option value="usado" <?php echo ($veiculo->getCondicao() == 'usado') ? 'selected' : ''; ?>>
                Usado
            </option>
        </select>
        <br><br>

        <button type="submit">Salvar Alterações</button>

    </form>

</body>
</html>