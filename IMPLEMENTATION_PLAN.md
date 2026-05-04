# Courier Management System - Comprehensive Implementation Plan

**Project**: Courier Management System (Web Application)  
**Framework**: Laravel (PHP)  
**Database**: MySQL  
**Created**: May 4, 2026

---

## 📋 Table of Contents
1. [Project Overview](#project-overview)
2. [Architecture Design](#architecture-design)
3. [Database Schema](#database-schema)
4. [Models & Relationships](#models--relationships)
5. [Controllers & Business Logic](#controllers--business-logic)
6. [Routes & API Endpoints](#routes--api-endpoints)
7. [Middleware & Authentication](#middleware--authentication)
8. [Implementation Steps](#implementation-steps)
9. [Testing Strategy](#testing-strategy)
10. [Deployment Checklist](#deployment-checklist)

---

## Project Overview

### Objectives
- Manage courier bookings and tracking
- Handle admin, agent, and customer roles
- Generate reports (date-wise, city-wise)
- Send SMS notifications
- Track shipments in real-time

### Key Features
| Feature | Admin | Agent | Customer |
|---------|-------|-------|----------|
| Login | ✓ | ✓ | ✓ |
| Create Courier | ✓ | ✓ | ✗ |
| View Couriers | ✓ (all) | ✓ (branch) | ✓ (own) |
| Track Shipment | ✓ | ✓ | ✓ |
| Send SMS | ✓ | ✓ | ✗ |
| Manage Agents | ✓ | ✗ | ✗ |
| Manage Customers | ✓ | ✗ | ✗ |
| Download Reports | ✓ | ✓ | ✗ |

---

## Architecture Design

```
Courier Management System
│
├── Models (Database Layer)
│   ├── User
│   ├── Customer
│   ├── Shipment
│   ├── ShipmentTracking
│   ├── Agent
│   └── SMSLog
│
├── Controllers (Business Logic)
│   ├── AuthController
│   ├── AdminController
│   ├── AgentController
│   ├── CourierController
│   ├── TrackingController
│   └── ReportController
│
├── Migrations (Database Schema)
│   ├── users
│   ├── customers
│   ├── shipments
│   ├── shipment_tracking
│   ├── agents
│   └── sms_logs
│
├── Routes
│   ├── web.php (Customer/User routes)
│   ├── admin.php (Admin routes)
│   └── agent.php (Agent routes)
│
├── Middleware
│   ├── Authenticate
│   └── RoleMiddleware
│
├── Requests (Validation)
│   ├── StoreShipmentRequest
│   └── UpdateShipmentRequest
│
└── Resources (Response Formatting)
    └── ShipmentResource
```

---

## Database Schema

### 1. Users Table (Extended from Laravel default)
```
users
- id (PK)
- name (string)
- email (string, unique)
- email_verified_at (timestamp)
- password (hashed)
- phone (string)
- role (enum: admin, agent, customer)
- city (string, nullable)
- status (enum: active, inactive)
- remember_token
- created_at
- updated_at
```

### 2. Customers Table
```
customers
- id (PK)
- user_id (FK to users)
- company_name (string, nullable)
- address (string)
- phone (string)
- email (string)
- city (string)
- gst_number (string, nullable)
- created_at
- updated_at
```

### 3. Agents Table
```
agents
- id (PK)
- user_id (FK to users)
- branch_city (string)
- agent_code (string, unique)
- status (enum: active, inactive)
- created_at
- updated_at
```

### 4. Shipments Table
```
shipments
- id (PK)
- tracking_number (string, unique)
- sender_id (FK to customers)
- receiver_id (FK to customers)
- from_city (string)
- to_city (string)
- courier_type (enum: standard, express, overnight)
- weight (decimal)
- price (decimal)
- status (enum: pending, in_transit, delivered, cancelled)
- booking_date (date)
- expected_delivery_date (date)
- actual_delivery_date (date, nullable)
- created_by (FK to users) - Admin/Agent who created
- created_at
- updated_at
```

### 5. Shipment Tracking Table
```
shipment_tracking
- id (PK)
- shipment_id (FK to shipments)
- status (string)
- location (string)
- notes (text)
- updated_by (FK to users)
- created_at
- updated_at
```

### 6. SMS Logs Table
```
sms_logs
- id (PK)
- shipment_id (FK to shipments)
- recipient_phone (string)
- message (text)
- sms_type (enum: from_to, delivery)
- sent_at (timestamp)
- created_at
```

### 7. Reports Table
```
reports
- id (PK)
- generated_by (FK to users)
- report_type (enum: shipment, city_wise, date_wise)
- filters (json)
- file_path (string)
- download_count (integer)
- created_at
- updated_at
```

---

## Models & Relationships

### User Model
```
relationships:
- hasMany shipments (created couriers)
- hasOne customer
- hasOne agent
- hasMany smsLogs (sent by this user)
- hasMany shipmentTracking (updated by this user)
```

### Customer Model
```
relationships:
- belongsTo user
- hasMany shipments (as sender/receiver)
```

### Agent Model
```
relationships:
- belongsTo user
- scope: branch_city filtering
```

### Shipment Model
```
relationships:
- belongsTo sender (Customer)
- belongsTo receiver (Customer)
- belongsTo creator (User - admin/agent)
- hasMany tracking
- hasMany smsLogs
```

### ShipmentTracking Model
```
relationships:
- belongsTo shipment
- belongsTo updatedBy (User)
```

### SMSLog Model
```
relationships:
- belongsTo shipment
- belongsTo user (sent by)
```

---

## Controllers & Business Logic

### 1. AuthController
**Methods:**
- `showRegister()` - Display registration form
- `register(Request $request)` - Store new customer
- `showLogin()` - Display login form
- `login(Request $request)` - Authenticate user
- `logout()` - Logout user
- `profile()` - Show user profile
- `updateProfile(Request $request)` - Update profile

### 2. AdminController
**Methods:**
- `dashboard()` - Admin dashboard with status counts
- `getStatistics()` - Total shipments, delivered, in-transit
- `agentList()` - List all agents
- `createAgent()` - Show create agent form
- `storeAgent(Request $request)` - Store new agent
- `editAgent($id)` - Show edit agent form
- `updateAgent($id, Request $request)` - Update agent
- `deleteAgent($id)` - Delete agent
- `customerList()` - List all customers
- `searchCustomer(Request $request)` - Search customers
- `manageCustomer($id)` - Manage customer details

### 3. CourierController
**Methods:**
- `index()` - List all/filtered couriers
- `create()` - Show create courier form
- `store(StoreShipmentRequest $request)` - Store new shipment
- `show($id)` - Show shipment details
- `edit($id)` - Show edit form
- `update($id, UpdateShipmentRequest $request)` - Update shipment
- `delete($id)` - Delete shipment
- `updateStatus($id, Request $request)` - Update shipment status

### 4. AgentController
**Methods:**
- `dashboard()` - Agent dashboard (branch-specific)
- `getStatistics()` - Status counts for agent's branch
- `couriers()` - List couriers for agent's branch
- `shipmentsByStatus()` - Filter by status

### 5. TrackingController
**Methods:**
- `searchForm()` - Show tracking search form
- `search(Request $request)` - Search by tracking number
- `viewStatus($trackingNumber)` - Display tracking status
- `print($trackingNumber)` - Print tracking details
- `getTracking($id)` - API endpoint for tracking info

### 6. ReportController
**Methods:**
- `generate(Request $request)` - Generate report
- `dateWiseReport(Request $request)` - Date-wise report
- `cityWiseReport(Request $request)` - City-wise report
- `downloadReport($id)` - Download report as XLSX
- `viewReport($id)` - View report details

### 7. SMSController
**Methods:**
- `sendFromToSMS($shipmentId)` - Send from-to SMS
- `sendDeliverySMS($shipmentId)` - Send delivery SMS
- `getSMSLogs($shipmentId)` - View SMS logs

---

## Routes & API Endpoints

### Guest Routes
```
GET  / - Welcome page
POST /register - Register customer
POST /login - Login user
```

### Customer Routes (Authenticated)
```
GET  /dashboard - Customer dashboard
POST /logout - Logout
GET  /track - Track shipment form
POST /track - Search shipment
GET  /track/{trackingNumber} - View tracking details
GET  /track/{trackingNumber}/print - Print tracking
GET  /profile - View profile
POST /profile/update - Update profile
```

### Admin Routes (Authenticated + Role)
```
GET  /admin/dashboard - Admin dashboard
GET  /admin/statistics - Dashboard statistics

// Agent Management
GET  /admin/agents - List agents
GET  /admin/agents/create - Create agent form
POST /admin/agents - Store agent
GET  /admin/agents/{id}/edit - Edit agent form
PUT  /admin/agents/{id} - Update agent
DELETE /admin/agents/{id} - Delete agent

// Customer Management
GET  /admin/customers - List customers
POST /admin/customers/search - Search customers
GET  /admin/customers/{id} - View customer details
PUT  /admin/customers/{id} - Update customer

// Courier Management
GET  /admin/couriers - List all couriers
GET  /admin/couriers/create - Create courier form
POST /admin/couriers - Store courier
GET  /admin/couriers/{id} - View courier details
GET  /admin/couriers/{id}/edit - Edit courier form
PUT  /admin/couriers/{id} - Update courier
DELETE /admin/couriers/{id} - Delete courier
POST /admin/couriers/{id}/status - Update status

// SMS Management
POST /admin/couriers/{id}/send-sms/from-to - Send from-to SMS
POST /admin/couriers/{id}/send-sms/delivery - Send delivery SMS

// Reports
GET  /admin/reports - Reports page
POST /admin/reports/generate - Generate report
GET  /admin/reports/download/{id} - Download report
```

### Agent Routes (Authenticated + Role)
```
GET  /agent/dashboard - Agent dashboard
GET  /agent/statistics - Branch statistics

// Courier Management (Branch-specific)
GET  /agent/couriers - List branch couriers
GET  /agent/couriers/create - Create courier form
POST /agent/couriers - Store courier
GET  /agent/couriers/{id}/edit - Edit courier form
PUT  /agent/couriers/{id} - Update courier
POST /agent/couriers/{id}/send-sms/from-to - Send SMS
POST /agent/couriers/{id}/send-sms/delivery - Send SMS

// Reports
GET  /agent/reports - Branch reports
POST /agent/reports/generate - Generate report
GET  /agent/reports/download/{id} - Download report
```

---

## Middleware & Authentication

### Middleware Stack

1. **Authenticate** (Laravel built-in)
   - Redirect unauthenticated users to login

2. **CheckRole** (Custom)
   ```php
   // Parameters: role1, role2, ...
   Route::middleware('role:admin')->group(...);
   Route::middleware('role:agent,admin')->group(...);
   ```

3. **VerifyEmail** (Optional)
   - Verify email before accessing certain features

4. **CheckAgentCity** (Custom)
   - Agents can only view/modify their branch city data

---

## Implementation Steps

### Phase 1: Setup & Database (Days 1-2)
- [ ] Create database configuration
- [ ] Create migrations for all tables
- [ ] Create model files with relationships
- [ ] Run migrations

### Phase 2: Authentication (Days 3-4)
- [ ] Create User model extended functionality
- [ ] Setup role-based authentication
- [ ] Create registration & login controllers
- [ ] Create login/register views
- [ ] Create middleware for role checking

### Phase 3: Core Functionality (Days 5-8)
- [ ] Implement CourierController (CRUD)
- [ ] Create shipment views
- [ ] Implement TrackingController
- [ ] Create tracking views
- [ ] Create ShipmentTracking updates

### Phase 4: Admin Features (Days 9-11)
- [ ] Implement AdminController
- [ ] Agent management
- [ ] Customer management
- [ ] Dashboard & statistics
- [ ] Create admin views

### Phase 5: Agent Features (Days 12-13)
- [ ] Implement AgentController
- [ ] Branch-specific filtering
- [ ] Create agent views
- [ ] Agent reports

### Phase 6: Additional Features (Days 14-15)
- [ ] SMS integration
- [ ] Report generation (XLSX)
- [ ] Email notifications
- [ ] Validation rules
- [ ] Error handling

### Phase 7: Testing & Refinement (Days 16-17)
- [ ] Unit tests
- [ ] Feature tests
- [ ] Manual testing
- [ ] Bug fixes

### Phase 8: Documentation & Deployment (Days 18)
- [ ] Code documentation
- [ ] API documentation
- [ ] User manual
- [ ] Deployment

---

## Testing Strategy

### Unit Tests
- Model relationships
- Validation rules
- Helper functions
- Service classes

### Feature Tests
- Authentication flow
- Authorization (role-based)
- CRUD operations
- Report generation

### Integration Tests
- Database operations
- API endpoints
- SMS sending
- Email notifications

---

## Deployment Checklist

- [ ] Environment variables configured (.env)
- [ ] Database seeded with initial data
- [ ] Migrations executed
- [ ] Cache cleared
- [ ] Storage links created
- [ ] File permissions set correctly
- [ ] Error logging configured
- [ ] Session storage configured
- [ ] Queue workers (if async jobs needed)
- [ ] Backup strategy defined

---

## File Structure After Implementation

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── AuthController.php
│   │   ├── AdminController.php
│   │   ├── CourierController.php
│   │   ├── AgentController.php
│   │   ├── TrackingController.php
│   │   ├── ReportController.php
│   │   └── SMSController.php
│   ├── Requests/
│   │   ├── StoreShipmentRequest.php
│   │   ├── UpdateShipmentRequest.php
│   │   └── StoreCustomerRequest.php
│   └── Middleware/
│       ├── CheckRole.php
│       └── CheckAgentCity.php
├── Models/
│   ├── User.php
│   ├── Customer.php
│   ├── Shipment.php
│   ├── ShipmentTracking.php
│   ├── Agent.php
│   └── SMSLog.php
├── Services/
│   ├── ShipmentService.php
│   ├── SMSService.php
│   └── ReportService.php
└── Providers/
    └── AppServiceProvider.php

database/
├── migrations/
│   ├── [timestamp]_alter_users_table.php
│   ├── [timestamp]_create_customers_table.php
│   ├── [timestamp]_create_agents_table.php
│   ├── [timestamp]_create_shipments_table.php
│   ├── [timestamp]_create_shipment_tracking_table.php
│   ├── [timestamp]_create_sms_logs_table.php
│   └── [timestamp]_create_reports_table.php
└── seeders/
    ├── UserSeeder.php
    ├── CustomerSeeder.php
    ├── AgentSeeder.php
    └── ShipmentSeeder.php

routes/
├── web.php (Customer routes)
├── admin.php (Admin routes)
├── agent.php (Agent routes)
└── api.php (API endpoints)

resources/
├── views/
│   ├── layouts/
│   │   ├── app.blade.php
│   │   ├── admin.blade.php
│   │   └── agent.blade.php
│   ├── auth/
│   │   ├── login.blade.php
│   │   └── register.blade.php
│   ├── customer/
│   │   ├── dashboard.blade.php
│   │   └── track.blade.php
│   ├── admin/
│   │   ├── dashboard.blade.php
│   │   ├── agents/
│   │   ├── customers/
│   │   └── couriers/
│   └── agent/
│       ├── dashboard.blade.php
│       └── couriers/
└── css/
    └── app.css
```

---

## Success Criteria

✅ All models created with correct relationships  
✅ All migrations run without errors  
✅ Authentication working for all three roles  
✅ CRUD operations for shipments functional  
✅ Tracking system working  
✅ Reports generating correctly  
✅ SMS notifications sending  
✅ All validation rules in place  
✅ No PHP errors in logs  
✅ All tests passing  

---

**Last Updated**: May 4, 2026  
**Status**: Ready for Implementation  
**Next Step**: Start with Phase 1 - Database Setup
