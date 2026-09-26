<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Código de verificación</title>
</head>
<body style="background-color: #f9fafb; font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; margin: 0; padding: 0; -webkit-font-smoothing: antialiased;">

    <!-- Contenedor Principal -->
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color: #f9fafb; padding: 40px 0;">
        <tr>
            <td align="center">
                
                <!-- Tarjeta Central (max-w-md / border / shadow) -->
                <table role="presentation" width="100%" style="max-width: 448px; background-color: #ffffff; border: 1px solid #f3f4f6; border-radius: 16px; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.02); text-align: center; padding: 32px; margin: 0 auto;">
                    
                    <!-- Header -->
                    <tr>
                        <td style="padding-bottom: 24px;">
                            <h1 style="color: #111827; font-size: 24px; font-weight: 700; letter-spacing: -0.025em; margin: 0;">
                                Verificación de Acceso
                            </h1>
                            <p style="color: #6b7280; font-size: 14px; margin-top: 6px; margin-bottom: 0;">
                                Usa el siguiente código para completar tu inicio de sesión.
                            </p>
                        </td>
                    </tr>

                    <!-- Bloque del Token (Caja destacada) -->
                    <tr>
                        <td style="padding: 12px 0;">
                            <div style="background-color: #eff6ff; border: 1px border-blue-100; border-radius: 12px; padding: 20px; text-align: center;">
                                <span style="font-family: monospace, monospace; font-size: 32px; font-weight: 800; color: #2563eb; letter-spacing: 0.25em; display: inline-block;">
                                    {{ $token }}
                                </span>
                            </div>
                        </td>
                    </tr>

                    <!-- Mensaje de Expiración -->
                    <tr>
                        <td style="padding-top: 20px; padding-bottom: 24px;">
                            <p style="color: #4b5563; font-size: 14px; line-height: 1.5; margin: 0;">
                                Este código expira en <strong>5 minutos</strong>. Si no solicitaste este acceso, puedes ignorar este correo de forma segura.
                            </p>
                        </td>
                    </tr>

                    <!-- Divider -->
                    <tr>
                        <td style="border-top: 1px solid #f3f4f6; padding-top: 20px;">
                            <p style="color: #9ca3af; font-size: 12px; margin: 0;">
                                &copy; {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.
                            </p>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>