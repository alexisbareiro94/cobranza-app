<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Cliente;
use App\Models\Auditoria;

class AuditSystemTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_logs_creation_of_cliente()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $cliente = Cliente::create([
            'nombre' => 'Cliente Test',
            'cobrador_id' => $user->id,
            'nro_ci' => '1234567',
            'direccion' => 'Calle Falsa 123',
            'telefono' => '0981123456',
            'ciudad' => 'Asuncion',
            'correo' => 'test@example.com',
            'geo' => '0,0'
        ]);

        $this->assertDatabaseHas('auditorias', [
            'user_id' => $user->id,
            'accion' => 'crear',
            'modelo_afectado' => Cliente::class,
            'registro_id' => $cliente->id,
        ]);

        $audit = Auditoria::where('modelo_afectado', Cliente::class)->latest('id')->first();
        $this->assertNotNull($audit->datos_nuevos);
        $this->assertEquals('Cliente Test', $audit->datos_nuevos['nombre']);
    }

    public function test_it_logs_update_of_cliente()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $cliente = Cliente::create([
            'nombre' => 'Cliente Original',
            'cobrador_id' => $user->id,
            'nro_ci' => '1234567',
            'direccion' => 'Calle Falsa 123',
            'telefono' => '0981123456',
            'ciudad' => 'Asuncion',
            'correo' => 'test@example.com',
            'geo' => '0,0'
        ]);

        $cliente->update(['nombre' => 'Cliente Modificado']);

        $this->assertDatabaseHas('auditorias', [
            'accion' => 'actualizar',
            'registro_id' => $cliente->id,
        ]);

        $audit = Auditoria::where('modelo_afectado', Cliente::class)->where('accion', 'actualizar')->latest('id')->first();
        $this->assertEquals('Cliente Original', $audit->datos_anteriores['nombre']);
        $this->assertEquals('Cliente Modificado', $audit->datos_nuevos['nombre']);
    }

    public function test_it_logs_deletion_of_cliente()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $cliente = Cliente::create([
            'nombre' => 'Cliente Borrar',
            'cobrador_id' => $user->id,
            'nro_ci' => '1234567',
            'direccion' => 'Calle Falsa 123',
            'telefono' => '0981123456',
            'ciudad' => 'Asuncion',
            'correo' => 'test@example.com',
            'geo' => '0,0'
        ]);

        $cliente->delete();

        $this->assertDatabaseHas('auditorias', [
            'accion' => 'eliminar',
            'registro_id' => $cliente->id,
        ]);
    }
}
