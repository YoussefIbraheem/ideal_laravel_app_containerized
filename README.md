# 🐳 Ideal Laravel Task Management API (Dockerized)

A robust RESTful backend API for task management built with **Laravel**, tested using **PestPHP**, and containerised using **Laravel Sail (Docker)**. It supports role-based access control (Admin, Manager, User), task dependencies, status workflows, and a clean developer experience.

---

## 📄 Table of Contents

- [🐳 Ideal Laravel Task Management API (Dockerized)](#-Ideal Laravel-task-management-api-dockerized)
  - [📄 Table of Contents](#-table-of-contents)
  - [📚 Features](#-features)
  - [📊 ER Diagram](#-er-diagram)
  - [📦 API Test Collection (Postman)](#-api-test-collection-postman)
  - [🧪 Testing Environment](#-testing-environment)
  - [🚀 Docker Setup](#-docker-setup)
    - [⚙️ Setup via Laravel Sail](#️-setup-via-laravel-sail)
      - [📦 1. Clone \& Install](#-1-clone--install)
    - [🌱 Migrate \& Seed Database](#-migrate--seed-database)
    - [✅ Running Tests in Docker](#-running-tests-in-docker)
  - [📄 API Documentation](#-api-documentation)
  - [📮 API Summary](#-api-summary)
  - [👨‍👩‍👧‍👦 Roles \& Permissions](#-roles--permissions)
  - [🧪 Test Coverage](#-test-coverage)
  - [📦 Installed Packages](#-installed-packages)
    - [🔐 Auth \& Roles](#-auth--roles)
    - [📄 API Docs](#-api-docs)
    - [🧪 Testing \& QA](#-testing--qa)
  - [🗺️ ERD (Entity Relationship Diagram)](#️-erd-entity-relationship-diagram)

---

## 📚 Features

- 🔐 Auth (Register, Login, Logout)
- 🔁 Role Switching (Admin ↔ Manager)
- 🧑‍💼 Task creation with assignees
- ⛓️ Task dependencies (parent-child logic)
- 🔄 Status change workflow with role & dependency validation
- 🔍 Role-based visibility
- 📄 API Docs via Scribe (`/docs`)
- 🧪 Full test coverage (using PestPHP)
- 🐳 Dockerized with Laravel Sail

---

## 📊 ER Diagram

📁 `ERD.drawio` — visual schema of `users`, `tasks`, and pivot tables for task assignment & dependencies.

> You can open it using [draw.io](https://app.diagrams.net)

---

## 📦 API Test Collection (Postman)

📄 File: `SoftXpert.postman_collection.json`

> Import into Postman to explore all endpoints.

---

## 🧪 Testing Environment

- In-memory SQLite (`:memory:`) used for isolated testing.
- `.env.testing` config provided.
- Tests written using **PestPHP**.
- Parallel testing enabled with `brianium/paratest`.

---

## 🚀 Docker Setup

This project uses [Laravel Sail](https://laravel.com/docs/sail) as a lightweight Docker environment.

---

### ⚙️ Setup via Laravel Sail

#### 📦 1. Clone & Install

```bash
git clone https://github.com/YoussefIbraheem/softxpert-containerized.git
cd softxpert-containerized
cp .env.example .env
./vendor/bin/sail composer install
./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate
````

> You can alias Sail for convenience:
>
> ```bash
> alias sail="./vendor/bin/sail"
> ```

---

### 🌱 Migrate & Seed Database

```bash
sail artisan migrate --seed
```

Reset with:

```bash
sail artisan migrate:fresh --seed
```

---

### ✅ Running Tests in Docker

Run all tests:

```bash
sail test
```

Or with Pest:

```bash
sail pest
```

With coverage report:

```bash
sail pest --coverage
```

> Ensure `.env.testing` and `phpunit.xml` are correctly configured for SQLite.

---

## 📄 API Documentation

📁 Generated using [**Scribe**](https://scribe.knuckles.wtf)

📂 Location: `/docs`

To regenerate:

```bash
sail artisan scribe:generate
```

Then visit:

```
http://localhost/docs
```

---

## 📮 API Summary

| Action                    | Admin | Manager |       User      |
| ------------------------- | :---: | :-----: | :-------------: |
| Create task               |   ✅   |    ✅    |        ❌        |
| Edit task (except status) |   ✅   |    ✅    |        ❌        |
| Add dependents            |   ✅   |    ✅    |        ❌        |
| Change status             |   ✅   |    ✅    | ✅ (if assigned) |
| Cancel task               |   ✅   |    ✅    |        ❌        |
| Delete task               |   ✅   |    ❌    |        ❌        |
| View all tasks            |   ✅   |    ✅    |        ❌        |
| View own tasks            |   ✅   |    ✅    |        ✅        |

---

## 👨‍👩‍👧‍👦 Roles & Permissions

* 🧑‍💼 **Admin**: Full control
* 👨‍💼 **Manager**: Can create & manage tasks, cancel tasks, assign users
* 👤 **User**: Can only change status of assigned tasks (except `cancelled`)

---

## 🧪 Test Coverage

Thorough tests cover:

* 🔐 Auth
* 👥 Role management
* 📋 Task CRUD & visibility
* 🔄 Status transitions
* ⛓️ Dependency logic
* 🛡️ Policy restrictions

---

## 📦 Installed Packages

### 🔐 Auth & Roles

| Package                     | Description                |
| --------------------------- | -------------------------- |
| `laravel/sanctum`           | Token-based authentication |
| `spatie/laravel-permission` | Role-based access control  |

### 📄 API Docs

| Package              | Description                 |
| -------------------- | --------------------------- |
| `knuckleswtf/scribe` | Automatic API documentation |

### 🧪 Testing & QA

| Package             | Description                   |
| ------------------- | ----------------------------- |
| `pestphp/pest`      | Elegant PHP Testing framework |
| `brianium/paratest` | Parallel test execution       |
| `phpstan/phpstan`   | Static analysis               |
| `larastan/larastan` | Laravel extension for PHPStan |

---

## 🗺️ ERD (Entity Relationship Diagram)

📄 File: [`ERD.drawio`](ERD.drawio)

<details>
<summary>Overview</summary>

* **Users**

  * Can create many tasks
  * Can be assigned to many tasks
* **Tasks**

  * Belongs to one user (creator)
  * Has many assignees
  * Has many dependencies (self-join)

</details>

---
