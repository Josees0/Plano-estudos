<?php
    include_once('connection.php');

   if (isset($_POST['submit'])) {
        $user = $_POST['user'] ?? '';
        $senha = $_POST['senha'] ?? '';
        $confirmar_senha = $_POST['confirmar_senha'] ?? '';

   if ($senha === $confirmar_senha) {
           $result = mysqli_query($conn, "INSERT INTO registro(User, Senha) VALUES ('$user', '$senha')");
            
            if ($result) {
               echo("<script>window.location.href='criar-plano.html';</script>");
            } else {
                echo "Erro no registro" . mysqli_error($conn);
            }
        } else {
            echo "Senhas nao coincidem";
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <form action="loginpage.php" method="POST">
        <p>
            <label>Usuário</label>
            <input type="text" name="user" id="user" required>
        </p>
        <p>
            <label>Senha</label>
            <input type="password" name="senha" id="senha" required>
        </p>
        <p>
            <label>Confirmar Senha</label>
            <input type="password" name="confirmar_senha" id="confirmar_senha" required>
        </p>
        <input type="submit" value="Registrar" name="submit" id="submit">
    </form>
</body>
</html>
