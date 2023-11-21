
# Trackify

A B2B solution to track and monitor traffic activity on your application. This application logs unique visitors and update their interaction stages. It provides a comprehensive API to log and update visits as well as a detailed dashboard to view real time statistics.



## Environment Variables

To run this project, you will need to update the following environment variables to your .env file

`DB_DATABASE=[your_database_name]`


## Installation

After cloning the project run

```bash
  composer install
  npm install
  php artisan key:generate
  npm run build
  php artisan migrate
```
    
## Deployment

You should the following commands on each Deployment

```bash
  composer install
  npm install
  npm run build
  php artisan migrate
```
Run this command to seed 1000 visits
```bash
  php artisan db:seed --class=VisitsTableSeeder
```

## Additional Commands

You should the following commands on each Deployment

```bash
  composer install
  npm install
  npm run build
  php artisan migrate
```
Run this command to seed 1000 visits
```bash
  php artisan db:seed --class=VisitsTableSeeder
```

## API Reference

#### Track visit
Logs a visit for the unique external ID

```http
  GET /api/v1/track-visit/${externalId}
```

| Parameter     | Type        | Location        | Description           |
| :--------     | :-----------  | :------  | :------------------------- |
| `bearer token` | `string` | `header` | **Required**. Api token generated from the app |
| `externalId` | `string` | `URI` | **Required**. external id to log |

#### Update Stage
Logs a visit for the unique external ID

```http
  PATCH /api/v1/update-stage
```

| Parameter     | Type           | Location        | Description                |
| :--------     | :----------  | :---------------  | :------------------------- |
| `bearer token` | `string` | `header` | **Required**. Api token generated from the app |
| `externalId`      | `string` | `body` | **Required**. external id to update |
| `stage`      | `string` | `body` | **Required**. See valid stages |

| Valid Stages |
| :-------- |
| `visited` |
| `viewed_page` |
| `searched` |
| `contacted` |
| `completed` |
| `cancelled` |
| `declined` |


## Running Tests

To run tests, run the following command

```bash
  php artisan test
```

