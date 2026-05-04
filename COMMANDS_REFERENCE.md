# Courier Management System - Artisan Commands Reference

**All commands to be executed in the project root directory**

---

## 📝 Database Migrations - Commands to Run

### Modify Users Table (Add role, phone, city, status fields)
```bash
php artisan make:migration alter_users_table_add_fields --table=users
```

### Create New Tables

```bash
# Customers table
php artisan make:migration create_customers_table

# Agents table
php artisan make:migration create_agents_table

# Shipments table
php artisan make:migration create_shipments_table

# Shipment Tracking table
php artisan make:migration create_shipment_tracking_table

# SMS Logs table
php artisan make:migration create_sms_logs_table

# Reports table
php artisan make:migration create_reports_table
```

---

## 🏗️ Model Creation - Commands to Run

```bash
# User Model (already exists, but will extend)
php artisan make:model Customer

# Agent Model
php artisan make:model Agent

# Shipment Model
php artisan make:model Shipment

# ShipmentTracking Model
php artisan make:model ShipmentTracking

# SMSLog Model
php artisan make:model SMSLog

# Report Model
php artisan make:model Report
```

---

## 🎮 Controller Creation - Commands to Run

```bash
# Auth Controller
php artisan make:controller AuthController

# Admin Controller (with resource methods)
php artisan make:controller AdminController --resource

# Courier/Shipment Controller
php artisan make:controller CourierController --resource

# Agent Controller
php artisan make:controller AgentController --resource

# Tracking Controller
php artisan make:controller TrackingController

# Report Controller
php artisan make:controller ReportController --resource

# SMS Controller
php artisan make:controller SMSController
```

---

## ✅ Form Request Validation - Commands to Run

```bash
# Store/Create Shipment validation
php artisan make:request StoreShipmentRequest

# Update Shipment validation
php artisan make:request UpdateShipmentRequest

# Store Customer validation
php artisan make:request StoreCustomerRequest

# Update Customer validation
php artisan make:request UpdateCustomerRequest

# Create Agent validation
php artisan make:request StoreAgentRequest

# Update Agent validation
php artisan make:request UpdateAgentRequest
```

---

## 🔐 Middleware Creation - Commands to Run

```bash
# Role-based access middleware
php artisan make:middleware CheckRole

# Agent city verification middleware
php artisan make:middleware CheckAgentCity
```

---

## 📊 Database Seeders - Commands to Run

```bash
# Admin seeder
php artisan make:seeder UserSeeder

# Customer seeder
php artisan make:seeder CustomerSeeder

# Agent seeder
php artisan make:seeder AgentSeeder

# Shipment seeder (for testing)
php artisan make:seeder ShipmentSeeder

# Main Database Seeder (to run all)
php artisan make:seeder DatabaseSeeder
```

---

## 🎯 Service Classes - Commands to Create

Service classes need to be created manually (no Artisan command), but here are the files:

```bash
# To create a Services directory and files:
# mkdir app/Services
# Then create these files:
# - app/Services/ShipmentService.php
# - app/Services/SMSService.php
# - app/Services/ReportService.php
```

---

## 📦 Resource Classes (API Response) - Commands to Run

```bash
# Shipment resource
php artisan make:resource ShipmentResource

# Customer resource
php artisan make:resource CustomerResource

# Agent resource
php artisan make:resource AgentResource

# Collection resources
php artisan make:resource ShipmentCollection
```

---

## 🔍 Order of Execution

Execute these commands in this order:

### Step 1: Migrations
```bash
php artisan make:migration alter_users_table_add_fields --table=users
php artisan make:migration create_customers_table
php artisan make:migration create_agents_table
php artisan make:migration create_shipments_table
php artisan make:migration create_shipment_tracking_table
php artisan make:migration create_sms_logs_table
php artisan make:migration create_reports_table
```

### Step 2: Models
```bash
php artisan make:model Customer
php artisan make:model Agent
php artisan make:model Shipment
php artisan make:model ShipmentTracking
php artisan make:model SMSLog
php artisan make:model Report
```

### Step 3: Controllers
```bash
php artisan make:controller AuthController
php artisan make:controller AdminController --resource
php artisan make:controller CourierController --resource
php artisan make:controller AgentController --resource
php artisan make:controller TrackingController
php artisan make:controller ReportController --resource
php artisan make:controller SMSController
```

