# Installation 
## Node Installation
### Install Node Dependencies
`npm i`

## Laravel Installation

### Install Composer Dependencies
`composer install`

### Create .env
`cp .env.example .env`

#### Generate Key
`php artisan key:ge`

#### Fill out Database Details
`code .env` & fill out necessary keys

### Run migrations
`php artisan migrate`

# Running Locally

## Frontend
For live updates...
`npm run watch`

## Backend
`php artisan serve`