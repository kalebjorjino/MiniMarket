# SAM-J KMART ECOMMERCE WEB APP

## Prerequisites

Before running this project, ensure that you have the following prerequisites installed on your system:
- PHP (minimum version 8.1)
- Composer
- Node.js (minimum version 14.x)
- npm or Yarn

## Installation

To run this project, follow the steps below:


```
git clone https://github.com/aleaxim/samj-ecommerce-web.git
cd samj-ecommerce-web
composer install
npm install

cp .env.example .env
php artisan key:generate
```

Populate your database
```
php artisan migrate
php artisan db:seed
```

Build the frontend assets and start the Laravel development server:
```
npm run dev
php artisan serve
```

## License

This project is licensed under the MIT License. Feel free to use and modify the code as per your requirements.

