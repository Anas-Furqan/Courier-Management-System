# Courier Management System - Detailed Task Breakdown

---

## 📌 Overview

This document provides detailed breakdown of what needs to be implemented in each file, with code structure examples.

---

## DATABASE MIGRATIONS

### 1. Alter Users Table
**File**: `database/migrations/[timestamp]_alter_users_table_add_fields.php`

**Changes to Add**:
```php
Schema::table('users', function (Blueprint $table) {
    $table->enum('role', ['admin', 'agent', 'customer'])->default('customer');
    $table->string('phone')->nullable();
    $table->string('city')->nullable();
    $table->enum('status', ['active', 'inactive'])->default('active');
});
```

### 2. Create Customers Table
**File**: `database/migrations/[timestamp]_create_customers_table.php`

**Columns**:
```php
$table->id();
$table->foreignId('user_id')->constrained('users')->onDelete('cascade');
$table->string('company_name')->nullable();
$table->string('address');
$table->string('phone');
$table->string('email');
$table->string('city');
$table->string('gst_number')->nullable();
$table->timestamps();
$table->unique(['user_id']);
```

### 3. Create Agents Table
**File**: `database/migrations/[timestamp]_create_agents_table.php`

**Columns**:
```php
$table->id();
$table->foreignId('user_id')->constrained('users')->onDelete('cascade');
$table->string('branch_city');
$table->string('agent_code')->unique();
$table->enum('status', ['active', 'inactive'])->default('active');
$table->timestamps();
$table->unique(['user_id']);
```

### 4. Create Shipments Table
**File**: `database/migrations/[timestamp]_create_shipments_table.php`

**Columns**:
```php
$table->id();
$table->string('tracking_number')->unique();
$table->foreignId('sender_id')->constrained('customers')->onDelete('cascade');
$table->foreignId('receiver_id')->constrained('customers')->onDelete('cascade');
$table->string('from_city');
$table->string('to_city');
$table->enum('courier_type', ['standard', 'express', 'overnight'])->default('standard');
$table->decimal('weight', 10, 2);
$table->decimal('price', 10, 2);
$table->enum('status', ['pending', 'in_transit', 'delivered', 'cancelled'])->default('pending');
$table->date('booking_date');
$table->date('expected_delivery_date');
$table->date('actual_delivery_date')->nullable();
$table->foreignId('created_by')->constrained('users')->onDelete('cascade');
$table->timestamps();
$table->index('tracking_number');
$table->index('status');
```

### 5. Create Shipment Tracking Table
**File**: `database/migrations/[timestamp]_create_shipment_tracking_table.php`

**Columns**:
```php
$table->id();
$table->foreignId('shipment_id')->constrained('shipments')->onDelete('cascade');
$table->string('status');
$table->string('location');
$table->text('notes')->nullable();
$table->foreignId('updated_by')->constrained('users')->onDelete('cascade');
$table->timestamps();
$table->index('shipment_id');
```

### 6. Create SMS Logs Table
**File**: `database/migrations/[timestamp]_create_sms_logs_table.php`

**Columns**:
```php
$table->id();
$table->foreignId('shipment_id')->constrained('shipments')->onDelete('cascade');
$table->string('recipient_phone');
$table->text('message');
$table->enum('sms_type', ['from_to', 'delivery']);
$table->timestamp('sent_at')->nullable();
$table->timestamps();
$table->index('shipment_id');
```

### 7. Create Reports Table
**File**: `database/migrations/[timestamp]_create_reports_table.php`

**Columns**:
```php
$table->id();
$table->foreignId('generated_by')->constrained('users')->onDelete('cascade');
$table->enum('report_type', ['shipment', 'city_wise', 'date_wise']);
$table->json('filters')->nullable();
$table->string('file_path');
$table->integer('download_count')->default(0);
$table->timestamps();
$table->index('generated_by');
```

---

## MODELS

### 1. User Model (Extended)
**File**: `app/Models/User.php`

**Key Methods to Add**:
```php
public function customer() {
    return $this->hasOne(Customer::class);
}

public function agent() {
    return $this->hasOne(Agent::class);
}

public function shipments() {
    return $this->hasMany(Shipment::class, 'created_by');
}

public function isAdmin() {
    return $this->role === 'admin';
}

public function isAgent() {
    return $this->role === 'agent';
}

public function isCustomer() {
    return $this->role === 'customer';
}
```

### 2. Customer Model
**File**: `app/Models/Customer.php`

