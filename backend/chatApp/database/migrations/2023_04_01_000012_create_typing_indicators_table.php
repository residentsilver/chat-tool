<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * タイピングインジケーターテーブルを作成するマイグレーション
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
        Schema::create('typing_indicators', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chat_room_id')->comment('チャットルームID')
                ->constrained('chat_rooms')
                ->onDelete('cascade');
            $table->foreignId('user_id')->comment('ユーザーID')
                ->constrained('users')
                ->onDelete('cascade');
            $table->timestamp('started_at')->comment('タイピング開始時間');
            
            // 同じルーム内の同じユーザーのタイピング状態は一つのみ
            $table->unique(['chat_room_id', 'user_id']);
        });
    }

    /**
     * マイグレーションを巻き戻す
     * 
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('typing_indicators');
    }
}; 