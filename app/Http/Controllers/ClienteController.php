<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClienteRequest;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Http\Requests\UpdateClienteRequest;

class ClienteController extends Controller
{
    public function store(StoreClienteRequest $request)
    {
        try {
            $data = $request->validated();
            if ($request->hasFile('imagen')) {
                $file = $request->file('imagen');
                $name = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('imagenes'), $name);
                $data['imagen'] = $name;
            }
            $data['cobrador_id'] = auth()->user()->id;
            Cliente::create($data);

            return response()->json([
                'message' => 'Cliente Agregado',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    public function index(Request $request)
    {
        try {
            $q = $request->query('q');
            $query = Cliente::query()
                ->where('cobrador_id', auth()->user()->id);

            if (filled($q)) {
                $query->whereLike('nombre', "%$q%")
                    ->orWhereLike("nro_ci", "%$q%")
                    ->orWhereLike('telefono', "%$q%");
            }

            $clientes = $query->orderByDesc('created_at')->get();

            return response()->json([
                'data' => $clientes,
                'cobrador_id' => auth()->user()->id,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function show_view(string $id)
    {
        try {
            $cliente = Cliente::where('cobrador_id', auth()->user()->id)
                ->with('prestamos', 'pagos')
                ->findOrFail($id);

            return view('clientes.ver', [
                'cliente' => $cliente,
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function show(string $id)
    {
        try {
            $user = Cliente::findOrFail($id);
            return response()->json([
                'data' => $user,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function update(UpdateClienteRequest $request, string $id)
    {
        try {
            $cliente = Cliente::findOrFail($id);
            $cliente->update($request->validated());
            return response()->json([
                'message' => 'Cliente Actualizado',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 400);
        }
    }
}