**Content**:
```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model {
    protected $fillable = [
        'user_id', 'company_name', 'address', 'phone', 'email', 'city', 'gst_number'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function sentShipments() {
        return $this->hasMany(Shipment::class, 'sender_id');
    }

    public function receivedShipments() {
        return $this->hasMany(Shipment::class, 'receiver_id');
    }
}
```

### 3. Agent Model
**File**: `app/Models/Agent.php`

**Content**:
```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model {
    protected $fillable = [
        'user_id', 'branch_city', 'agent_code', 'status'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function shipments() {
        return Shipment::where('from_city', $this->branch_city)
                      ->orWhere('to_city', $this->branch_city);
    }
}
```

### 4. Shipment Model
**File**: `app/Models/Shipment.php`

**Content**:
```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model {
    protected $fillable = [
        'tracking_number', 'sender_id', 'receiver_id', 'from_city', 'to_city',
        'courier_type', 'weight', 'price', 'status', 'booking_date',
        'expected_delivery_date', 'actual_delivery_date', 'created_by'
    ];

    protected $casts = [
        'booking_date' => 'date',
        'expected_delivery_date' => 'date',
        'actual_delivery_date' => 'date'
    ];

    public function sender() {
        return $this->belongsTo(Customer::class, 'sender_id');
    }

    public function receiver() {
        return $this->belongsTo(Customer::class, 'receiver_id');
    }

    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function tracking() {
        return $this->hasMany(ShipmentTracking::class);
    }

    public function smsLogs() {
        return $this->hasMany(SMSLog::class);
    }

    public function getLatestStatus() {
        return $this->tracking()->latest()->first();
    }
}
```

### 5. ShipmentTracking Model
**File**: `app/Models/ShipmentTracking.php`

**Content**:
```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShipmentTracking extends Model {
    protected $table = 'shipment_tracking';
    protected $fillable = [
        'shipment_id', 'status', 'location', 'notes', 'updated_by'
    ];

    public function shipment() {
        return $this->belongsTo(Shipment::class);
    }

    public function updatedBy() {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
```

### 6. SMSLog Model
**File**: `app/Models/SMSLog.php`

**Content**:
```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SMSLog extends Model {
    protected $table = 'sms_logs';
    protected $fillable = [
        'shipment_id', 'recipient_phone', 'message', 'sms_type', 'sent_at'
    ];

    protected $casts = [
        'sent_at' => 'datetime'
    ];

    public function shipment() {
        return $this->belongsTo(Shipment::class);
    }
}
```

### 7. Report Model
**File**: `app/Models/Report.php`

**Content**:
```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model {
    protected $fillable = [
        'generated_by', 'report_type', 'filters', 'file_path', 'download_count'
    ];

    protected $casts = [
        'filters' => 'json'
    ];

    public function generator() {
        return $this->belongsTo(User::class, 'generated_by');
    }
}
```

---

## CONTROLLERS

### 1. AuthController
**File**: `app/Http/Controllers/AuthController.php`

**Methods Required**:
```php
public function showLogin() {
    // Show login form
}

public function login(Request $request) {
    // Authenticate user
    // Check role and redirect to appropriate dashboard
}

public function showRegister() {
    // Show registration form
}

public function register(Request $request) {
    // Validate input
    // Create User with role='customer'
    // Create associated Customer record
    // Auto-login and redirect to dashboard
}

public function logout(Request $request) {
    // Logout user
    // Clear session
}

public function profile() {
    // Show user profile
}

public function updateProfile(Request $request) {
    // Update user/customer details
}
```

### 2. AdminController (Resource Controller)
**File**: `app/Http/Controllers/AdminController.php`

**Methods Required**:
```php
public function dashboard() {
    // Show admin dashboard
    // Get total shipments, delivered, in-transit counts
}

public function index() {
    // List agents (for CRUD)
}

public function create() {
    // Show create agent form
}

public function store(StoreAgentRequest $request) {
    // Create new agent user and agent record
}

public function edit($id) {
    // Show edit agent form
}

public function update($id, UpdateAgentRequest $request) {
    // Update agent details
}

public function destroy($id) {
    // Delete agent
}

// Additional methods
public function customers() {
    // List all customers
}

public function searchCustomer(Request $request) {
    // Search customer by name/email/phone
}

public function statistics() {
    // Return dashboard statistics JSON
}
```

### 3. CourierController (Resource Controller)
**File**: `app/Http/Controllers/CourierController.php`

