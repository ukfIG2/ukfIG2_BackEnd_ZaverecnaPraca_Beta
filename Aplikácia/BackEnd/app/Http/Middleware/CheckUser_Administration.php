<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Administration;

class CheckUser_Administration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $userModel = get_class($user);

        Log::info('Authenticated user model: ' . $userModel);

        if ($user instanceof Administration) {
            Log::info('User is an Administration. Proceeding with request.');
            return $next($request);
        }

        Log::info('User is not an Administration. Blocking request.');
        abort(403, 'Unauthorized action.');

        return $next($request);
    }
}
?>