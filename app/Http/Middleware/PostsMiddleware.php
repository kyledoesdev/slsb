<?php

namespace App\Http\Middleware;

use App\Models\Post;

use Closure;
use Illuminate\Http\Request;

class PostsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {        
        abort_if(Post::find($request->route('id'))->user_id != auth()->id(), 403);

        return $next($request);
    }
}
