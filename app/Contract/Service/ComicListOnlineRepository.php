<?php

namespace App\Contract\Service;

use Generator;

interface ComicListOnlineRepository
{
    public function list($page = 1, $perPage = 10, $orderBy = 'id', $order = 'desc'): Generator;

    public function all($startPage = 1, $perPage = 10, $pageCount = 0, $orderBy = 'id', $order = 'desc'): Generator;
}
