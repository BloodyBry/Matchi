# Matchi

Matchi is a comprehensive SaaS platform built with Laravel that connects sports enthusiasts with sports facility managers. It simplifies the process of finding, booking, and managing sports fields.

## Features

The platform is divided into three distinct user roles, each with its own dedicated dashboard and capabilities:

### For Users (Athletes)
- **Discover Facilities**: Browse available sports centers and fields in your area.
- **Easy Booking**: View real-time availability and book fields instantly.
- **Reservation Management**: Track your upcoming matches and cancel if necessary.
- **Review System**: Leave feedback and rate fields after your game.

### For Facility Managers
- **Center Management**: Create and manage your sports center profile.
- **Field Configuration**: Add multiple fields, specifying the sport type, price, and surface type.
- **Schedule Management**: Set specific operating hours and availability slots for each field.
- **Booking Dashboard**: Monitor reservations and keep track of your facility's usage.

### For Administrators
- **Platform Oversight**: Full visibility over all platform reservations.
- **User Management**: Monitor, suspend, or ban users as needed.
- **Center Verification**: Approve or reject sports centers to maintain platform quality.
- **Sport Categories**: Manage the list of available sports on the platform.

## Technology Stack

- **Backend Framework**: [Laravel](https://laravel.com/) (PHP)
- **Frontend**: Blade Templating Engine + Vanilla CSS
- **Database**: MySQL / SQLite (configurable via `.env`)

## Getting Started (Local Development)

Follow these steps to set up the project locally.

### Prerequisites
- PHP >= 8.2
- Composer
- Node.js & npm
- MySQL or SQLite

### Installation

1. **Clone the repository**
   ```bash
   git clone <your-repo-url>
   cd Matchi
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Frontend dependencies**
   ```bash
   npm install
   ```

4. **Environment Setup**
   Copy the example environment file and configure your database settings.
   ```bash
   cp .env.example .env
   ```
   *Make sure to update the `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` variables in your new `.env` file.*

5. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

6. **Run Migrations & Seeders**
   This will set up your database tables and populate them with initial data (like sports categories and an admin user).
   ```bash
   php artisan migrate --seed
   ```

7. **Start the Development Servers**
   You will need two terminal windows to run both the Laravel backend and the Vite frontend compiler.
   
   Terminal 1:
   ```bash
   php artisan serve
   ```
   
   Terminal 2:
   ```bash
   npm run dev
   ```

8. **Access the Application**
   Open your browser and navigate to `http://localhost:8000`.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
