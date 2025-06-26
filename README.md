# AdminLTE 3 PHP Panel

A clean, **Admin Dashboard** built with **Vanilla PHP** and **AdminLTE 3** — with fully offline support, modular layout, and basic authentication.

## ✨ Features

- 🔐 Login & Registration (with hashed passwords)
- 🧑‍💼 User Management (CRUD with modals)
- 📊 DataTables integration (fully offline)
- 🧱 Modular layout (like Laravel's Blade)
- 🧭 Sidebar routing via `?page=...`
- ✅ Session-based auth
- 📦 Toast notifications using AdminLTE (no external libraries)
- 🔐 Admin user type support

---

## 🗂 Folder Structure

```
/assets               → AdminLTE 3 assets
/auth                 → Login & Register pages
/dashboard
├── index.php         → Main router
├── pages/            → Modular page files (home.php, profile.php, settings.php, users.php)
├── functions/        → Logic controllers (profile.php, setting.php, user.php)
includes
├── auth-footer.php   → Footer layout for login/register
├── auth-header.php   → Header layout for login/register
├── auth.php          → Session protection
├── footer.php        → General footer
├── header.php        → General header
├── layout.php        → Master layout file
├── sidebar.php       → AdminLTE sidebar menu
404.html
config.php            → DB connection & session
index.php             → Root redirect handler (login or dashboard)
logout.php
```

---

## 💾 Requirements

- PHP 7.4+
- MySQL or MariaDB
- Apache/Nginx (or PHP’s built-in dev server)
- Composer (optional if you want to extend)

---

## 🚀 Setup

### 🔁 Root Redirect Logic

The root `index.php` file handles session-based redirection:

```php
<?php
session_start();

if (isset($_SESSION['user'])) {
  // If already logged in, go to the dashboard
  header("Location: dashboard/index.php");
  exit;
} else {
  // Not logged in, redirect to login page
  header("Location: auth/login.php");
  exit;
}
```


1. **Clone the repository**
  ```bash
  git clone https://github.com/rdevz-ph/adminlte-offline-php-panel.git
  cd adminlte-offline-php-panel
  ```

2. **Create the `auth_demo` database**
  - Open your MySQL/MariaDB client (phpMyAdmin, CLI, etc.).
  - Run:
    ```sql
    CREATE DATABASE auth_demo CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
    ```

3. **Import the SQL file**
  - Locate the provided `auth_demo.sql` file in the project (or download it if provided separately).
  - Import it using your preferred tool:
    - **phpMyAdmin:** Select the `auth_demo` database, then use the "Import" tab to upload `auth_demo.sql`.
    - **CLI:**
      ```bash
      mysql -u your_username -p auth_demo < path/to/auth_demo.sql
      ```

  > **Default Admin User:**  
  > Username: `admin`  
  > Password: `admin123`

4. **Serve the project**
  ```bash
  php -S localhost:8000
  ```

  Visit: [http://localhost:8000](http://localhost:8000)

---



## 📄 License

This project is open-source and free to use under the MIT License.