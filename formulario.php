<?php 
    session_start();


    if (isset($_SESSION['logado']) && $_SESSION['logado']) header("Location: index.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    .container {
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      padding: 20px;
      width: 300px;
    }

    form {
      display: flex;
      flex-direction: column;
    }

    label {
      margin-bottom: 8px;
    }

    input {
      padding: 8px;
      margin-bottom: 16px;
    }

    button {
      background-color: #3498db;
      color: #fff;
      padding: 10px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    button:hover {
      background-color: #2980b9; 
    }
  </style>
  <title>Formulários de Cadastro e Login</title>
</head>
<body>
  <div class="container">
    <!-- Formulário de Cadastro -->
    <form id="cadastroForm" action="cadastro.php" method="post">
      <h2>Cadastro</h2>

      <label for="nome">Nome:</label>
      <input type="text" id="nome" name="nome" required>

      <label for="emailCadastro">E-mail:</label>
      <input type="email" id="emailCadastro" name="emailCadastro" required>

      <label for="senhaCadastro">Senha:</label>
      <input type="password" id="senhaCadastro" name="senhaCadastro" required>

      <button type="submit">Cadastrar</button>
    </form>

    <hr>

    <!-- Formulário de Login -->
    <form id="loginForm" action="login.php" method="post">
      <h2>Login</h2>

      <label for="emailLogin">E-mail:</label>
      <input type="email" id="emailLogin" name="emailLogin" required>

      <label for="senhaLogin">Senha:</label>
      <input type="password" id="senhaLogin" name="senhaLogin" required>

      <button type="submit">Entrar</button>
    </form>
  </div>

</body>
</html>
