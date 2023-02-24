#### Create .env file configuration (from the example env file):
```cp .env.example .env```

#### Build docker environment:
```docker-compose up -d --build```

#### Composer update:
```docker-compose run --user=1000 --rm composer update```

#### Key generate:
```docker-compose run artisan key:generate```

#### Create the database and seed (only in case you need data to a demo):
```docker-compose run --rm artisan migrate --seed```

#### Check PSR-12:
```docker-compose run --rm composer check-psr12```

#### Run Integration Tests
```docker-compose run --rm composer test tests/Integration```

### Endpoints Available:

####  Create a new bank account
```
POST - {{URL}}/api/v1/accounts

{
    "customer_id": 1,
    "balance": 100
}
```

#### Transfer By Accounts
```
POST - {{URL}}/api/v1/transfer

{
    "amount": 10,
    "from_account": "7525794266",
    "to_account": "3127526238"
}
```

#### Retrieve Balance
```
GET - {{URL}}/api/v1/accounts/balance/7525794266
```

#### Transfer Historical by Account
```
GET - {{URL}}/api/v1/transactions/7525794266
```
