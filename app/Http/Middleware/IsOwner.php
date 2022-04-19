<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string $type = null (accept 'comment')
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $type)
    {
        $types = [
            'post' => 'post',
            'comment' => 'comment'
        ];
        $data = in_array($type, $types) ? $types[$type] : false;
        if ($data) {
            if ($data === 'comment' && $request->post->id != $request->comment->post_id) {
                abort(403, __('comments.messages.not_belongs_to_this_post'));
            }
            if (Auth::user()->id != $request->$data->user_id) {
                abort(403, __('global.messages.is_not_own'));
            }
        }
        return $next($request);
    }
}
