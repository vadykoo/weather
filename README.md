Postman collection
https://www.getpostman.com/collections/09deb27db9c4349f6139
and in the root folder

[![Watch the video](https://siamscuba.com/wp-content/uploads/2015/09/WatchVideo-1.gif)](https://youtu.be/D-_5DoX7ymM)

## How to deploy
composer install

copy yourself a .env file

Create a database

change database info and update tokens

DB_USERNAME = 
DB_PASSWORD = 

IPINFO_SECRET=
OPENWEATHER_SECRET=

php artisan migrate --seed

php artisan serve

## About Task

Test assignment for the position of PHP developer

Weather data retrieval service

Create a REST API application to get weather data

Conditions:

1. Receiving weather is available only to authorized users.
Implement authorization capability using JWT. The token must be generated based on the username and password.

Request format:
POST / api / auth / login

Options:
login - string
password - string

Response format:
{
   "token": "token_string"
}

2. Implementation of the weather receiving functionality.

Request format:
GET / api / weather? City = {$ city} & date = {$ date}

Options:
date - optional
city ​​- optional

Response format:
{
   "temp": 6.82
   "pressure": 1028,
   humidity: 93
}

The temperature should be in degrees Celsius.
If city is missing in the request, return weather information, determining the current location by the ip from which the request was made.
If the date parameter is missing in the request, return information about the current weather.

3. Write a seeding with n number of users. User data: name, login, password. The login must be unique.


Technical requirements:

1. The application must be written using the Laravel framework
2. The results of responses must be presented in JSON format
3. The result of the task should be posted on github

Recommendations for the test task:

To determine the user's location, use the ipinfo.io service.
Use the openweathermap service to get weather information.
