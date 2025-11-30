<?php
include 'config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Datos del formulario
    $nombreCompleto = $_POST['nombreCompleto'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $fechaVisita = $_POST['fechaVisita'] ?? '';
    $horaVisita = $_POST['horaVisita'] ?? '';
    $visitantes = $_POST['visitantes'] ?? '';
    $rutaPreferida = $_POST['rutaPreferida'] ?? '';
    $guia = isset($_POST['guia']) ? 1 : 0; // Convert checkbox to 0 or 1

    // Validar que los campos requeridos no estén vacíos
    if (empty($nombreCompleto) || empty($email) || empty($password) || empty($confirmPassword) || 
        empty($fechaVisita) || empty($horaVisita) || empty($visitantes) || empty($rutaPreferida)) {
        echo json_encode(['success' => false, 'message' => 'Todos los campos obligatorios deben estar completos.']);
        exit;
    }

    // Validar que las contraseñas coincidan
    if ($password !== $confirmPassword) {
        echo json_encode(['success' => false, 'message' => 'Las contraseñas no coinciden.']);
        exit;
    }

    // Validar formato de email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Formato de email inválido.']);
        exit;
    }

    try {
        // Verificar si el email ya existe
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => false, 'message' => 'El email ya está registrado.']);
            exit;
        }

        // Encriptar la contraseña
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Iniciar transacción
        $pdo->beginTransaction();

        // Insertar usuario
        $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, email, password, telefono) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nombreCompleto, $email, $passwordHash, $telefono]);
        $usuarioId = $pdo->lastInsertId();

        // Insertar reserva
        $stmt = $pdo->prepare("INSERT INTO reservas (usuario_id, fecha_visita, hora_visita, numero_visitantes, ruta_preferida, requiere_guia) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$usuarioId, $fechaVisita, $horaVisita, $visitantes, $rutaPreferida, $guia]);

        // Confirmar transacción
        $pdo->commit();

        echo json_encode(['success' => true, 'message' => 'Registro y reserva completados exitosamente.']);
    } catch (Exception $e) {
        // Revertir transacción en caso de error
        $pdo->rollback();
        echo json_encode(['success' => false, 'message' => 'Error al procesar los datos: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método de solicitud no válido.']);
}
?>