**Methods Required**:
```php
public function index() {
    // List shipments (filtered by user role/branch)
}

public function create() {
    // Show create shipment form
}

public function store(StoreShipmentRequest $request) {
    // Create new shipment
    // Generate tracking number
    // Create initial tracking record
}

public function show($id) {
    // Show shipment details with tracking history
}

public function edit($id) {
    // Show edit form (only if not delivered)
}

public function update($id, UpdateShipmentRequest $request) {
    // Update shipment details
}

public function destroy($id) {
    // Delete/cancel shipment
}

// Additional methods
public function updateStatus($id, Request $request) {
    // Update shipment status and create tracking record
}
```

### 4. AgentController (Resource Controller)
**File**: `app/Http/Controllers/AgentController.php`

**Methods Required**:
```php
public function dashboard() {
    // Show agent dashboard
    // Only for agent's branch city
}

public function index() {
    // List couriers for agent's branch
}

public function create() {
    // Show create courier form
}

public function store(StoreShipmentRequest $request) {
    // Create courier for agent's branch
}

public function edit($id) {
    // Edit courier (agent's branch only)
}

public function update($id, UpdateShipmentRequest $request) {
    // Update courier (agent's branch only)
}

public function statistics() {
    // Get statistics for agent's branch
}
```

### 5. TrackingController
**File**: `app/Http/Controllers/TrackingController.php`

**Methods Required**:
```php
public function search(Request $request) {
    // Search shipment by tracking number
    // Return shipment details
}

public function view($trackingNumber) {
    // Display full tracking details with history
}

public function print($trackingNumber) {
    // Generate printable tracking slip
}

public function getTracking($id) {
    // API endpoint for tracking data (JSON)
}
```

### 6. ReportController (Resource Controller)
**File**: `app/Http/Controllers/ReportController.php`

**Methods Required**:
```php
public function index() {
    // List generated reports
}

public function create() {
    // Show report generation form
}

public function store(Request $request) {
    // Generate report based on filters
    // Save to file
}

public function download($id) {
    // Download report as XLSX
}

// Additional methods
public function dateWiseReport(Request $request) {
    // Generate date-wise report
}

public function cityWiseReport(Request $request) {
    // Generate city-wise report
}
```

### 7. SMSController
**File**: `app/Http/Controllers/SMSController.php`

**Methods Required**:
```php
public function sendFromToSMS($shipmentId) {
    // Send "from to" SMS notification
}

public function sendDeliverySMS($shipmentId) {
    // Send delivery confirmation SMS
}

public function logs($shipmentId) {
    // View SMS logs for shipment
}
```

---

## MIDDLEWARE

### 1. CheckRole Middleware
**File**: `app/Http/Middleware/CheckRole.php`

**Logic**:
```php
public function handle($request, Closure $next, ...$roles) {
    if (!in_array(auth()->user()->role, $roles)) {
        return redirect('/')->with('error', 'Unauthorized');
    }
    return $next($request);
}

// Usage in routes:
// Route::middleware('role:admin')->group(...);
// Route::middleware('role:agent,admin')->group(...);
```

### 2. CheckAgentCity Middleware
**File**: `app/Http/Middleware/CheckAgentCity.php`

**Logic**:
```php
public function handle($request, Closure $next) {
    if (auth()->user()->isAgent()) {
        $agent = auth()->user()->agent;
        // Verify resource belongs to agent's branch
    }
    return $next($request);
}
```

---

## FORM REQUESTS (Validation)

### 1. StoreShipmentRequest
**File**: `app/Http/Requests/StoreShipmentRequest.php`

**Rules**:
```php
public function rules() {
    return [
        'sender_id' => 'required|exists:customers,id',
        'receiver_id' => 'required|exists:customers,id',
        'from_city' => 'required|string',
        'to_city' => 'required|string',
        'courier_type' => 'required|in:standard,express,overnight',
        'weight' => 'required|numeric|min:0.1',
        'price' => 'required|numeric|min:0',
        'expected_delivery_date' => 'required|date|after:today',
    ];
}
```

### 2. UpdateShipmentRequest
**Similar to StoreShipmentRequest** but for updates

### 3. StoreCustomerRequest
**File**: `app/Http/Requests/StoreCustomerRequest.php`

**Rules**:
```php
public function rules() {
    return [
        'company_name' => 'nullable|string',
        'address' => 'required|string',
        'phone' => 'required|string',
        'email' => 'required|email',
        'city' => 'required|string',
        'gst_number' => 'nullable|string',
    ];
}
```

