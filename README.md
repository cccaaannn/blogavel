# Blogavel

Blog application with Laravel

![GitHub top language](https://img.shields.io/github/languages/top/cccaaannn/blogavel?color=blue&style=flat-square) ![GitHub repo size](https://img.shields.io/github/repo-size/cccaaannn/blogavel?color=orange&style=flat-square) [![GitHub](https://img.shields.io/github/license/cccaaannn/blogavel?color=green&style=flat-square)](https://github.com/cccaaannn/blogavel/blob/master/LICENSE)

---

## Development
#### Install php dependencies
```shell
composer install
```
#### Install node dependencies
```shell
pnpm install && pnpm run build
```
#### Populate `.env` file with your db connection info
```shell
cp .env.example .env
```
#### Generate secret app key
```shell
php artisan key:generate
```
#### Migrate db
```shell
php artisan migrate
```
#### Run for development
```shell
composer run dev
```
#### Clear cache
```shell
php artisan config:clear
```

---

### Generate items
#### Generating the app
```shell
laravel new blogavel
```
#### Generate controller
```shell
php artisan make:controller PostController
```
#### Generate migration
```shell
php artisan make:migration create_posts_table --table=posts
```
#### Generate model (linked with migration by the name)
```shell
php artisan make:model Post
```
#### Generate middleware
```shell
php artisan make:middleware SetLocale
```

---

### Used lib versions
```text
Composer 2.7
Laravel 11
PHP 8.3
jquery 4
```

---

## Deploy with docker
### Build
```shell
docker build -f .deploy/Dockerfile -t blogavel .
```
### Run
```shell
docker run -d -p 80:80 --env-file .env blogavel 
```
### Run with compose
```shell
docker compose -f .deploy/docker-compose.yml up
```
### Run migrations from container
```shell
docker exec -t blogavel php artisan migrate
```
### Setup object storage for avatars (minio)
#### Set custom access policy to the bucket
```json
{
    "Version": "2012-10-17",
    "Statement": [
        {
            "Effect": "Allow",
            "Principal": {
                "AWS": [
                    "*"
                ]
            },
            "Action": [
                "s3:GetObject"
            ],
            "Resource": [
                "arn:aws:s3:::blogavel/public*"
            ]
        }
    ]
}
```



