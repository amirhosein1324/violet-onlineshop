# 🛍️ Violet & Slate E-Commerce Store (Laravel + Livewire)

A modern, fast, and feature-rich online shop built with **Laravel**, **Livewire**, and **Tailwind CSS**, featuring a custom **Electric Violet & Slate Gray** theme with sleek UI effects (glassmorphism, micro-interactions, neon accents).

---

## ✨ Features Implemented

### 🎨 Storefront & Public Routes
* **Hero Banner & Catalog Grid**: Interactive product showcases with category filtering and real-time search.
* **Wishlist Management**: Instant product toggling for authenticated users.
* **Real-time Checkout**: Livewire-driven checkout interface.

### 🎟️ Coupons & Discounts
* Dynamic creation of fixed-amount or percentage-based promo codes.
* Minimum order thresholds and toggleable active/disabled statuses.

### 📦 Order Processing & Tracking
* **Customer Order History (`/my-orders`)**: Track order status (`pending`, `processing`, `completed`, `cancelled`), view itemized receipts, and shipping details.
* **Admin Order Dashboard (`/admin/orders`)**: Real-time order fulfillment updating and order overview.

### ⚡ Admin Dashboard
* **Manage Products (`/admin/products`)**: CRUD operations for inventory items with file uploads linked to local storage.
* **Manage Coupons (`/admin/coupons`)**: Promotion control center.
* **Manage Orders (`/admin/orders`)**: Fulfill customer orders and monitor live revenue.

---

## 🛠️ Tech Stack & Requirements

* **Framework:** [Laravel](https://laravel.com/)
* **Frontend:** Blade Templates, [Tailwind CSS](https://tailwindcss.com/)
* **Database:** MySQL
* **Icons & Styling:** Heroicons / Custom SVG with Tailwind glassmorphism backdrop blurs

---

---

### ⚙️ Installation & Setup

1. **Clone the repository & install PHP dependencies**:
   ```bash
   composer install

---


| Method | Endpoint | Livewire / Controller | Access Level | Description |
| :--- | :--- | :--- | :--- | :--- |