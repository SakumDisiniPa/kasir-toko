<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MinifyHtml
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if ($response->isSuccessful() && strpos($response->headers->get('Content-Type'), 'text/html') !== false) {
            $output = $response->getContent();
            // Hapus komentar HTML (kecuali conditional IE)
            $output = preg_replace('/<!--(?!\[if).*?-->/s', '', $output);

            $search = [
                '/\>[^\S ]+/s',     // strip whitespaces after tags, except space
                '/[^\S ]+\</s',     // strip whitespaces before tags, except space
                '/(\s)+/s'          // shorten multiple whitespace sequences
            ];
            $replace = [
                '>',
                '<',
                '\\1'
            ];

            $output = preg_replace($search, $replace, $output);
            $response->setContent($output);
        }

        return $response;
    }
}
