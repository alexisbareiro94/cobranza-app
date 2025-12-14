<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use \App\Traits\Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'foto_perfil',
        'telefono',
        'nombre_negocio',
        'direccion_oficina',
        'horario_atencion',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function cajas()
    {
        return $this->hasMany(Caja::class, 'cobrador_id');
    }

    public function clientes()
    {
        return $this->hasMany(Cliente::class, 'cobrador_id');
    }

    public function configuracionPrestamos()
    {
        return $this->hasOne(ConfiguracionPrestamo::class);
    }

    public function configuracionRecibos()
    {
        return $this->hasOne(ConfiguracionRecibo::class);
    }
}
