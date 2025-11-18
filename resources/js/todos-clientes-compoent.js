import { $, $$, $el, abrirModalConAnimacion, cerrarModalConAnimacion } from "./utils";

if($('#abrir-todos-clientes')){
    $el('#abrir-todos-clientes', 'click', () => {
        const div = $('#clientes-animate');
        $('#modal-todos-clientes').classList.remove('hidden');
        abrirModalConAnimacion(div.id);
    })
}

if($('#cerrar-todos-clientes')){
    $el('#cerrar-todos-clientes', 'click', () => {    
        cerrarModalConAnimacion($('#modal-todos-clientes').id, $('#clientes-animate').id);
    });
}

if($('#modal-todos-clientes')){
    $el('#modal-todos-clientes', 'click', e => {
        if(e.target == $('#modal-todos-clientes')){
            cerrarModalConAnimacion($('#modal-todos-clientes').id, $('#clientes-animate').id);
        }
    });
}