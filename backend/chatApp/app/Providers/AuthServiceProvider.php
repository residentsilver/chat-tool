<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

/**
 * 認証サービスプロバイダー
 * 
 * アプリケーションの認証とポリシーを登録します。
 */
class AuthServiceProvider extends ServiceProvider
{
    /**
     * アプリケーションのポリシーマッピング
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * サービスの登録
     */
    public function register(): void
    {
        //
    }

    /**
     * サービスの起動
     */
    public function boot(): void
    {
        $this->registerPolicies();

        //
    }
} 