# 📇 Laravel Contacts Manager

This is a Laravel 11 project for managing contacts with user authentication, search filters, pagination, custom validation, and PHPUnit automated testing.

## 🚀 Features

- User registration and login
- Create, edit, search, and delete contacts
- Search filter by name, email, or contact number
- Pagination of results
- Soft deletes for contacts
- Validation using Form Requests
- Unit and feature testing with PHPUnit
- SQLite used for testing environment

Need to install sqlite

sudo apt install php8.1-sqlite3

---

## 🛠️ Technologies

- PHP 8.1
- Laravel 10
- SQLite (testing)
- MySQL or PostgreSQL (production)
- PHPUnit
- Faker (model factories)

---

## 📦 Installation

```bash
# Clone the repository
git clone https://github.com/dilsoncampelo10/contacts
cd contacts

# Install dependencies
composer install

# Copy .env and configure
cp .env.example .env

# Generate app key
php artisan key:generate

php artisan test
