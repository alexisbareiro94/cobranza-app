/**
 * Ajustes - JavaScript
 * Maneja la funcionalidad de la página de ajustes
 */

document.addEventListener('DOMContentLoaded', function () {
    console.log('Ajustes cargado');
    init();
});

/**
 * Inicializa la página de ajustes
 */
function init() {
    setupTabs();
    setupImagePreviews();
    setupForms();
}

/**
 * Configura el sistema de tabs
 */
function setupTabs() {
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            const tabName = button.dataset.tab;

            // Remover clase active de todos los botones y contenidos
            tabButtons.forEach(btn => {
                btn.classList.remove('active', 'border-green-600', 'text-green-600');
                btn.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
            });

            tabContents.forEach(content => {
                content.classList.add('hidden');
                content.classList.remove('active');
            });

            // Agregar clase active al botón y contenido seleccionado
            button.classList.add('active', 'border-green-600', 'text-green-600');
            button.classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');

            const selectedContent = document.getElementById(`tab-${tabName}`);
            if (selectedContent) {
                selectedContent.classList.remove('hidden');
                selectedContent.classList.add('active');
            }
        });
    });

    // Activar el primer tab por defecto
    if (tabButtons.length > 0) {
        tabButtons[0].click();
    }
}

/**
 * Configura los previews de imágenes
 */
function setupImagePreviews() {
    // Preview foto de perfil
    const inputFotoPerfil = document.getElementById('input-foto-perfil');
    const previewFotoPerfil = document.getElementById('preview-foto-perfil');

    if (inputFotoPerfil && previewFotoPerfil) {
        inputFotoPerfil.addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                // Validar tamaño
                if (file.size > 2 * 1024 * 1024) {
                    showToast('La imagen no debe superar 2MB', 'error');
                    return;
                }

                // Validar tipo
                if (!file.type.match('image.*')) {
                    showToast('Solo se permiten imágenes', 'error');
                    return;
                }

                // Mostrar preview
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewFotoPerfil.src = e.target.result;
                };
                reader.readAsDataURL(file);

                // Subir automáticamente
                uploadFotoPerfil(file);
            }
        });
    }

    // Preview logo
    const inputLogo = document.getElementById('input-logo');
    const previewLogo = document.getElementById('preview-logo');

    if (inputLogo && previewLogo) {
        inputLogo.addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                // Validar tamaño
                if (file.size > 2 * 1024 * 1024) {
                    showToast('La imagen no debe superar 2MB', 'error');
                    return;
                }

                // Validar tipo
                if (!file.type.match('image.*')) {
                    showToast('Solo se permiten imágenes', 'error');
                    return;
                }

                // Mostrar preview
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewLogo.src = e.target.result;
                };
                reader.readAsDataURL(file);

                // Subir automáticamente
                uploadLogo(file);
            }
        });
    }
}

/**
 * Configura los formularios
 */
function setupForms() {
    // Formulario de perfil
    const formPerfil = document.getElementById('form-perfil');
    if (formPerfil) {
        formPerfil.addEventListener('submit', handlePerfilSubmit);
    }

    // Formulario de préstamos
    const formPrestamos = document.getElementById('form-prestamos');
    if (formPrestamos) {
        formPrestamos.addEventListener('submit', handlePrestamosSubmit);
    }

    // Formulario de recibos
    const formRecibos = document.getElementById('form-recibos');
    if (formRecibos) {
        formRecibos.addEventListener('submit', handleRecibosSubmit);
    }

    // Formulario de contraseña
    const formPassword = document.getElementById('form-password');
    if (formPassword) {
        formPassword.addEventListener('submit', handlePasswordSubmit);
    }
}

/**
 * Maneja el envío del formulario de perfil
 */
