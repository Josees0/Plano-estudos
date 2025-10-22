<?php
include_once('connection.php');

if (isset($_POST['submit'])) {
    $user = $_POST['usuario'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $confirmar_senha = $_POST['confirmar_senha'] ?? '';
    $codigo = $_POST['codigo'] ?? '';

    if ($senha !== $confirmar_senha) {
        echo "<script>alert('Senhas não coincidem'); window.location.href=window.location.href;</script>";
    }
    else {$stmt = $conn->prepare("SELECT * FROM codigos_validos WHERE codigo = ? AND valido = FALSE");
    $stmt->bind_param("s", $codigo);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        echo "<script>alert('Código inválido ou já utilizado'); window.location.href=window.location.href;</script>";
        exit;
    }
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
    $stmt_registro = $conn->prepare("INSERT INTO registro(usuario, senha) VALUES (?, ?)");
    $stmt_registro->bind_param("ss", $user, $senha_hash);
    $registro_ok = $stmt_registro->execute();

    if ($registro_ok) {
        $stmt_update = $conn->prepare("UPDATE codigos_validos SET valido = TRUE WHERE codigo = ?");
        $stmt_update->bind_param("s", $codigo);
        $stmt_update->execute();
        echo("<script>window.location.href='login.php';</script>");
    } else {
        echo "Erro no registro: " . $conn->error;
    }
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
    <h2>PÁGINA DE REGISTRO</h2>
    <h3>*Código obrigatório para registro*</h1>
    <form action="" method="POST">
        <p>
            <label>Usuário</label>
            <input type="text" name="usuario" id="user" required>
        </p>
        <p>
            <label>Senha</label>
            <input type="password" name="senha" id="senha" required>
        </p>
        <p>
            <label>Confirmar Senha</label>
            <input type="password" name="confirmar_senha" id="confirmar_senha" required>
        </p>
        <p>
            <label>Código de Assinante</label>
            <input type="text" name="codigo" id="codigo" required>
        </p>
        <p2>
        <input type="submit" value="Registrar" name="submit" id="submit">
        </p2>
        <p3>Já tem uma conta? <a href="login.php">Logar</a></p3>
    </form>
  </div>
    
</body>
</html>
