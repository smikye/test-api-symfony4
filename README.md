# test-api-symfony4
RESTful API created with Symfony 4

It's an endpoint for API

Purpose of it to fill information about products to the Database (Name of products, expiry date, count, portions)

##### POST /api/productionCapacities
Request body example:

```
{
  "productionCapacities": [
    {
      "amount": 10,
      "productionUnit": {
        "id": 3,
        "name": "portion"
      },
      "timeUnit": {
        "id": 1,
        "name": "daily"
      },
      "productGroup": {
        "id": 56,
        "name": "sushi"
      }
    },
    {
      "amount": 500,
      "productionUnit": {
        "id": 5,
        "name": "piece"
      },
      "timeUnit": {
        "id": 2,
        "name": "weekly"
      },
      "productGroup": {
        "id": 67,
        "name": "sandwich"
      }
    }
  ]
}
```
