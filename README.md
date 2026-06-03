# CI4 Painting Tag

A robust CRUD application built with CodeIgniter 4 for managing a collection of paintings and their associated tags. This project demonstrates best practices in MVC architecture, RESTful controllers, database migrations, seeding, and automated testing.

---

## Table of Contents

* [Overview](#overview)
* [Features](#features)
* [Tech Stack & Prerequisites](#tech-stack--prerequisites)
* [Installation & Setup](#installation--setup)
* [Configuration](#configuration)
* [Database Migrations & Seeding](#database-migrations--seeding)
* [Running the Application](#running-the-application)
* [Project Structure](#project-structure)
* [Controller Functions](#controller-functions)
* [Model Methods](#model-methods)
* [Views & Templates](#views--templates)
* [Public Entry & Assets](#public-entry--assets)
* [RESTful API Endpoints](#restful-api-endpoints)
* [Automated Testing](#automated-testing)
* [Best Practices & Conventions](#best-practices--conventions)
* [Continuous Integration](#continuous-integration)
* [Contributing](#contributing)
* [License](#license)

---

## Overview

CI4 Painting Tag is designed as a modular, maintainable, and scalable application to handle a many-to-many relationship between Paintings and Tags. Users can create, read, update, and delete paintings and tags through web forms or via JSON API calls.

## Features

* ✅ CRUD operations for Paintings and Tags
* 🔗 Many-to-many tagging system
* 🔍 Search and filter paintings by tag(s)
* 📦 RESTful JSON API alongside web interface
* 🛠 Database migrations and seeders
* 🧪 Unit and feature tests with PHPUnit
* 📋 PSR-12 coding standards enforced
* 🚀 Ready for CI/CD integration

## Tech Stack & Prerequisites

* **Language**: PHP 7.4+
* **Framework**: CodeIgniter 4
* **Database**: MySQL or PostgreSQL
* **Dependencies**: Composer
* **Dev Tools**: PHPUnit, PHP\_CodeSniffer
* **Optional**: Node.js & npm (for asset compiling)

Ensure you have installed:

```bash
php --version
composer --version
npm --version   # optional
```

## Installation & Setup

1. **Clone the repository**

   ```bash
   ```

git clone [https://github.com/and703/CI4-Painting-Tag.git](https://github.com/and703/CI4-Painting-Tag.git)
cd CI4-Painting-Tag

````

2. **Install PHP dependencies**
   ```bash
composer install
````

3. **Environment file**

   ```bash
   ```

cp env .env

# Update database credentials and base URL in .env

````

4. **Generate application key**
   ```bash
php spark key:generate
````

5. **Install Node.js dependencies** (if using asset pipeline)

   ```bash
   ```

npm install
npm run build

````

## Configuration

In `.env`, set:
```dotenv
app.baseURL = 'http://localhost:8080'
database.default.hostname = '127.0.0.1'
database.default.database = 'ci4_painting_tag'
database.default.username = 'root'
database.default.password = ''
environment = 'development'
````

## Database Migrations & Seeding

* **Run migrations**:

  ```bash
  php spark migrate
  ```

* **Run all seeders**:

  ```bash
  php spark db:seed DatabaseSeeder
  ```

  *(Seeds include `PaintingSeeder` and `TagSeeder` by default.)*

## Running the Application

Start the built‑in server:

```bash
php spark serve
```

Access via `http://localhost:8080`.

## Project Structure

```
├── app/
│   ├── Controllers/
│   ├── Models/
│   └── Views/
├── DB/
│   ├── Migrations/
│   └── Seeds/
├── public/
│   ├── index.php
│   ├── .htaccess
│   └── assets/
├── tests/
├── writable/
├── builds/
├── composer.json
└── spark
```

## Function Overview

### Controllers

#### BaseController

* `initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)` – Sets up the request and response objects, initializes session handling, and loads common helpers for derived controllers.

#### PaintingController

* `__construct()` – Loads the `PaintingModel`, `TagModel`, and necessary services (validation, session).
* `index()` – Lists paintings with pagination and optional `?tags[]=...` filtering.
* `show($id)` – Displays details for a single painting along with its associated tags.
* `create()` – Renders the form to create a new painting.
* `store()` – Validates input, saves a new painting record, and attaches selected tags.
* `edit($id)` – Renders the form to edit an existing painting.
* `update($id)` – Validates input and updates the painting record and its tag relationships.
* `delete($id)` – Deletes a painting and detaches all associated tags.

#### TagController

* `__construct()` – Loads the `TagModel` and necessary services.
* `index()` – Lists all tags with their usage counts.
* `show($id)` – Displays details for a single tag and the paintings associated with it.
* `create()` – Renders the form to create a new tag.
* `store()` – Validates input and saves a new tag record.
* `edit($id)` – Renders the form to edit an existing tag.
* `update($id)` – Validates input and updates the tag record.
* `delete($id)` – Deletes a tag and cleans up its associations.

### Models

#### PaintingModel

* `getPaintingWithTags(int $id): array` – Retrieves a painting record joined with its related tags.
* `searchByTags(array $tags): array` – Queries and returns paintings matching all provided tags.

#### TagModel

* `getTagWithPaintings(int $id): array` – Retrieves a tag record joined with its related paintings.

## Model Methods

### PaintingModel

* **Properties**: `protected $table = 'paintings';`, `$allowedFields`, `$primaryKey`, timestamps
* `getPaintingWithTags(int $id): array` – Fetch painting joined with tags table.
* `searchByTags(array $tags): array` – Retrieve paintings matching all provided tags.

### TagModel

* **Properties**: `protected $table = 'tags';`, `$allowedFields`, timestamps
* `getTagWithPaintings(int $id): array` – Fetch tag with its related paintings.

## Views & Templates

* **Layout**: `app/Views/layout.php` – Base HTML structure with `<head>`, header, footer.
* **Partials**: `header.php`, `footer.php` for reusable markup.
* **Paintings Folder**:

  * `index.php`, `form.php`, `show.php`.
* **Tags Folder**:

  * `index.php`, `form.php`, `show.php`.

All forms utilize CSRF protection and validation error display via built‑in CI4 helpers.

## Public Entry & Assets

* **public/index.php**: Bootstraps framework, registers autoloader, dispatches request.
* **public/.htaccess**: Removes `index.php` from URLs, handles rewrite.
* **public/assets/**: Place custom CSS/JS, images; consider versioning with build tool.

## RESTful API Endpoints

| Endpoint              | Method | Description                    |
| --------------------- | ------ | ------------------------------ |
| `/api/paintings`      | GET    | JSON list of paintings         |
| `/api/paintings/{id}` | GET    | JSON detail of single painting |
| `/api/paintings`      | POST   | Create painting (JSON payload) |
| `/api/paintings/{id}` | PUT    | Update painting                |
| `/api/paintings/{id}` | DELETE | Delete painting                |
| `/api/tags`           | GET    | JSON list of tags              |
| `/api/tags/{id}`      | GET    | JSON detail of single tag      |
| `/api/tags`           | POST   | Create tag                     |
| `/api/tags/{id}`      | PUT    | Update tag                     |
| `/api/tags/{id}`      | DELETE | Delete tag                     |

## Automated Testing

* **Unit Tests**: `tests/Unit/*` for Model methods.
* **Feature Tests**: `tests/Feature/*` hitting controllers via HTTP.
* **Run**:

  ```bash
  ./vendor/bin/phpunit --coverage-text
  ```

## Best Practices & Conventions

* **Coding Standard**: PSR-12 via PHP\_CodeSniffer.
* **Environment**: Keep `.env` out of VCS; commit `.env.example`.
* **Validation**: Centralize in Controllers or create custom Request classes.
* **Entities**: Use CI4 Entities for richer data objects.
* **Error Handling**: Uniform JSON error responses for API.

## Continuous Integration

A sample GitHub Actions workflow (`.github/workflows/ci.yml`) can:

1. Check out code
2. Install dependencies
3. Run linting
4. Execute tests
5. Report coverage

## Contributing

1. Fork repository
2. Create branch: `git checkout -b feature/YourFeature`
3. Code and add tests
4. Lint & test locally
5. Commit & push
6. Open PR, reference issue

Please follow the existing code style and ensure tests pass before merging.

## License

MIT License © 2025. See [LICENSE](LICENSE).
