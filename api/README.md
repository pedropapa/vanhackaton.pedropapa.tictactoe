## This project has been made for the 2016 Vanhackaton weekend.
It consists in a API for the game Tic-Tac-Toe and Tic-Tac-Toe Ultimate, it uses the BizLay bundles for the back-end abstraction.


## About the Bizlay bundles.
The Bizlay bundles are currently maintained by Pablo "Phackwer" Sanchez, who I had the pleasure to work here in Brasília (Brazil).

## Installation.
- Create an database (name it as you like) and an user, then grant all privileges on the new table to the new user.
- Edit app/config/parameters.yml with the database information you used in the step above.
- Clone the project repo in the folder you prefer.

After cloning the repo, navigate to the repo's "api" folder and execute the following commands:

- php bin/composer.phar install
- php app/console doctrine:schema:update --force
- php app/console server:start

You can now use the api to play the game!

## How to use it.

First of all, you need to get an session ID:
curl -c ~/cookies.txt -H "Content-Type: application/json" -X POST -d '{"dsName": "Pedro"}' http://localhost:8000/app_dev.php/api/player/saves
Response: Player's ID

Then you can play around!

### Create a grid:
curl -b ~/cookies.txt -H "Content-Type: application/json" -X POST http://localhost:8000/app_dev.php/api/grid/creates

### Join a grid:
curl -b ~/cookies.txt -H "Content-Type: application/json" -X POST -d '{"grid": {id: 10}}' http://localhost:8000/app_dev.php/api/grid/joins

### Check a position on a grid:
curl -b ~/cookies.txt -H "Content-Type: application/json" -X POST -d '{"grid": {"id": 18}, "colPos": 2, "rowPos": 1}' http://localhost:8000/app_dev.php/api/gridcheck/saves

### Simulating a real game where Foo is the winner:
- Creating players
    - curl -c ~/foo-cookies.txt -H "Content-Type: application/json" -X POST -d '{"dsName": "Foo"}' http://localhost:8000/app_dev.php/api/player/saves
        - Response: 1
    - curl -c ~/bar-cookies.txt -H "Content-Type: application/json" -X POST -d '{"dsName": "Bar"}' http://localhost:8000/app_dev.php/api/player/saves
        - Response: 2

- Foo creates a Grid and waits for Bar to join in.
    - curl -b ~/foo-cookies.txt -H "Content-Type: application/json" -X POST http://localhost:8000/app_dev.php/api/grid/creates
        - Response: {"success":true,"playerGrid":{"id":22,"isActive":true,"dtCreate":"2016-05-21T13:36:49-03:00","grid":{"id":19,"isActive":true,"dtCreate":"2016-05-21T13:36:49-03:00"},"player":{"id":13,"dtCreate":"2016-05-21T13:36:17-03:00","isActive":true,"dsName":"Foo","dsKey":"1f3b7f1e658a314e2b6f8c589ce1f037","playerGrids":[],"password":"1f3b7f1e658a314e2b6f8c589ce1f037","username":"Foo","wins":[]}}}

- Bar joins in Foo's Grid:
    - curl -b ~/bar-cookies.txt -H "Content-Type: application/json" -X POST -d '{"grid": {"id": 1}}' http://localhost:8000/app_dev.php/api/grid/joins
        - Response: {"success":true,"playerGrid":{"id":19,"is_active":true,"dt_create":"2016-05-21T13:36:49-0300","grid_players":[{"id":22,"player":{"id":13,"dt_create":"2016-05-21T13:36:17-0300","is_active":true,"ds_name":"Foo","player_grids":[],"wins":[]},"is_active":true,"dt_create":"2016-05-21T13:36:49-0300"},{"id":23,"player":{"id":14,"dt_create":"2016-05-21T13:36:22-0300","is_active":true,"ds_name":"Bar","player_grids":[],"wins":[]},"is_active":true,"dt_create":"2016-05-21T13:38:23-0300"}],"grid_checks":[]}}
       