async function handlePerfilSubmit(e) {
    e.preventDefault();

    const formData = new FormData(e.target);

    try {
        const response = await fetch('/ajustes/perfil', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': formData.get('_token'),
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(Object.fromEntries(formData))
        });

        const data = await response.json();

        if (response.ok) {
            showToast(data.message || 'Perfil actualizado correctamente', 'success');
        } else {
            showToast(data.error || 'Error al actualizar el perfil', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showToast('Error al actualizar el perfil', 'error');
    }
}

/**
 * Maneja el envío del formulario de préstamos
 */
async function handlePrestamosSubmit(e) {
    e.preventDefault();

    const formData = new FormData(e.target);

    try {
        const response = await fetch('/ajustes/prestamos', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': formData.get('_token'),
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(Object.fromEntries(formData))
        });

        const data = await response.json();

        if (response.ok) {
            showToast(data.message || 'Configuración actualizada correctamente', 'success');
        } else {
            showToast(data.error || 'Error al actualizar la configuración', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showToast('Error al actualizar la configuración', 'error');
    }
}

/**
 * Maneja el envío del formulario de recibos
 */
async function handleRecibosSubmit(e) {
    e.preventDefault();

    const formData = new FormData(e.target);

    try {
        const response = await fetch('/ajustes/recibos', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': formData.get('_token'),
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(Object.fromEntries(formData))
        });

        const data = await response.json();

        if (response.ok) {
            showToast(data.message || 'Configuración actualizada correctamente', 'success');
        } else {
            showToast(data.error || 'Error al actualizar la configuración', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showToast('Error al actualizar la configuración', 'error');
    }
}

/**
 * Maneja el envío del formulario de contraseña
 */
async function handlePasswordSubmit(e) {
    e.preventDefault();

    const formData = new FormData(e.target);
    const password = formData.get('password');
    const passwordConfirmation = formData.get('password_confirmation');

    // Validar que las contraseñas coincidan
    if (password !== passwordConfirmation) {
        showToast('Las contraseñas no coinciden', 'error');
        return;
    }

    try {
        const response = await fetch('/ajustes/password', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': formData.get('_token'),
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(Object.fromEntries(formData))
        });

        const data = await response.json();

        if (response.ok) {
            showToast(data.message || 'Contraseña actualizada correctamente', 'success');
            e.target.reset();
        } else {
            showToast(data.error || 'Error al actualizar la contraseña', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showToast('Error al actualizar la contraseña', 'error');
    }
}

/**
 * Sube la foto de perfil
 */
async function uploadFotoPerfil(file) {
    const formData = new FormData();
    formData.append('foto_perfil', file);
    formData.append('_token', document.querySelector('input[name="_token"]').value);

    try {
        const response = await fetch('/ajustes/foto-perfil', {
            method: 'POST',
            body: formData
        });

        const data = await response.json();

        if (response.ok) {
            showToast(data.message || 'Foto de perfil actualizada', 'success');
        } else {
            showToast(data.error || 'Error al subir la foto', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showToast('Error al subir la foto', 'error');
    }
}

/**
 * Sube el logo
 */
async function uploadLogo(file) {
    const formData = new FormData();
    formData.append('logo', file);
    formData.append('_token', document.querySelector('input[name="_token"]').value);

    try {
        const response = await fetch('/ajustes/logo', {
            method: 'POST',
            body: formData
        });

        const data = await response.json();

        if (response.ok) {
            showToast(data.message || 'Logo actualizado', 'success');
        } else {
            showToast(data.error || 'Error al subir el logo', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showToast('Error al subir el logo', 'error');
    }
}

/**
 * Muestra un toast de notificación
 */
function showToast(message, type = 'info') {
    // Crear elemento toast
    const toast = document.createElement('div');
    toast.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg text-white z-50 transition-all transform translate-x-0 ${
        type === 'success' ? 'bg-green-600' :
        type === 'error' ? 'bg-red-600' :
        'bg-blue-600'
    }`;
    toast.textContent = message;

    document.body.appendChild(toast);

    // Animar entrada
    setTimeout(() => {
        toast.style.transform = 'translateX(0)';
    }, 10);

    // Remover después de 3 segundos
    setTimeout(() => {
        toast.style.transform = 'translateX(400px)';
        setTimeout(() => {
            document.body.removeChild(toast);
        }, 300);
    }, 3000);
}
