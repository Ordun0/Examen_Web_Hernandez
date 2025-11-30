<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $locacion = $_POST['locacion'];
    $dificultad = $_POST['dificultad'];
    $rating = $_POST['rating'];
    
    try {
        $stmt = $pdo->prepare("INSERT INTO rutas (nombre, locacion, dificultad, rating) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nombre, $locacion, $dificultad, $rating]);
        
        // Redirigir de vuelta a la página principal con un mensaje de éxito
        header("Location: index.html?registrado=1");
        exit();
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    header("Location: index.html");
    exit();
}
?>