
## API - Laravel Project

Este proyecto consume la API pública (`https://rickandmortyapi.com/api/character`) y guarda los primeros 100 personajes en una base de datos MySQL. A partir de allí, se listan, visualizan en detalle y permiten ser editados desde una interfaz desarrollada en Laravel.


---

## Caracteristicas

- 🔗 Consumo de API externa
- 📦 Almacenamiento de datos en MySQL
- 📃 Listado de personajes
- 🔍 Vista de detalles por personaje
- ✏️ Funcionalidad de edición por personaje


## 🛠️ Tecnologías usadas

- **PHP 8.2.12**
- **Laravel 12.19.0**
- **MySQL**
- **Blade (sistema de plantillas de Laravel)**
- **Bootstrap básico / HTML**

---

## 🔧 Instalación

### 1. Clonar el proyecto

```bash
git clone https://github.com/Monhabell/Consumo-Api-personajes.git
```

### 2. Instalar dependencias

```bash
composer install

```

### 3. Copiar archivo de entorno

```bash
cp .env.example .env

```

```bash

DB_CONNECTION=sqlite
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=personajes_db
DB_USERNAME=ro

```



### 4. Generar clave de aplicacion

```bash
php artisan key:generate

```

### 5. Crear base de datos y tablas en MySQL

```bash
php artisan migrate

```

### 6. Ejecutar el servidor

```bash
php artisan serve

```

### ✍️ Autor
Desarrollado por Gabriel Monhabell
