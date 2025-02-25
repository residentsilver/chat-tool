<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * チャットルームユーザー中間テーブルを作成するマイグレーション
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
        Schema::create('chat_room_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chat_room_id')->comment('チャットルームID')
                ->constrained('chat_rooms')
                ->onDelete('cascade');
            $table->foreignId('user_id')->comment('ユーザーID')
                ->constrained('users')
                ->onDelete('cascade');
            $table->string('role', 20)->default('member')->comment('ルーム内の役割 (admin, member)');
            $table->timestamp('joined_at')->useCurrent()->comment('参加日時');
            $table->timestamp('last_read_at')->nullable()->comment('最後に読んだ時間');
            $table->timestamps();

            // 同じルームに同じユーザーが複数回参加することを防ぐ
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
        Schema::dropIfExists('chat_room_users');
    }
}; 