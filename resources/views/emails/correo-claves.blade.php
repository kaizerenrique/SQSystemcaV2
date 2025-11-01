<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Credenciales de Acceso - Qslab Sistemas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
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
            border: 1px solid #e1e1e1;
        }
        .credential-box {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
            border-left: 4px solid #1E40AF;
        }
        .info-box {
            background-color: #e8f4fd;
            border-left: 4px solid #1E40AF;
            padding: 15px;
            margin: 15px 0;
        }
        .warning-box {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 15px 0;
            color: #856404;
        }
        .btn-primary {
            background-color: #1E40AF;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin: 10px 0;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #666;
            border-top: 1px solid #e1e1e1;
            padding-top: 20px;
        }
        .credential-item {
            margin: 10px 0;
            padding: 10px;
            background-color: white;
            border-radius: 3px;
        }
        .label {
            font-weight: bold;
            color: #1E40AF;
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
            <h2>Bienvenido a Nuestra Plataforma</h2>
            
            <p>Estimado cliente,</p>
            
            <p>Se ha creado exitosamente su cuenta en nuestro sistema. A continuación encontrará sus credenciales de acceso:</p>
            
            <div class="info-box">
                <h3>Información del Laboratorio:</h3>
                <p><strong>Nombre:</strong> {{ $laboratorio->nombre }}</p>
                <p><strong>RIF:</strong> {{ $laboratorio->rif }}</p>
            </div>
            
            <div class="credential-box">
                <h3>Sus Credenciales de Acceso:</h3>
                
                <div class="credential-item">
                    <span class="label">Usuario/Email:</span>
                    <strong>{{ $correo }}</strong>
                </div>
                
                <div class="credential-item">
                    <span class="label">Contraseña:</span>
                    <strong>{{ $password }}</strong>
                </div>
            </div>
            
            <div class="warning-box">
                <h4>⚠️ Importante de Seguridad</h4>
                <p>Por su seguridad, le recomendamos:</p>
                <ul>
                    <li>Cambiar su contraseña después del primer acceso</li>
                    <li>No compartir sus credenciales con terceros</li>
                    <li>Utilizar una contraseña segura y única</li>
                </ul>
            </div>
            
            <div style="text-align: center; margin: 25px 0;">
                <a href="https://qslabsistemas.site/login" class="btn-primary">
                    🚀 Acceder al Sistema
                </a>
            </div>
            
            <p>Si tiene alguna dificultad para acceder al sistema, no dude en contactarnos.</p>
            
            <p>Atentamente,<br>
            <strong>El equipo de Qslab Sistemas</strong></p>
        </div>
        
        <div class="footer">
            <p>Este es un mensaje automático, por favor no responda a este correo.</p>
            <p>© {{ date('Y') }} Qslab Sistemas. Todos los derechos reservados.</p>
            <p>
                <small>
                    Si recibió este correo por error, por favor ignórelo y elimínelo de su bandeja.
                </small>
            </p>
        </div>
    </div>
</body>
</html>