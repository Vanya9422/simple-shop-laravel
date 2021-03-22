## Пошаговая установка: ( Laravel 8 Simple Shop )

## Быстрый старт 
1 Клонируйте репозиторий: `git clone https://github.com/Vanya9422/simple-shop-laravel`
2. Перейдите в папку с проеэктом  и установите зависимости: `composer install` И измените `.env.example` на `.env` поссле `php artisan storage:link`
3. После установки композитора установите зависимости npm `npm install`
4. Миграции `php artisan migrate --seed` 

## или если вам не нужна фейковая информация, в этом случае вам необходимо выполнить следующие команды:	
- `php artisan migrate`
- `php artisan db:seed --class=RoleSeeder`
- `php artisan db:seed --class=RolesAndPermissionsSeeder`
- `php artisan db:seed --class=CategorySeeder`

## email admin@example.com  password - password  
- `php artisan db:seed --class=AdminSeeder`

## В Конце
- `npm run dev` и `php artisan serve`

## ПРОЕКТ в настоящее время не завершен, остальные изменения добавлю позже по commitom




