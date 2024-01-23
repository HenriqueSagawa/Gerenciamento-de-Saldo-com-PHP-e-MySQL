<?php
include_once('conexao.php');
session_start();

$id = isset($_GET['id']) ? intval($_GET['id']) : die('ID da imagem não fornecido.');

$sql = "SELECT foto FROM usuarios WHERE id = $id";
$result = $conexao->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $imagemConteudo = $row['foto'];

    echo $imagemConteudo;
} else {
    echo "Imagem não encontrada.";
}

$conexao->close();
?>
?>