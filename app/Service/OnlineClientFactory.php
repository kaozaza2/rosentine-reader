<?php

namespace App\Service;

use App\Contract\Service\OnlineRepositoryClient;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class OnlineClientFactory implements OnlineRepositoryClient
{
    protected string $url;

    protected string $endpoint;

    protected array $headers;

    public function __construct(array $options = [])
    {
        $options = array_merge_recursive(config('manga.source', []), $options);

        $this->url = $options['url'];
        $this->endpoint = $options['endpoint'];
        $this->headers = $options['headers'] ?? [];
    }

    public function request($path, $params = []): ?array
    {
        try {
            $response = Http::baseUrl(str($this->url)->finish('/'))
                ->withHeaders($this->headers)
                ->get(str($this->endpoint)->finish('/')->append($path), $params);

            if ($response->successful()) {
                return $response->json();
            }
        } catch (ConnectionException $e) {
            report($e);

            throw $e;
        }

        return null;
    }

    public function rawRequest($path, $params = []): ?string
    {
        try {
            $response = Http::baseUrl(str($this->url)->finish('/'))
                ->withHeaders($this->headers)
                ->get(str($path)->finish('/'), $params);

            if ($response->successful()) {
                return $response->body();
            }
        } catch (ConnectionException $e) {
            report($e);

            throw $e;
        }

        return null;
    }

    public function url(string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function endpoint(string $endpoint): static
    {
        $this->endpoint = $endpoint;

        return $this;
    }
}
