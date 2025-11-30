<?php
include 'config.php';

try {
    $stmt = $pdo->query("SELECT * FROM rutas ORDER BY id DESC");
    $rutas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    header('Content-Type: application/json');
    echo json_encode($rutas);
} catch(PDOException $e) {
    echo json_encode([]);
}
?>