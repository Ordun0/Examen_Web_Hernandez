// Validación de formulario de registro de usuarios
// Basado en la plantilla proporcionada

// Objeto para almacenar los datos del formulario
const datos = {
    nombre: '',
    email: '',
    password: '',
    confirmPassword: '',
    terms: false
}

// Seleccionar los elementos del formulario
const nombre = document.querySelector('#nombre');
const email = document.querySelector('#email');
const password = document.querySelector('#password');
const confirmPassword = document.querySelector('#confirmPassword');
const terms = document.querySelector('#terms');
const formulario = document.querySelector('#registroForm');

// Agregar eventos de escucha para los campos del formulario
nombre.addEventListener('input', leerInputs);
email.addEventListener('input', leerInputs);
password.addEventListener('input', leerInputs);
confirmPassword.addEventListener('input', leerInputs);
terms.addEventListener('change', leerInputs);

// Evento para el submit del formulario
formulario.addEventListener('submit', function(evento) {
    evento.preventDefault();
    
    // Limpiar errores previos
    limpiarErrores();
    
    // Validar el formulario
    const errores = validarFormulario();
    
    if (Object.keys(errores).length > 0) {
        // Mostrar los errores encontrados
        mostrarErrores(errores);
        return;
    }
    
    // Si no hay errores, simular envío exitoso
    mostrarAlerta('¡Usuario registrado correctamente!', false);
    
    // Opcional: Resetear el formulario después de un registro exitoso
    formulario.reset();
    // Resetear el objeto de datos
    Object.keys(datos).forEach(key => {
        if (typeof datos[key] === 'boolean') {
            datos[key] = false;
        } else {
            datos[key] = '';
        }
    });
});

// Función para leer los valores de los inputs y almacenarlos en el objeto datos
function leerInputs(evento) {
    if (evento.target.type === 'checkbox') {
        datos[evento.target.id] = evento.target.checked;
    } else {
        datos[evento.target.id] = evento.target.value;
    }
}

// Función para validar el formulario
function validarFormulario() {
    const errores = {};
    
    // Validar nombre completo (requerido, mínimo 3 caracteres)
    if (!datos.nombre || datos.nombre.trim() === '') {
        errores.nombre = 'El nombre completo es obligatorio';
    } else if (datos.nombre.length < 3) {
        errores.nombre = 'El nombre debe tener al menos 3 caracteres';
    }
    
    // Validar correo electrónico (formato válido)
    if (!datos.email || datos.email.trim() === '') {
        errores.email = 'El correo electrónico es obligatorio';
    } else if (!validarEmail(datos.email)) {
        errores.email = 'Por favor ingrese un correo electrónico válido';
    }
    
    // Validar contraseña (mínimo 8 caracteres)
    if (!datos.password || datos.password.trim() === '') {
        errores.password = 'La contraseña es obligatoria';
    } else if (datos.password.length < 8) {
        errores.password = 'La contraseña debe tener al menos 8 caracteres';
    }
    
    // Validar confirmación de contraseña (debe coincidir con la anterior)
    if (!datos.confirmPassword || datos.confirmPassword.trim() === '') {
        errores.confirmPassword = 'Debe confirmar la contraseña';
    } else if (datos.password !== datos.confirmPassword) {
        errores.confirmPassword = 'Las contraseñas no coinciden';
    }
    
    // Validar aceptar términos y condiciones (checkbox obligatorio)
    if (!datos.terms) {
        errores.terms = 'Debe aceptar los términos y condiciones';
    }
    
    return errores;
}

// Función para validar formato de email
function validarEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}

// Función para mostrar errores específicos
function mostrarErrores(errores) {
    Object.keys(errores).forEach(campo => {
        const elementoError = document.getElementById(`error-${campo}`);
        if (elementoError) {
            elementoError.textContent = errores[campo];
            // Agregar clase de error al campo correspondiente
            const campoElemento = document.getElementById(campo);
            if (campoElemento) {
                campoElemento.classList.add('error-campo');
            }
        }
    });
}

// Función para limpiar mensajes de error
function limpiarErrores() {
    const mensajesError = document.querySelectorAll('.error');
    mensajesError.forEach(mensaje => {
        mensaje.textContent = '';
    });
    
    // Remover clases de error de los campos
    const campos = document.querySelectorAll('input');
    campos.forEach(campo => {
        campo.classList.remove('error-campo');
    });
}

// Función para mostrar alertas
function mostrarAlerta(mensaje, error = null) {
    // Crear elemento de alerta
    const alerta = document.createElement('P');
    alerta.textContent = mensaje;
    if (error) {
        alerta.classList.add('error');
    } else {
        alerta.classList.add('exito');
    }
    
    // Insertar la alerta antes del botón de submit
    const botonSubmit = formulario.querySelector('button[type="submit"]');
    formulario.insertBefore(alerta, botonSubmit);
    
    // Eliminar la alerta después de 3 segundos
    setTimeout(() => {
        alerta.remove();
    }, 3000);
}