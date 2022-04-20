<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CommentBelongsToPost
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
        if ($request->post->id != $request->comment->post_id) {
            abort(403, __('global.messages.not_belongs_to_this_post'));
        }
        return $next($request);
    }
}
