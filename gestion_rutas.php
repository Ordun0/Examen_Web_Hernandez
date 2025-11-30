<?php
include 'config.php';

$action = $_POST['action'] ?? $_GET['action'] ?? '';

switch($action) {
    case 'eliminar':
        eliminarRuta();
        break;
    case 'editar':
        editarRuta();
        break;
    case 'crear':
        crearRuta();
        break;
    default:
        header("Location: index.php");
        exit();
}

function eliminarRuta() {
    global $pdo;
    
    $id = $_POST['id'] ?? 0;
    
    if($id > 0) {
        try {
            $stmt = $pdo->prepare("DELETE FROM rutas WHERE id = ?");
            $stmt->execute([$id]);
        } catch(PDOException $e) {
            die("Error al eliminar la ruta: " . $e->getMessage());
        }
    }
    
    header("Location: index.php");
    exit();
}

function editarRuta() {
    global $pdo;
    
    $id = $_POST['id'] ?? 0;
    $nombre = $_POST['nombre'] ?? '';
    $locacion = $_POST['locacion'] ?? '';
    $dificultad = $_POST['dificultad'] ?? '';
    $rating = $_POST['rating'] ?? '';
    
    if($id > 0 && $nombre && $locacion && $dificultad !== '' && $rating !== '') {
        try {
            $stmt = $pdo->prepare("UPDATE rutas SET nombre = ?, locacion = ?, dificultad = ?, rating = ? WHERE id = ?");
            $stmt->execute([$nombre, $locacion, $dificultad, $rating, $id]);
        } catch(PDOException $e) {
            die("Error al actualizar la ruta: " . $e->getMessage());
        }
    }
    
    header("Location: index.php");
    exit();
}

function crearRuta() {
    global $pdo;
    
    $nombre = $_POST['nombre'] ?? '';
    $locacion = $_POST['locacion'] ?? '';
    $dificultad = $_POST['dificultad'] ?? '';
    $rating = $_POST['rating'] ?? '';
    
    if($nombre && $locacion && $dificultad !== '' && $rating !== '') {
        try {
            $stmt = $pdo->prepare("INSERT INTO rutas (nombre, locacion, dificultad, rating) VALUES (?, ?, ?, ?)");
            $stmt->execute([$nombre, $locacion, $dificultad, $rating]);
        } catch(PDOException $e) {
            die("Error al crear la ruta: " . $e->getMessage());
        }
    }
    
    header("Location: index.php");
    exit();
}
?>