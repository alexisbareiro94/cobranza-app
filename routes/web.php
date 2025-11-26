<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GetClienteImageController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\RutaController;
use App\Http\Middleware\CobradorMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/register', [AuthController::class, 'register_view'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/login', [AuthController::class, 'login_view'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::middleware(['auth', CobradorMiddleware::class])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/ubicaciones', [RutaController::class, 'index_view'])->name('ruta.index');

    Route::get('/historial', [HistorialController::class, 'index_view'])->name('historial.index');
    Route::post('/historial/exportar', [HistorialController::class, 'exportar'])->name('historial.exportar');

    Route::get('/cliente/{id}', [ClienteController::class, 'show_view'])->name('cliente.show');
    //prox feat: get imagenes privadas
    Route::get('/imagenes/{clienteId}', [GetClienteImageController::class, 'mostrar'])->name('get.imagen');

    //apis    
    Route::post('/api/cliente', [ClienteController::class, 'store'])->name('cliente.store');
    Route::get('/api/cliente', [ClienteController::class, 'index']);
    Route::get('/api/cliente/{id}', [ClienteController::class, 'show']);

    Route::post('/api/prestamo', [PrestamoController::class, 'store']);
    Route::get('/api/prestamo', [PrestamoController::class, 'index']);

    Route::get('/api/pago/{id}', [PagoController::class, 'show']);
    Route::post('/api/pago/{code}', [PagoController::class, 'update']);

    Route::get('/api/prestamo', [PrestamoController::class, 'index']);

    Route::get('/api/ruta', [RutaController::class, 'index']);

    Route::get('/api/ganancias', [PagoController::class, 'ganancias']);

    Route::get('/api/historial', [HistorialController::class, 'index']);
    Route::get('/api/historial/{id}', [HistorialController::class, 'show']);
    Route::post('/api/historial/{id}', [HistorialController::class, 'update']);
});

use Illuminate\Support\Facades\Cache;

Route::get('/debug', function () {
    Cache::forget('historial');
    echo 'Cache eliminado';
});
