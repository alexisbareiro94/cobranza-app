<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Recibo Electrónico</title>
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
            /* green-700 */
            color: #16a34a;
        }

        .header h1 {
            font-size: 18pt;
            font-weight: bold;
            margin: 0;
            display: inline-block;
        }

        .header .subtitle {
            font-size: 9pt;
            opacity: 0.9;
            margin-left: 6px;
        }

        .body {
            padding: 20px;
        }

        .row {
            display: table;
            width: 100%;
            margin-bottom: 8px;
        }

        .label {
            display: table-cell;
            font-weight: bold;
            width: 40%;
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

        .total-amount {
            text-align: right;
            margin-top: 20px;
        }

        .total-amount .label {
            font-weight: normal;
            color: #666;
        }

        .total-amount .value {
            font-size: 16pt;
            font-weight: bold;
            color: #16a34a;
        }

        .footer {
            background-color: #f9fafb;
            padding: 12px 20px;
            text-align: center;
            font-size: 9pt;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
        }
    </style>
</head>

<body>
    <div class="receipt-container">
        <div class="header">
            <h1>RECIBO ELECTRÓNICO</h1>
            <span class="subtitle">Comprobante de pago válido</span>
        </div>

        <div class="body">

            <table style="width: 100%; margin-bottom: 8px;">
                <tr>
                    <td class="label">Fecha y hora:</td>
                    <td class="value" id="fecha-recibo">05/12/2025 14:30</td>
                </tr>
            </table>

            <div class="divider">
                <table style="width: 100%;">
                    <tr>
                        <td class="label">Recibido de:</td>
                        <td class="value" id="recibido-de">Alexis Bareiro</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="value" id="recibido-de-email"
                            style="text-align: left; font-size: 10pt; color: #4b5563;">
                            alexisblugo@gmail.com
                        </td>
                    </tr>
                </table>
            </div>

            <table style="width: 100%; margin-bottom: 8px;">
                <tr>
                    <td class="label">Concepto:</td>
                    <td class="value" id="concepto-recibo" style="text-align: left;">
                        Pago por servicios de desarrollo de software
                    </td>
                </tr>
            </table>

            <div class="total-amount">
                <table style="width: 100%;">
                    <tr>
                        <td class="label">Monto total:</td>
                        <td class="value" id="monto-recibo"
                            style="font-size: 16pt; font-weight: bold; color: #16a34a;">
                            $150.00
                        </td>
                    </tr>
                </table>
            </div>

        </div>


        <div class="footer">
            <p>Este recibo fue generado electrónicamente y no requiere firma.</p>
            <p>© 2025 Sistema de Gestión Comercial</p>
        </div>
    </div>
</body>

</html>
