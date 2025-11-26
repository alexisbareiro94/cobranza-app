@extends('layouts.app')

@section('title', 'Historial')

@section('content')

    <div id="historial-container" class=" fade-in">
        <div class="bg-white rounded-lg shadow p-4 mb-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-bold text-gray-800">Historial de Pagos</h2>
                <button id="cerrar-historial" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <!-- Filtros -->
            <div class="mb-4 flex flex-wrap gap-3">
                <select id="filtro-estado" class="text-sm px-3 py-2 border border-gray-300 rounded-md">
                    <option value="todos">Todos los estados</option>
                    <option value="pagado">Pagado</option>
                    <option value="pendiente">Pendiente</option>
                    <option value="parcial">Parcial</option>
                    <option value="no_pagado">No Pagado</option>
                </select>

                <select id="filtro-mes" class="text-sm px-3 py-2 border border-gray-300 rounded-md">
                    <option value="todos">Todos los meses</option>
                    <option value="1">Enero</option>
                    <option value="2">Febrero</option>
                    <option value="3">Marzo</option>
                    <option value="4">Abril</option>
                    <option value="5">Mayo</option>
                    <option value="6">Junio</option>
                    <option value="7">Julio</option>
                    <option value="8">Agosto</option>
                    <option value="9">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                </select>

                <input type="number" id="filtro-anio" placeholder="Año" min="2020" max="2030"
                    class="text-sm px-3 py-2 border border-gray-300 rounded-md w-24">

                <button id="btn-filtrar"
                    class="text-sm font-semibold bg-blue-600 text-white px-3 py-2 rounded hover:bg-blue-700">
                    Filtrar
                </button>

                <button id="btn-exportar"
                    class="text-sm font-semibold bg-green-600 text-white px-3 py-2 rounded hover:bg-green-700 ml-auto">
                    <i class="fas fa-download mr-1"></i> Exportar
                </button>
            </div>

            <!-- Resumen de pagos -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                <div class="bg-blue-50 p-3 rounded-lg border border-blue-200">
                    <p class="text-sm text-blue-700">Total Pagado</p>
                    <p class="text-lg font-bold text-blue-800">Gs. 2.450.000</p>
                </div>
                <div class="bg-green-50 p-3 rounded-lg border border-green-200">
                    <p class="text-sm text-green-700">Pagos Completos</p>
                    <p class="text-lg font-bold text-green-800">8</p>
                </div>
                <div class="bg-yellow-50 p-3 rounded-lg border border-yellow-200">
                    <p class="text-sm text-yellow-700">Pagos Pendientes</p>
                    <p class="text-lg font-bold text-yellow-800">2</p>
                </div>
                <div class="bg-red-50 p-3 rounded-lg border border-red-200">
                    <p class="text-sm text-red-700">Pagos Atrasados</p>
                    <p class="text-lg font-bold text-red-800">1</p>
                </div>
            </div>

            <!-- Lista de pagos -->
            <div class="overflow-x-auto bg-gray-100 mx-4">
                <div class="px-4 py-8">

                    <form class="flex items-center max-w-sm mx-auto space-x-2">
                        <label for="simple-search" class="sr-only">Search</label>
                        <div class="relative w-full">
                            <input type="text" id="simple-search"
                                class="px-3 py-2.5 rounded-md bg-neutral-secondary-medium border border-default-medium rounded-base ps-4 text-heading text-sm focus:ring-brand focus:border-brand block w-full placeholder:text-body"
                                placeholder="Search branch name..." required />
                        </div>
                        <button type="submit"
                            class="bg-blue-500 rounded-md inline-flex items-center justify-center shrink-0 text-white bg-brand hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs rounded-base w-10 h-10 focus:outline-none">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                    d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                            </svg>
                            <span class="sr-only">Icon description</span>
                        </button>
                    </form>

                </div>
                <table class="min-w-full bg-white rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">Fecha de pago</th>
                            <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">Monto</th>
                            <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">Estado</th>
                            <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">Código</th>
                            <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="lista-pagos">
                        @foreach ($historial as $item)
                            <tr>
                                <td class="py-3 px-4 border-b text-sm">{{ format_fecha($item->created_at) }}</td>
                                <td class="py-3 px-4 border-b text-sm font-medium">Gs. {{ format_monto($item->monto) }}</td>
                                <td class="py-3 px-4 border-b">
                                    <span id="prueba" @class([
                                        'text-xs px-2 py-1 rounded font-semibold',
                                        'bg-yellow-200 text-yellow-700' => $item->pago->estado == 'pendiente',
                                        'bg-orange-200 text-orange-700' => $item->pago->estado == 'parcial',
                                        'bg-red-200 text-red-700' => $item->pago->estado == 'no_pagado',
                                        'bg-green-200 text-green-700' => $item->pago->estado == 'pagado',
                                    ])>
                                        {{ set_estado_pago($item->pago->estado) }}
                                    </span>
                                </td>

                                <td class="py-3 px-4 border-b text-sm text-gray-500">#{{ $item->pago->codigo }}</td>
                                <td class="py-3 px-4 border-b">
                                    <div class="flex space-x-2">
                                        <button data-id="{{ $item->id }}"
                                            class="editar-pago text-blue-600 hover:text-blue-800 text-sm cursor-pointer transition-all active:scale-90">
                                            <i class="">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                </svg>
                                            </i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $historial->links() }}
        </div>
    </div>
    <x-editar-pago />

@endsection
