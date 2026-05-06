# DeliverIt - Courier Management System

A Laravel-based courier management system with role-based access for Admin, Agent, and Customer.

## 📋 Features

### Admin Features
- Login & Dashboard with statistics
- Create, view, edit, delete shipments
- Create and manage agents
- Manage customers
- Update shipment status
- Send SMS notifications
- Generate reports (Date-wise, City-wise, Shipment-wise)
- Print shipment details

### Agent Features
- Login & Branch-specific dashboard
- Create shipments (auto-populated branch city)
- View branch shipments only
- Update shipment status
- Send SMS notifications
- Generate branch-wise reports
- Print shipment details

### Customer Features
- Register & Login
- Track shipment with tracking number
- View shipment status
- View my shipments
- Print tracking details
- Dashboard with statistics

---

## 🛠️ Installation & Setup

### Prerequisites
- PHP 8.2+
- MySQL 8.0+
- Composer
- Node.js & NPM

### Installation Steps

```bash
# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Configure database in .env file, then run migrations
php artisan migrate

# Seed the database (optional)
php artisan db:seed

# Build assets
npm run build

# Start the server
php artisan serve
```

Access the application at: `http://127.0.0.1:8000`

### Demo Credentials

- **Admin**: `admin@delivit.com` / `password123`
- **Agent**: `agent@delivit.com` / `password123`
- **Customer**: `customer@delivit.com` / `password123`

---

## 📁 Project Folders

```
├── app/Http/Controllers/      # Application logic
├── app/Models/                # Database models
├── database/migrations/        # Database schema
├── database/seeders/          # Seed data
├── resources/views/           # Blade templates
├── resources/css/             # Stylesheets
├── resources/js/              # Frontend scripts
├── routes/web.php             # Routes
├── config/                    # Configuration files
└── storage/                   # Logs and file storage
```

---

**Last Updated**: May 6, 2026  
**Status**: Production Ready ✅
