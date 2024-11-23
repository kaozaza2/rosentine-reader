<?php

namespace App\Contract\Service;

interface OnlineRepositoryClient
{
    public function request($path, $params = []): ?array;

    public function url(string $url): static;

    public function endpoint(string $endpoint): static;

    public function rawRequest($path, $params = []): ?string;
}
