<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * 認証済みリダイレクトミドルウェア
 * 
 * すでに認証されているユーザーが認証ページにアクセスした場合に
 * ダッシュボードにリダイレクトします。
 */
class RedirectIfAuthenticated
{
    /**
     * リクエストを処理します。
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect('/home');
            }
        }

        return $next($request);
    }
} 