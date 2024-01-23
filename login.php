<?php
include_once('conexao.php');

if (!session_id()) session_start();

$email = $_POST['emailLogin'];
$loginSenha = $_POST['senhaLogin'];

$query = mysqli_prepare($conexao, "SELECT id, nome, email, senha FROM usuarios WHERE email = ?");
$query->bind_param('s', $email);

$query->execute();
$resultado = $query->get_result();

$senha = '';
$nome = '';
$id = '';
$email = '';

if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $senha = $row['senha'];
        $nome = $row['nome'];
        $id = $row['id'];
        $email = $row['email'];
    }
}

if (password_verify($loginSenha, $senha)) {
    $_SESSION['logado'] = true;
    $_SESSION['id'] = $id;
    $_SESSION['nome'] = $nome;
    $_SESSION['email'] = $email;

    $query2 = "SELECT saldo FROM saldo WHERE id = $id";
    $resultado2 = $conexao->query($query2);

    if ($resultado2->num_rows > 0) {
        while ($row = $resultado2->fetch_assoc()) {
            $saldo = $row['saldo'];
            $_SESSION['saldo'] = $saldo;
        }
    }

    header("Location: index.php");
    echo "<script>alert('Login realizado com sucesso');</script>";
} else {
    header("Location: formulario.php");
    echo "<script>alert('Algo deu de errado');</script>";
}
?>
