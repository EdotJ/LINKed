# LINKed

Fundamentals of Information Systems Group Project

Project setup:

WITH DOCKER:

1. Install docker:
     [Ubuntu](https://docs.docker.com/install/linux/docker-ce/ubuntu/)
     |
     [Windows](https://docs.docker.com/docker-for-windows/install/)

2. Install [docker-compose](https://docs.docker.com/compose/install/)
3. Clone the project with `git clone https://github.com/EdotJ/LINKed/` and make it your working directory
4. Copy `docker-compose.yml.dist`, name it `docker-compose.yml` and copy `api/.env.example` with the name `api/.env`
5. You'll need to generate a key for the Laravel application. If you have Composer, just run `php artisan key:generate` in the `api` folder. If not continue. If you generated the key, go to step 9
6. Run `docker-compose up`
7. Run `docker ps` to find out the container name. Search for container `PROJECTNAME_php_1`
8. Generate key in the container with `docker exec -it PROJECTNAME_php_1 php artisan key:generate`
9. Restart `docker-compose` if needed. 
10. Access the project through `localhost`

WITHOUT DOCKER:

1. Make sure you have `php`, `composer`, `node`, `npm` installed locally.
2. Set up a MySQL (MariaDB) database for the project. 
[WINDOWS](https://mariadb.com/kb/en/library/installing-mariadb-msi-packages-on-windows/) | [UBUNTU](https://computingforgeeks.com/install-mariadb-10-on-ubuntu-18-04-and-centos-7/)
3. Clone the project with `git clone https://github.com/EdotJ/LINKed/` and make `api` your working directory
4. Make sure database settings in `.env` are the same as the settings you configured when setting up the database.
5. Run `composer install` to install PHP dependencies.
6. Run `npm install` to install NPM (Node Package Manager) dependencies.
7. Run `npm run dev && npm run watch` to compile assets and run asset watching for recompilation on edit. (SASS/JS)
8. Run `php artisan serve` and click the `localhost` link provided in the output. You should see the homepage.

NOTES:

* If Laravel can't connect to the database, check the `.env` database settings. They should be the same as in `docker-compose.yml`.