// Script para validación de formularios y funcionalidades de la aplicación

document.addEventListener('DOMContentLoaded', function() {
    // Validación del formulario de contacto
    const contactoForm = document.getElementById('contacto-form');
    if(contactoForm) {
        contactoForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Obtener valores del formulario
            const nombre = document.getElementById('nombre_contacto').value.trim();
            const email = document.getElementById('email').value.trim();
            const mensaje = document.getElementById('mensaje').value.trim();
            
            // Validar campos
            let isValid = true;
            
            if(nombre === '') {
                alert('Por favor ingrese su nombre');
                isValid = false;
            }
            
            if(email === '') {
                alert('Por favor ingrese su email');
                isValid = false;
            } else if(!isValidEmail(email)) {
                alert('Por favor ingrese un email válido');
                isValid = false;
            }
            
            if(mensaje === '') {
                alert('Por favor ingrese un mensaje');
                isValid = false;
            }
            
            if(isValid) {
                // Enviar formulario vía AJAX
                const formData = new FormData(contactoForm);
                
                fetch('procesar_contacto.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    alert('Formulario enviado correctamente. Gracias por contactarnos.');
                    contactoForm.reset();
                })
                .catch(error => {
                    alert('Error al enviar el formulario. Por favor, inténtelo de nuevo.');
                });
            }
        });
    }
    
    // Función para validar email
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
    
    // Validación del formulario de registro de rutas
    const rutaForm = document.getElementById('ruta-form');
    if(rutaForm) {
        rutaForm.addEventListener('submit', function(e) {
            // La validación del lado del cliente se hace con el atributo 'required' en HTML
            // Aquí podríamos agregar validación adicional si es necesario
        });
    }
});

// Función para desplazarse a una sección específica
function scrollToSection(sectionId) {
    const section = document.getElementById(sectionId);
    if(section) {
        section.scrollIntoView({ behavior: 'smooth' });
    }
}

// Función para editar una ruta
function editarRuta(id, nombre, locacion, dificultad, rating) {
    // Llenar el formulario con los datos actuales
    document.getElementById('nombre').value = nombre;
    document.getElementById('locacion').value = locacion;
    document.getElementById('dificultad').value = dificultad;
    document.getElementById('rating').value = rating;
    
    // Cambiar el formulario para que actualice en lugar de crear
    const form = document.getElementById('ruta-form');
    form.action = 'gestion_rutas.php';
    
    // Agregar campo oculto para indicar la acción de edición
    let actionInput = document.createElement('input');
    actionInput.type = 'hidden';
    actionInput.name = 'action';
    actionInput.value = 'editar';
    form.appendChild(actionInput);
    
    // Agregar campo oculto para el ID
    let idInput = document.createElement('input');
    idInput.type = 'hidden';
    idInput.name = 'id';
    idInput.value = id;
    form.appendChild(idInput);
    
    // Cambiar el texto del botón
    const submitButton = form.querySelector('button[type="submit"]');
    submitButton.textContent = 'Actualizar Ruta';
    
    // Hacer scroll al formulario de registro
    scrollToSection('registro');
}

// Función para restablecer el formulario a su estado original
function resetForm() {
    const form = document.getElementById('ruta-form');
    form.action = 'registrar_ruta.php';
    
    // Remover campos ocultos si existen
    const hiddenInputs = form.querySelectorAll('input[type="hidden"]');
    hiddenInputs.forEach(input => {
        if(input.name === 'action' || input.name === 'id') {
            input.remove();
        }
    });
    
    // Restablecer el formulario
    form.reset();
    
    // Restablecer el texto del botón
    const submitButton = form.querySelector('button[type="submit"]');
    submitButton.textContent = 'Registrar Ruta';
}