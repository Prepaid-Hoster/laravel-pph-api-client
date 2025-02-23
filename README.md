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
    public function testGetHostings()
    {
        // Automatically injects the API key from the .env file
        $client = app(ApiClient::class);
        
        // Get all hostings, with the alternative server 'fsn-01'
        $response = $client
            ->withAlt('fsn-01')
            ->get('/client/hostings');
        
        // Get the first hosting ID
        $firstHosting = $response->get('data.0.id');

        // Get the complete hosting information
        $completeHosting = $client->get("/client/hostings/{$firstHosting}");
        dd($completeHosting->all());
    }
```
