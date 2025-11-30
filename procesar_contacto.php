<?php
// Este archivo procesa el formulario de contacto
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre_contacto'] ?? '';
    $email = $_POST['email'] ?? '';
    $mensaje = $_POST['mensaje'] ?? '';
    
    // Aquí normalmente se enviaría un email o se guardaría en la base de datos
    // Por ahora, simplemente redirigimos de vuelta al index con un mensaje
    
    // Validar que los campos no estén vacíos
    if (!empty($nombre) && !empty($email) && !empty($mensaje)) {
        // En una aplicación real, aquí iría la lógica para enviar el mensaje
        header("Location: index.php?contacto=enviado");
        exit();
    } else {
        header("Location: index.php?contacto=error");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>