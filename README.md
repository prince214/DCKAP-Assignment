## DCKAP Assignment 2021

## Steps for Installation: 
- Copy ```env.example``` to ```.env``` file and change database name and credentials.
- Also copy paste provided in the mail the ```GOOGLE_CLIENT_ID``` and ```GOOGLE_CLIENT_SECRET``` (IMP for google login)
- IMP :: In order to work the demo project correctly please make sure the ```APP_URL=http://127.0.0.1:8000/```. Here after the ```8000``` there is ```forward slash```, this is important. please ensure that slash is present after the local url.
- Run ```composer install```
- Run ```php artisan key:generate```
- Run ```php artisan migrate```
- Run ```npm install```
- Run ```npm dev run```
- Run ```php artisan serve```
