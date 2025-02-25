<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

/**
 * イベントサービスプロバイダー
 * 
 * アプリケーションのイベントリスナーを登録します。
 */
class EventServiceProvider extends ServiceProvider
{
    /**
     * アプリケーションのイベントリスナーマッピング
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * アプリケーションのイベントを登録
     */
    public function boot(): void
    {
        //
    }

    /**
     * イベントとリスナーの自動検出を行うべきかを判定
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
} 