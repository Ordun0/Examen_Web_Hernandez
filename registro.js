const datos = {
    nombre: '',
    email: '',
    password: '',
    confirmPassword: '',
    terms: false
}

const nombre = document.querySelector('#nombre');
const email = document.querySelector('#email');
const password = document.querySelector('#password');
const confirmPassword = document.querySelector('#confirmPassword');
const terms = document.querySelector('#terms');
const formulario = document.querySelector('#registroForm');

nombre.addEventListener('input', leerInputs);
email.addEventListener('input', leerInputs);
password.addEventListener('input', leerInputs);
confirmPassword.addEventListener('input', leerInputs);
terms.addEventListener('change', leerInputs);

formulario.addEventListener('submit', function(evento) {
    evento.preventDefault();
    
    limpiarErrores();
    
    const errores = validarFormulario();
    
    if (Object.keys(errores).length > 0) {
        mostrarErrores(errores);
        return;
    }
    
    mostrarAlerta('¡Usuario registrado correctamente!', false);
    
    formulario.reset();
    Object.keys(datos).forEach(key => {
        if (typeof datos[key] === 'boolean') {
            datos[key] = false;
        } else {
            datos[key] = '';
        }
    });
});

function leerInputs(evento) {
    if (evento.target.type === 'checkbox') {
        datos[evento.target.id] = evento.target.checked;
    } else {
        datos[evento.target.id] = evento.target.value;
    }
}

function validarFormulario() {
    const errores = {};
    
    if (!datos.nombre || datos.nombre.trim() === '') {
        errores.nombre = 'El nombre completo es obligatorio';
    } else if (datos.nombre.length < 3) {
        errores.nombre = 'El nombre debe tener al menos 3 caracteres';
    }
    
    if (!datos.email || datos.email.trim() === '') {
        errores.email = 'El correo electrónico es obligatorio';
    } else if (!validarEmail(datos.email)) {
        errores.email = 'Por favor ingrese un correo electrónico válido';
    }
    
    if (!datos.password || datos.password.trim() === '') {
        errores.password = 'La contraseña es obligatoria';
    } else if (datos.password.length < 8) {
        errores.password = 'La contraseña debe tener al menos 8 caracteres';
    }
    
    if (!datos.confirmPassword || datos.confirmPassword.trim() === '') {
        errores.confirmPassword = 'Debe confirmar la contraseña';
    } else if (datos.password !== datos.confirmPassword) {
        errores.confirmPassword = 'Las contraseñas no coinciden';
    }
    
    if (!datos.terms) {
        errores.terms = 'Debe aceptar los términos y condiciones';
    }
    
    return errores;
}

function validarEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}

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

function limpiarErrores() {
    const mensajesError = document.querySelectorAll('.error');
    mensajesError.forEach(mensaje => {
        mensaje.textContent = '';
    });
    
    const campos = document.querySelectorAll('input');
    campos.forEach(campo => {
        campo.classList.remove('error-campo');
    });
}

function mostrarAlerta(mensaje, error = null) {
    const alerta = document.createElement('P');
    alerta.textContent = mensaje;
    if (error) {
        alerta.classList.add('error');
    } else {
        alerta.classList.add('exito');
    }
    
    const botonSubmit = formulario.querySelector('button[type="submit"]');
    formulario.insertBefore(alerta, botonSubmit);
    
    setTimeout(() => {
        alerta.remove();
    }, 3000);
}
