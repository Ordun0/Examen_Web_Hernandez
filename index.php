<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rutas de Escalada - Parque Nacional</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Rutas de Escalada - Parque Nacional</h1>
        <nav>
            <ul>
                <li><a href="#inicio">Inicio</a></li>
                <li><a href="#rutas">Ver Rutas</a></li>
                <li><a href="#registro">Registrar Ruta</a></li>
                <li><a href="#contacto">Contacto</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="inicio">
            <h2>Bienvenido al Sistema de Gestión de Rutas de Escalada</h2>
            <p>Este sistema permite gestionar las rutas de escalada del Parque Nacional.</p>
        </section>

        <section id="rutas">
            <h2>Rutas Disponibles</h2>
            <div id="rutas-lista">
                <?php
                include 'config.php';
                
                try {
                    $stmt = $pdo->query("SELECT * FROM rutas ORDER BY id DESC");
                    $rutas = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    
                    if (count($rutas) > 0) {
                        foreach ($rutas as $ruta) {
                            echo '<div class="ruta-item">';
                            echo '<h3>' . htmlspecialchars($ruta['nombre']) . '</h3>';
                            echo '<div class="ruta-info">';
                            echo '<div><strong>Locación:</strong> ' . htmlspecialchars($ruta['locacion']) . '</div>';
                            echo '<div><strong>Dificultad:</strong> <span class="ruta-dificultad dificultad-' . $ruta['dificultad'] . '">Clase ' . $ruta['dificultad'] . '</span></div>';
                            echo '<div><strong>Rating:</strong> <span class="ruta-rating">' . str_repeat('★', $ruta['rating']) . '</span></div>';
                            echo '</div>';
                            
                            // Botones de editar y eliminar
                            echo '<div class="acciones-ruta">';
                            echo '<button class="btn-editar" onclick="editarRuta(' . $ruta['id'] . ', \'' . addslashes($ruta['nombre']) . '\', \'' . addslashes($ruta['locacion']) . '\', \'' . $ruta['dificultad'] . '\', \'' . $ruta['rating'] . '\')">Editar</button>';
                            echo '<form method="post" action="gestion_rutas.php" style="display:inline;" onsubmit="return confirm(\'¿Está seguro de que desea eliminar esta ruta?\');">';
                            echo '<input type="hidden" name="action" value="eliminar">';
                            echo '<input type="hidden" name="id" value="' . $ruta['id'] . '">';
                            echo '<button type="submit" class="btn-eliminar">Eliminar</button>';
                            echo '</form>';
                            echo '</div>';
                            
                            echo '</div>';
                        }
                    } else {
                        echo '<p>No hay rutas registradas aún.</p>';
                    }
                } catch(PDOException $e) {
                    echo '<p>Error al cargar las rutas: ' . $e->getMessage() . '</p>';
                }
                ?>
            </div>
        </section>

        <section id="registro">
            <h2>Registrar/Actualizar Ruta</h2>
            <form id="ruta-form" action="gestion_rutas.php" method="POST">
                <input type="hidden" name="action" value="crear">
                <div class="form-group">
                    <label for="nombre">Nombre de la Ruta:</label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>
                
                <div class="form-group">
                    <label for="locacion">Locación (Cañón/Valle/Bosque):</label>
                    <input type="text" id="locacion" name="locacion" required>
                </div>
                
                <div class="form-group">
                    <label for="dificultad">Dificultad (0-3):</label>
                    <select id="dificultad" name="dificultad" required>
                        <option value="">Seleccione...</option>
                        <option value="0">Clase 0 (Fácil)</option>
                        <option value="1">Clase 1 (Intermedio)</option>
                        <option value="2">Clase 2 (Difícil)</option>
                        <option value="3">Clase 3 (Experto)</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="rating">Rating (1-5):</label>
                    <select id="rating" name="rating" required>
                        <option value="">Seleccione...</option>
                        <option value="1">1 Estrella</option>
                        <option value="2">2 Estrellas</option>
                        <option value="3">3 Estrellas</option>
                        <option value="4">4 Estrellas</option>
                        <option value="5">5 Estrellas</option>
                    </select>
                </div>
                
                <button type="submit">Registrar Ruta</button>
                <button type="button" onclick="resetForm()">Cancelar</button>
            </form>
        </section>

        <section id="contacto">
            <h2>Contacto</h2>
            <form id="contacto-form" action="procesar_contacto.php" method="POST">
                <div class="form-group">
                    <label for="nombre_contacto">Nombre:</label>
                    <input type="text" id="nombre_contacto" name="nombre_contacto" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="mensaje">Mensaje:</label>
                    <textarea id="mensaje" name="mensaje" required></textarea>
                </div>
                
                <button type="submit">Enviar</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Sistema de Gestión de Rutas de Escalada</p>
    </footer>

    <script src="js/script.js"></script>
    <?php
    if (isset($_GET['registrado']) && $_GET['registrado'] == 1) {
        echo '<script>alert("Ruta registrada exitosamente");</script>';
    }
    
    if (isset($_GET['contacto'])) {
        if ($_GET['contacto'] == 'enviado') {
            echo '<script>alert("Mensaje de contacto enviado exitosamente");</script>';
        } elseif ($_GET['contacto'] == 'error') {
            echo '<script>alert("Error al enviar el mensaje de contacto");</script>';
        }
    }
    ?>
</body>
</html>