# Book Reviews

A simple Laravel web application for browsing and adding reviews for books — no login or registration required.

---

## Features

- View a list of books
- Read reviews for each book
- Add a review for any book (no account needed)
- Clean and simple interface

---

## Tech Stack

- **Framework:** Laravel 10+
- **Language:** PHP 8.1+
- **Database:** MySQL
- **Frontend:** Blade templates
- **Package Manager:** Composer

---

## Requirements

Make sure you have the following installed:

- PHP >= 8.1
- Composer
- MySQL
- Node.js & npm *(optional, for assets)*

---

## Installation & Setup

### 1. Clone the repository

```bash
git clone https://github.com/outhmanebelgasim/book-reviews.git
cd book-reviews
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Copy the environment file

```bash
cp .env.example .env
```

### 4. Generate the application key

```bash
php artisan key:generate
```

### 5. Configure the database

Open `.env` and update the database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=book_reviews
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 6. Create the database

```sql
CREATE DATABASE book_reviews;
```

### 7. Run the migrations

```bash
php artisan migrate
```

### 8. (Optional) Seed the database with sample data

```bash
php artisan db:seed
```

### 9. Start the development server

```bash
php artisan serve
```

The application will be available at **http://127.0.0.1:8000**

---

## Project Structure

```
book-reviews/
├── app/
│   ├── Http/Controllers/     # BookController, ReviewController
│   └── Models/               # Book, Review
├── database/
│   ├── migrations/           # Database structure
│   └── seeders/              # Sample data
├── resources/
│   └── views/                # Blade templates
├── routes/
│   └── web.php               # Application routes
└── public/                   # Public assets
```

---

## Routes

| Method | URL                        | Description              |
|--------|----------------------------|--------------------------|
| GET    | `/`                        | Home — list of books     |
| GET    | `/books/{id}`              | Book detail & reviews    |
| GET    | `/books/{id}/reviews/create` | Add review form        |
| POST   | `/books/{id}/reviews`      | Submit a review          |

---

## Running Tests

```bash
php artisan test
```

---

## License

This project is open-source and available under the [MIT License](LICENSE).

---

## Author

Made by **Outhmane Belgasim** — IRISI 1, FST Marrakech
