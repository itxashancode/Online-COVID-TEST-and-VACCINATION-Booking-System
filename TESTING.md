# COVID Booking System - Testing Accounts

## Database Setup Required

Before using these accounts, make sure you have:
1. ✅ Created the `covid_booking` database in phpMyAdmin
2. ✅ Ran all SQL commands from `SQL.md`
3. ✅ Started the Laravel server: `php artisan serve`
4. ✅ Accessing: http://127.0.0.1:8000

---

## Login Credentials for All 3 Roles

### 🔐 ADMIN ROLE
**URL**: http://127.0.0.1:8000/login

| Field | Value |
|-------|-------|
| Email | `admin@covid.com` |
| Password | `password` |

**Admin Can**:
- ✅ View all patients
- ✅ Approve/reject hospital registrations
- ✅ Manage vaccines (add/edit/delete)
- ✅ View all bookings
- ✅ Export reports to Excel
- ✅ View COVID test reports

**Admin Dashboard**: `/admin/dashboard`

---

### 🏥 HOSPITAL ROLE

**IMPORTANT**: Hospital accounts need admin approval first!

#### Step 1: Register a Hospital Account

1. Click **"Register"** on the login page
2. Fill in:
   - Name: `City General Hospital` (or any hospital name)
   - Email: `hospital@demo.com`
   - Password: `password`
   - Confirm Password: `password`
3. Click **"Register"**

#### Step 2: Admin Approves the Hospital

1. Login as **Admin** (`admin@covid.com` / `password`)
2. Go to: **Hospitals** in sidebar
3. Find the pending hospital
4. Click **"Approve"** button
5. Hospital can now login

#### Step 3: Hospital Login

After approval, hospital can login:

| Field | Value |
|-------|-------|
| Email | `hospital@demo.com` |
| Password | `password` |

**Hospital Can**:
- ✅ View dashboard with appointment stats
- ✅ See patients with approved appointments
- ✅ View appointment requests
- ✅ Approve/reject patient appointment requests
- ✅ Update COVID test results (positive/negative)
- ✅ Update vaccination status (which vaccine, dose, date)

**Hospital Dashboard**: `/hospital/dashboard`

---

### 🧑‍⚕️ PATIENT ROLE

#### Register a Patient Account

1. Click **"Register"** on the login page
2. Fill in:
   - Name: `John Doe` (or any patient name)
   - Email: `patient@demo.com`
   - Password: `password`
   - Confirm Password: `password`
3. Click **"Register"**

#### Patient Login

| Field | Value |
|-------|-------|
| Email | `patient@demo.com` |
| Password | `password` |

**Patient Can**:
- ✅ View dashboard with appointment stats
- ✅ Search for approved hospitals
- ✅ Book appointments (COVID test or vaccination)
- ✅ View their appointments (My Appointments)
- ✅ View test results and vaccination records
- ✅ Edit their profile
- ✅ Delete their account

**Patient Dashboard**: `/patient/dashboard`

---

## Quick Test Workflow

### **Complete User Journey Test:**

1. **Admin** logs in → Approves a hospital
2. **Hospital** logs in → Dashboard shows 0 stats initially
3. **Patient** registers → Searches for hospitals
4. **Patient** books appointment → Hospital receives request
5. **Hospital** approves appointment → Patient sees approved status
6. **Hospital** updates result/vaccination → Patient sees results
7. **Admin** views reports → Exports to Excel

---

## URL Reference

| Role | Dashboard URL | Notes |
|------|---------------|-------|
| Admin | `/admin/dashboard` | Access all features |
| Hospital | `/hospital/dashboard` | Needs admin approval first |
| Patient | `/patient/dashboard` | Can register immediately |

---

## Common Issues & Solutions

### ❌ "Access denied" error when hospital logs in
**Solution**: Admin must approve the hospital first via Admin → Hospitals → Approve

### ❌ No hospitals show in patient search
**Solution**:
- Hospital must be approved by admin
- Hospital's status must be `approved` in database

### ❌ Patient can't book appointment
**Solution**:
- Make sure at least one hospital is approved
- Patient must select hospital, date, and appointment type

### ❌ Can't see data in admin dashboard
**Solution**:
- Data is only shown once it's in the database
- Register some patients, hospitals, bookings to see stats

---

## Demo Data Helper

To quickly add demo data, you can manually add entries via phpMyAdmin:

1. **Add a Hospital** (in `hospitals` table):
   - `user_id`: 2 (the hospital user ID)
   - `hospital_name`: `City General Hospital`
   - `address`: `123 Main St`
   - `city`: `New York`
   - `phone`: `+1 234 567 8900`
   - `status`: `approved`

2. **Add a Vaccine** (in `vaccines` table):
   - `vaccine_name`: `Pfizer-BioNTech`
   - `availability`: `available`

---

## Browser URLs Quick Access

- **Login**: http://127.0.0.1:8000/login
- **Register**: http://127.0.0.1:8000/register
- **Logout**: Any authenticated page → Click "Logout"

---

**Need Help?** Check the main `README.md` for full feature documentation!
