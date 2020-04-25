#!/bin/bash

mkdir assets assets/profilepics

docker exec -it php-apache php -f sql/create_database.php