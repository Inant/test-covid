<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckDataPemeriksaan
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $cookie = json_decode($request->cookie('lara_list'), true);
        if (empty($cookie['data_pemeriksaan'])) {
            return redirect()
                ->route('pemeriksaan.create')
                ->with('error', 'Data Pemeriksaan Belum diisi')
                ;
        }

        return $next($request);
    }
}
