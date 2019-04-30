# Techlify FileManager

A simple package for Laravel that provides a File Management RESTful API

## Installation

Install this package with composer using the following command:

```
composer require techlify-inc/file-manager
```

Run migrations

```
$ php artisan migrate
```

## Usage

You can now use the API methods from your frontend


```php
POST techlify-files/upload - uploads a file to the Laravel code base and returns the name of the file
```

There is also a full database of files that can be stored. The following information can be sent in the HTTP requests and is stored:

```php
owner_type - String, the type of model that owns this file. ex: Person if the file belongs to a person
owner_id - id of the owner object
title - a title for the file
```

Here are the Requests: 

```php
POST    techlify-files - stores a new file record
GET     techlify-files - gets a list of all stored files
PUT     techlify-files/{id} - updates a file record
GET     techlify-files/{id} - loads a single file record
DELETE  techlify-files/{id} - Deletes a file
```