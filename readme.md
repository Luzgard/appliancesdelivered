## Instructions ###

Clone repository
* `git clone https://github.com/vnponce/appliancesdelivered.git projectname`

Change to project folder
* `cd projectname`

Run composer to install all dependencies
* `composer install`

Rename *.env-example* to *.env*

Generate key to *.env* file
* `php artisan key:generate`

Create a database and inform *.env*

```
DB_CONNECTION=mysql     // Type of connection to your database
DB_HOST=127.0.0.1       // Host where database exists
DB_PORT=3306            // Communication port
DB_DATABASE=db_name     // Database name
DB_USERNAME=root        // User who can connect to database
DB_PASSWORD=secret      // Users password
```

To create and populate tables
* `php artisan migrate —seed` 

To start the app on http://localhost:8000/
* `php artisan serve`

### Users ###
Project seed two users.

Abel Ponce
* Email:  `abel@square1.io`
* Password: `secret`

Juan Diego Morales
* Email:  `juan@square1.io`
* Password: `secret`