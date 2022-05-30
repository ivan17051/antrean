<?php

namespace App\Http\Middleware;

use Closure;

class CustomizeParameter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //variabel idunitkerja dipindah dari parameter pada url ke attribute request
        $idunitkerja = $request->route()->parameters()['idunitkerja'];

        $request->attributes->add(['idunitkerja' => $idunitkerja]);
        $request->route()->forgetParameter('idunitkerja'); //dihapus dari parameter
        return $next($request);
    }
}
