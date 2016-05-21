## This project has been made for the 2016 Vanhackaton weekend.
It consists in a API for the game Tic-Tac-Toe and Tic-Tac-Toe Ultimate, it uses the BizLay bundles for the back-end abstraction.


## About the Bizlay bundles.
The Bizlay bundles are currently maintained by Pablo "Phackwer" Sanchez, who I had the pleasure to work here in Brasília (Brazil).

## Installation.
- Create an database (name it as you like) and an user, then grant all privileges on the new table to the new user.
- Edit app/config/parameters.yml with the database information you used in the step above.
- Clone the project repo in the folder you prefer.

After cloning the repo, navigate to the repo's "api" folder and execute the following commands:
php bin/composer.phar install
php app/console doctrine:schema:update --force
php app/console server:start

Here you go, you can now use the api to play the game!

Some examples:

First of all, you need to get an session ID:
curl -c ~/cookies.txt -H "Content-Type: application/json" -X POST -d '{"dsName": "Pedro"}' http://localhost:8000/app_dev.php/api/player/saves
Response: Player's ID

Then you can play around