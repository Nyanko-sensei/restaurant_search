# Programing task for job application

## Requirements
1. Use PHP 7.x
2. This project should be able to run by running a PHP server on port 8000 reaching it by
localhost:8000
3. Import the data provided in the JSON file
Write an API in PHP that handles a request to search for relevant restaurants based on:
   * Name of restaurant
   * Cuisine
   * City
   * Distance from me
   * Free text
  
### Goal
While the task itself should be easy to solve, the goal of this task is to show us how you
structure your code, what principles do you use, what kind of strategy that has driven your
development.

## Running project
Testing data ('backend-data.json') should be added to `data`  folder.  
There  is docker setup in docker dir.  It can be run by: 
```
cd docker
sudo docker-compose up -d
```

After project can be run reached by:
>localhost:8000

Accessing terminal in container can be done  by:
```
sudo docker exec -ti -u  laradock  test_workspace_1 bash
```

Restaurants can view on:
>localhost:8000/restaurants

search can be accomplished by get params:
>localhost:8000/restaurant?name=Sto

## Running tests
Test are in `<project_dir>/tests`.
They can be run in containers terminal by:
```
vendor/bin/phpunit
```

### Supported searches/filters
#### name
Searches by restaurant name
exapmple:
>?name='Sto'

#### cuisine
Searches by cuisine
example:
>?cuisine=Hamburgare

#### city
Searches by city
example:
>?city=Sto

#### free_text
Searches in client key, restaurant name, city, cuisine
example:
>?free_text=Sto

### distance
Searches restaurants in given distance,fromgiven position
example:
>?lat=59&long=18&distance=100000

## Project structure
* config => main settings for set upping project
  * interfaceImplementationMap.php  => place where we register classes for auto wiring
  * routes.php => place where we register routes
* data => place where we put json data file
* docker => docker setup
* public => dir to which server should point
* src => main code dir
* tests => place where we put tests
* vendor => place,we composer puts dependencies  

