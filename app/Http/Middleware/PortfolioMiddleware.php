<?php

namespace App\Http\Middleware;

use App\Models\Portfolio\Album;
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PortfolioMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Album::addGlobalScope(function (Builder $query) {
            $query->where('is_visible', true);
        });

        return $next($request);
    }
}
