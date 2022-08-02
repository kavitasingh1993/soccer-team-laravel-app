# Getting Started

### Clone the repository using the following command

    git clone https://github.com/kavitasingh1993/soccer-team-laravel-app.git
        
## Getting Started | Installation

In order to start developing, follow these steps:

- Create a `.env` using the `.env.example` example.
- In .env file generate the application key using 'php artisan key:generate' command and also make database changes.
- Install dependencies running `composer install`.
- Run `docker-compose up -d --build` to spin up framework server.
- If permission issue then : sudo chmod 666 /var/run/docker.sock
- Go to src folder and Run `docker-compose run --rm artisan migrate` to setup the database.
- Go to Browser and run the url as http://localhost:8088/ to start the application.
- Create a `.env.testing` using the `.env.example` example.
- Go to src folder and Run 'vendor/bin/phpunit' command to run the unit test cases.
