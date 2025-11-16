import { $, $$, $el, abrirModalConAnimacion, cerrarModalConAnimacion } from './utils'

$el('#abrir-proximos-pagos', 'click', () => {
    $('#modal-proximos-pagos').classList.remove('hidden');
    abrirModalConAnimacion($('#proximos-pagos-animation').id);
});

$el('#cerrar-proximos-pagos', 'click', () => {
    cerrarModalConAnimacion($('#modal-proximos-pagos').id, $('#proximos-pagos-animation').id);
});

$el('#modal-proximos-pagos', 'click', e => {
    if(e.target == $('#modal-proximos-pagos')){
        cerrarModalConAnimacion($('#modal-proximos-pagos').id, $('#proximos-pagos-animation').id);
    }
});