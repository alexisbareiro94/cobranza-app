/**
 * Detalle de Préstamo - JavaScript
 * Maneja la interactividad de la vista de detalle del préstamo
 */

document.addEventListener('DOMContentLoaded', function () {
    console.log('Detalle de Préstamo cargado');

    // Inicializar la vista
    init();
});

/**
 * Inicializa la vista de detalle del préstamo
 */
function init() {
    setupTableHighlight();
    setupPrintButton();
    addAnimations();
}

/**
 * Configura el resaltado de las filas de la tabla al pasar el mouse
 */
function setupTableHighlight() {
    const rows = document.querySelectorAll('#lista-pagos tr');
    rows.forEach(row => {
        row.addEventListener('mouseenter', function () {
            this.classList.add('bg-green-50');
        });
        row.addEventListener('mouseleave', function () {
            this.classList.remove('bg-green-50');
        });
    });
}

/**
 * Configura el botón de impresión (si se necesita en el futuro)
 */
function setupPrintButton() {
    // Crear botón de impresión si no existe
    const container = document.getElementById('detalle-prestamo-container');
    if (!container) return;

    // Puedes agregar un botón de impresión aquí si lo necesitas
    // Por ahora, solo dejamos la función preparada
}

/**
 * Agrega animaciones suaves a los elementos
 */
function addAnimations() {
    const cards = document.querySelectorAll('.bg-white');
    cards.forEach((card, index) => {
        setTimeout(() => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'all 0.5s ease';

            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 50);
        }, index * 100);
    });
}

/**
 * Formatea números a formato de moneda paraguaya
 * @param {number} amount - Monto a formatear
 * @returns {string} Monto formateado
 */
function formatCurrency(amount) {
    return new Intl.NumberFormat('es-PY', {
        style: 'currency',
        currency: 'PYG',
        minimumFractionDigits: 0
    }).format(amount);
}

/**
 * Calcula el progreso del préstamo
 * @returns {number} Porcentaje de progreso (0-100)
 */
function calculateProgress() {
    const totalPagado = parseFloat(document.querySelector('[data-total-pagado]')?.dataset.totalPagado || 0);
    const montoTotal = parseFloat(document.querySelector('[data-monto-total]')?.dataset.montoTotal || 0);

    if (montoTotal === 0) return 0;
    return Math.min((totalPagado / montoTotal) * 100, 100);
}

/**
 * Resalta pagos vencidos
 */
function highlightOverduePayments() {
    const today = new Date();
    today.setHours(0, 0, 0, 0);

    const rows = document.querySelectorAll('#lista-pagos tr');
    rows.forEach(row => {
        const vencimientoCell = row.querySelector('td:nth-child(3)');
        const estadoCell = row.querySelector('td:nth-child(6) span');

        if (!vencimientoCell || !estadoCell) return;

        const vencimientoText = vencimientoCell.textContent.trim();
        const estado = estadoCell.textContent.trim().toLowerCase();

        // Parse fecha en formato dd/mm/yyyy
        const [day, month, year] = vencimientoText.split('/');
        const vencimiento = new Date(year, month - 1, day);

        // Si está vencido y no está pagado
        if (vencimiento < today && (estado === 'pendiente' || estado === 'no_pagado')) {
            row.classList.add('bg-red-50');
            vencimientoCell.classList.add('text-red-600', 'font-bold');
        }
    });
}

// Ejecutar resaltado de pagos vencidos después de cargar
setTimeout(highlightOverduePayments, 100);
