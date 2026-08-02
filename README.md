# 🛒 Violet Online Shop — Modern Laravel E-Commerce Store

![Laravel](https://img.shields.io/badge/Laravel-10.x%20%2F%2011.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.x-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

**Violet shop** is a modern, high-performance e-commerce platform built on Laravel with a sleek **Electric Violet & Slate Gray** theme. Designed for optimal user experience, it features custom glowing UI elements, glassmorphism UI components, real-time customer reviews, coupon management, and robust administrative tools.

---

## 🎨 Key Features & Highlights

* **💜 Modern Dark Mode UI:** Electric Violet accents layered over Charcoal/Slate Gray backgrounds with subtle glassmorphism and glowing hover effects.
* **🛍️ Product Showcase & Catalog:** Dynamic product grid displaying real-time star ratings, availability, and detailed product attributes.
* **⭐ Star Ratings & Reviews System:** Allows users to submit 1–5 star ratings and written reviews with dynamic aggregate score calculation.
* **🛒 Shopping Cart & Coupon Engine:** Seamless session-based cart management with discount coupon code validation.
* **📊 Sales & Analytics Dashboard:** Integrated admin overview for tracking orders, top-selling items, and platform metrics.
* **📱 Responsive Design:** Fully responsive layout optimized across mobile, tablet, and desktop viewports.

---


## 🛠️ Tech Stack

* **Framework:** [Laravel](https://laravel.com/)
* **Frontend:** Blade Templates, [Tailwind CSS](https://tailwindcss.com/)
* **Database:** MySQL
* **Icons & Styling:** Heroicons / Custom SVG with Tailwind glassmorphism backdrop blurs

---

---

### ⚙️ Installation & Setup

1. **Clone the repository:**
   ```bash
   git clone [https://github.com/your-username/byte-bazaar.git](https://github.com/your-username/byte-bazaar.git)

---
## 🛣️ Application Route Summary

| Method | Endpoint | Livewire / Controller | Access Level | Description |
| :--- | :--- | :--- | :--- | :--- |
| `GET` | `/` | `ProductController@index` | Public | Home page & product catalog |
| `GET` | `/wishlist` | `WishlistController@index` | Public / User | Saved wishlist items |
| `POST` | `/wishlist/{id}/toggle` | `WishlistController@toggle` | User | Toggle saved item status |
| `GET` | `/checkout` | `App\Livewire\Checkout` | Public / User | Cart & checkout process |
