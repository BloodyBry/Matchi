<div align="center">

# ⚽ Matchi

**A modern SaaS platform for sports facility discovery, booking, and management.**

[![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.3+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)
[![Vite](https://img.shields.io/badge/Vite-646CFF?style=for-the-badge&logo=vite&logoColor=white)](https://vitejs.dev)
[![License: MIT](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)](https://opensource.org/licenses/MIT)

*Connecting athletes with sports facilities — seamlessly.*

</div>

---

## 📖 Overview

**Matchi** is a full-stack web application built with **Laravel 13** that bridges the gap between sports enthusiasts and facility managers. Athletes can discover, compare, and instantly book sports fields, while managers get a powerful dashboard to manage their centers, configure fields, and monitor reservations — all from one unified platform.

The platform enforces a clean **three-role architecture** (`user`, `manager`, `admin`) to provide a tailored experience for every stakeholder.

---

## ✨ Features

### 🧑 For Athletes (Users)
| Feature | Description |
|---|---|
| 🔍 Discover Facilities | Browse sports centers and available fields by sport type |
| 📅 Real-time Booking | Check live availability and reserve a field instantly |
| 🎟️ Reservation Management | View, track, and cancel upcoming bookings |
| ⭐ Review System | Rate and review fields to help the community |

### 🏟️ For Facility Managers
| Feature | Description |
|---|---|
| 🏢 Center Profile | Create and manage your sports center's public profile |
| ⚽ Field Configuration | Add multiple fields with sport type, price/hour, capacity, and surface details |
| 🕐 Schedule Management | Define operating hours and availability windows per field |
| 📊 Booking Dashboard | Monitor all incoming reservations and facility usage at a glance |

### 🛡️ For Administrators
| Feature | Description |
|---|---|
| 📋 Platform Oversight | Full visibility over all reservations platform-wide |
| 👥 User Management | Suspend or ban users to enforce platform policies |
| ✅ Center Verification | Approve or reject sports center registrations for quality control |
| 🏅 Sport Categories | Add and manage the list of sports offered on the platform |

---

## 🗂️ Data Model

```
User ──────────────────────────────────────────────────────────┐
 │ role: user | manager | admin                                │
 │ status: active | suspended | banned                        │
 │                                                             │
 ├──(manager_id)──► SportsCenter ──────────────────────────────┤
 │                   └──► Field ──────────────────────────────  │
 │                         │ sport_id ──► Sport               │
 │                         ├──► FieldSchedule                 │
 │                         ├──► Reservation ◄── User          │
 │                         └──► Review ◄── User               │
 └─────────────────────────────────────────────────────────────┘
```

**Core Entities:**
- **`User`** — Authenticated account with one of three roles (`user`, `manager`, `admin`).
- **`SportsCenter`** — A physical facility owned by a manager. Subject to admin approval.
- **`Sport`** — A sport category (e.g., Football, Tennis) managed by admins.
- **`Field`** — A bookable surface within a sports center, linked to a specific sport.
- **`FieldSchedule`** — Time slots that define a field's operating availability.
- **`Reservation`** — A confirmed booking linking a user to a specific field and time slot.
- **`Review`** — A post-game rating and comment left by a user for a field.

---

## 🛠️ Technology Stack

| Layer | Technology |
|---|---|
| **Backend** | [Laravel 13](https://laravel.com/) (PHP 8.3+) |
| **Templating** | Blade Template Engine |
| **Frontend** | Vanilla CSS + [Vite](https://vitejs.dev/) |
| **Database** | MySQL (configurable to SQLite via `.env`) |
| **Auth** | Laravel's built-in session-based authentication |
| **Testing** | PHPUnit 12 |
| **Dev Tooling** | Laravel Pail (log viewer), Laravel Pint (code style) |

---

## 🚀 Getting Started

### Prerequisites

Make sure you have the following installed before proceeding:

- **PHP** >= 8.3
- **Composer** >= 2.x
- **Node.js** >= 18.x & **npm**
- **MySQL** (or SQLite for quick local setup)

---

### ⚡ Quick Setup (One Command)

The project includes a `composer setup` script that automates the entire installation:

```bash
git clone <your-repo-url> matchi
cd matchi
composer run setup
```

> **Note:** Before running, make sure to configure your database credentials in `.env` (created automatically from `.env.example`).

---

### 🔧 Manual Installation

Follow these steps for a step-by-step setup:

**1. Clone the repository**
```bash
git clone <your-repo-url> matchi
cd matchi
```

**2. Install PHP dependencies**
```bash
composer install
```

**3. Install frontend dependencies**
```bash
npm install
```

**4. Set up environment variables**
```bash
cp .env.example .env
```
Open `.env` and configure your database connection:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=matchi
DB_USERNAME=root
DB_PASSWORD=
```

**5. Generate the application key**
```bash
php artisan key:generate
```

**6. Run database migrations and seeders**

This creates all tables and populates them with initial data (sport categories, a default admin account, etc.).
```bash
php artisan migrate --seed
```

**7. Start the development servers**

Run all services (Laravel, Vite, queue worker, and log viewer) with a single command:
```bash
composer run dev
```

Or start them individually in separate terminals:
```bash
# Terminal 1 — Laravel backend
php artisan serve

# Terminal 2 — Vite frontend compiler (hot reload)
npm run dev
```

**8. Open the application**

Navigate to [http://localhost:8000](http://localhost:8000) in your browser.

---

### 🧪 Running Tests

```bash
composer run test
# or
php artisan test
```

---

## 📁 Project Structure

```
matchi/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── Admin/          # Admin-only controllers
│   │       ├── Manager/        # Manager-only controllers
│   │       └── Auth/           # Authentication controllers
│   └── Models/                 # Eloquent models
├── database/
│   ├── migrations/             # Database schema
│   └── seeders/                # Initial data seeders
├── resources/
│   └── views/                  # Blade templates (admin, manager, user)
├── routes/
│   └── web.php                 # Application routes
└── public/                     # Publicly accessible assets
```

---

## 🪪 Default Credentials

After seeding, you can log in with the default admin account:

| Field | Value |
|---|---|
| **Email** | `admin@matchi.com` |
| **Password** | `password` |

> ⚠️ **Change the default credentials immediately** in any staging or production environment.

---

## 📜 License

This project is open-sourced software licensed under the [MIT License](https://opensource.org/licenses/MIT).
