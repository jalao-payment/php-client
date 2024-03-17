# Jalao PHP Client

This is a PHP client for the Jalao API. It provides a simple way to interact with the Jalao API.
More information about the Jalao API can be found [here](https://doc.jalao.com/).

## Usage
You must create a new Jalao client first:
```php
$jalaoClient = new \Jalao\Client([
    'endpoint' => 'live',
    'token' => 'FF7uRSWW5jxJ4yVkJ8fp7pY8Mqtu5x8F8bKEOsGRjrpBfd4c9qla5ePRoEQi6zCf'
]);
```

The `endpoint` can be either `live` or `sandbox`. The `token` is the API token provided by Jalao.

To do a request, you must use a method of a collection as specified in the API documentation. For example, to create a charge, you can use the `charge` method of the `transactions` collection by providing the required parameters and optionally some options.
The parameters are defined in the API documentation and the options are the following:
- `project_id`: the project ID to use for the request (will be mapped as 'X-Project-Id' in the request headers)



## Examples

### Create a customer
To create a customer, you can use the `create` method of the `customers` object:
```php
$jalaoClient->customer->create([
    'email' => 'test@test.com',
    'first_name' => 'Test',
    'last_name' => 'Test'
], [
    'project_id' => '1cbd5193-a8f6-40b0-b9a9-9a62765f3b2f'
]);
```

The response (if there is no error) will be an array containing the customer data as described in the API documentation. For example, if the customer is created successfully, the response will be something like this:
```php
[
  "email" => "test@test.com"
  "first_name" => "Test"
  "last_name" => "Test"
  "additional_data" => array:3 [
    "identifier" => null
    "phone_number" => null
    "address" => array:5 [
      "city" => null
      "country" => null
      "line1" => null
      "line2" => null
      "postcode" => null
    ]
  ]
  "tags" => []
  "project_id" => "1cbd5193-a8f6-40b0-b9a9-9a62765f3b2f"
  "id" => "7ce88191-2605-4604-9b2a-d9fb2c5a01a3"
  "updated_at" => "2024-01-17T17:05:08.000000Z"
  "created_at" => "2024-01-17T17:05:08.000000Z"
  "full_name" => "Test Test"
  "total_spent" => 0
  "card_last_digits" => null
  "last_payment_date" => null
]
```

### Create a charge
To create a charge, you can use the `charge` method of the `transactions` object:
```php
$jalaoClient->transaction->charge([
    'amount' => 100,
    'currency' => 'EUR',
    'description' => 'Test charge'
],
[
    'project_id' => '1cbd5193-a8f6-40b0-b9a9-9a62765f3b2f'
]);
```

Please refer to the [Jalao API documentation](https://doc.jalao.com/) for more information about the available methods and parameters.
