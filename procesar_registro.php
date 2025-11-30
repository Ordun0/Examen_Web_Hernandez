<?php
// Este archivo procesa el formulario de registro de usuarios y reserva de visita
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombreCompleto = $_POST['nombreCompleto'] ?? '';
    $email = $_POST['email'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $password = $_POST['password'] ?? '';
    $fechaVisita = $_POST['fechaVisita'] ?? '';
    $horaVisita = $_POST['horaVisita'] ?? '';
    $numeroVisitantes = $_POST['numeroVisitantes'] ?? '';
    $rutaPreferida = $_POST['rutaPreferida'] ?? '';
    $requiereGuia = $_POST['requiereGuia'] ?? '';
    
    // Validar que los campos requeridos no estén vacíos
    if (empty($nombreCompleto) || empty($email) || empty($password) || empty($fechaVisita) || 
        empty($horaVisita) || empty($numeroVisitantes) || empty($rutaPreferida)) {
        echo json_encode(['success' => false, 'message' => 'Todos los campos obligatorios deben ser completados.']);
        exit();
    }
    
    // Validar formato de email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Por favor ingrese un correo electrónico válido.']);
        exit();
    }
    
    // Validar longitud de contraseña
    if (strlen($password) < 8) {
        echo json_encode(['success' => false, 'message' => 'La contraseña debe tener al menos 8 caracteres.']);
        exit();
    }
    
    // Validar fecha (no debe ser anterior a hoy)
    $fechaActual = date('Y-m-d');
    if ($fechaVisita < $fechaActual) {
        echo json_encode(['success' => false, 'message' => 'La fecha de visita no puede ser anterior a hoy.']);
        exit();
    }
    
    // Validar número de visitantes
    if ($numeroVisitantes < 1 || $numeroVisitantes > 20) {
        echo json_encode(['success' => false, 'message' => 'El número de visitantes debe estar entre 1 y 20.']);
        exit();
    }
    
    // Aquí normalmente se guardaría la información en la base de datos
    // Por ahora, simplemente devolvemos éxito
    
    // En una aplicación real, aquí iría la lógica para guardar el usuario y la reserva
    // Incluiría encriptar la contraseña, guardar en la base de datos, etc.
    
    echo json_encode(['success' => true, 'message' => 'Usuario registrado y visita reservada exitosamente.']);
    exit();
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
    exit();
}
?>