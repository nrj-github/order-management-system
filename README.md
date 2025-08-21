# Mini Order Management System

This is a simple order management system built with the Laravel framework. It provides basic CRUD (Create, Read, Update, Delete) functionality for managing customers, products, and orders.

## Features

- **Customer Management**: Create, view, edit, and delete customer records.
- **Product Management**: Create, view, edit, and delete product records, including stock quantity.
- **Order Management**: Create new orders by selecting a customer and one or more products.
- **Stock Validation**: Prevents an order from being placed if there is insufficient product stock.
- **Search & Pagination**: Search for products and orders and view them in paginated lists.

## Installation

Follow these steps to get the project up and running on your local machine.

1.  **Clone the repository:**
    ```bash
    git clone [https://github.com/nrj-github/order-management-system.git](https://github.com/nrj-github/order-management-system.git)
    cd order-management-system
    ```

2.  **Install PHP dependencies:**
    ```bash
    composer install
    ```

3.  **Install JavaScript dependencies (for Tailwind CSS):**
    ```bash
    npm install
    npm run dev
    ```

4.  **Set up the environment file:**
    ```bash
    cp .env.example .env
    ```
    Now, open the `.env` file and update the **DB_DATABASE**, **DB_USERNAME**, and **DB_PASSWORD** with your MySQL credentials. Then, generate the application key.
    ```bash
    php artisan key:generate
    ```

5.  **Run database migrations:**
    ```bash
    php artisan migrate
    ```

6.  **Start the development server:**
    ```bash
    php artisan serve
    ```

You can now access the application in your browser at `http://127.0.0.1:8000`.