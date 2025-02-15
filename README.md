# Simple test database
With laravel 11 and Filament 3.x

## Install and Run
clone into a folder and cd into it

composer update

npm install

npm run build

php artisan key:generate --ansi

php artisan migrate --graceful --ansi
php artisan migrate:fresh --seed 

php artisan serve 

open web page http://127.0.0.1:8000/admin  ~or whatever the server says + admin

user: admin@ex.io

password:  asdf


## Add your notes here

### Outline

This project extends the initial Laravel 11 and Filament 3.x setup by implementing the following features:

- **User Management**
    - Added `user_type` column to the `users` table (Admin, Staff, Client).
    - Enum `UserTypeEnum` is used for type safety.
    - Filament resource for Users with filtering and badge display for user types.

- **Organizations**
    - Model: `Organization`
    - Organizations can have multiple `Staff` users.
    - Organizations have many Companies.

- **Companies**
    - Model: `Company`
    - Companies must belong to exactly one Organization.
    - Companies can have multiple `Client` users.

- **Database Migrations & Seeding**
    - Seeders create:
        - **Admin user (`admin@ex.io`) is created if missing**
        - **20 Staff users**
        - **200 Client users**
        - **5 Organizations**
        - **30 Companies**

- **Filament Integration**
    - Resources for Users, Organizations, and Companies.
    - Relationship management between Companies ↔ Users & Organizations ↔ Staff Users.
    - Deleting Companies and Organizations also removes related records.

- **UI Enhancements**
    - User types displayed as **badges** with distinct colors.
    - Live notifications when a new user is created.
    - Forms reset when creating new users.

- **Bonus Feature: Version Widget**
    - Added a Filament dashboard widget displaying application version.
    - Version is stored in `config/cw.php` as `Version 1.02.03`.
    - Uses `APP_NAME` from `.env`.

---

### Other Notes / Questions / Comments

- If you experience issues with migrations, try:
  ```bash
  php artisan migrate:fresh --seed
