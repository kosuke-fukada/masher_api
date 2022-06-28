<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AjaxOnly
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return void
     */
    public function handle(Request $request, Closure $next)
    {
        abort_unless($request->ajax(), 404);

        return $next($request);
    }
}
