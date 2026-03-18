<?php

namespace Noo\SafeEntities;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class Middleware
{
    /**
     * Restore configured entities and apply replacements in the response body.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (! $this->isGetRequest($request) || ! $this->isHtmlResponse($response)) {
            return $response;
        }

        $content = $response->getContent();
        $content = (string) SafeEntities::renderHtml($content);
        $response->setContent($content);

        return $response;
    }

    private function isGetRequest(Request $request): bool
    {
        return $request->method() === 'GET';
    }

    private function isHtmlResponse(Response $response): bool
    {
        return Str::of($response->headers->get('content-type'))->contains('text/html');
    }
}
