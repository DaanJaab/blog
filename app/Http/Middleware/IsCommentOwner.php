<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsCommentOwner
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
        if (Auth::user() && Auth::user()->id === $request->comment->user_id) {
            if ($request->post->id === $request->comment->post_id) {
                return $next($request);
            }
            return redirect()->route('blog.index')->with('message', ['danger', __('comments.messages.not_belongs_to_this_post')]);
        }
        return redirect()->route('blog.index')->with('message', ['danger', __('comments.messages.is_not_own')]);
    }
}
