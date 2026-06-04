# 🚚 EntregaYa — Sistema de Gestión Logística y Rutas

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![Google Maps](https://img.shields.io/badge/Google_Maps-4285F4?style=for-the-badge&logo=google-maps&logoColor=white)

> Plataforma web integral para la gestión operativa de flotas y asignación de paquetería, que conecta en tiempo real a los administradores de central con los conductores en ruta.

---

## 📋 Tabla de Contenidos

- [Descripción](#-descripción)
- [Características](#-características-principales)
- [Tecnologías](#️-tecnologías-y-arquitectura)
- [Requisitos](#-requisitos-previos)
- [Instalación](#-instalación-y-despliegue-local)
- [Uso](#-uso)
- [Estructura del Proyecto](#-estructura-del-proyecto)


---

## 📦 Descripción

**EntregaYa** es una solución desarrollada en **Laravel 11** que optimiza el flujo de trabajo logístico entre administradores y conductores. Mediante un sistema de roles, cada perfil accede a su módulo dedicado: la central gestiona flotillas y asigna entregas, mientras que los conductores reciben sus rutas directamente en su móvil con integración a Google Maps.

---

## ✨ Características Principales

El sistema implementa control de acceso basado en roles (Middleware), dividiendo la aplicación en dos módulos:

### 👨‍💼 Módulo Administrador — Central

| Función | Descripción |
|---|---|
| **Dashboard Operativo** | Métricas en tiempo real: conductores activos, vehículos disponibles, entregas en curso y completadas. |
| **Gestión de Flotilla** | Registro y control de estado de vehículos y conductores. |
| **Asignación Inteligente** | Creación de guías de entrega vinculando paquetes, clientes, conductores y vehículos. |
| **Centro de Monitoreo** | Historial de entregas exitosas y panel de alertas para incidencias reportadas en calle. |

### 🚙 Módulo Conductor — App Móvil Web

| Función | Descripción |
|---|---|
| **Interfaz Responsiva** | Diseño 100% adaptado a dispositivos móviles con Tailwind CSS. |
| **Panel de Entregas** | Visualización de paquetes pendientes asignados con datos de contacto del cliente. |
| **Rutas Interactivas** | Integración con Google Maps para visualizar la ruta exacta tocando el destino. |
| **Reporte de Incidencias** | Formulario para notificar averías, tráfico o problemas con clientes. |
| **Actualización de Estado** | Marca paquetes como "Entregados" y actualiza la base de datos en tiempo real. |

---

## 🛠️ Tecnologías y Arquitectura

```
EntregaYa/
├── Backend:    PHP 8 / Laravel 11
├── Frontend:   Blade Templates + Tailwind CSS
├── Base datos: MySQL (Eloquent ORM + Migraciones)
├── Arquitectura: MVC (Modelo-Vista-Controlador)
├── Seguridad:  Autenticación + Middlewares personalizados
└── Integración: Google Maps API
```

---

## ✅ Requisitos Previos

Antes de instalar, asegúrate de tener lo siguiente:

- **PHP** >= 8.0
- **Composer** >= 2.x
- **Node.js** >= 18.x y **npm**
- **MySQL** >= 8.0
- **Git**

---

## 🚀 Instalación y Despliegue Local

### 1. Clonar el repositorio

```bash
git clone https://github.com/GabrielQuintanilla94/EntregaYa.git
cd EntregaYa
```

### 2. Instalar dependencias

```bash
composer install
npm install
```

### 3. Configurar variables de entorno

```bash
cp .env.example .env
```

Abre el archivo `.env` y configura tus credenciales:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=entregaya
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña

# Agrega tu clave de Google Maps
GOOGLE_MAPS_API_KEY=tu_api_key
```

### 4. Generar la clave de la aplicación

```bash
php artisan key:generate
```

### 5. Ejecutar las migraciones

```bash
php artisan migrate
```

> **Opcional:** Si el proyecto incluye seeders para datos de prueba:
> ```bash
> php artisan db:seed
> ```

### 6. Compilar assets y levantar el servidor

```bash
npm run build
php artisan serve
```

La aplicación estará disponible en **[http://localhost:8000](http://localhost:8000)**

---

## 📖 Uso

Una vez levantado el servidor, puedes ingresar con los roles disponibles:

| Rol | Acceso | Descripción |
|---|---|---|
| **Administrador** | `/admin/dashboard` | Gestión completa de flotilla, conductores y entregas. |
| **Conductor** | `/conductor/panel` | Panel de rutas y actualización de estado de entregas. |

---

## 📁 Estructura del Proyecto

```
EntregaYa/
├── app/
│   ├── Http/
│   │   ├── Controllers/     # Controladores por módulo
│   │   └── Middleware/      # Control de acceso por roles
│   └── Models/              # Modelos Eloquent
├── database/
│   └── migrations/          # Estructura de la base de datos
├── resources/
│   └── views/               # Plantillas Blade
│       ├── admin/           # Vistas del módulo administrador
│       └── conductor/       # Vistas del módulo conductor (responsivas)
├── routes/
│   └── web.php              # Definición de rutas
└── public/                  # Assets compilados
```
