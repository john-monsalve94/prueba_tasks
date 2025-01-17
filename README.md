# AMTES DE CORRER EL PROYECTO
## COMANDOS
1. instalar dependencia: composer install
2. copiar el .env.example - linux cp .env.example .env
3. generar app_key - php artisan key:generate
4. correr migraciones y seeders - php artisan migrate --seed
5. para  que ek middleware funcione tenemos que generar un token con el comando - php artisan jwt:secret
