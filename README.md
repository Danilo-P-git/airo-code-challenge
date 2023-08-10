# airo-code-challenge

# Repository Setup Instructions

This repository contains a project that requires the following tools and versions:

- PHP 8.1
- Node.js with npm 9.6.7
- Laravel 10
- Angular 14

Follow the steps below to set up and run the project:

## Backend Setup (BE)

1. Clone the project repository.

2. Navigate to the `BE` folder in your terminal.

3. Install PHP dependencies using Composer:

   ```sh
   composer install
   ```

4. Generate the application key:
   ```sh
    php artisan key:generate
   ```
5. Create the .env file from the provided .env-example:
   ```sh
   cp .env-example .env
   ```
6. Install Laravel Passport for authentication:

   ```sh
   php artisan passport:install

   ```

7. Run database migrations:

   ```sh
   php artisan migrate

   ```

8. Run database migrations:

   ```sh
   php artisan migrate
   ```

9. Seed the database with initial data:
   ```sh
   php artisan db:seed
   ```

## Frontend Setup (FE)

1. Navigate to the `FE` folder in your terminal.

2. Install Node.js dependencies using npm:

   ```sh
   npm install
   ```

3. To run the frontend server, use the following command:

   ```sh
   ng serve
   The project is now set up and running. You can access the frontend by navigating to the specified URL where the Angular server is running.
   ```

Feel free to explore the codebase, make modifications, and start building and developing your application!

Remember to regularly commit your changes, and have fun coding!
