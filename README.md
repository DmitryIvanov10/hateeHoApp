# hatee-ho-app
Simple test task

## Versions:
**Symfony 4.4**

**PHP 7.4.6**

## Install and run:
1. ```git clone git@github.com:DmitryIvanov10/hateeHoApp.git```
2. ```cd hateeHoApp```
3. ```docker-compose up --build -d```
3. ```docker exec -it php sh```
4. Inside php container: ```composer install```
5. Test the app from the container by running ```php bin/console app:hatee-ho```
6. Run tests with ```php bin/phpunit```