- Foo checks position 1x1:
    - curl -b ~/foo-cookies.txt -H "Content-Type: application/json" -X POST -d '{"grid": {"id": 1}, "colPos": 1, "rowPos": 1}' http://localhost:8000/app_dev.php/api/gridcheck/saves
        - Response: {"id":19,"is_active":true,"dt_create":"2016-05-21T13:36:49-0300","grid_players":[{"id":22,"player":{"id":13,"dt_create":"2016-05-21T13:36:17-0300","is_active":true,"ds_name":"Foo","player_grids":[],"wins":[]},"is_active":true,"dt_create":"2016-05-21T13:36:49-0300"},{"id":23,"player":{"id":14,"dt_create":"2016-05-21T13:36:22-0300","is_active":true,"ds_name":"Bar","player_grids":[],"wins":[]},"is_active":true,"dt_create":"2016-05-21T13:38:23-0300"}],"grid_checks":[{"id":8,"player":{"id":13,"dt_create":"2016-05-21T13:36:17-0300","is_active":true,"ds_name":"Foo","player_grids":[{"id":22,"is_active":true,"dt_create":"2016-05-21T13:36:49-0300"}],"wins":[]},"is_active":true,"col_pos":1,"row_pos":1,"dt_create":"2016-05-21T13:39:06-0300"}]}

- Bar checks position 2x2:
    - curl -b ~/bar-cookies.txt -H "Content-Type: application/json" -X POST -d '{"grid": {"id": 1}, "colPos": 2, "rowPos": 2}' http://localhost:8000/app_dev.php/api/gridcheck/saves
        - Response: {"id":19,"is_active":true,"dt_create":"2016-05-21T13:36:49-0300","grid_players":[{"id":22,"player":{"id":13,"dt_create":"2016-05-21T13:36:17-0300","is_active":true,"ds_name":"Foo","player_grids":[],"wins":[]},"is_active":true,"dt_create":"2016-05-21T13:36:49-0300"},{"id":23,"player":{"id":14,"dt_create":"2016-05-21T13:36:22-0300","is_active":true,"ds_name":"Bar","player_grids":[],"wins":[]},"is_active":true,"dt_create":"2016-05-21T13:38:23-0300"}],"grid_checks":[{"id":8,"player":{"id":13,"dt_create":"2016-05-21T13:36:17-0300","is_active":true,"ds_name":"Foo","player_grids":[{"id":22,"is_active":true,"dt_create":"2016-05-21T13:36:49-0300"}],"wins":[]},"is_active":true,"col_pos":1,"row_pos":1,"dt_create":"2016-05-21T13:39:06-0300"},{"id":9,"player":{"id":14,"dt_create":"2016-05-21T13:36:22-0300","is_active":true,"ds_name":"Bar","player_grids":[{"id":23,"is_active":true,"dt_create":"2016-05-21T13:38:23-0300"}],"wins":[]},"is_active":true,"col_pos":2,"row_pos":2,"dt_create":"2016-05-21T13:40:34-0300"}]}
    
- Foo checks position 3x3:
    - curl -b ~/foo-cookies.txt -H "Content-Type: application/json" -X POST -d '{"grid": {"id": 1}, "colPos": 3, "rowPos": 3}' http://localhost:8000/app_dev.php/api/gridcheck/saves
        - Response: {"id":19,"is_active":true,"dt_create":"2016-05-21T13:36:49-0300","grid_players":[{"id":22,"player":{"id":13,"dt_create":"2016-05-21T13:36:17-0300","is_active":true,"ds_name":"Foo","player_grids":[],"wins":[]},"is_active":true,"dt_create":"2016-05-21T13:36:49-0300"},{"id":23,"player":{"id":14,"dt_create":"2016-05-21T13:36:22-0300","is_active":true,"ds_name":"Bar","player_grids":[],"wins":[]},"is_active":true,"dt_create":"2016-05-21T13:38:23-0300"}],"grid_checks":[{"id":8,"player":{"id":13,"dt_create":"2016-05-21T13:36:17-0300","is_active":true,"ds_name":"Foo","player_grids":[{"id":22,"is_active":true,"dt_create":"2016-05-21T13:36:49-0300"}],"wins":[]},"is_active":true,"col_pos":1,"row_pos":1,"dt_create":"2016-05-21T13:39:06-0300"},{"id":9,"player":{"id":14,"dt_create":"2016-05-21T13:36:22-0300","is_active":true,"ds_name":"Bar","player_grids":[{"id":23,"is_active":true,"dt_create":"2016-05-21T13:38:23-0300"}],"wins":[]},"is_active":true,"col_pos":2,"row_pos":2,"dt_create":"2016-05-21T13:40:34-0300"},{"id":10,"player":{"id":13,"dt_create":"2016-05-21T13:36:17-0300","is_active":true,"ds_name":"Foo","player_grids":[{"id":22,"is_active":true,"dt_create":"2016-05-21T13:36:49-0300"}],"wins":[]},"is_active":true,"col_pos":3,"row_pos":3,"dt_create":"2016-05-21T13:41:34-0300"}]}
    
