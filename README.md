# CheckIn Cebu – Event Registration & QR Check-in

CheckIn Cebu is a web application built using Laravel 12 and MySQL. It allows users to view events, register online, and use a QR ticket when attending. Staff can also manage registrations and check attendees in.

## Installation

1. Create a MySQL database named `event_checkin_db`.
2. Copy `.env.example` and rename the copy to `.env`.
3. Update the database settings in `.env`.
4. Open the terminal and run:

```bash
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```

5. Open `http://127.0.0.1:8000` in your browser.

**Note:** `migrate:fresh` resets the database and deletes its existing tables and data. Use it only when you are okay with starting over.

## Demo Accounts

**Door Staff**
- Username: `doorstaff`
- Password: `Pass1234!`

**Organizer**
- Username: `organizer`
- Password: `Pass1234!`

## Main Features

- View available events and their details.
- Register for an event using your name, email, and mobile number.
- Get a unique ticket with a QR code.
- Retrieve a ticket using the ticket code and email.
- Join the waitlist when an event is full.
- Cancel an active registration.
- Check in attendees by scanning their QR code or entering their ticket code.
- Search the attendee list and export it as a CSV file.
- Manage events through the organizer account.
- View check-in records and activity logs.

The system also checks for duplicate registrations and prevents the event from accepting more attendees than its capacity.

## Sample Events

Two events are included in the sample data:

- **Cebu Dev Meetup 2026** – Ayala Center Cebu, Function Room 2, with a capacity of 30 attendees.
- **Cebu Design Social** – Capacity of 3 attendees. This event is already full for testing the waitlist feature.

## Database Tables

The application uses four main tables:

- `events` – stores event information.
- `registrations` – stores attendee details and ticket information.
- `staff_users` – stores staff accounts and roles.
- `audit_logs` – stores records of staff activities.

## Notes and Limitations

- QR scanning requires camera permission and an internet connection.
- QR code images use an external service.
- Email notifications and live deployment are not included.
