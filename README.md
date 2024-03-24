# PHP IGGY

A simple PHP application for tracking expenses.

## Features

- Add expenses
- List expenses
- Filter expenses by category
- Delete expenses
- Authentication

## Requirements

- PHP 8.2+
- A web server (e.g. Apache or nginx)

## Installation

1. Clone this repository
2. Install dependencies with `composer install`
3. Copy `.env.example` to `.env` and edit it with your database credentials
4. Run `php cli.php db:migrate` to create the database schema
5. Start the web server and navigate to `localhost/public`

## Usage

1. Go to `localhost/public` and click on "Add new expense"
2. Fill out the form and click "Save"
3. To list all expenses, click on "List expenses"
4. To filter expenses by category, click on the category in the "List expenses" view
5. To delete an expense, click on "Delete" next to the expense

## License

MIT
