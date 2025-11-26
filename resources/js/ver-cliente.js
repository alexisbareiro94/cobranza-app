import axios from 'axios';

window.addEventListener('DOMContentLoaded', function () {
    const clienteId = window.location.pathname.split('/').pop();
    console.log(clienteId);
});