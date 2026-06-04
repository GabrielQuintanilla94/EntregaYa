<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - EntregaYa</title>
    
    {{-- Estilos internos para la página de registro --}}
    <style>
        /* Estilos generales del cuerpo */
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
        
        /* Contenedor principal del formulario de registro */
        .register-box { 
            background: white; 
            padding: 40px; 
            border-radius: 12px; 
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); 
            width: 100%; 
            max-width: 450px; 
        }
        
        /* Encabezados y textos */
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
        
        /* Agrupación de elementos del formulario */
        .form-group { 
            margin-bottom: 20px; 
        }
        
        /* Estilos para las etiquetas de los campos */
        label { 
            display: block; 
            margin-bottom: 8px; 
            font-weight: 600; 
            color: #374151; 
            font-size: 14px;
        }
        
        /* Estilos compartidos para campos de entrada y selector desplegable */
        input, select { 
            width: 100%; 
            padding: 12px; 
            border: 1px solid #d1d5db; 
            border-radius: 6px; 
            box-sizing: border-box; 
            font-size: 15px; 
            transition: all 0.3s ease; 
            background-color: white;
        }
        
        /* Efecto al seleccionar (enfocar) un campo */
        input:focus, select:focus { 
            outline: none; 
            border-color: #2563eb; 
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2); 
        }
        
        /* Botón de envío principal */
        button { 
            width: 100%; 
            padding: 12px; 
            background-color: #10b981; 
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
        
        /* Estilos para el cuadro de errores de validación */
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
        
        /* Enlace para ir al inicio de sesión */
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

        {{-- Bloque para mostrar errores de validación del formulario --}}
        @if ($errors->any())
            <div class="error">
                <ul>
                    {{-- Iterar y mostrar cada error devuelto por el controlador --}}
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Formulario de registro que envía los datos por método POST a /registro --}}
        <form action="/registro" method="POST">
            {{-- Directiva Blade para protección contra ataques CSRF --}}
            @csrf
            
            {{-- Campo: Nombre Completo --}}
            <div class="form-group">
                <label for="name">Nombre Completo</label>
                {{-- old('name') mantiene el valor ingresado en caso de error de validación --}}
                <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Ej. Juan Pérez">
            </div>

            {{-- Campo: Correo Electrónico --}}
            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="ejemplo@entregaya.com">
            </div>

            {{-- Campo: Contraseña --}}
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required placeholder="Mínimo 6 caracteres">
            </div>

            {{-- Selector: Rol del Usuario --}}
            <div class="form-group">
                <label for="rol">Tipo de Cuenta</label>
                <select id="rol" name="rol" required>
                    <option value="" disabled selected>Selecciona un rol...</option>
                    {{-- Opciones disponibles para registro --}}
                    <option value="conductor">Conductor (Repartidor)</option>
                    <option value="admin">Administrador (Despachador)</option>
                </select>
            </div>

            {{-- Botón para enviar el formulario --}}
            <button type="submit">Registrarse</button>
        </form>

        {{-- Enlace alternativo para usuarios ya registrados --}}
        <div class="login-link">
            ¿Ya tienes una cuenta? <a href="/login">Inicia sesión aquí</a>
        </div>
    </div>

</body>
</html>