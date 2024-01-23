<?php
session_start();
include_once('conexao.php');

if (!$_SESSION['logado'] == true) header("Location: formulario.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['confirmar'])) {
        $pessoa = $_POST['pessoa'];
        $valor = $_POST['valor'];

        if ($valor > $_SESSION['saldo']) {
            echo "<script>alert('Saldo insuficiente'); window.location.href = 'transacao.php'</script>";
            die();
        }

        $_SESSION['valorEnviado'] = $valor;
        $_SESSION['pessoaEnviada'] = $pessoa;

        $query = "SELECT nome, foto FROM usuarios WHERE id = $pessoa";
        $resultado = $conexao->query($query);

        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $nome = $row['nome'];
                $fotoConteudo = $row['foto'];
                echo "
                    <form action='' method='post' class='position-absolute alert alert-danger rounded-bottom fixed-top col-md-6 mx-auto' style=''>
                        <h3>Deseja enviar R$$valor para $nome</h3>
                        <img src='mostrar_imagem.php?id=" . $pessoa . "' style='width: 5rem; height: fit-content;'> <br>
                        <button type='submit'name='enviar' class='btn btn-success mt-1'>Enviar</button>
                        <a href='transacao.php' class='btn btn-danger mt-1'>Não</a>
                    </form>
                    ";
            }
        } else {
            echo "<script>alert('Pessoa não encontrada'); window.location.href = 'transacao.php';</script>";
            die();
        }
    } elseif (isset($_POST['enviar'])) {
        $saldoFinal = $_SESSION['saldo'] - $_SESSION['valorEnviado'];
        $pessoa = $_SESSION['pessoaEnviada'];
        $valor = $_SESSION['valorEnviado'];

        $usuarioAtual = $_SESSION['id'];

        $query2 = "UPDATE saldo SET saldo = $saldoFinal WHERE id = $usuarioAtual;";
        $conexao->query($query2);


        $query3 = "SELECT saldo FROM saldo WHERE id = $pessoa";
        $resultado3 = $conexao->query($query3);

        if ($resultado3->num_rows > 0) {
            while ($row = $resultado3->fetch_assoc()) {
                $saldo = $row['saldo'];
            }
        }

        $pagamento = $saldo + $valor;

        $query4 = "UPDATE saldo SET saldo = $pagamento WHERE id = $pessoa";
        $conexao->query($query4);

        $query5 = "SELECT saldo FROM saldo WHERE id = $usuarioAtual";
        $resutlado5 = $conexao->query($query5);

        if ($resutlado5->num_rows > 0) {
            while ($row = $resutlado5->fetch_assoc()) {
                $_SESSION['saldo'] = $row['saldo'];
            }
        }

        header('Location: index.php');
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Pagar</title>
</head>

<body class="p-3">
    <h1><?php echo "Seu saldo atual: R$" . $_SESSION['saldo'] ?></h1>

    <form action="" method="post">
        <h4>Insira o ID</h4>
        <div class="input-group mb-3">
            <span class="input-group-text">#</span>
            <input type="number" name="pessoa" class="form-control" style="max-width: 250px;" aria-label="Dollar amount (with dot and two decimal places)">
        </div>

        <h4>Insira o valor</h4>
        <div class="input-group mb-3">
            <span class="input-group-text">$</span>
            <input type="number" name="valor" class="form-control" style="max-width: 250px;" aria-label="Dollar amount (with dot and two decimal places)">
        </div>
        <button type="submit" class="btn btn-primary" name="confirmar">Confirmar</button>
    </form>
</body>

</html>