## Change name of database in /Aplikacia/BackEnd/.env
This is just example \
**DB_DATABASE=BackEnd_UKF**

## Make migration
``` console
php artisan make:migration migration_name
```

## Make model
``` console
php artisan make:model model_name
```

## Make model and migration in one command
``` console
php artisan make:model ModelName -m
```
or
``` console
php artisan make:model ModelName --migration
```

## Inspect model
``` console
php artisan model:show ModelName
```

## ER diaram generator from
https://github.com/beyondcode/laravel-er-diagram-generator
``` console
php artisan generate:erd output.png
```
## Make controller
``` console
php artisan make:controller NameController
```
**This will make basic crud operations for your model and use your model.**
``` console
php artisan make:controller NameController --model=NameModel
```

## Common naming practices
**Tables should be singluar, lower-case and use "_".**\
**Models should be singluar and first letter capital.**\
**In model relationship "belongs to" should be singluar lower case.**\
**In model relationship "has many" should be pluar lower case.**