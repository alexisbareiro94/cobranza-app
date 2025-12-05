@php
    $ciudades = [
        20 => 'Asuncion',
        1 => 'Areguá',
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
        19 => 'Ypané',
    ];
@endphp


@props([
    'ciudadId' => 20,
])


<div>
    <select name="ciudad" id="ciudad"
        class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none bg-gray-50">
        <option value="" disabled selected>-Seleccionar-</option>
        @foreach ($ciudades as $id => $ciudad)
            <option value="{{ $id }}" {{ $id == $ciudadId ? 'selected' : '' }}>{{ $ciudad }}</option>
        @endforeach
    </select>
</div>
