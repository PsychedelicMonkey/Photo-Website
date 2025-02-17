<?php

namespace App\Http\Middleware;

use App\Enums\PostStatus;
use App\Models\Blog\Post;
use Carbon\Carbon;
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlogMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Post::addGlobalScope(function (Builder $builder) {
            $builder
                ->where('status', PostStatus::Published)
                ->whereDate('published_at', '<=', Carbon::now());
        });

        return $next($request);
    }
}
