<?php
require '../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    switch ($action) {
        case 'create':
            createProduct($pdo);
            break;
        case 'update':
            updateProduct($pdo);
            break;
        case 'delete':
            deleteProduct($pdo);
            break;
    }
}

function createProduct($pdo) {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    $stmt = $pdo->prepare('INSERT INTO productos (nombre, precio, stock) VALUES (?, ?, ?)');
    $stmt->execute([$nombre, $precio, $stock]);
    header('Location: ../views/dashboard.php');
}

function updateProduct($pdo) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    $stmt = $pdo->prepare('UPDATE productos SET nombre = ?, precio = ?, stock = ? WHERE id = ?');
    $stmt->execute([$nombre, $precio, $stock, $id]);
    header('Location: ../views/dashboard.php');
}

function deleteProduct($pdo) {
    $id = $_POST['id'];

    $stmt = $pdo->prepare('DELETE FROM productos WHERE id = ?');
    $stmt->execute([$id]);
    header('Location: ../views/dashboard.php');
}
?>