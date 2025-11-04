import { $, $$, $el, abrirModalConAnimacion, cerrarModalConAnimacion } from "./utils";


$el('#abrir-todos-clientes', 'click', () => {
    const div = $('#clientes-animate');
    $('#modal-todos-clientes').classList.remove('hidden');
    abrirModalConAnimacion(div.id);
})

$el('#cerrar-todos-clientes', 'click', () => {    
    cerrarModalConAnimacion($('#modal-todos-clientes').id, $('#clientes-animate').id);
});

$el('#modal-todos-clientes', 'click', e => {
    if(e.target == $('#modal-todos-clientes')){
        cerrarModalConAnimacion($('#modal-todos-clientes').id, $('#clientes-animate').id);
    }
});