<?php

namespace App\StaticCaching;

use Illuminate\Http\Response;
use Statamic\StaticCaching\Replacer;

class CacheHeaderReplacer implements Replacer
{
    public function prepareResponseToCache(Response $response, Response $initial): void
    {
        $response->headers->set('X-Static-Cache', 'true');
    }

    public function replaceInCachedResponse(Response $response): void
    {
        $response->headers->set('X-Static-Cache', 'true');
    }
}
