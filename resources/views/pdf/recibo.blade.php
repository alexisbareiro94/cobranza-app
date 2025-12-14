<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Recibo de Pago - {{ $pago->codigo }}</title>
    <style>
        @page {
            margin: 0.5cm;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: white;
            color: #333;
            font-size: 12pt;
        }

        .receipt-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            border: 1px solid #d1f9d1;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: white;
            padding: 16px;
            border-bottom: 2px solid #16a34a;
            color: #16a34a;
            position: relative;
        }

        .logo {
            max-width: 120px;
            max-height: 60px;
            margin-bottom: 8px;
        }

        .header h1 {
            font-size: 18pt;
            font-weight: bold;
            margin: 0;
        }

        .header .subtitle {
            font-size: 9pt;
            opacity: 0.9;
        }

        .contact-info {
            font-size: 9pt;
            color: #666;
            margin-top: 8px;
            white-space: pre-line;
        }

        .body {
            padding: 20px;
        }

        .info-section {
            margin-bottom: 16px;
        }

        .info-row {
            display: table;
            width: 100%;
            margin-bottom: 6px;
        }

        .label {
            display: table-cell;
            font-weight: bold;
            width: 40%;
            color: #555;
        }

        .value {
            display: table-cell;
            text-align: right;
            width: 60%;
        }

        .divider {
            border-top: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
            padding: 12px 0;
            margin: 12px 0;
        }

        .total-section {
            background-color: #f0fdf4;
            padding: 16px;
            border-radius: 8px;
            margin-top: 20px;
        }

        .total-row {
            display: table;
            width: 100%;
            margin-bottom: 4px;
        }

        .total-label {
            display: table-cell;
            font-size: 11pt;
            color: #666;
        }

        .total-value {
            display: table-cell;
            text-align: right;
            font-size: 11pt;
        }

        .grand-total {
            margin-top: 8px;
            padding-top: 8px;
            border-top: 2px solid #16a34a;
        }

        .grand-total .total-label {
            font-weight: bold;
            font-size: 12pt;
            color: #16a34a;
        }

        .grand-total .total-value {
            font-weight: bold;
            font-size: 16pt;
            color: #16a34a;
        }

        .custom-message {
            background-color: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 12px;
            margin: 16px 0;
            font-size: 10pt;
            color: #78350f;
        }

        .footer {
            background-color: #f9fafb;
            padding: 12px 20px;
            text-align: center;
            font-size: 9pt;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
        }

        .footer p {
            margin: 4px 0;
        }
    </style>
</head>

<body>
    <div class="receipt-container">
        <div class="header">
            @if ($configRecibo && $configRecibo->logo_path)
                <img src="{{ public_path('storage/' . $configRecibo->logo_path) }}" alt="Logo" class="logo">
            @endif

            <h1>RECIBO DE PAGO</h1>
            <div class="subtitle">Comprobante de pago válido</div>

            @if ($configRecibo && $configRecibo->info_contacto)
                <div class="contact-info">{{ $configRecibo->info_contacto }}</div>
            @elseif($user->nombre_negocio || $user->telefono)
                <div class="contact-info">
                    @if ($user->nombre_negocio)
                        {{ $user->nombre_negocio }}
                    @endif
                    @if ($user->telefono)
                        Teléfono: {{ $user->telefono }}
                    @endif
                </div>
            @endif
        </div>

        <div class="body">
            <!-- Información del Recibo -->
            <div class="info-section">
                <div class="info-row">
                    <div class="label">Código de Recibo:</div>
                    <div class="value">#{{ $pago->codigo }}</div>
                </div>
                <div class="info-row">
                    <div class="label">Fecha de Pago:</div>
                    <div class="value">
                        {{ $pago->fecha_pago ? \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y H:i') : \Carbon\Carbon::now()->format('d/m/Y H:i') }}
                    </div>
                </div>
                <div class="info-row">
                    <div class="label">Fecha de Vencimiento:</div>
                    <div class="value">{{ \Carbon\Carbon::parse($pago->vencimiento)->format('d/m/Y') }}</div>
                </div>
            </div>

            <div class="divider">
                <!-- Información del Cliente -->
                <div class="info-row">
                    <div class="label">Cliente:</div>
                    <div class="value">{{ $pago->cliente->nombre }}</div>
                </div>
                @if ($pago->cliente->nro_ci)
                    <div class="info-row">
                        <div class="label">CI:</div>
                        <div class="value">{{ $pago->cliente->nro_ci }}</div>
                    </div>
                @endif
                @if ($pago->cliente->telefono)
                    <div class="info-row">
                        <div class="label">Teléfono:</div>
                        <div class="value">{{ $pago->cliente->telefono }}</div>
                    </div>
                @endif
            </div>

            <!-- Detalles del Préstamo -->
            <div class="info-section">
                <div class="info-row">
                    <div class="label">Código de Préstamo:</div>
                    <div class="value">#{{ $pago->prestamo->codigo }}</div>
                </div>
                <div class="info-row">
                    <div class="label">Cuota Nº:</div>
                    <div class="value">{{ $pago->numero_cuota }} de {{ $pago->prestamo->cantidad_cuotas }}</div>
                </div>
                <div class="info-row">
                    <div class="label">Estado:</div>
                    <div class="value">{{ ucfirst($pago->estado) }}</div>
                </div>
            </div>

            <!-- Mensaje Personalizado -->
            @if ($configRecibo && $configRecibo->mensaje_personalizado)
                <div class="custom-message">
                    {{ $configRecibo->mensaje_personalizado }}
                </div>
            @endif

            <!-- Totales -->
            <div class="total-section">
                <div class="total-row">
                    <div class="total-label">Monto Esperado:</div>
                    <div class="total-value">Gs. {{ number_format($pago->monto_esperado, 0, ',', '.') }}</div>
                </div>
                <div class="total-row">
                    <div class="total-label">Monto Pagado:</div>
                    <div class="total-value">Gs. {{ number_format($pago->monto_pagado ?? 0, 0, ',', '.') }}</div>
                </div>
                @if ($pago->monto_pagado && $pago->monto_esperado > $pago->monto_pagado)
                    <div class="total-row">
                        <div class="total-label">Saldo Pendiente:</div>
                        <div class="total-value" style="color: #dc2626;">Gs.
                            {{ number_format($pago->monto_esperado - $pago->monto_pagado, 0, ',', '.') }}</div>
                    </div>
                @endif

                <div class="total-row grand-total">
                    <div class="total-label">TOTAL:</div>
                    <div class="total-value">Gs.
                        {{ number_format($pago->monto_pagado ?? $pago->monto_esperado, 0, ',', '.') }}</div>
                </div>
            </div>

            @if ($pago->observaciones)
                <div class="info-section" style="margin-top: 16px;">
                    <div class="label">Observaciones:</div>
                    <div style="margin-top: 4px; font-size: 10pt; color: #666;">{{ $pago->observaciones }}</div>
                </div>
            @endif
        </div>

        <div class="footer">
            @if ($configRecibo && $configRecibo->pie_pagina)
                <p>{{ $configRecibo->pie_pagina }}</p>
            @else
                <p>Este recibo fue generado electrónicamente y es válido como comprobante de pago.</p>
            @endif
            <p>© {{ date('Y') }} {{ $user->nombre_negocio ?? 'Sistema de Cobranza' }}</p>
        </div>
    </div>
</body>

</html>
