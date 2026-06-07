<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAttendanceAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user) {
            abort(403);
        }

        if ($user->canManageAttendance()) {
            return $next($request);
        }

        if ($user->canManageArticles()) {
            return redirect()->route('mahad-admin.dashboard');
        }

        abort(403);
    }
}
