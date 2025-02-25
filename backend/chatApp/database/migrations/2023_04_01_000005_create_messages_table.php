<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * メッセージテーブルを作成するマイグレーション
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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chat_room_id')->comment('チャットルームID')
                ->constrained('chat_rooms')
                ->onDelete('cascade');
            $table->foreignId('sender_id')->comment('送信者ID')
                ->constrained('users');
            $table->unsignedBigInteger('parent_id')->nullable()->comment('親メッセージID（スレッド機能）');
            $table->text('content')->nullable()->comment('メッセージ内容');
            $table->boolean('is_deleted')->default(false)->comment('削除フラグ');
            $table->timestamp('deleted_at')->nullable()->comment('削除日時');
            $table->timestamps();
            
            // パフォーマンス向上のためのインデックス
            $table->index(['chat_room_id', 'created_at']);
        });

        // 自己参照の外部キー制約を追加（テーブル作成後）
        Schema::table('messages', function (Blueprint $table) {
            $table->foreign('parent_id')
                ->references('id')
                ->on('messages')
                ->onDelete('set null');
        });
    }

    /**
     * マイグレーションを巻き戻す
     * 
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
}; 