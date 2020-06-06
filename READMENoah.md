# Bloo Project

## Setup:

```bash
git clone ....
cd projectname
composer install                   # Install backend dependencies

cp .env.example .env               # Update database credentials configuration
                                   # (Dont forget to create database name following credentials configuration)
php artisan key:generate           # Generate new keys for Laravel
php artisan migrate:refresh --seed       # Run migration and seed users and categories for testing
npm install                        # Install node dependencies
npm run dev                        # To compile assets for prod
```

#### JS plugins:

* [Laravel Mix](laravel-mix)
* [Ionicons](https://github.com/driftyco/ionicons)
* [bootstrap](https://github.com/twbs/bootstrap)
* [chosen](https://github.com/harvesthq/bower-chosen)
* [datatables + plugins](https://github.com/DataTables/DataTables)
* [datetimepicker](https://github.com/xdan/datetimepicker)
* [font-awesome](https://github.com/FortAwesome/Font-Awesome)
* [jquery](https://github.com/jquery/jquery)
* [sweetalert2](https://github.com/limonte/sweetalert2)
* [iCheck](https://github.com/fronteed/iCheck)
* [Axios](https://github.com/mzabriskie/axios)
* [VueJs](http://vuejs.org/)
