<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureSyncApiToken
{
    public function handle(Request $request, Closure $next): Response
    {
        $expectedToken = config('services.sync_api.token');

        if (blank($expectedToken)) {
            abort(503, 'SYNC_API_TOKEN is not configured.');
        }

        $providedToken = $request->bearerToken() ?: $request->header('X-Api-Token');

        abort_unless(hash_equals($expectedToken, (string) $providedToken), 401, 'Unauthorized');

        return $next($request);
    }
}