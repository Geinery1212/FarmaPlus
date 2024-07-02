# FarmaPlus

## Overview
This is a basic PHP e-commerce application for a pharmacy. It is built using PHP 8.0.26 and MySQL 8.0.31.

## Technologies Used
- **Bootstrap**: 5.1.3
- **jQuery**: 3.6.0
- **Toastr**: v2.1.3
- **SweetAlert2**: v11.12.1
- **Font Awesome**: v6.5.2
- **TinyMCE**: v7.2.0

## Features
- **User Authentication**: Login and Register
- **Search Functionality**
- **Admin Panel**:
  - Categories CRUD
  - Product CRUD
  - Order Status Management
- **Payment Integration**: PayPal
- **Order Review**
- **Blog**:
  - CRUD Category Blog
  - CRUD Entry Blog

## Installation

### Basic Installation
1. **Install a Local Server**: Use WAMP, XAMPP, MAMP, or any other local server that supports PHP.
2. **Clone the Project**: Clone the project into the root folder of your local server (e.g., the `www` folder for WAMP).
3. **Create a Database**: Import the SQL script located in `ecommerce/database`.
4. **Configure Database Credentials**: Ensure all credentials are correct in `ecommerce/config/ConnectionDB.php`.
5. **Change Base URL**: Update the base URL in `.htaccess`, `ecommerce/config/parameters.php`, and `blog/config/parameters.php`.
    - Example: `https://welcometofarmaplus.000webhostapp.com/` or `http://localhost/projects/backup_farmaplus/`.

### Admin Credentials
- **Email**: admin@admin.com
- **Password**: 1234

### Additional Configurations
1. **PayPal Configuration**:
    - Change the `client_id` of PayPal in `ecommerce/views/layout/header.php` on line 22.
    - Add your `paypalClientID` and `paypalSecret` in `ecommerce/controllers/PedidoController.php` on lines 173 and 174.

2. **Email Configuration**:
    - Create an app password at [Google App Passwords](https://myaccount.google.com/u/2/apppasswords?rapt=AEjHL4MAzK0TtOH1-xzYRIa4w3sN_gj9SjidOJtkc7sV0k9pHFOVArMq0GZltqqF_FkBrbimgbyzyP-C1BHKX2We4kzVJlP6SayuU3zXBbha0KczZvM5PoA).
    - Add the app password to `ecommerce/controllers/PedidoController.php` on line 198.
    - Add your email on lines 197 and 203 in the same file.

3. **TinyMCE Configuration**:
    - Change the `id` of TinyMCE in `blog/views/layout/header.php` on line 20.    

## Notes
- Please ensure to change the credentials and sensitive data before using the project in a production environment.

## Demo
You can watch it online at [FarmaPlus](https://welcometofarmaplus.000webhostapp.com/blog/posts/index).
