<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Novo Veículo</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

    <div class="container">
        <h1>Cadastrar Novo Veículo</h1>
        <a href="/veiculos">Voltar para a lista</a>
        <hr>
        <form action="/veiculos/criar" method="POST">
        
            <label>Marca:</label><br>
            <input type="text" name="marca" required placeholder="Ex: Fiat">
            <br><br>
            <label>Modelo:</label><br>
            <input type="text" name="modelo" required placeholder="Ex: Uno Mille">
            <br><br>
            <label>Ano:</label><br>
            <input type="number" name="ano" required min="1900" max="2099">
            <br><br>
            <label>Quilometragem (KM):</label><br>
            <input type="number" name="km" required>
            <br><br>
            <label>Condição:</label><br>
            <select name="condicao">
                <option value="novo">Novo</option>
                <option value="usado" selected>Usado</option>
            </select>
            <br><br>
            <button type="submit">Salvar Veículo</button>
        </form>
    </div>

</body>
</html>