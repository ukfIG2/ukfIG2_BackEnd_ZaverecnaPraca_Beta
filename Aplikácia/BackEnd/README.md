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

