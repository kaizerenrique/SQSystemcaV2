<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nuevo Token de API Generado</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #1E40AF;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 0 0 5px 5px;
        }
        .token-box {
            background-color: #eee;
            padding: 15px;
            border-radius: 5px;
            margin: 15px 0;
            font-family: monospace;
            word-break: break-all;
        }
        .info-box {
            background-color: #e8f4fd;
            border-left: 4px solid #1E40AF;
            padding: 15px;
            margin: 15px 0;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Qslab Sistemas</h1>
            <p>Sistema de Gestión de Laboratorios Clínicos</p>
        </div>
        
        <div class="content">
            <h2>Notificación: Nuevo Token de API Generado</h2>
            
            <p>Se ha generado un nuevo token de API para un laboratorio registrado en el sistema.</p>
            
            <div class="info-box">
                <h3>Información del Laboratorio:</h3>
                <p><strong>Nombre:</strong> {{ $laboratorio->nombre }}</p>
                <p><strong>Rif:</strong> {{ $laboratorio->rif }}</p>                
            </div>
            
            <h3>Token de API Generado:</h3>
            <div class="token-box">
                {{ $token }}
            </div>
            
            <p><strong>Importante:</strong> Este token permite acceso a las APIs del sistema. Asegúrese de que el laboratorio lo almacene de forma segura.</p>
            
            <p>Puede gestionar los tokens de API desde el panel de administración.</p>
            
            <p>Atentamente,<br>El equipo de Qslab Sistemas</p>
        </div>
        
        <div class="footer">
            <p>Este es un mensaje automático, por favor no responda a este correo.</p>
            <p>© {{ date('Y') }} Qslab Sistemas. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>
