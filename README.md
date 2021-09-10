## DCKAP Assignment 2021

## Steps for Installation: 
- Copy ```env.example``` to ```.env``` file and change database name and credentials.
- Also copy paste the ```GOOGLE_CLIENT_ID``` and ```GOOGLE_CLIENT_SECRET``` in the env file. Keys are provided in the mail (IMP for google login)
- IMP :: In order to work the demo project correctly please make sure the ```APP_URL=http://127.0.0.1:8000/```. Here after the ```8000``` there is ```forward slash```, this is important. please ensure that slash is present after the local url.
- Run ```composer install```
- Run ```php artisan key:generate```
- Run ```php artisan migrate```
- Run ```php artisan db:seed``` (Run this cmd to fill countries and cities table in database)
- Run ```npm install```
- Run ```npm run dev```
- Run ```php artisan serve```

### Note: There is no need to import external database because i have made migration for every table and also provided database seeds. But just in case anything goes wrong i have provided the ```database.zip``` file in the git itself
