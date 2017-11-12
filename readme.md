<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

# Notes about standards used on this application

## Authentication
- client: app\Http\Controllers\Auth
- admin: app\Http\Controllers\Admin\Auth

## IDE auto-complete
- barryvdh/laravel-ide-helper + artisan
- doctrine/dbal + artisan

## Email
- mailtrap.io => SMTP faker

## View
- patricktalmadge/bootstrapper + service provider + facade
- kris/laravel-form-builder + service provider + facade

## Routes
- Route::resource('users', 'UsersController');
- Routes Model Binding => route argument equal to the one from the action

## CRUD User
- php artisan make:controller Admin\UsersController --resource --model=CodeFlix\Models\User
- php artisan make:form Forms\UserForm --fields="name:text, email:email"

## NavBar
- $navbar = Navbar::withBrand(config('app.name'), route('admin.dashboard'))->inverse();
- $menusLeft = Navigation::links($arrayLinksLeft);
- $menusRight = Navigation::links($arrayLinksRight)->right();
- $formLogout = FormBuilder::plain([]);

## Design Pattern: Repository (layer between Model and the Data Source)
- prettus/l5-repository + service provider
- php artisan vendor:publish --provider="Prettus\Repository\Providers\RepositoryServiceProvider"

## CRUD Category using L5-Repository
- php artisan make:entity Category
	- Presenter: no
	- Validator: no
	- Controller: yes
- files used
	- modified:
		- config/app.php
	- new:
		- app/Http/Controllers/CategoriesController.php
		- app/Http/Requests/
		- app/Models/Category.php
		- app/Providers/RepositoryServiceProvider.php
		- app/Repositories/
		- database/migrations/2017_11_12_204552_create_categories_table.php

## CRUD Serie
- php artisan make:repository Serie
- php artisan make:controller SeriesController --resource --model=CodeFlix\Models\Serie
- php artisan make:seeder Admin\SeriesTableSeeder
- php artisan make:form Forms\SerieForm --fields"title:text, description:textarea"














