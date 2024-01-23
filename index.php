<?php
    session_start();

    if (!$_SESSION['logado']) header('Location: formulario.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Página Inicial</title>
</head>
<body class="p-2">
    <h1><?php  echo "Olá " . $_SESSION['nome'];?> </h1>

    <p><?php echo "Seu saldo é: R$" . $_SESSION['saldo'];?></p>

    <a href="logout.php" class="btn btn-primary">Sair</a>
</body>
</html>