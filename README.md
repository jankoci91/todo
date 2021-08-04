# TODO

## Setup

- `touch ./docker/php/data/.bash_history`

- `docker-compose up -d`

- `docker-compose exec php bash`

- `composer install`

- `bin/console do:mi:mi`

## Tests

`bin/phpunit`

## Usage

http://localhost:8080

POST /tasks
```
{
    "text": "Lorem ipsum",
    "checked": false
}
```

GET /tasks

PUT /tasks/1
```
{
    "text": "Lorem ipsum",
    "checked": true
}
```

DELETE /tasks/1
