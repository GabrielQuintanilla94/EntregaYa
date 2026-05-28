<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - EntregaYa</title>
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background-color: #f3f4f6; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            min-height: 100vh; 
            margin: 0; 
            padding: 20px;
            box-sizing: border-box;
        }
        .register-box { 
            background: white; 
            padding: 40px; 
            border-radius: 12px; 
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); 
            width: 100%; 
            max-width: 450px; 
        }
        h2 { 
            text-align: center; 
            color: #111827; 
            margin-top: 0; 
            font-size: 26px; 
        }
        .subtitle { 
            text-align: center; 
            color: #6b7280; 
            margin-bottom: 25px; 
            font-size: 15px; 
        }
        .form-group { 
            margin-bottom: 20px; 
        }
        label { 
            display: block; 
            margin-bottom: 8px; 
            font-weight: 600; 
            color: #374151; 
            font-size: 14px;
        }
        input { 
            width: 100%; 
            padding: 12px; 
            border: 1px solid #d1d5db; 
            border-radius: 6px; 
            box-sizing: border-box; 
            font-size: 15px; 
            transition: all 0.3s ease; 
        }
        input:focus { 
            outline: none; 
            border-color: #2563eb; 
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2); 
        }
        button { 
            width: 100%; 
            padding: 12px; 
            background-color: #10b981; /* Un color verde para diferenciar el registro del login */
            color: white; 
            border: none; 
            border-radius: 6px; 
            font-size: 16px; 
            font-weight: bold; 
            cursor: pointer; 
            transition: background-color 0.3s ease; 
            margin-top: 10px;
        }
        button:hover { 
            background-color: #059669; 
        }
        .error { 
            background-color: #fee2e2; 
            color: #dc2626; 
            padding: 12px; 
            border-radius: 6px; 
            font-size: 14px; 
            margin-bottom: 20px; 
            border: 1px solid #f87171; 
        }
        .error ul {
            margin: 0;
            padding-left: 20px;
        }
        .login-link {
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
            color: #6b7280;
        }
        .login-link a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }
        .login-link a:hover {
            color: #1d4ed8;
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="register-box">
        <h2>Crear Cuenta</h2>
        <p class="subtitle">Únete al equipo de EntregaYa</p>

        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/registro" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nombre Completo</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Ej. Juan Pérez">
            </div>

            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="ejemplo@entregaya.com">
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required placeholder="Mínimo 6 caracteres">
            </div>

            <button type="submit">Registrarse</button>
        </form>

        <div class="login-link">
            ¿Ya tienes una cuenta? <a href="/login">Inicia sesión aquí</a>
        </div>
    </div>

</body>
</html>