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

  

open web page http://127.0.0.1:8000/admin ~or whatever the server says + admin

  

user: admin@ex.io

  

password: asdf

  
  

## Add your notes here

  

## Outline

### Tasks:

 - Added user profile as `type_user` enum column in database unsign values Admin, Staff and Client
 
 - Ensure that user seed keeps original admin user with same credentials and create new users
	 - 20 staff users
	 - 200 client users
 - Implemented Enum `TypeUserEnum` in `app/Enums`
 - Created Organization model with migration and seeders using factories
 - Ensure that seed creates 5 organization and attach staff users ramdomnly
 - Created Company model with migration and seeders using factories
 - Ensure that seed creates 30 companies and ensure that each company belongs to a single organization and have multiples client users ramdomnly
 - Update users CRUD resource to add option to asign user's profile
 - Create organization CRUD resource to list organizations, create, delete, edit organization and asign staff users
 - Create company CRUD resource to list companies, create, delete, edit and asign client users

### Extras

 - Add widget in dashboard to show app version
 
 - Add some visual enhancements changing icons in menu and displaying number of users in company and organizations
 - Add a tab at top of user's list to filter by user profile
 - As an **extra layer of security**, added UID column to tables so users will not see record's ids as a consecutive order of numbers
	 - Changed from `/admin/users/1/edit` to `/admin/users/67b232dd50def/edit`