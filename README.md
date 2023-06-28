# SAM-J KMART ECOMMERCE WEB APP

|          |  |
:-------------------------:|:-------------------------:
![sign-up](https://github.com/aleaxim/samj-ecommerce-web/assets/56270967/18ec3db8-b6eb-4330-9e3d-81ace08afb69) |  ![our-products](https://github.com/aleaxim/samj-ecommerce-web/assets/56270967/edd9ce02-2761-4477-ba56-03f04aced47f)
![admin-dashboard](https://github.com/aleaxim/samj-ecommerce-web/assets/56270967/c3292017-c59c-4a08-8103-efcb4267b69f) | ![admin-products](https://github.com/aleaxim/samj-ecommerce-web/assets/56270967/ac030c14-fe3c-40d6-92a3-515c0287be49)

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

