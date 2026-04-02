# SQL Commands for COVID Booking System

Run these commands in phpMyAdmin or any SQL client to set up the database and populate it with test data.

### 1. Database Setup
```sql
# Create and Use the Database
CREATE DATABASE IF NOT EXISTS covid_booking;
USE covid_booking;

# ---------------------------------------------------------
# Table Structure
# ---------------------------------------------------------

# Users Table
DROP TABLE IF EXISTS users;
CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    email_verified_at TIMESTAMP NULL DEFAULT NULL,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NULL,
    address TEXT NULL,
    city VARCHAR(100) NULL,
    user_type ENUM('admin', 'hospital', 'patient') DEFAULT 'patient',
    status ENUM('active', 'inactive', 'pending') DEFAULT 'active',
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_user_type (user_type),
    INDEX idx_status (status),
    INDEX idx_city (city)
);

# Hospitals Table
DROP TABLE IF EXISTS hospitals;
CREATE TABLE hospitals (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    hospital_name VARCHAR(255) NOT NULL,
    address VARCHAR(500) NOT NULL,
    city VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    description TEXT NULL,
    status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_status (status),
    INDEX idx_city (city)
);

# Vaccines Table
DROP TABLE IF EXISTS vaccines;
CREATE TABLE vaccines (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    vaccine_name VARCHAR(255) NOT NULL,
    description TEXT NULL,
    availability ENUM('available', 'unavailable') DEFAULT 'available',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_availability (availability)
);

# Appointments Table
DROP TABLE IF EXISTS appointments;
CREATE TABLE appointments (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    patient_id BIGINT UNSIGNED NOT NULL,
    hospital_id BIGINT UNSIGNED NOT NULL,
    appointment_type ENUM('covid_test', 'vaccination') NOT NULL,
    appointment_date DATE NOT NULL,
    appointment_time TIME NULL,
    status ENUM('pending', 'approved', 'rejected', 'completed') DEFAULT 'pending',
    notes TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (patient_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (hospital_id) REFERENCES hospitals(id) ON DELETE CASCADE,
    INDEX idx_patient_status (patient_id, status),
    INDEX idx_hospital_status (hospital_id, status),
    INDEX idx_appointment_date (appointment_date),
    INDEX idx_appointment_type (appointment_type)
);

# Test Results Table
DROP TABLE IF EXISTS test_results;
CREATE TABLE test_results (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    appointment_id BIGINT UNSIGNED NOT NULL UNIQUE,
    patient_id BIGINT UNSIGNED NOT NULL,
    hospital_id BIGINT UNSIGNED NOT NULL,
    result ENUM('positive', 'negative', 'pending') DEFAULT 'pending',
    doctor_notes TEXT NULL,
    result_date DATE NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (appointment_id) REFERENCES appointments(id) ON DELETE CASCADE,
    FOREIGN KEY (patient_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (hospital_id) REFERENCES hospitals(id) ON DELETE CASCADE,
    INDEX idx_patient (patient_id),
    INDEX idx_hospital (hospital_id),
    INDEX idx_result (result),
    INDEX idx_result_date (result_date)
);

# Vaccination Records Table
DROP TABLE IF EXISTS vaccination_records;
CREATE TABLE vaccination_records (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    appointment_id BIGINT UNSIGNED NOT NULL UNIQUE,
    patient_id BIGINT UNSIGNED NOT NULL,
    hospital_id BIGINT UNSIGNED NOT NULL,
    vaccine_id BIGINT UNSIGNED NOT NULL,
    dose ENUM('first', 'second', 'booster') NOT NULL,
    vaccination_date DATE NOT NULL,
    status ENUM('completed', 'pending') DEFAULT 'completed',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (appointment_id) REFERENCES appointments(id) ON DELETE CASCADE,
    FOREIGN KEY (patient_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (hospital_id) REFERENCES hospitals(id) ON DELETE CASCADE,
    FOREIGN KEY (vaccine_id) REFERENCES vaccines(id) ON DELETE CASCADE,
    INDEX idx_patient_date (patient_id, vaccination_date),
    INDEX idx_hospital (hospital_id),
    INDEX idx_vaccine (vaccine_id)
);

# Roles Table
DROP TABLE IF EXISTS roles;
CREATE TABLE roles (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL UNIQUE,
    guard_name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

# Permissions Table
DROP TABLE IF EXISTS permissions;
CREATE TABLE permissions (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL UNIQUE,
    guard_name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

# Model Has Roles Table
DROP TABLE IF EXISTS model_has_roles;
CREATE TABLE model_has_roles (
    role_id BIGINT UNSIGNED NOT NULL,
    model_type VARCHAR(255) NOT NULL,
    model_id BIGINT UNSIGNED NOT NULL,
    PRIMARY KEY (role_id, model_id, model_type),
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE
);

# ---------------------------------------------------------
# Test Data Population
# ---------------------------------------------------------

# 1. Insert Roles
INSERT INTO roles (name, guard_name) VALUES
('admin', 'web'),
('hospital', 'web'),
('patient', 'web');

# 2. Insert Users (Password is 'password')
INSERT INTO users (id, name, email, password, user_type, status, city, address) VALUES
(1, 'System Admin', 'admin@covid.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 'active', 'Colombo', 'Admin HQ'),
(2, 'City General Hospital Admin', 'citygen@hospital.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'hospital', 'active', 'Colombo', '123 Main St'),
(3, 'Metro Medical Center Admin', 'metromed@hospital.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'hospital', 'active', 'Kandy', '456 Hill Rd'),
(4, 'John Doe', 'john@patient.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'patient', 'active', 'Colombo', '789 Garden Ave'),
(5, 'Jane Smith', 'jane@patient.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'patient', 'active', 'Kandy', '321 Lake View'),
(6, 'Robert Wilson', 'robert@patient.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'patient', 'active', 'Galle', '555 Coastal Rd');

# 3. Assign Roles
INSERT INTO model_has_roles (role_id, model_type, model_id) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 4),
(3, 'App\\Models\\User', 5),
(3, 'App\\Models\\User', 6);

# 4. Insert Hospitals
INSERT INTO hospitals (id, user_id, hospital_name, address, city, phone, description, status) VALUES
(1, 2, 'City General Hospital', '123 Main St, Colombo 01', 'Colombo', '011-2223334', 'Primary healthcare facility in the capital.', 'approved'),
(2, 3, 'Metro Medical Center', '456 Hill Rd, Kandy', 'Kandy', '081-4445556', 'Specialized center for vaccines and tests.', 'approved');

# 5. Insert Vaccines
INSERT INTO vaccines (id, vaccine_name, description, availability) VALUES
(1, 'Pfizer-BioNTech', 'mRNA vaccine, 2 doses required.', 'available'),
(2, 'Moderna', 'mRNA vaccine, 2 doses required.', 'available'),
(3, 'AstraZeneca', 'Viral vector vaccine, 2 doses required.', 'available'),
(4, 'Sinopharm', 'Inactivated virus vaccine, 2 doses required.', 'available');

# 6. Insert Appointments (COVID Tests)
INSERT INTO appointments (id, patient_id, hospital_id, appointment_type, appointment_date, appointment_time, status) VALUES
(1, 4, 1, 'covid_test', CURDATE() - INTERVAL 5 DAY, '09:00:00', 'completed'),
(2, 5, 2, 'covid_test', CURDATE() - INTERVAL 3 DAY, '10:30:00', 'completed'),
(3, 6, 1, 'covid_test', CURDATE() + INTERVAL 2 DAY, '14:00:00', 'pending');

# 7. Insert Appointments (Vaccinations)
INSERT INTO appointments (id, patient_id, hospital_id, appointment_type, appointment_date, appointment_time, status) VALUES
(4, 4, 1, 'vaccination', CURDATE() - INTERVAL 10 DAY, '09:00:00', 'completed'),
(5, 5, 2, 'vaccination', CURDATE() - INTERVAL 2 DAY, '11:00:00', 'completed'),
(6, 6, 2, 'vaccination', CURDATE() + INTERVAL 1 DAY, '15:30:00', 'approved');

# 8. Insert Test Results
INSERT INTO test_results (appointment_id, patient_id, hospital_id, result, result_date, doctor_notes) VALUES
(1, 4, 1, 'negative', CURDATE() - INTERVAL 4 DAY, 'Patient shows no symptoms.'),
(2, 5, 2, 'positive', CURDATE() - INTERVAL 2 DAY, 'Advised home isolation for 10 days.');

# 9. Insert Vaccination Records
INSERT INTO vaccination_records (appointment_id, patient_id, hospital_id, vaccine_id, dose, vaccination_date, status) VALUES
(4, 4, 1, 1, 'first', CURDATE() - INTERVAL 10 DAY, 'completed'),
(5, 5, 2, 2, 'first', CURDATE() - INTERVAL 2 DAY, 'completed');
```

---

### How to use:
1. Open **phpMyAdmin**.
2. Select your database (or create a new one named `covid_booking`).
3. Click the **SQL** tab.
4. Copy and paste the entire script above and click **Go**.
5. All passwords are set to: `password`
