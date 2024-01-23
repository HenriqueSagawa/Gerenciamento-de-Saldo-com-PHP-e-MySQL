<?php
    include_once('conexao.php');

    $nome = $_POST['nome'];
    $email = $_POST['emailCadastro'];
    $senha = $_POST['senhaCadastro'];
    $senha = password_hash($senha, PASSWORD_DEFAULT);

    $query = mysqli_prepare($conexao, "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
    $query->bind_param('sss', $nome, $email, $senha);
    $query->execute();

    $query2 = 'INSERT INTO saldo (saldo) VALUES (100.00)';
    $conexao->query($query2);

    header('location: index.php');

    $conexao -> close();
?>