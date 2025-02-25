<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * 通知テーブルを作成するマイグレーション
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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->comment('通知を受け取るユーザーID')
                ->constrained('users')
                ->onDelete('cascade');
            $table->string('type', 50)->comment('通知タイプ');
            $table->unsignedBigInteger('notifiable_id')->comment('関連するエンティティのID');
            $table->string('notifiable_type')->comment('関連するエンティティのタイプ');
            $table->json('data')->comment('通知の詳細データ');
            $table->timestamp('read_at')->nullable()->comment('既読日時');
            $table->timestamps();
            
            // パフォーマンス向上のためのインデックス
            $table->index(['user_id', 'read_at']);
            $table->index(['notifiable_id', 'notifiable_type']);
        });
    }

    /**
     * マイグレーションを巻き戻す
     * 
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
}; 