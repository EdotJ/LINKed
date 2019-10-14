# LINKed

Fundamentals of Information Systems Group Project

Project setup:

1. Install docker:
     [Ubuntu](https://docs.docker.com/install/linux/docker-ce/ubuntu/)
     |
     [Windows](https://docs.docker.com/docker-for-windows/install/)

2. Install [docker-compose](https://docs.docker.com/compose/install/)
3. Clone the project with `git clone https://github.com/EdotJ/LINKed/` and make it your working directory
4. Copy `docker-compose.yml.dist`, name it `docker-compose.yml` and copy `.env.example` with the name `.env`
5. You'll need to generate a key for the Laravel application. If you have Composer, just run `php artisan key:generate` in the `api` folder. If not continue. If you generated the key, steps 7
6. Run `docker-compose up`
7. Run `docker ps` to find out the container name. Search for container `PROJECTNAME_php_1`
8. Generate key in the container with `docker exec -it PROJECTNAME_php_1 php artisan key:generate`
9. Restart `docker-compose` if needed. 
10. Access the Laravel side through `localhost:3000` and Front-end through `localhost` 

If Laravel can't connect to the database, check the `.env` database settings. They should be the same as in `docker-compose.yml`.