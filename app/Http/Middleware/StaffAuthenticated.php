<?php
namespace App\Http\Middleware;
use Closure; use Illuminate\Http\Request; use Symfony\Component\HttpFoundation\Response;
class StaffAuthenticated { public function handle(Request $request, Closure $next): Response { if (! $request->session()->has('staff_user_id')) return redirect()->route('staff.login')->with('error', 'Please sign in to access staff tools.'); return $next($request); } }
