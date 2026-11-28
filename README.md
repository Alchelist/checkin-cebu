# CheckIn Cebu – Event Registration & QR Check-in System

CheckIn Cebu is a web-based event registration and QR check-in application developed using **Laravel 12, PHP, and MySQL**.

The system allows attendees to browse published events, register online, receive a unique ticket with a QR code, and retrieve their registration details. Authorized staff can manage event attendance and validate tickets during check-in.

## Live Application

**Production URL:** https://checkin-cebu-production.up.railway.app

The application is deployed using Railway with a MySQL database.

## Technology Stack

- **Backend:** Laravel 12
- **Language:** PHP
- **Database:** MySQL
- **Frontend:** Blade, HTML, CSS, JavaScript
- **QR Tickets:** QR code generation
- **Deployment:** Railway
- **Development Environment:** XAMPP, Visual Studio Code

## Main Features

### Attendee Features
- Browse published events and view event details.
- Register using full name, email address, and Philippine mobile number.
- Receive a unique registration ticket with a QR code.
- Retrieve a ticket using registration details.
- Join the waitlist when an event reaches capacity.
- Cancel an eligible registration.

### Staff Features
- Secure staff authentication.
- QR-based or manual ticket check-in.
- Validate tickets and prevent duplicate check-ins.
- Search and view attendee registrations.
- View attendance information and check-in records.

### Organizer Features
- Manage event information.
- Manage event publication status.
- Monitor registrations and attendance.
- Export attendee information as CSV.
- Review activity records.

### Validation and Security
- Prevent duplicate active registrations for the same event.
- Enforce event capacity during registration.
- Validate attendee information.
- Use hashed staff passwords.
- Protect staff and organizer pages through role-based authorization.

## Installation and Local Setup

### Requirements
- PHP 8.2 or later
- Composer
- MySQL
- Node.js and npm
- Git

### 1. Clone the repository

```bash
git clone https://github.com/Alchelist/checkin-cebu.git
cd checkin-cebu
```

### 2. Install dependencies

```bash
composer install
npm install
```

### 3. Configure the environment

Copy `.env.example` and rename the copy to `.env`.

For Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

Update your `.env` database configuration:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=checkin_cebu
DB_USERNAME=root
DB_PASSWORD=
```

Create a MySQL database named `checkin_cebu`.

Generate your application key:

```bash
php artisan key:generate
```

### 4. Configure demo account passwords

Add your own passwords to `.env`:

```env
DEMO_DOORSTAFF_PASSWORD=your_doorstaff_password
DEMO_ORGANIZER_PASSWORD=your_organizer_password
```

Do not commit actual passwords or your `.env` file to GitHub.

### 5. Run migrations and seed the database

```bash
php artisan migrate --seed
```

The seeder creates the demonstration staff accounts and sample events.

**Important:** Avoid `php artisan migrate:fresh` on an existing database because it drops all tables and deletes their data.

### 6. Build frontend assets

```bash
npm run build
```

### 7. Start the application

```bash
php artisan serve
```

Open:

http://127.0.0.1:8000

## Demo Accounts

The seeder creates two demonstration accounts:

| Role | Username |
|---|---|
| Organizer | `organizer` |
| Door Staff | `doorstaff` |

Passwords are configured through `DEMO_ORGANIZER_PASSWORD` and `DEMO_DOORSTAFF_PASSWORD` environment variables. They are not published in this repository.

## Sample Events

The database seeder includes:

- **Cebu Dev Meetup 2026** – Ayala Center Cebu, Function Room 2. Capacity: 30 attendees.
- **Cebu Design Social** – The Greenery, Kasambagan. Capacity: 3 attendees.

The events are seeded as published events. Registration and waitlist behavior can be tested by creating attendee registrations.

## Database Structure

The main application tables include:

| Table | Purpose |
|---|---|
| `events` | Stores event details, schedules, venues, capacity, and status. |
| `registrations` | Stores attendee registration and ticket information. |
| `staff_users` | Stores staff accounts and access roles. |
| `audit_logs` | Stores activity records. |

Laravel also uses framework tables for sessions, cache, and queued jobs where configured.

## Known Limitations

- QR code images rely on an external QR code service.
- Camera-based QR scanning requires camera permission and an HTTPS connection.
- Email is currently configured with Laravel's log mailer; actual email delivery is not configured.
- The system requires an active internet connection to access the deployed application and external QR service.

## Project Repository

GitHub: https://github.com/Alchelist/checkin-cebu

