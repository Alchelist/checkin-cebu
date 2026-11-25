<?php
namespace App\Http\Middleware;
use App\Models\StaffUser; use Closure; use Illuminate\Http\Request;
class OrganizerOnly { public function handle(Request $request, Closure $next) { $staff=StaffUser::find($request->session()->get('staff_user_id')); abort_unless($staff?->role==='organizer',403,'Organizer access is required.'); return $next($request); } }
