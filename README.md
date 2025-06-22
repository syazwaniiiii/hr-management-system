# HR Management System - Laravel + Sail + PostgreSQL

## Requirements

Before starting, make sure you have these installed:

* [Docker Desktop](https://www.docker.com/products/docker-desktop)
* [Git](https://git-scm.com/)
* PHP 8.x and Composer (if needed for artisan commands outside Sail)

---

## 1. Clone the Project

```bash
git clone https://github.com/syahrulx/hr-management-system.git
cd hr-management-system
```

---

## 2. Copy the .env File

Copy `.env.example` to `.env`:

```bash
cp .env.example .env
```

Then edit `.env`:

```env
DB_CONNECTION=pgsql
DB_HOST=pgsql
DB_PORT=5432
DB_DATABASE=vitalstaff
DB_USERNAME=postgres
DB_PASSWORD=root123
```

---

## 3. Install Dependencies & Sail

If Composer is installed:

```bash
composer install
php artisan sail:install
```

---

## 4. Start Docker Containers

Run this to start Laravel Sail:

```bash
./vendor/bin/sail up -d
```

This will run the Laravel and PostgreSQL services in Docker.

---

## 5. Run Migrations

To create the database tables:

```bash
./vendor/bin/sail artisan migrate
```

---

## 6. Seed the Database (Optional)

If the project has seeders available:

```bash
./vendor/bin/sail artisan db:seed
```

---

## 7. Access the App

Open your browser:

```
http://localhost
```

