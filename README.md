# docker-instant-wp

 Docker local environment configuration for Wordpress + MySQL + phpMyAdmin


 The docker-compose.yml is used for local environment configuration of Docker containers. It specifies which image should Docker use for container, it configure connection between Wordpress and database and set-up volumes for persistent data.

 Our environment will have 3 containers (wordpress, database, phpmyadmin). This is all we need to easily deploy finished website to production site. The changes in files are seen in our hosts folder and we can easily dump database and import it on production site.


 Check out whole article on how to setup your Docker local environment for Wordpress + MySQL + phpMyAdmin on medium
 ---


 HOW TO START:

 Open terminal - navigate to project folder - run docker environment with: docker-compose up - that is it


 - website is at localhost:8080
 - phpMyAdmin is at localhost:8181