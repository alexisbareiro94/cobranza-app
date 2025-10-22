<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GetClienteImageController extends Controller
{
    public function mostrar($clienteId)
    {
        $cliente = Cliente::findOrFail($clienteId);
        
        $this->authorize('view', $cliente);        
        $path = 'clientes/' . $cliente->imagen;

        if (!Storage::disk('private')->exists($path)) {
            abort(404);
        }

        $file = Storage::disk('private')->get($path);
        $type = Storage::disk('private')->mimeType($path);

        return response($file, 200)->header('Content-Type', $type);
    }
}
