<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="#"><img src="https://img.shields.io/badge/status-in%20development-orange" alt="Status"></a>
<a href="#"><img src="https://img.shields.io/badge/python-recommendation-blue" alt="Python"></a>
<a href="#"><img src="https://img.shields.io/badge/license-MIT-green.svg" alt="License"></a>
</p>

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
