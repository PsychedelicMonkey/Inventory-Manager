#!/bin/bash

DIR='./DocumentRoot/assets/profilepics'
mkdir ./DocumentRoot/assets $DIR
sudo chmod 777 $DIR

docker exec -it php-apache php -f sql/create_database.php

echo "===================================================================================================="
echo "Login to the application using the following credentials:"
echo "Username: admin"
echo "Password: password"
echo "===================================================================================================="