# Prepaid Hoster API Client for Laravel

This package provides a simple way to communicate with the Prepaid Hoster API. It is a wrapper around the GuzzleHttp library, which provides a simple way to communicate with servers via HTTP.

## Installation

```bash
composer require dezio/pph-api
```

## Usage

First, update your .env file with the following variables:

```dotenv
PPH_API_KEY="your-api-key"
```

Then, you can use the package like this:

```php
$client = app(ApiClient::class);
$response = $client->get('/public/products/simple');
foreach($response->array('data') as $product) {
    echo $product['name'] . PHP_EOL;
}
```
