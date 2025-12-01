# Sistema de Gestión de Rutas de Escalada - Parque Nacional

## Descripción del sistema

Este sistema web permite gestionar las rutas de escalada del Parque Nacional. Proporciona funcionalidades CRUD (Crear, Leer, Actualizar, Eliminar) para administrar la información de las rutas, incluyendo nombre, ubicación, dificultad y rating.

## Funciones implementadas

- **Registro de rutas**: Permite ingresar nuevas rutas con su nombre, ubicación, dificultad y rating.
- **Visualización de rutas**: Muestra todas las rutas registradas en el sistema con sus detalles.
- **Formulario de contacto**: Sistema para que los usuarios puedan contactar al administrador.
- **Validación de formularios**: Validación tanto en el cliente como en el servidor.

## Tecnologías utilizadas

- **Frontend**: HTML5, CSS3, JavaScript
- **Backend**: PHP
- **Base de datos**: MySQL
- **Servidor**: Apache (mediante XAMPP u otro entorno local)

## Estructura del proyecto

```
/workspace/
├── index.php              # Página principal con todas las funcionalidades
├── config.php             # Configuración de la base de datos
├── registrar_ruta.php     # Procesa el registro de nuevas rutas
├── obtener_rutas.php      # Obtiene las rutas desde la base de datos
├── crear_base_datos.sql   # Script SQL para crear la base de datos
├── css/
│   └── styles.css         # Hoja de estilos
├── js/
│   └── script.js          # Archivos JavaScript
└── README.md              # Documentación del proyecto
```

## Instalación y configuración

1. Copiar todos los archivos en el directorio htdocs de XAMPP o en el directorio web de tu servidor local.
2. Importar el archivo `crear_base_datos.sql` en tu servidor MySQL para crear la base de datos y la tabla necesaria.
3. Asegurarse de que el servidor Apache y MySQL estén corriendo.
4. Acceder al sistema mediante un navegador web.

## Requisitos del sistema

- Apache Web Server
- PHP 7.0 o superior
- MySQL 5.6 o superior
- Navegador web moderno

## Manual de usuario

### Visualizar el sistema completo
1. Descargar el zip del repositorio
2. Mover todos los documentos a una carpeta dentro de la carpeta raiz del servidor, en Linux es: '/var/www/html'.
3. Modificar el archivo 'config.php' con las credenciales correctas de su SQL.
4. Importar el documento 'crear_base_de_datos.sql' en PHPmyAdmin.
5. Para modificar la base de datos acceder a "http://localhost/"nombre de la carpeta creada en la raiz"/index.php".

### Registro de una nueva ruta

1. Navegar a la sección "Registrar Ruta" en la página principal.
2. Completar el formulario con los siguientes campos:
   - Nombre de la Ruta: Nombre descriptivo de la ruta
   - Locación: Ubicación dentro del parque (cañón, valle, bosque)
   - Dificultad: Nivel de dificultad (Clase 0-3)
   - Rating: Calificación de la ruta (1-5 estrellas)
3. Hacer clic en "Registrar Ruta"

### Visualización de rutas

Todas las rutas registradas se muestran en la sección "Rutas Disponibles", mostrando:
- Nombre de la ruta
- Locación dentro del parque
- Nivel de dificultad con codificación por colores
- Rating en estrellas

## Base de datos

La base de datos `parque_nacional` contiene una tabla llamada `rutas` con la siguiente estructura:

- `id`: Identificador único autoincremental
- `nombre`: Nombre de la ruta (VARCHAR 255)
- `locacion`: Ubicación dentro del parque (VARCHAR 255)
- `dificultad`: Nivel de dificultad (ENUM 0,1,2,3)
- `rating`: Calificación de la ruta (ENUM 1,2,3,4,5)
- `fecha_registro`: Fecha y hora de registro (TIMESTAMP)

También hay una base de datos de usuarios que registra:
- Nombre
- Email
- Mensaje

