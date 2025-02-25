<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * ユーザーテーブルに追加のカラムを追加するマイグレーション
 */
return new class extends Migration
{
    /**
     * マイグレーションを実行
     * 
     * @return void
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // 既存のテーブルに新しいカラムを追加
            $table->string('status_message')->nullable()->comment('ユーザーのステータスメッセージ');
            $table->boolean('is_online')->default(false)->comment('オンライン状態');
            $table->timestamp('last_active_at')->nullable()->comment('最終アクティブ時間');
            $table->string('avatar')->nullable()->comment('プロフィール画像パス');
            $table->string('theme', 20)->default('light')->comment('テーマ設定 (light/dark)');
            $table->string('notification_sound', 50)->default('default')->comment('通知音設定');
        });
    }

    /**
     * マイグレーションを巻き戻す
     * 
     * @return void
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // 追加したカラムを削除
            $table->dropColumn([
                'status_message',
                'is_online',
                'last_active_at',
                'avatar',
                'theme',
                'notification_sound',
            ]);
        });
    }
}; 