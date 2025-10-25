Laravel Admin LRT Dashboard Starter

A starter Laravel project designed to help developers quickly build admin dashboards with modern features like SPA, dynamic DataTables, permission management, and localization.

The goal is to provide a strong boilerplate for starting any Laravel-based dashboard project.

🚀 Features

⚡ SPA (Single Page Application) Support

Fully AJAX-based navigation without full-page reloads.

Dynamic modals for create, edit, and show views.

📊 Yajra DataTables Integration

Server-side data loading for large tables.

Built-in filters, sorting, searching, and export options.

🔐 Laratrust Roles & Permissions

Simple and powerful role/permission management system.

Easy to control access to each part of the dashboard.

🌍 Mcamara Laravel Localization

Full multilingual support (e.g., English / Arabic).

Easily manage translation files and switch languages.

🎨 AdminLTE Dashboard

Clean and responsive admin interface.

Ready-to-use layout for quick project setup.

🧱 Tech Stack
Package	Purpose
Laravel	Main backend framework (v10+ or v11).
AdminLTE	Dashboard UI built with Bootstrap.
Yajra DataTables	Interactive and server-side data tables.
Laratrust	Roles and permissions management.
Mcamara Localization	Multilingual site support.
AJAX + jQuery	For SPA-style interactivity.
⚙️ Requirements

PHP 8.1 or higher

Composer

Node.js & NPM

MySQL (or any supported database)

🧩 Installation

Clone the project

git clone https://github.com/username/laravel-admin-lrt-dashboard.git
cd laravel-admin-lrt-dashboard


Install dependencies

composer install
npm install && npm run dev


Configure the environment

cp .env.example .env
php artisan key:generate


Run migrations and seeders

php artisan migrate --seed


Start the server

php artisan serve


Then open your browser and visit:
👉 http://localhost:8000/admin/login

👑 Default Login
Email	Password
admin@admin.com	password
📂 Project Structure
app/
 ├── Http/Controllers/Admin/    → All admin controllers
 ├── Models/                    → Application models
resources/
 ├── views/admin/               → Dashboard Blade views
 ├── lang/                      → Translation files
public/
 ├── adminlte/                  → AdminLTE assets (CSS, JS)
routes/
 ├── admin.php                  → Dashboard routes

🧠 Developer Notes

Permissions and roles can be managed from the Admin → Roles & Permissions page.

Full localization support via LaravelLocalization.

Organized and scalable structure — ideal for starting new Laravel projects fast.

🤝 Contributing

Contributions are welcome ❤️
To contribute:

git checkout -b feature/new-feature
git commit -m "Add new feature"
git push origin feature/new-feature


Then open a Pull Request.

📄 License

This project is open-sourced under the MIT License.

Would you like me to add a “How to create new CRUD modules using the SPA modal system” section at the end?
It’ll make your README more practical for developers who want to extend the dashboard easily.
