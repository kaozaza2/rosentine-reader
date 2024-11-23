<?php

namespace App\Contract\Service;

use Generator;

interface ComicOnlineRepository
{
    public function get($page = 1, $perPage = 10, $order = 'id', $orderBy = 'desc'): Generator;
}
