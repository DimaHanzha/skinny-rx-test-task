# Laravel API with Job Queue, Database, and Event Handling

## Objective

This project is a REST API built with Laravel that demonstrates proficiency with Laravel's job queues, database operations, and event handling. It includes a single API endpoint to handle submissions, processes data asynchronously using job queues, and logs events upon successful data saving.

## Setup Instructions

### 1. Clone the Repository

```
https://github.com/DimaHanzha/skinny-rx-test-task.git

cd skinny-rx-test-task
```

### 2. Build docker image and run container

```
comoser install
```

### 3. Build docker image and run container

```
docker compose up -d
```

### 4. Execute webserver container

```
docker exec -it <container-name> sh
```

### 5. Run migration and start queue work

```
php artisan migrate

php artisan queue:work
```

### 6. Test run

```
php artisan test
```

### 7. For testing endpoint you need to use Postman

```
Send post request to http://localhost:<you port>/v1/submissions with body

{
      "name": "John Doe",
      "email": "john.doe@google.com",
      "message": "This is a test message."
}

Add to Headers 

Accept: application/json
Content-Type: application/json
```
### Env file variable need to set

- DB_HOST=database

- DB_PORT=3306 if you need to use a different port, change in [docker-compose.yaml](docker-compose.yaml)

- QUEUE_CONNECTION=database

- CACHE_STORE=file

- DB_CONNECTION=mysql


Other env variables with a value that you can take from the [.env.example](.env.example)