### 4. StoreAgentRequest
**File**: `app/Http/Requests/StoreAgentRequest.php`

**Rules**:
```php
public function rules() {
    return [
        'name' => 'required|string',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8',
        'phone' => 'required|string',
        'branch_city' => 'required|string',
        'agent_code' => 'required|unique:agents',
    ];
}
```

---

## ROUTES

### 1. Web Routes (Customer)
**File**: `routes/web.php`

```php
// Guest routes
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Tracking (public)
Route::get('/track', [TrackingController::class, 'search'])->name('track');
Route::get('/track/{trackingNumber}', [TrackingController::class, 'view'])->name('track.view');
Route::get('/track/{trackingNumber}/print', [TrackingController::class, 'print'])->name('track.print');

// Authenticated customer routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [AuthController::class, 'profile'])->name('dashboard');
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
    
    // Customer can track their shipments
    Route::get('/my-shipments', [TrackingController::class, 'myShipments'])->name('my-shipments');
});
```

### 2. Admin Routes
**File**: `routes/admin.php` (or in web.php with middleware)

```php
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/statistics', [AdminController::class, 'statistics'])->name('statistics');
    
    // Agent management
    Route::resource('agents', AdminController::class);
    
    // Customer management
    Route::get('/customers', [AdminController::class, 'customers'])->name('customers.index');
    Route::post('/customers/search', [AdminController::class, 'searchCustomer'])->name('customers.search');
    Route::get('/customers/{id}', [AdminController::class, 'showCustomer'])->name('customers.show');
    
    // Courier management
    Route::resource('couriers', CourierController::class);
    Route::post('/couriers/{id}/status', [CourierController::class, 'updateStatus'])->name('couriers.status');
    Route::post('/couriers/{id}/send-sms/from-to', [SMSController::class, 'sendFromToSMS'])->name('sms.from-to');
    Route::post('/couriers/{id}/send-sms/delivery', [SMSController::class, 'sendDeliverySMS'])->name('sms.delivery');
    
    // Reports
    Route::resource('reports', ReportController::class);
    Route::get('/reports/{id}/download', [ReportController::class, 'download'])->name('reports.download');
});
```

### 3. Agent Routes
**File**: `routes/agent.php` (or in web.php with middleware)

```php
Route::middleware(['auth', 'role:agent'])->prefix('agent')->name('agent.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AgentController::class, 'dashboard'])->name('dashboard');
    Route::get('/statistics', [AgentController::class, 'statistics'])->name('statistics');
    
    // Courier management (branch-specific)
    Route::resource('couriers', AgentController::class);
    Route::post('/couriers/{id}/send-sms/from-to', [SMSController::class, 'sendFromToSMS'])->name('sms.from-to');
    Route::post('/couriers/{id}/send-sms/delivery', [SMSController::class, 'sendDeliverySMS'])->name('sms.delivery');
    
    // Reports
    Route::resource('reports', ReportController::class);
    Route::get('/reports/{id}/download', [ReportController::class, 'download'])->name('reports.download');
});
```

---

## KEY IMPLEMENTATION NOTES

### Tracking Number Generation
```php
// In ShipmentService or CourierController
$trackingNumber = 'CMS' . date('YmdHis') . random_int(1000, 9999);
// Example: CMS202605041205301234
```

### Role-Based Dashboard Redirect
```php
// In LoginController or AuthController
if (auth()->user()->isAdmin()) {
    return redirect('/admin/dashboard');
} elseif (auth()->user()->isAgent()) {
    return redirect('/agent/dashboard');
} else {
    return redirect('/dashboard');
}
```

### Agent City Filtering
```php
// In AgentController
$agent = auth()->user()->agent;
$shipments = Shipment::where(function ($q) use ($agent) {
    $q->where('from_city', $agent->branch_city)
      ->orWhere('to_city', $agent->branch_city);
})->get();
```

### SMS Integration
```php
// In SMSService (To be implemented)
public function sendSMS($phone, $message) {
    // Use third-party SMS API (Twilio, AWS SNS, etc.)
    // Log in sms_logs table
}
```

### Report Generation
```php
// In ReportService (To be implemented)
public function generateExcel($filters) {
    // Use Laravel Excel or similar library
    // Filter shipments based on date, city, etc.
    // Generate XLSX file
}
```

---

**Created**: May 4, 2026  
**Status**: Implementation Guide  
**Next Action**: Start implementing migrations and models
