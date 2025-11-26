<?php

declare(strict_types=1);

use Carbon\Carbon;

function format_monto(int $monto)
{
    return number_format($monto, 0, '.', '.');
}

function format_fecha($fecha, $diff = false)
{
    $fechaForm = Carbon::parse($fecha);

    if ($fechaForm->isToday()) {
        return "hoy";
    }

    if ($diff == true) {
        return $fechaForm->diffForHumans();
    } else {
        return $fechaForm->format('d-m-Y');
    }
}

function set_ciudad($id)
{
    $ciudades = [
        20 => 'Asuncion',
        1 => "Areguá",
        2 => 'Capiatá',
        3 => 'Fernando de la Mora',
        4 => 'Guarambaré',
        5 => 'Itá',
        6 => 'Itauguá',
        7 => 'Julián Augusto Saldívar',
        8 => 'Lambaré',
        9 => 'Limpio',
        10 => 'Luque',
        11 => 'Mariano Roque Alonso',
        12 => 'Ñemby',
        13 => 'Nueva Italia',
        14 => 'San Antonio',
        15 => 'San Lorenzo',
        16 => 'Villa Elisa',
        17 => 'Villeta',
        18 => 'Ypacaraí',
        19 => 'Ypané'
    ];

    foreach ($ciudades as $index => $ciudad) {
        if ($id == $index) {
            return $ciudad;
        }
    }
}

function set_estado_pago($estado)
{
    $estados = [
        'pagado' => 'Pagado',
        'parcial' => 'Parcial',
        'no_pagado' => 'No Pagado',
        'pendiente' => 'Pendiente',
    ];

    foreach ($estados as $index => $value) {
        if ($estado == $index) {
            return $value;
            break;
        }
    }
}

//valor = fecha de vencimiento del pago
function verificar_fecha($valor)
{
    $fecha = Carbon::parse($valor);

    if ($fecha < today()) {
        return 'Venció';
    } else {
        return 'Vence';
    }
}

function set_code()
{
    $string = 'ABCDEFGHIJKLMNOPQRSTXYZ0123456789';
    $array = str_split($string);
    $code = "";
    $count = 0;
    foreach ($array as $item) {
        if ($count >= 5) {
            break;
        }
        $char = rand(0, count($array) - 1);
        $code .= $array[$char];
        $count++;
    }
    return $code;
}

function auth_role()
{
    return auth()->user()->role;
}
