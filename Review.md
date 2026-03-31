Please audit and implement the following improvements for our `Online COVID TEST and VACCINATION Booking System` (Laravel 10). I want to ensure the application perfectly matches the PRD requirements, is fully production-ready, and has a premium user experience.

Here are the specific tasks you need to complete. Please work through them systematically:

### 1. Advanced Admin Reports (Date Filtering)
In `AdminReportController` and `resources/views/admin/reports/index.blade.php`, the Excel export has date logic, but the actual on-screen HTML table of COVID Test Reports does not have functional date filtering. 
- Wire up the "Filter by Date" input so that the Admin can view the results grouped/filtered by date directly on the webpage. 
- Implement backend query scopes to handle this filtering cleanly.

### 2. Search, Sort, & Pagination (DataTables)
Currently, lists of Patients, Hospitals, and Bookings are displayed as static HTML tables.
- Add pagination to all list methods in Controllers (`paginate(10)` instead of `get()`).
- Update the blade views to use Laravel's `{{ $records->links() }}`.
- Add search bars to the Admin Bookings, Admin Hospitals, and Hospital Patients views to allow filtering by name or email.

### 3. Email Notifications
The `.env` file is configured for Mailpit. Implement Laravel Mail and Jobs to send asynchronous email notifications when:
- A Hospital's registration is approved or rejected by the Admin.
- A Patient's appointment is approved or rejected by the Hospital.
- A Patient's COVID-19 test result is updated by the Hospital.

### 4. Patient PDF Report Generation
In the Patient's `results` dashboard (`PatientResultController`), provide a "Download Certificate" button that generates a PDF of their completed test result or vaccination record.
- You can install and use `barryvdh/laravel-dompdf` for this functionality.
- Create a clean, official-looking Blade layout for the PDF certificate.

### 5. Frontend Polish & UX Enhancements
- Add loading spinners and disable submit buttons across all forms (Patient Appointment Booking, Hospital Result Updates, Registration) using Alpine.js or vanilla JS to prevent double-submissions.
- Ensure the 'Forgot Password' and 'Reset Password' views are styled using the same premium glassmorphic UI as the Login and Register views.

### 6. Code Refactoring (Form Requests)
- To maintain a clean architecture, extract the validation logic currently residing inline within Controller methods (e.g., `RegisteredUserController@store`, `PatientAppointmentController@store`, `HospitalResultController@update`) into dedicated Laravel FormRequest classes.

Please review the codebase, plan out the changes, and implement them one by one. Confirm with me after completing each section so we can review before proceeding to the next.
