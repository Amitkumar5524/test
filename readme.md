Steps :-
After cloning this repository, go to the root folder, run the following commands,
#composer install
#composer update
	
Rename .env.example to .env and provide your database details there.
It needs a database table to perform CRUD operations on it. Run php artisan migrate to import the table.
Run
php artisan key:generate