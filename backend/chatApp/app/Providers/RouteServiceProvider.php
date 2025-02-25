<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

/**
 * ルートサービスプロバイダ
 * 
 * アプリケーションのすべてのルート登録を処理します。
 * web.phpとapi.phpのルートを読み込み、
 * APIのルートに正しいプレフィックスとミドルウェアを適用します。
 */
class RouteServiceProvider extends ServiceProvider
{
    /**
     * "home"ルートのパス。リダイレクト時に使用されます。
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * APIルートのパスプレフィックス
     *
     * @var string
     */
    protected $apiPrefix = 'api';

    /**
     * ルートモデルのバインディングやパターン、その他のルート設定を定義します。
     */
    public function boot(): void
    {
        // レート制限の定義
        $this->configureRateLimiting();

        // ルートの読み込み
        $this->routes(function () {
            // APIルートの読み込み
            Route::prefix($this->apiPrefix)
                ->middleware('api')
                ->group(base_path('routes/api.php'));

            // Webルートの読み込み
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * レート制限の設定
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
} 