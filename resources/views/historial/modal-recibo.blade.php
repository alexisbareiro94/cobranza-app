<!-- Main modal -->
<div id="modal-recibo" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black/40">
    <div id="recibo-animate" class="relative p-4 w-full max-w-md max-h-full animate-modal-in">
        <!-- Modal content -->
        <div class="relative bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Modal header -->
            <div class="bg-white p-4 text-green-700 border-b border-green-700">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <h1 class="text-xl font-bold">RECIBO ELECTRÓNICO</h1>
                        <p class="text-xs opacity-90">Comprobante de pago válido</p>
                    </div>

                    <button id="cerrar-recibo"
                        class="text-green-700 hover:bg-black/20 hover:text-white rounded-full w-8 h-8 flex items-center justify-center transition">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Cerrar</span>
                    </button>
                </div>
            </div>

            <!-- Cuerpo del recibo -->
            <div class="p-5 space-y-4">
                <!-- Información de la transacción -->
                <div class="grid grid-cols-2 gap-1 text-sm">
                    <div class="font-medium">Fecha y hora:</div>
                    <div id="fecha-recibo" class="text-gray-700">05/12/2025 14:30</div>
                </div>

                <div class="border-t border-b py-3">
                    <div class="font-medium text-gray-800">Recibido de:</div>
                    <p id="recibido-de" class="text-gray-700">Alexis Bareiro</p>
                    <p id="recibido-de-email" class="text-gray-600 text-sm">alexisblugo@gmail.com</p>
                </div>

                <!-- Descripción -->
                <div>
                    <div class="font-medium text-gray-800">Concepto:</div>
                    <p id="concepto-recibo" class="text-gray-700">Pago por servicios de desarrollo de software</p>
                </div>

                <!-- Monto -->
                <div class="text-right mt-4">
                    <div class="text-gray-600">Monto total:</div>
                    <div id="monto-recibo" class="text-2xl font-bold text-green-600">$150.00</div>
                </div>
            </div>

            <!-- Pie -->
            <div class="bg-gray-50 px-5 py-3 text-center text-xs text-gray-500 border-t">
                <p>Este recibo fue generado electrónicamente y no requiere firma.</p>
                <p class="mt-1">© 2025 Sistema de Gestión Comercial</p>
            </div>
        </div>

        <div class="bg-gray-50 px-5 py-3 text-center text-xs text-gray-500 border-t mt-3 rounded-lg">
            <div class="flex justify-center gap-4">
                <a id="descargar-pdf"
                    class="flex items-center gap-2 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2 2 2 0 0 0 2 2h12a2 2 0 0 0 2-2 2 2 0 0 0 2-2v-7a2 2 0 0 0-2-2V4a2 2 0 0 0-2-2h-7Zm-6 9a1 1 0 0 0-1 1v5a1 1 0 1 0 2 0v-1h.5a2.5 2.5 0 0 0 0-5H5Zm1.5 3H6v-1h.5a.5.5 0 0 1 0 1Zm4.5-3a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h1.376A2.626 2.626 0 0 0 15 15.375v-1.75A2.626 2.626 0 0 0 12.375 11H11Zm1 5v-3h.375a.626.626 0 0 1 .625.626v1.748a.625.625 0 0 1-.626.626H12Zm5-5a1 1 0 0 0-1 1v5a1 1 0 1 0 2 0v-1h1a1 1 0 1 0 0-2h-1v-1h1a1 1 0 1 0 0-2h-2Z"
                            clip-rule="evenodd" />
                    </svg>

                    Descargar PDF
                </a>
                <button id="enviar-whatsapp"
                    class="flex items-center gap-2 px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                        class="" viewBox="0 0 16 16">
                        <path
                            d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232" />
                    </svg>
                    Enviar por WhatsApp
                </button>
            </div>

        </div>
    </div>
</div>
