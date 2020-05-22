# Sistema de Hogar de Cuidados


![](https://i.imgur.com/Fms7gXF.png)
![](https://i.imgur.com/HyHIINn.png)

Antes de comenzar asegurate de cumplir con los requisitos minimos
```json
        "php": "^7.2.5",
        "ext-json": "*",
        "barryvdh/laravel-dompdf": "^0.8.6",
        "dompdf/dompdf": "~0.7",
        "fideloper/proxy": "^4.2",
        "fruitcake/laravel-cors": "^1.0",
        "guzzlehttp/guzzle": "^6.3",
        "intervention/image": "^2.5",
        "laravel/framework": "^7.0",
        "laravel/passport": "^9.2",
        "laravel/tinker": "^2.0",
        "maatwebsite/excel": "^3.1"
```
## Antes de comenzar
Asegurate de tener una Base de Datos "MySQL" y configurar el acceso en el archivo `.env` 
recuerda crear el archivo .env basado en `.env.example` 

## Instalación

Ejecutar en orden los siguientes comandos.

`composer install`

`php artisan migrate:refresh`

`php artisan db:seed`

`php artisan passport:install`

> Si tienes instalado __NODE__ puedes usar un atajo ejecutando `npm run reset`

Si estas en tu pc ejecutar:
`php artisan serve`

__IMPORTANTE__

Recuerda ejecutar `php artisan passport:keys --force`
