<p align="center"><img src="https://thetechyhub.com/wp-content/uploads/2015/08/the_techy_hub_logo.png"></p>
<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>


# <h1 align="center">  The Techy Hub Laravel Project Template </h1>


## About The Template

The Template was created as a starting point for the upcoming Laravel projects. It comes with pre build features and setups to speed up your development process and to make things easier for you.

Some of the features includes:

- Full Authentication setup including ( multi-level authentication and password recovery ).
- Bootstrap dashboard setup for admin access.
- File structures ready for multi-users app.
- Admin account settings and crew members features.

More features will be added with time.

## Setup Instruction

The following structures will walk you through the setup of the template.

- Clone The Repo.
- rename the project to your new project name.
- change the remote git repo to the new one ` git remote set-url origin https://github.com/USERNAME/REPOSITORY.git `.
- run ` composer install `.
- run ` npm install `.
- run ` npm run dev `, for production ` npm run production `.
- Copy The ` .env.example ` to ` .env `.
- update the database section in the `.env` file to match your details, make sure to create the database by using phpmyadmin or the command line.
- run ` php artisan key:generate ` to generate the app key.
- run ` php artisan migrate ` to generate the app migration.
- run ` php artisan  storage:link ` to generate the public storage link.


## Contributing

For contribution, make sure to follow the below structures:

- create a new branch.
- Once done, create a pull request and wait for the review.

## For issues or feature requests

Please use the [github form](https://github.com/thetechyhub/template/issues) to report any issues or to propose any other features.
