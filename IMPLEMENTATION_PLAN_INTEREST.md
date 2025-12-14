# Plan de Implementación: Sistema de Intereses y Mora

Este documento detalla los pasos necesarios para agregar la funcionalidad de tasas de interés y recargos por mora en el sistema de préstamos.

## 1. Modificaciones en Base de Datos (Migraciones)

Actualmente la tabla `prestamos` almacena `monto_total` pero no distingue entre el capital prestado y el interés generado, ni almacena configuraciones de mora.

### Nueva Migración

Crear una migración para agregar las siguientes columnas a la tabla `prestamos`:

```bash
php artisan make:migration add_interes_columns_to_prestamos_table --table=prestamos
```

**Columnas sugeridas:**

-   `monto_prestado` (Decimal/Integer): Para almacenar el capital original entregado al cliente (sin intereses). Esto permite distinguir entre lo que se prestó y lo que se cobrará (`monto_total`).
-   `porcentaje_interes` (Decimal, ej: 5.2): El porcentaje de interés aplicado al préstamo al momento de crearlo.
-   `porcentaje_mora` (Decimal): El porcentaje de recargo que se aplicará si hay retraso.
-   `tipo_interes` (Enum/String, Opcional): Si planeas tener 'Simple', 'Compuesto', etc. Por ahora, 'Simple' (tasa fija sobre el capital) es lo más común.

**Ejemplo de esquema en `up()`:**

```php
Schema::table('prestamos', function (Blueprint $table) {
    // Usamos decimal para mayor precisión en tasas y montos
    $table->decimal('monto_prestado', 10, 2)->after('cobrador_id')->comment('Capital original prestado');
    $table->decimal('porcentaje_interes', 5, 2)->default(0)->after('monto_prestado');
    $table->decimal('porcentaje_mora', 5, 2)->default(0)->after('porcentaje_interes');
    // Opcional: Si la mora es un monto fijo en lugar de porcentaje
    // $table->decimal('monto_mora_fijo', 10, 2)->nullable();
});
```

_Nota: Es recomendable cambiar `monto_total`, `monto_cuota`, etc. a `decimal` o `bigInteger` si manejas centavos, aunque `integer` funciona si manejas todo en enteros._

---

## 2. Modificaciones en el Backend (Laravel)

### Modelo `Prestamo`

Agregar los nuevos campos a la propiedad `$fillable`.

```php
protected $fillable = [
    // ... campos existentes
    'monto_prestado',
    'porcentaje_interes',
    'porcentaje_mora',
];
```

### Request `StorePrestramoRequest`

Agregar las reglas de validación para los nuevos campos.

```php
public function rules(): array
{
    return [
        // ...
        'monto_prestado' => 'required|numeric|min:1',
        'porcentaje_interes' => 'required|numeric|min:0',
        'porcentaje_mora' => 'nullable|numeric|min:0',
        // 'monto_total' se puede seguir recibiendo o calcularse en el backend para seguridad
    ];
}
```

### Controlador `PrestamoController`

En el método `store`:

1.  Guardar `monto_prestado` (Capital).
2.  Guardar `porcentaje_interes`.
3.  Guardar `porcentaje_mora`.
4.  (Opcional pero recomendado) Recalcular `monto_total` en el servidor para validar que coincida con `monto_prestado + (monto_prestado * porcentaje_interes / 100)`.

---

## 3. Lógica de Negocio (Cálculo de Intereses)

### En la Creación (Frontend -> Backend)

Al crear el préstamo, el flujo sería:

1.  Usuario ingresa `Monto a Prestar` (Capital) y `Tasa de Interés (%)`.
2.  El sistema calcula automáticamente:
    -   `Monto Total` = Capital + (Capital \* %Interés).
    -   `Monto Cuota` = Monto Total / Cantidad Cuotas.

### Lógica de Mora (Recargo por Atraso)

La "mora" es más compleja porque ocurre _después_, cuando el cliente se atrasa.

**Estrategia Sugerida:**

1.  **Job Diario (Scheduled Task):**
    -   Crear un comando de consola (ej: `prestamos:revisar-mora`).
    -   Este comando se ejecuta todos los días (vía Cron).
    -   Busca cuotas vencidas (`vencimiento < hoy` Y `estado != pagado`).
    -   Aplica el recargo.

**¿Cómo aplicar el recargo?**
Opción A: **Multa en la Cuota**

-   Agregar columna `recargo_mora` a la tabla `pagos` (cuotas).
-   Si la cuota vence, se suma `porcentaje_mora` al `monto_esperado` de esa cuota específica.

Opción B: **Saldo Global** (Más complejo)

-   Aumentar el `saldo_pendiente` del préstamo.

_Recomendación:_ La **Opción A** es más transparente. Se agrega una columna `mora_generada` a la tabla `pagos`.

**Nueva Migración (Pagos):**

```php
Schema::table('pagos', function (Blueprint $table) {
    $table->decimal('mora_generada', 10, 2)->default(0)->after('monto_esperado');
});
```

Así, cuando cobres una cuota atrasada, el sistema cobrará: `monto_esperado` + `mora_generada`.

---

## 4. Resumen de Tareas

1.  [ ] Crear migración para `prestamos` (`monto_prestado`, `porcentaje_interes`, `porcentaje_mora`).
2.  [ ] (Opcional) Crear migración para `pagos` (`mora_generada`) si deseas aplicar la mora automáticamente.
3.  [ ] Actualizar `Prestamo` Model y `StorePrestramoRequest`.
4.  [ ] Actualizar el formulario de creación en el Frontend para incluir los campos de Interés.
