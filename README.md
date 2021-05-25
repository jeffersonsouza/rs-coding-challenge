## How to Run the project

The project was done with latest version of Symfony framework. To get start you can run `docker-compose up -d` (if you have `docker` and `docker-compose` up and running). 
In case you have no docker to run it, you will need to change the DB credentials in `.env` file to your actual credentials.

After that you can start the application with symfony command `symfony server:start`. 

To then be able to see actual data, you need to run the commands: `php bin/console doctrine:migrations:migrate` and `php bin/console doctrine:fixtures:load` 
to start database structure (migrate) and also to seed with dummy data.

After that you can access the created resources at the url [https://localhost:8000/stations/](https://localhost:8000/stations/) and follow the flow.
