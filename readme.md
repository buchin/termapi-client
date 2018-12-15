# Term API Client
Client for consuming Term API

## Installation
composer require buchin/termapi-client dev-master

## Usage

### Recent Terms:

````
$api = new TermApi($options['token']);
$api->recent($options);
````

### Popular Terms

````
$api = new TermApi($options['token']);
$api->popular($options);
````

### Insert Keywords

````
$keyword = 'makan sehat';
$api = new TermApi($options['token']);
$api->insert($keyword);
````