<?php
/**
 * File: ApiClient.php
 * Created: Feb 2025
 * Project: PPH-Virt-Manager
 */

namespace DeZio\PrepaidHoster\API\Client;

use Context;
use Http;
use Illuminate\Support\Fluent;

class ApiClient
{
    private array $config = [];

    public function __construct(array $config)
    {
        $this->config = $config;
    }


    public function setApiKey(string $apiKey): self
    {
        $this->config['api_key'] = $apiKey;
        return $this;
    }

    public function withAlt(string $alt): self
    {
        $altUrls = $this->config['alternative'] ?? [];
        if(isset($altUrls[$alt])) {
            $this->config['base_url'] = $altUrls[$alt];
        } // if end
        else {
            $this->config['base_url'] = $alt;
        } // else end
        return $this;
    }

    private function collectHeaders()
    {
        $mainHeaders = [
            "Authorization" => "Bearer {$this->config['api_key']}",
            "Content-Type"  => "application/json",
            "X-Key"         => $this->config['internal_key'],
            "Accept"        => "application/json",
        ];
        if ($customHeaders = $this->config['custom_headers'] ?? "") {
            $mainHeaders = array_merge($mainHeaders, $customHeaders);
        }

        return collect($mainHeaders)->filter()->all();
    }

    private function acceptsJson(): bool
    {
        $headers = $this->collectHeaders();

        return str($headers['Accept'] ?? '')->contains('json');
    }

    private function call(string $method, string $url, array $params = []): mixed
    {
        $http = Http::withOptions([
            'base_uri' => $this->config['base_url'],
            'headers'  => $this->collectHeaders(),
        ]);

        Context::add('api_call', [
            'method' => $method,
            'url'    => $url,
            'params' => $params,
        ]);

        $response = $http->{$method}($url, $params);
        return $this->acceptsJson() ? $response->json() : $response->body();
    }

    public function get(string $url, array $params = []): Fluent
    {
        return new Fluent($this->call('get', $url, $params));
    }

    public function post(string $url, array $params = []): Fluent
    {
        return new Fluent($this->call('post', $url, $params));
    }
}