### Step 4: Form Requests
```bash
php artisan make:request StoreShipmentRequest
php artisan make:request UpdateShipmentRequest
php artisan make:request StoreCustomerRequest
php artisan make:request UpdateCustomerRequest
php artisan make:request StoreAgentRequest
php artisan make:request UpdateAgentRequest
```

### Step 5: Middleware
```bash
php artisan make:middleware CheckRole
php artisan make:middleware CheckAgentCity
```

### Step 6: Resources
```bash
php artisan make:resource ShipmentResource
php artisan make:resource CustomerResource
php artisan make:resource AgentResource
```

### Step 7: Seeders
```bash
php artisan make:seeder UserSeeder
php artisan make:seeder CustomerSeeder
php artisan make:seeder AgentSeeder
php artisan make:seeder ShipmentSeeder
```

### Step 8: Run Migrations
```bash
php artisan migrate
```

### Step 9: Run Seeders (Optional - for test data)
```bash
php artisan db:seed
```

---

## 🚀 Additional Helpful Commands

### Clear/Cache Commands (After making changes)
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Generate Application Key (if not done)
```bash
php artisan key:generate
```

### Install Laravel UI (for scaffolding)
```bash
composer require laravel/ui
php artisan ui bootstrap --auth
npm install && npm run dev
```

### Tinker (Interactive Shell)
```bash
php artisan tinker
```

### Show Routes
```bash
php artisan route:list
```

### Database Fresh (Warning: Deletes all data)
```bash
php artisan migrate:fresh --seed
```

---

## 📋 Complete Single Command Block (Copy & Paste)

You can run all commands in sequence:

```bash
# Migrations
php artisan make:migration alter_users_table_add_fields --table=users && \
php artisan make:migration create_customers_table && \
php artisan make:migration create_agents_table && \
php artisan make:migration create_shipments_table && \
php artisan make:migration create_shipment_tracking_table && \
php artisan make:migration create_sms_logs_table && \
php artisan make:migration create_reports_table && \

# Models
php artisan make:model Customer && \
php artisan make:model Agent && \
php artisan make:model Shipment && \
php artisan make:model ShipmentTracking && \
php artisan make:model SMSLog && \
php artisan make:model Report && \

# Controllers
php artisan make:controller AuthController && \
php artisan make:controller AdminController --resource && \
php artisan make:controller CourierController --resource && \
php artisan make:controller AgentController --resource && \
php artisan make:controller TrackingController && \
php artisan make:controller ReportController --resource && \
php artisan make:controller SMSController && \

# Form Requests
php artisan make:request StoreShipmentRequest && \
php artisan make:request UpdateShipmentRequest && \
php artisan make:request StoreCustomerRequest && \
php artisan make:request UpdateCustomerRequest && \
php artisan make:request StoreAgentRequest && \
php artisan make:request UpdateAgentRequest && \

# Middleware
php artisan make:middleware CheckRole && \
php artisan make:middleware CheckAgentCity && \

# Resources
php artisan make:resource ShipmentResource && \
php artisan make:resource CustomerResource && \
php artisan make:resource AgentResource && \

# Seeders
php artisan make:seeder UserSeeder && \
php artisan make:seeder CustomerSeeder && \
php artisan make:seeder AgentSeeder && \
php artisan make:seeder ShipmentSeeder && \

# Migrations
php artisan migrate && \

# Clear Cache
php artisan cache:clear && \
php artisan config:clear
```

---

## ⚙️ File Generation Summary

| Category | Count | Files |
|----------|-------|-------|
| Migrations | 7 | ✓ 7 files |
| Models | 6 | ✓ 6 files |
| Controllers | 7 | ✓ 7 files (with 3 resource methods) |
| Form Requests | 6 | ✓ 6 files |
| Middleware | 2 | ✓ 2 files |
| Resources | 3 | ✓ 3 files |
| Seeders | 4 | ✓ 4 files |
| **TOTAL** | **35** | **35 files + 7 DB tables** |

---

**Note**: After running all commands, you'll have the complete skeleton. The next step is to fill in the logic in each file according to the IMPLEMENTATION_PLAN.md

Generated: May 4, 2026
