# Courier Management System - Quick Reference & Architecture

---

## 📊 System Architecture Overview

```
┌─────────────────────────────────────────────────────────────────────┐
│                        COURIER MANAGEMENT SYSTEM                    │
│                            (Laravel Web App)                        │
└─────────────────────────────────────────────────────────────────────┘

┌──────────────────────────────────────────────────────────────────────┐
│                        PRESENTATION LAYER                            │
│  ┌─────────────────┬──────────────────┬──────────────────────────┐  │
│  │  Customer UI    │    Admin UI       │      Agent UI            │  │
│  │  - Dashboard    │  - Dashboard      │  - Dashboard             │  │
│  │  - Tracking     │  - Manage Agents  │  - Manage Couriers       │  │
│  │  - Profile      │  - Manage Custmrs │  - Branch Reports        │  │
│  │  - Reports      │  - All Couriers   │                          │  │
│  └─────────────────┴──────────────────┴──────────────────────────┘  │
└──────────────────────────────────────────────────────────────────────┘
                                   │
                        ┌──────────▼──────────┐
                        │ Authentication &    │
                        │ Authorization       │
                        │ Middleware          │
                        └──────────┬──────────┘
                                   │
┌──────────────────────────────────────────────────────────────────────┐
│                     ROUTING LAYER (Routes)                           │
│  ┌─────────────────┬──────────────────┬──────────────────────────┐  │
│  │  web.php        │  admin.php       │  agent.php               │  │
│  │  Customer Routes│ Admin Routes     │  Agent Routes            │  │
│  └─────────────────┴──────────────────┴──────────────────────────┘  │
└──────────────────────────────────────────────────────────────────────┘
                                   │
┌──────────────────────────────────────────────────────────────────────┐
│                    BUSINESS LOGIC LAYER (Controllers)                │
│  ┌──────────────┬──────────────┬───────────────┬─────────────────┐  │
│  │ AuthController   AdminController   CourierController  SMSController   │
│  │ TrackingController    ReportController    AgentController   │  │
│  └──────────────┴──────────────┴───────────────┴─────────────────┘  │
│                                                                      │
│  Form Requests & Validation:                                        │
│  ┌─────────────────┬──────────────────┬───────────────────────────┐ │
│  │ StoreShipmentReq │ UpdateShipmentReq │ StoreCustomerRequest    │ │
│  │ StoreAgentReq   │ UpdateAgentReq    │ UpdateCustomerRequest   │ │
│  └─────────────────┴──────────────────┴───────────────────────────┘ │
│                                                                      │
│  Service Layer:                                                      │
│  ┌──────────────────┬──────────────────┬──────────────────────────┐ │
│  │ ShipmentService  │ SMSService       │ ReportService            │ │
│  └──────────────────┴──────────────────┴──────────────────────────┘ │
└──────────────────────────────────────────────────────────────────────┘
                                   │
┌──────────────────────────────────────────────────────────────────────┐
│                    DATA MODEL LAYER (Models)                         │
│  ┌──────┬──────────┬────────┬─────────────────┬────────┬─────────┐  │
│  │ User │ Customer │ Agent  │ Shipment        │ SMSLog │ Report  │  │
│  └──────┴──────────┴────────┴─────────────────┴────────┴─────────┘  │
│                                                                      │
│  Relationships:                                                      │
│  - User hasMany Shipments                                           │
│  - User hasOne Customer, Agent                                      │
│  - Shipment belongsTo Sender, Receiver (Customer)                   │
│  - Shipment hasMany Tracking, SMSLogs                               │
│  - Agent belongsTo User, filtered by branch_city                    │
└──────────────────────────────────────────────────────────────────────┘
                                   │
┌──────────────────────────────────────────────────────────────────────┐
│                    DATABASE LAYER (Migrations)                       │
│  ┌────────┬───────────┬────────┬──────────┬──────────────────────┐   │
│  │ users  │ customers │ agents │ shipments│ shipment_tracking    │   │
│  │        │           │        │          │ sms_logs             │   │
│  │        │           │        │          │ reports              │   │
│  └────────┴───────────┴────────┴──────────┴──────────────────────┘   │
│                                                                      │
│              MySQL Database with 7 Tables                            │
└──────────────────────────────────────────────────────────────────────┘
```

---

## 🔄 User Roles & Permissions Matrix

