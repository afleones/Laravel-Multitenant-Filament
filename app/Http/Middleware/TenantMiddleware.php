<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Tenant;
use Illuminate\Support\Facades\DB;

class TenantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $tenant = Tenant::where('subdomain', $request->getHost())->first();
        if (!$tenant) {
            abort(404);
        }

        config(['database.connections.tenant.database' => $tenant->database_name]);
        DB::purge('tenant');

        return $next($request);
    }
}
