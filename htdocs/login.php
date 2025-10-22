<?php
include_once('connection.php');

if (isset($_POST['login'])) {
    $user = $_POST['usuario'] ?? '';
    $senha = $_POST['senha'] ?? '';

    $stmt = $conn->prepare("SELECT senha FROM registro WHERE usuario = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();


    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "Senha digitada: " . $senha . "<br>";
        echo "Hash no banco: " . $row['senha'] . "<br>";
        if (password_verify($senha, $row['senha'])) {
            header("Location: plano.html");
            exit;
        } else {
            echo "<script>alert('Senha incorreta.');</script>";
        }
    } else {
        echo "<script>alert('Usuário não encontrado.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="stylepanels.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
</head>
<header>
 <div class="header-box">
      <button class="home" onclick="window.location.href='index.html'"> 
        <img src="https://i.imgur.com/8wdi9k0.png" alt="Logo" class="logo">
    </button>
    </div>
  </header>
<body class="fade-in">
    <div class="cards-container">
    <div class="info-card">
    <h2>PÁGINA DE LOGIN</h2>
    <h3>*Para fazer o login, é necessário estar registrado*</h1>
    <form action="" method="POST">
        <p>
            <label>Usuário</label>
            <input type="text" name="usuario" required>
        </p>
        <p>
            <label>Senha</label>
            <input type="password" name="senha" required>
        </p>
        <p2>
        <input type="submit" name="login" value="Entrar">
        </p2>
        <p3>Não está registrado? <a href="register.php">Registro</a></p3>
  </form>
  </div>
</body>
</html>