| Action | Admin | Agent | Customer |
|--------|-------|-------|----------|
| **Authentication** | | | |
| Login | ✓ | ✓ | ✓ |
| Register | - | - | ✓ |
| Logout | ✓ | ✓ | ✓ |
| **Dashboard** | | | |
| View Dashboard | ✓ | ✓ | ✓ |
| View Statistics | ✓ (all) | ✓ (branch) | - |
| **Shipments** | | | |
| Create Shipment | ✓ | ✓ | - |
| View All Shipments | ✓ | ✓ (branch) | ✓ (own) |
| Edit Shipment | ✓ | ✓ (branch) | - |
| Delete Shipment | ✓ | ✓ (branch) | - |
| Update Status | ✓ | ✓ (branch) | - |
| **Tracking** | | | |
| Track Shipment | ✓ | ✓ | ✓ |
| Print Tracking | ✓ | ✓ | ✓ |
| **SMS** | | | |
| Send SMS | ✓ | ✓ | - |
| View SMS Logs | ✓ | ✓ | - |
| **Reports** | | | |
| Generate Reports | ✓ | ✓ (branch) | - |
| Download XLSX | ✓ | ✓ (branch) | - |
| **Admin Features** | | | |
| Manage Agents | ✓ | - | - |
| Manage Customers | ✓ | - | - |
| View All Users | ✓ | - | - |

---

## 📁 Key Files Summary

### Models (6 files)
```
✓ User.php (extended)
✓ Customer.php (new)
✓ Agent.php (new)
✓ Shipment.php (new)
✓ ShipmentTracking.php (new)
✓ SMSLog.php (new)
✓ Report.php (new)
```

### Controllers (7 files)
```
✓ AuthController.php
✓ AdminController.php
✓ CourierController.php
✓ AgentController.php
✓ TrackingController.php
✓ ReportController.php
✓ SMSController.php
```

### Migrations (7 files)
```
✓ alter_users_table_add_fields
✓ create_customers_table
✓ create_agents_table
✓ create_shipments_table
✓ create_shipment_tracking_table
✓ create_sms_logs_table
✓ create_reports_table
```

### Routes (3 files)
```
✓ web.php (Customer routes)
✓ admin.php (Admin routes)
✓ agent.php (Agent routes)
```

### Form Requests (6 files)
```
✓ StoreShipmentRequest.php
✓ UpdateShipmentRequest.php
✓ StoreCustomerRequest.php
✓ UpdateCustomerRequest.php
✓ StoreAgentRequest.php
✓ UpdateAgentRequest.php
```

### Middleware (2 files)
```
✓ CheckRole.php
✓ CheckAgentCity.php
```

### Services (3 files - create manually)
```
✓ ShipmentService.php
✓ SMSService.php
✓ ReportService.php
```

---

## 🔐 Authentication Flow

```
┌────────────┐
│   User     │
│  Visits    │
│  Website   │
└────┬───────┘
     │
     ▼
┌──────────────────┐
│  Login/Register  │
│  Page            │
└────┬─────────────┘
     │
     ▼
┌──────────────────────────┐      ┌──────────────┐
│ Authenticate using       │─────▶│ Store in     │
│ email + password         │      │ Session      │
│ (AuthController)         │      └──────────────┘
└────┬─────────────────────┘
     │
     ▼
┌──────────────────────────┐
│ Check Role & Redirect    │
│ - Admin  → /admin        │
│ - Agent  → /agent        │
│ - User   → /dashboard    │
└────┬─────────────────────┘
     │
     ▼
┌──────────────────────────┐
│ Apply Middleware         │
│ - Authenticate           │
│ - CheckRole              │
│ - CheckAgentCity         │
└────┬─────────────────────┘
     │
     ▼
┌──────────────────────────┐
│ Access Granted           │
│ User can access role     │
│ specific features        │
└──────────────────────────┘
```

---

## 📊 Data Flow for Shipment Creation

