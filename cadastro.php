<?php
    include_once('conexao.php');

    $nome = $_POST['nome'];
    $email = $_POST['emailCadastro'];
    $senha = $_POST['senhaCadastro'];
    $senha = password_hash($senha, PASSWORD_DEFAULT);
    $imagemConteudo = file_get_contents('1586969992913_perfilsemfoto.jpg');

    $query = mysqli_prepare($conexao, "INSERT INTO usuarios (nome, email, foto, senha) VALUES (?, ?, ?, ?)");
    $query->bind_param('ssss', $nome, $email, $imagemConteudo, $senha);
    $query->execute();

    $query2 = 'INSERT INTO saldo (saldo) VALUES (100.00)';
    $conexao->query($query2);

    header('location: index.php');

    $conexao -> close();
?>