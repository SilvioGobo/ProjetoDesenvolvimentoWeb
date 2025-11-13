<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Sistema</h1>
        <p>Acesse suas credenciais:</p>
        <form action="/login" method="POST">
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <br>
            <div>
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            <br>
            <button type="submit">Entrar</button>
            <br>
            <p>Não tem uma conta? <a href="/register">Crie uma aqui</a></p>
        </form>
    </div>
</body>
</html>