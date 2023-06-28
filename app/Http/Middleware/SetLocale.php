<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->get('lang');

        if ($locale) {
            app()->setLocale($locale);

            // Đặt giá trị ngôn ngữ cho `locale` trong file cấu hình
            config(['app.locale' => $locale]);
        }

        return $next($request);
    }
}
