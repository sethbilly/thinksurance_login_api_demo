# Simple Login API
 
 **Technology**

- Lumen Framework 8.0

- Docker

- PHP 7.4

- Data was persisted with MySql 5.6
    - Connection details:
        - port: `3306`
        - MYSQL_DATABASE: `loginapi_db`
        - MYSQL_USER: `loginapi`
        - MYSQL_PASSWORD: `loginapi_thinksurance`

- Testing was done with PHPUnit


 **Main Packages**

- This can be found in the composer.json in the root directory of the project

- PHPUnit =>7.0 was used for testing


 **How to run**
- Clone for Github and Copy Environment Variables
```bash
git clone git@github.com:sethbilly/loginapi.git

cd loginapi

cp .env.example .env
```

- To start the application server and run tests, run the following from root of application:
```bash
sh ./start.sh
```
- Tests can also be run separately by running[from the project's root folder] "composer test" when the docker container is up and running

- In case the start.sh does not seem to be runnable, use chmod 400 start.
- 
- To run project without docker , follow these steps(Assuming composer is already installed);
```bash
composer install
cp .env.example .env  [Change database connections in .env]
php artisan migrate --seed
php -S localhost:8000 -t ./public
composer test
```


 **Features**

The API conformed to REST practices and  provide the following functionality:
- Authenticate User
- Register User
- Assign User Role


 **Endpoints**

```
    models： user, role, permission
    
    post   /api/register                                 register a new account
    post   /api/login                                    authenticate user account and return roles with permissions
    post   /api/roles/assign                             assign role to user account
    
```
- The postman documentation link is at https://documenter.getpostman.com/view/6964961/TVYGbcfF

- This application conform to the specified endpoint structure given and return the HTTP status codes appropriate to each operation.  


 **Environment Variables**

- These are found in .env of the root directory of the project

- For production deployments , DEBUG should be switched to 'false' and APP_ENV changed to 'production'


 **Data Migration**

- This is found in database/migrations/ in the root directory of the project


 **Routes**

- This can be found in routes/routes.php in the root directory of the project
