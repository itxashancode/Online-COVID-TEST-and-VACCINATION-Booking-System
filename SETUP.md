# COVID Booking System - Complete Setup Guide (SQL Only)

## ✅ Prerequisites

1. **WAMP Server** is running (icon should be green in system tray)
2. **PHP 8.1** (located at `C:\wamp64\bin\php\php8.1.33\`)
3. **MySQL** is running through WAMP
4. **Composer packages** already installed

---

## 🚀 Quick Setup (5 Minutes)

### **Step 1: Create Database**

1. Open browser → go to: **http://localhost/phpmyadmin/**
2. Click **"Databases"** tab
3. Database name: `covid_booking`
4. Click **"Create"**

### **Step 2: Run SQL Commands**

1. Click on `covid_booking` database in left sidebar
2. Click **"SQL"** tab at the top
3. Open the file `SQL.md` from the project folder
4. **Copy ALL** the SQL code (Ctrl+A, Ctrl+C)
5. **Paste** into phpMyAdmin SQL query box
6. Click **"Go"** or **"Execute"**
7. Wait for all queries to complete (should see multiple "Success" messages)

### **Step 3: Start Laravel Server**

Open **PowerShell** in the project folder:

```powershell
cd "C:\Users\Ashan PC\Desktop\Github\Online-COVID-TEST-and-VACCINATION-Booking-System"

# Set PHP path for this session
$env:Path = "C:\wamp64\bin\php\php8.1.33;" + $env:Path

# Start the development server
php artisan serve
```

You should see:
```
Laravel development server started: http://127.0.0.1:8000
```

### **Step 4: Access the Application**

Open browser: **http://127.0.0.1:8000**

---

## 🔐 Login Credentials

### **Admin Account** (Pre-created)

| Field | Value |
|-------|-------|
| Email | `admin@covid.com` |
| Password | `password` |

**Admin Dashboard**: `/admin/dashboard`

---

### **Register New Accounts**

You can now register **Patient** and **Hospital** accounts:

1. Go to **http://127.0.0.1:8000/login**
2. Click **"Register here"** link
3. **Select Role**:
   - **Patient**: Can book appointments, view results
   - **Hospital**: Provides services, needs admin approval

#### Register as Hospital:

1. Select **"Hospital (Provide services)"** from dropdown
2. Fill in additional fields:
   - Hospital Name
   - Phone Number
   - City
   - Address
3. Submit registration
4. **Important**: Hospital needs **Admin approval** before they can log in

**To Approve Hospital**:
1. Login as **Admin** (`admin@covid.com`)
2. Go to **Hospitals** in sidebar
3. Find the pending hospital
4. Click **"Approve"** button
5. Hospital can now login

---

## 📝 Test Workflow Example

### **Complete Flow:**

1. **Admin** logs in → Approves hospital registration
2. **Hospital** logs in → Dashboard appears
3. **Patient** registers → Searches hospitals → Books appointment
4. **Hospital** receives appointment → Approves it
5. **Hospital** updates result/vaccination
6. **Patient** views results
7. **Admin** exports reports to Excel

---

## 🌐 Important URLs

| Page | URL |
|------|-----|
| Login | `/login` |
| Register | `/register` |
| Admin Dashboard | `/admin/dashboard` |
| Hospital Dashboard | `/hospital/dashboard` |
| Patient Dashboard | `/patient/dashboard` |
| Search Hospitals | `/patient/search` |
| Book Appointment | `/patient/appointments/create` |
| My Appointments | `/patient/appointments` |
| My Results | `/patient/results` |
| My Profile | `/patient/profile` |

---

## ⚙️ Configuration Notes

### **Using SQL Only (No Migrations)**

- ✅ **DO NOT** run `php artisan migrate`
- ✅ **DO NOT** run `php artisan db:seed`
- ✅ All tables created via **SQL.md** file
- ✅ Database structure includes:
  - All 6 main tables
  - Spatie Permission tables (roles, permissions)
  - Default admin user

### **Custom Middleware**

We created custom middleware for role-based access:
- `AdminMiddleware` → Routes: `/admin/*`
- `HospitalMiddleware` → Routes: `/hospital/*`
- `PatientMiddleware` → Routes: `/patient/*`

These are registered in `app/Http/Kernel.php`

---

## 🐛 Troubleshooting

### **404 Not Found on "/"**

This is expected. Laravel has no homepage. Use:
- `/login` for login page
- After login, redirects to appropriate dashboard

### **Cannot Register Hospital (Fields Missing)**

Make sure you're using the updated register form which shows hospital fields when "Hospital" role is selected. The JavaScript handles this.

### **Hospital Can't Login After Approval**

Check in phpMyAdmin:
- Users table: `user_type` = 'hospital', `status` = 'active'
- Hospitals table: `status` = 'approved'
- `model_has_roles` table: role_id should be 2 (hospital role)

### **Error: "key was too long" during migrations**

Ignore this. We're using SQL only, not migrations. If you accidentally ran migrations, just use the SQL.md file to create tables correctly.

---

## 📊 Database Tables Reference

```
covid_booking
├── users (with phone, address, city, user_type, status)
├── hospitals
├── vaccines
├── appointments
├── test_results
├── vaccination_records
├── roles (Spatie)
├── permissions (Spatie)
├── model_has_roles (Spatie)
├── model_has_permissions (Spatie)
└── role_has_permissions (Spatie)
```

---

## ✅ Checklist Before Starting

- [ ] WAMP Server running (Apache + MySQL green)
- [ ] Database `covid_booking` created in phpMyAdmin
- [ ] All SQL from `SQL.md` executed successfully
- [ ] Laravel server started with PHP 8.1
- [ ] Can access http://127.0.0.1:8000/login
- [ ] Admin login works: `admin@covid.com` / `password`
- [ ] Register link visible on login page

---

## 🎯 Next Steps After Setup

1. **Test Admin features**:
   - View dashboard
   - Go to Hospitals → Approve a pending hospital
   - Add vaccines (Vaccines → Add New)
   - View bookings/reports

2. **Test Hospital features** (after approval):
   - Login with hospital account
   - View dashboard
   - See patient appointments
   - Approve/reject requests
   - Update test results or vaccination status

3. **Test Patient features**:
   - Register new patient account
   - Search for approved hospitals
   - Book appointment (COVID test or vaccination)
   - View appointments in "My Appointments"
   - Hospital updates → Patient sees results

---
