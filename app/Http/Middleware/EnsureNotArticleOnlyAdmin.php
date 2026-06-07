<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureNotArticleOnlyAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && $user->canManageArticles() && ! $user->canManageAttendance()) {
            return redirect()->route('mahad-admin.dashboard');
        }

        return $next($request);
    }
}
