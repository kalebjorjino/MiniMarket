# SAM-J KMART ECOMMERCE WEB APP
A web app for a korean mart business using laravel, bootstrap, vue.js, and paypal api.

|   Storefront       | Admin |
:-------------------------:|:-------------------------:
![sign-up](https://github.com/aleaxim/samj-ecommerce-web/assets/56270967/ee13396e-31d7-4e2c-a93d-139b7ee7412f) | ![admin-dashboard](https://github.com/aleaxim/samj-ecommerce-web/assets/56270967/f26b86ab-fc96-46dc-ae3a-009f400aada7)
![our-products](https://github.com/aleaxim/samj-ecommerce-web/assets/56270967/df26f8eb-493a-4d93-9877-2df1d3167797) | ![admin-products](https://github.com/aleaxim/samj-ecommerce-web/assets/56270967/cf02ff4c-ea5f-4651-9e6b-75da1d052013)


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

This project is licensed under the GNU General Public License v3.0.

