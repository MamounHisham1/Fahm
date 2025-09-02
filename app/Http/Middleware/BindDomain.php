<?php

namespace App\Http\Middleware;

use App\Models\Client;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Context;
use Symfony\Component\HttpFoundation\Response;

class BindDomain
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $domainParts = explode('.', request()->getHost());
        if (count($domainParts) < 4) {
            abort(404);
        }
        
        $subdomain = $domainParts[0] ?? null;
        $client = Client::where('domain', $subdomain)->first();
        if (!$subdomain || !$client) {
            abort(404);
        }
        Context::addHidden('client', $client);
        return $next($request);
    }
}
