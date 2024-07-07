<?php
session_start();
require 'config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE correo = ? AND password = ?');
    $stmt->execute([$correo, $password]);
    $user = $stmt->fetch();

    if ($user) {
        $_SESSION['user_id'] = $user['UsuarioId'];
        header('Location: views/dashboard.php');
    } else {
        echo 'Usuario o contraseña incorrectos';
    }
}
?>

<form action="login.php" method="POST">
    <input type="text" name="correo" placeholder="Correo">
    <input type="password" name="password" placeholder="Contraseña">
    <button type="submit">Ingresar</button>
</form>