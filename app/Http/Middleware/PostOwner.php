<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PostOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $currentUsers = Auth::user();
        $post = Post::findOrFail($request->id);

        if ($post->author != $currentUsers->id) {
            return view(['message' => 'Data Not Found'], 404);
        }

        return $next($request);
    }
}
