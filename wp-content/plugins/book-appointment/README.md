# Book Appointment

Usage:

- Activate the plugin from WordPress admin (Plugins → Book Appointment).
- Place the shortcode `[book_appointment_form]` on any page or post to display the booking form.
- On activation the plugin creates a table named `{wpdb_prefix}appointment`.

Table columns created:

- `id` (primary auto increment)
- `patient_name`
- `specialist_check`
- `appointment_datetime` (datetime)
- `location`
- `phone_number`
