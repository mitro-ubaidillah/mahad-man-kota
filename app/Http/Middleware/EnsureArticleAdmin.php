<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureArticleAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user) {
            abort(403);
        }

        if ($user->canManageArticles()) {
            return $next($request);
        }

        if ($user->canManageAttendance()) {
            return redirect()->route('dashboard');
        }

        abort(403);
    }
}
