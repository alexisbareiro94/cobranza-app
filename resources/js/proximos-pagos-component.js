import { $, $$, $el, abrirModalConAnimacion, cerrarModalConAnimacion } from './utils'

if($('#abrir-proximos-pagos')){
    $el('#abrir-proximos-pagos', 'click', () => {
        $('#modal-proximos-pagos').classList.remove('hidden');
        abrirModalConAnimacion($('#proximos-pagos-animation').id);
    });
}

if($('#cerrar-proximos-pagos')){
    $el('#cerrar-proximos-pagos', 'click', () => {
        cerrarModalConAnimacion($('#modal-proximos-pagos').id, $('#proximos-pagos-animation').id);
    });
}

if($('#modal-proximos-pagos')){
    $el('#modal-proximos-pagos', 'click', e => {
        if(e.target == $('#modal-proximos-pagos')){
            cerrarModalConAnimacion($('#modal-proximos-pagos').id, $('#proximos-pagos-animation').id);
        }
    });
}