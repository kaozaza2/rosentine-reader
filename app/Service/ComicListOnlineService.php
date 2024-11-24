<?php

namespace App\Service;

use App\Contract\Service\ComicListOnlineRepository;
use App\Contract\Service\OnlineRepositoryClient;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class ComicListOnlineService implements ComicListOnlineRepository
{
    public function __construct(
        protected OnlineRepositoryClient $client,
    ) {
        //
    }

    public function list($page = 1, $perPage = 10, $orderBy = 'id', $order = 'desc'): Generator
    {
        $params = ['orderby' => $orderBy, 'order' => $order, 'page' => $page, 'per_page' => $perPage];

        try {
            $response = $this->client->request('categories', $params);

            if (blank($response)) {
                return;
            }

            foreach ($response as $comic) {
                yield $comic;
            }
        } catch (ConnectionException $e) {
            report($e);
            throw $e;
        }
    }

    public function all($startPage = 1, $perPage = 10, $pageCount = 0, $orderBy = 'id', $order = 'desc'): Generator
    {
        $times = 0;
        while ($pageCount <= 0 || $times < $pageCount) {
            $page = $startPage + $times;

            $iterator = $this->page($page, $perPage, $orderBy, $order);

            if (!$iterator->valid()) {
                break;
            }

            foreach ($iterator as $comic) {
                yield $comic;
            }

            $times++;
        }
    }
}