- Bar checks position 3x1:
    - curl -b ~/bar-cookies.txt -H "Content-Type: application/json" -X POST -d '{"grid": {"id": 1}, "colPos": 1, "rowPos": 3}' http://localhost:8000/app_dev.php/api/gridcheck/saves
        - Response: {"id":19,"is_active":true,"dt_create":"2016-05-21T13:36:49-0300","grid_players":[{"id":22,"player":{"id":13,"dt_create":"2016-05-21T13:36:17-0300","is_active":true,"ds_name":"Foo","player_grids":[],"wins":[]},"is_active":true,"dt_create":"2016-05-21T13:36:49-0300"},{"id":23,"player":{"id":14,"dt_create":"2016-05-21T13:36:22-0300","is_active":true,"ds_name":"Bar","player_grids":[],"wins":[]},"is_active":true,"dt_create":"2016-05-21T13:38:23-0300"}],"grid_checks":[{"id":8,"player":{"id":13,"dt_create":"2016-05-21T13:36:17-0300","is_active":true,"ds_name":"Foo","player_grids":[{"id":22,"is_active":true,"dt_create":"2016-05-21T13:36:49-0300"}],"wins":[]},"is_active":true,"col_pos":1,"row_pos":1,"dt_create":"2016-05-21T13:39:06-0300"},{"id":9,"player":{"id":14,"dt_create":"2016-05-21T13:36:22-0300","is_active":true,"ds_name":"Bar","player_grids":[{"id":23,"is_active":true,"dt_create":"2016-05-21T13:38:23-0300"}],"wins":[]},"is_active":true,"col_pos":2,"row_pos":2,"dt_create":"2016-05-21T13:40:34-0300"},{"id":10,"player":{"id":13,"dt_create":"2016-05-21T13:36:17-0300","is_active":true,"ds_name":"Foo","player_grids":[{"id":22,"is_active":true,"dt_create":"2016-05-21T13:36:49-0300"}],"wins":[]},"is_active":true,"col_pos":3,"row_pos":3,"dt_create":"2016-05-21T13:41:34-0300"},{"id":11,"player":{"id":14,"dt_create":"2016-05-21T13:36:22-0300","is_active":true,"ds_name":"Bar","player_grids":[{"id":23,"is_active":true,"dt_create":"2016-05-21T13:38:23-0300"}],"wins":[]},"is_active":true,"col_pos":1,"row_pos":3,"dt_create":"2016-05-21T13:41:57-0300"}]}
    
- Foo checks position 1x3:
    - curl -b ~/foo-cookies.txt -H "Content-Type: application/json" -X POST -d '{"grid": {"id": 1}, "colPos": 3, "rowPos": 1}' http://localhost:8000/app_dev.php/api/gridcheck/saves
        - Response: {"id":19,"is_active":true,"dt_create":"2016-05-21T13:36:49-0300","grid_players":[{"id":22,"player":{"id":13,"dt_create":"2016-05-21T13:36:17-0300","is_active":true,"ds_name":"Foo","player_grids":[],"wins":[]},"is_active":true,"dt_create":"2016-05-21T13:36:49-0300"},{"id":23,"player":{"id":14,"dt_create":"2016-05-21T13:36:22-0300","is_active":true,"ds_name":"Bar","player_grids":[],"wins":[]},"is_active":true,"dt_create":"2016-05-21T13:38:23-0300"}],"grid_checks":[{"id":8,"player":{"id":13,"dt_create":"2016-05-21T13:36:17-0300","is_active":true,"ds_name":"Foo","player_grids":[{"id":22,"is_active":true,"dt_create":"2016-05-21T13:36:49-0300"}],"wins":[]},"is_active":true,"col_pos":1,"row_pos":1,"dt_create":"2016-05-21T13:39:06-0300"},{"id":9,"player":{"id":14,"dt_create":"2016-05-21T13:36:22-0300","is_active":true,"ds_name":"Bar","player_grids":[{"id":23,"is_active":true,"dt_create":"2016-05-21T13:38:23-0300"}],"wins":[]},"is_active":true,"col_pos":2,"row_pos":2,"dt_create":"2016-05-21T13:40:34-0300"},{"id":10,"player":{"id":13,"dt_create":"2016-05-21T13:36:17-0300","is_active":true,"ds_name":"Foo","player_grids":[{"id":22,"is_active":true,"dt_create":"2016-05-21T13:36:49-0300"}],"wins":[]},"is_active":true,"col_pos":3,"row_pos":3,"dt_create":"2016-05-21T13:41:34-0300"},{"id":11,"player":{"id":14,"dt_create":"2016-05-21T13:36:22-0300","is_active":true,"ds_name":"Bar","player_grids":[{"id":23,"is_active":true,"dt_create":"2016-05-21T13:38:23-0300"}],"wins":[]},"is_active":true,"col_pos":1,"row_pos":3,"dt_create":"2016-05-21T13:41:57-0300"},{"id":12,"player":{"id":13,"dt_create":"2016-05-21T13:36:17-0300","is_active":true,"ds_name":"Foo","player_grids":[{"id":22,"is_active":true,"dt_create":"2016-05-21T13:36:49-0300"}],"wins":[]},"is_active":true,"col_pos":3,"row_pos":1,"dt_create":"2016-05-21T13:42:22-0300"}]}
        
