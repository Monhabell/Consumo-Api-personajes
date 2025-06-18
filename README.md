<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## API - Laravel Project

Este proyecto consume la API pública (`https://rickandmortyapi.com/api/character`) y guarda los primeros 100 personajes en una base de datos MySQL. A partir de allí, se listan, visualizan en detalle y permiten ser editados desde una interfaz desarrollada en Laravel.


---

## Caracteristicas

- 🔗 Consumo de API externa
- 📦 Almacenamiento de datos en MySQL
- 📃 Listado de personajes con paginación
- 🔍 Vista de detalles por personaje
- ✏️ Funcionalidad de edición por personaje
- 💾 Exportación de base de datos `.sql`

## 🛠️ Tecnologías usadas

- **PHP 8.2.12**
- **Laravel 12.19.0**
- **MySQL**
- **Blade (sistema de plantillas de Laravel)**
- **Bootstrap básico / HTML**
- **Axios (opcional si agregas AJAX)**

---

## 🔧 Instalación

### 1. Clonar el proyecto

```bash
git clone https://github.com/tu_usuario/rick-and-morty-laravel.git
cd rick-and-morty-laravel
```

### 2. Instalar dependencias

```bash
composer install

```

### 3. Copiar archivo de entorno

```bash
cp .env.example .env

```

### 4. Generar clave de aplicacion

```bash
php artisan key:generate

```

### 5. Configurar base de datos

```bash
DB_DATABASE=personajes_db
DB_USERNAME=root
DB_PASSWORD=
```

### 6 Crear base de datos en MySQL

```bash
CREATE DATABASE personajes_db;

```

### 6 Ejecutar el servidor

```bash
php artisan serve

```

✍️ Autor
Desarrollado por Gabriel Monhabell