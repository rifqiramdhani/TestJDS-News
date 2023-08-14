# ![Laravel News Management](logo.png)

[![Build Status](https://img.shields.io/travis/gothinkster/laravel-realworld-example-app/master.svg)](https://travis-ci.org/gothinkster/laravel-realworld-example-app) [![Gitter](https://img.shields.io/gitter/room/realworld-dev/laravel.svg)](https://gitter.im/realworld-dev/laravel) [![GitHub stars](https://img.shields.io/github/stars/gothinkster/laravel-realworld-example-app.svg)](https://github.com/gothinkster/laravel-realworld-example-app/stargazers) [![GitHub license](https://img.shields.io/github/license/gothinkster/laravel-realworld-example-app.svg)](https://raw.githubusercontent.com/gothinkster/laravel-realworld-example-app/master/LICENSE)

> ### Example Laravel codebase containing real world examples (CRUD, auth) that adheres to the [NewsManagement](https://github.com/rifqiramdhani/TestJDS-NewsManagement.git) spec and API.

This repo is functionality complete !

----------

# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/9.x/installation#your-first-laravel-project)

Clone the repository

    git clone git@github.com:rifqiramdhani/TestJDS-NewsManagement.git

Switch to the repo folder

    cd TestJDS-NewsManagement

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate
    
Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

**TL;DR command list**

    git clone git@github.com:rifqiramdhani/TestJDS-NewsManagement.git
    cd TestJDS-NewsManagement
    composer install
    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan serve


The api can be accessed at [http://localhost:8000/api](http://localhost:8000/api).

## Environment variables

- `.env` - Environment variables can be set in this file

***Note*** : You can quickly set the database information and other variables in this file and have the application fully working.

----------

# Testing API

Run the laravel development server

    php artisan serve

The api can now be accessed at

    http://localhost:8000/api

Request headers

| **Required** 	| **Key**              	| **Value**            	|
|----------	|------------------	|------------------	|
| Yes      	| Content-Type     	| application/json 	|
| Yes      	| X-Requested-With 	| XMLHttpRequest   	|
| Yes   	| Authorization    	| Laravel Passpoert |

Postman 

[![Run in Postman](https://run.pstmn.io/button.svg)](https://app.getpostman.com/run-collection/8195848-20d47fd0-7bc2-465e-aa4a-758d38317c4b?action=collection%2Ffork&source=rip_markdown&collection-url=entityId%3D8195848-20d47fd0-7bc2-465e-aa4a-758d38317c4b%26entityType%3Dcollection%26workspaceId%3Df57a78f7-6d00-4f79-bf34-f55562cb2fb6)
