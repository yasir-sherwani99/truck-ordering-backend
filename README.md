## Truck Ordering App Backend in Laravel 11

#### Installation:

1. Clone the Git Repository<br />
git clone [https://github.com/yasir-sherwani99/truck-ordering-backend.git](https://github.com/yasir-sherwani99/truck-ordering-backend.git) 
<br /><br />
2. Install Composer Dependencies<br />
composer install
<br /><br />
3. Setup .env<br />
Duplicate the .env.example file and rename it to .env<br /><br />
DB_CONNECTION=mysql<br />
DB_HOST=127.0.0.1<br />
DB_PORT=3306<br />
DB_DATABASE=your_database_name<br />
DB_USERNAME=your_database_username<br />
DB_PASSWORD=your_database_password
<br /><br />
4. Generate an application key<br />
php artisan key:generate
<br /><br />
5. Migrate the Database<br />
php artisan migrate
<br /><br />
6. Seed the Database<br />
php artisan db:seed
<br /><br />
7. Start the Development Server<br />
php artisan serve

#### Features:

- **User Authentication:** Users can signup, login and manager their accounts using Laravel Sanctum for API Authentication
- **Booking Management:** Customers can create, update and view booking status
- **Admin Management:** Admin can view bookings, received notifications on new bookings, update bookings status and communicate via email regarding their orders


#### Explanation:

##### Authentication 

The app uses Laravel Sanctum for API authentication. You can register and authenticate users via the following routes:

- **POST** /api/register: Register a new user (customers) and authenticate it.
- **POST** /api/login: Login an existing user and retrieve an API token.
- **GET** /api/logout: Logout an existing user and delete an API token.

##### Routes

###### Bookings

- **POST** /api/booking: Create a new booking for trucks.

Booking status options

- Pending
- Delivered
- In Progress
- Cancel

###### Admin

- **POST** /api/admin/login: Login an existing admin and retrieve an API token.
- **GET** /api/admin/logout: Logout an existing admin and delete an API token.
- **GET** /api/admin/bookings: View all customers bookings.
- **GET** /api/admin/booking/{id}/details: View a single booking details.
- **PUT** /api/admin/booking/{id}/status: Update booking status and notifiy user via email.