```
┌─────────────┐
│ User/Agent  │
│ Submits     │
│ Form        │
└────┬────────┘
     │
     ▼
┌──────────────────────────────┐
│ POST /couriers               │
│ CourierController@store()    │
└────┬─────────────────────────┘
     │
     ▼
┌──────────────────────────────────┐
│ Form Validation                  │
│ StoreShipmentRequest@validate()  │
└────┬─────────────────────────────┘
     │
     ▼
┌──────────────────────────────┐
│ Check Sender/Receiver Exist  │
│ (Customer Models)            │
└────┬─────────────────────────┘
     │
     ▼
┌──────────────────────────────┐
│ Generate Tracking Number     │
│ ShipmentService@generate()   │
└────┬─────────────────────────┘
     │
     ▼
┌──────────────────────────────┐
│ Create Shipment Record       │
│ Shipment::create()           │
└────┬─────────────────────────┘
     │
     ▼
┌──────────────────────────────┐
│ Create Initial Tracking      │
│ ShipmentTracking::create()   │
└────┬─────────────────────────┘
     │
     ▼
┌──────────────────────────────┐
│ Send SMS Notification        │
│ SMSService@send()            │
└────┬─────────────────────────┘
     │
     ▼
┌──────────────────────────────┐
│ Redirect with Success        │
│ Message                      │
└──────────────────────────────┘
```

---

## 🎯 Tracking Workflow

```
User visits tracking page
        │
        ▼
┌─────────────────────────────┐
│ Enter Tracking Number       │
│ (GET /track)                │
└────┬────────────────────────┘
     │
     ▼
┌─────────────────────────────┐
│ Search in Database          │
│ Shipment::where()           │
│ (TrackingController@search) │
└────┬────────────────────────┘
     │
     ▼
   Found?
   / \
  /   \
NO    YES
│      │
▼      ▼
Error  ┌──────────────────────┐
       │ Load Shipment Data   │
       │ with Relationships   │
       └────┬─────────────────┘
            │
            ▼
       ┌──────────────────────┐
       │ Load Tracking        │
       │ History              │
       │ ShipmentTracking::   │
       │ where(shipment_id)   │
       └────┬─────────────────┘
            │
            ▼
       ┌──────────────────────┐
       │ Display Tracking     │
       │ Page with Status     │
       │ History              │
       └──────────────────────┘
```

---

## 📋 Implementation Checklist

### Phase 1: Database Setup
- [ ] Create all migrations
- [ ] Define all table columns correctly
- [ ] Set up relationships (foreign keys)
- [ ] Run migrations: `php artisan migrate`

### Phase 2: Models
- [ ] Create all models
- [ ] Define relationships (hasMany, belongsTo, etc.)
- [ ] Add accessors/mutators if needed
- [ ] Add model scopes for filtering

### Phase 3: Controllers & Routes
- [ ] Create all controllers
- [ ] Define all route groups
- [ ] Implement CRUD methods in controllers
- [ ] Test routes: `php artisan route:list`

### Phase 4: Authentication
- [ ] Create login/register forms
- [ ] Implement role-based middleware
- [ ] Test authentication flow
- [ ] Test role-based access

### Phase 5: Features
- [ ] Shipment management (CRUD)
- [ ] Tracking system
- [ ] SMS notifications
- [ ] Report generation
- [ ] Dashboard statistics

### Phase 6: Views & UI
- [ ] Create blade templates
- [ ] Add Bootstrap/Tailwind styling
- [ ] Create responsive layout
- [ ] Add form validations

### Phase 7: Testing
- [ ] Unit tests for models
- [ ] Feature tests for controllers
- [ ] Integration tests
- [ ] Manual testing of all features

### Phase 8: Deployment
- [ ] Configure .env file
- [ ] Run migrations on production
- [ ] Set up file permissions
- [ ] Configure email/SMS services
- [ ] Monitor error logs

---

## 🚀 Quick Start Commands

```bash
# 1. Setup database schema
php artisan migrate

# 2. Create all models and controllers
php artisan make:model Customer
php artisan make:controller CourierController --resource
# ... (run all commands from COMMANDS_REFERENCE.md)

# 3. Create seeders (optional - for test data)
php artisan make:seeder UserSeeder
php artisan db:seed

# 4. Clear cache
php artisan cache:clear

# 5. Start development server
php artisan serve
```

---

## 📞 Contact & Support

For any issues or doubts:
1. Check the IMPLEMENTATION_PLAN.md for detailed information
2. Review COMMANDS_REFERENCE.md for command syntax
3. Refer to specifications.txt for feature requirements
4. Check problemstatement.txt for project objectives

---

**Generated**: May 4, 2026  
**Project Status**: Ready for Implementation  
**Next Step**: Execute commands from COMMANDS_REFERENCE.md
