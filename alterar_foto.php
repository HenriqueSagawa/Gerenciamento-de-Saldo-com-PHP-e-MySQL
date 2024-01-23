<?php
session_start();
include_once('conexao.php');
$imagemBlob = file_get_contents($_FILES['imagem']['tmp_name']);
$id = $_SESSION['id'];

$query = mysqli_prepare($conexao, "UPDATE usuarios SET foto = ? WHERE id = ?");
$query->bind_param('si', $imagemBlob, $id);
$query->execute();

$query->close();
header("Location: index.php");
