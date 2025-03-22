# Job board project

## Overview
This is a job board project created using Laravel 12, Inertia, Vue 3, and Sail as the development server. It allows users to post and search for job listings.

## Tech Stack
- **Laravel 12**: A PHP framework for building web applications.
- **Inertia**: A framework that allows you to create modern single-page React, Vue, and Svelte applications using classic server-side routing and controllers.
- **Vue 3**: A progressive JavaScript framework for building user interfaces.
- **Sail**: A lightweight command-line interface for interacting with Laravel's default Docker development environment.

## Installation
1. Clone the repository:
    ```sh
    git clone https://github.com/your-username/job-board-app.git
    cd job-board-app
    ```

2. Install dependencies:
    ```sh
    composer install
    npm install
    ```

3. Copy the example environment file and configure the environment variables:
    ```sh
    cp .env.example .env
    ```

4. Generate an application key:
    ```sh
    php artisan key:generate
    ```

5. Run the database migrations:
    ```sh
    php artisan migrate
    ```

6. Build the front-end assets:
    ```sh
    npm run dev
    ```

## Usage
To start the development server using Sail, run:
```sh
./vendor/bin/sail up
```

To start development services, queues, schedule jobs, etc:
```sh
./vendor/bin/sail composer run dev
```