# REST API for making short links

REST API with few endpoints for making short links from its full versions.
Based on Slim PHP Framework, tested with PHPUnit.

## Requirements

1. PHP8
2. Composer
3. MySQL

## Install

1) Clone repo to your machine:
```bash
$ git clone https://github.com/hinotora/short-link-api.git

$ cd short-link-api
```

2) Install dependencies via composer:

```bash
$ composer install
```

After installing dependencies composer will copy `.env.example` 
to `.env` and `.env.testing`

3) Change environment files (`.env` and `.env.testing`):

In both env files you need to set YOUR OWN database credentials, you can not set
testing env file if you will not test API.

```env
APP_NAME = 'Some cool rest api'
APP_VER = 1.0.0
APP_URL = 'http://localhost:8000/'

# Change to your environment type - 'development', 'production', 'testing'
APP_ENV = 'development'

DB_DRIVER = 'mysql'
DB_HOST = '127.0.0.1'
DB_PORT = '3306'
DB_NAME = 'database_name'
DB_USER = 'database_user'
DB_PASS = 'database_password'
```

4) Migrate tables to database (You need to create database which you set in env file)

```bash
# Creating tables
$ composer db-migrate

# Seeding database with some preset data (/database/seeds)
$ composer db-seed
```

5) Run development server
```bash
$ composer start
```

Server will be run at localhost:8000

## Endpoints

All request must be sent with `Accept` header for correct json response. 
```bash
Accept: application/json
``` 


You can see route file for full understanding of API structure (`/route/route.php`).

### Default endpoints

1. Home endpoint

```bash
GET /
```

Returns 302 HTTP and location header with redirect to version endpoint.

2. Main redirect endpoint

```bash
GET /{short-url-string}

# Example
GET https://mysite.com/AdfFDfHkjFh
```

Returns HTTP 302 and location header with redirect path. Returns HTTP 404 if link not found.

### API v1 Endpoints

Endpoints with `v1/` prefix.

1. Version

```bash
GET /v1/version
```
Returns HTTP 200 and full information about API. Response example:

```json
{
    "app_name": "APP NAME FROM ENV",
    "app_url": "http://localhost:8000/",
    "app_env": "development",
    "app_ver": "0.1.0",
    "services": {
        "database": "mysql",
        "php": "8.0.5"
    }
}
```

#### Link CRUD operation endpoints

1. Information about short link endpoint

```bash
GET /v1/link/{short-url-string}

# Example
GET https://mysite.com/v1/link/AdfFDfHkjFh
```
Returns 200 HTTP with information about short appearance as short, full links, creation date and redirects count. Will return 404 HTTP if link not found.
Response example:
```json
{
  "short": "http://localhost:8000/AdfFDfHkjFh",
  "full_link": "https://google.com/",
  "created_at": "2021-05-04 11:19:02",
  "redirects_count": "17"
}
```

2. Create new link endpoint

This request must be sent with `Content-Type` header and `PUT` method.

```bash
Accept: application/json
``` 

```bash
PUT /v1/link
```
Creates new short link with full link passed in body.

Request body:

```json
{
  "link": "https://google.com/"
}
```

Returns HTTP 201 if successfully created. Response example:

```json
{
  "short": "http://localhost:8000/FdfdDJKJhdf",
  "full_link": "https://google.com/",
  "created_at": "2021-05-04 11:19:02",
  "redirects_count": "0"
}
```

3. Remove short link from database

```bash
DELETE /v1/link/{short-url-string}

# Example
DELETE https://mysite.com/v1/link/AdfFDfHkjFh
```
Returns 204 HTTP if link deleted from server. Will return 404 if link no found.

## Testing

If you want test application via PHPUnit you need to set `.env.testing` file with test database credentials.

```shell
$ composer test
```

PHPUnit example output: 

<p align="center">
  <img alt="oops, no image" src="https://sun9-55.userapi.com/impg/HL1MDeGQ8P9qIBYdqobVDAIa3Oy-KNH9BDQZCw/1xwK9MC0iGI.jpg?size=813x239&quality=96&sign=224e18fdfbc18111a2826cbed9c486a2&type=album">
</p>

## Contribution

Pull requests are welcome!