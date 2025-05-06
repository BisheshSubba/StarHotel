<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## About the Project

This is a **Hotel Reservation System** developed as an academic project using **Laravel (PHP framework)**, **MySQL**, and **Python**. It offers a user-friendly interface for customers to:

- Browse and view available rooms
- Make bookings (with or without login)
- Receive room recommendations based on selected amenities using **Cosine Similarity**

Admins have access to a dashboard for managing rooms, bookings, gallery, and other content.

Python integration is done using a standalone script located in the Laravel `storage/app/python/` directory. Views are built using Laravel Blade templates, separated for admin and user roles.

---

## 🚀 Features

- Admin and user roles
- Room booking with optional user login
- Amenity-based recommendation using Python
- Responsive layout using HTML/CSS
- Dashboard with booking stats
- Currency exchange (NPR ↔ USD)
- eSewa/Khalti payment integration (testing phase)

---

## 🔧 Installation Guide

### 1. Clone the Repository

```bash
git clone https://github.com/your-username/hotel-reservation-system.git
cd hotel-reservation-system

### 2. Install Composer Dependencies

Make sure you have [Composer](https://getcomposer.org/) installed. Then run:

```bash
composer install
### 3. Set Up Environment File

Copy the example environment file and generate an application key:

```bash
cp .env.example .env
php artisan key:generate
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

### 4. Run Migrations

```bash
php artisan migrate
### 5. Start the Laravel Development Server
```bash
php artisan serve