- Bar checks position 1x2:
    - curl -b ~/bar-cookies.txt -H "Content-Type: application/json" -X POST -d '{"grid": {"id": 1}, "colPos": 2, "rowPos": 1}' http://localhost:8000/app_dev.php/api/gridcheck/saves
        - Response: {"id":19,"is_active":true,"dt_create":"2016-05-21T13:36:49-0300","grid_players":[{"id":22,"player":{"id":13,"dt_create":"2016-05-21T13:36:17-0300","is_active":true,"ds_name":"Foo","player_grids":[],"wins":[]},"is_active":true,"dt_create":"2016-05-21T13:36:49-0300"},{"id":23,"player":{"id":14,"dt_create":"2016-05-21T13:36:22-0300","is_active":true,"ds_name":"Bar","player_grids":[],"wins":[]},"is_active":true,"dt_create":"2016-05-21T13:38:23-0300"}],"grid_checks":[{"id":8,"player":{"id":13,"dt_create":"2016-05-21T13:36:17-0300","is_active":true,"ds_name":"Foo","player_grids":[{"id":22,"is_active":true,"dt_create":"2016-05-21T13:36:49-0300"}],"wins":[]},"is_active":true,"col_pos":1,"row_pos":1,"dt_create":"2016-05-21T13:39:06-0300"},{"id":9,"player":{"id":14,"dt_create":"2016-05-21T13:36:22-0300","is_active":true,"ds_name":"Bar","player_grids":[{"id":23,"is_active":true,"dt_create":"2016-05-21T13:38:23-0300"}],"wins":[]},"is_active":true,"col_pos":2,"row_pos":2,"dt_create":"2016-05-21T13:40:34-0300"},{"id":10,"player":{"id":13,"dt_create":"2016-05-21T13:36:17-0300","is_active":true,"ds_name":"Foo","player_grids":[{"id":22,"is_active":true,"dt_create":"2016-05-21T13:36:49-0300"}],"wins":[]},"is_active":true,"col_pos":3,"row_pos":3,"dt_create":"2016-05-21T13:41:34-0300"},{"id":11,"player":{"id":14,"dt_create":"2016-05-21T13:36:22-0300","is_active":true,"ds_name":"Bar","player_grids":[{"id":23,"is_active":true,"dt_create":"2016-05-21T13:38:23-0300"}],"wins":[]},"is_active":true,"col_pos":1,"row_pos":3,"dt_create":"2016-05-21T13:41:57-0300"},{"id":12,"player":{"id":13,"dt_create":"2016-05-21T13:36:17-0300","is_active":true,"ds_name":"Foo","player_grids":[{"id":22,"is_active":true,"dt_create":"2016-05-21T13:36:49-0300"}],"wins":[]},"is_active":true,"col_pos":3,"row_pos":1,"dt_create":"2016-05-21T13:42:22-0300"},{"id":13,"player":{"id":14,"dt_create":"2016-05-21T13:36:22-0300","is_active":true,"ds_name":"Bar","player_grids":[{"id":23,"is_active":true,"dt_create":"2016-05-21T13:38:23-0300"}],"wins":[]},"is_active":true,"col_pos":2,"row_pos":1,"dt_create":"2016-05-21T13:42:50-0300"}]}
    
- Foo checks position 2x3 and wins the game marking all positions on the third column!
    - curl -b ~/foo-cookies.txt -H "Content-Type: application/json" -X POST -d '{"grid": {"id": 1}, "colPos": 3, "rowPos": 2}' http://localhost:8000/app_dev.php/api/gridcheck/saves