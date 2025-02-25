<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * メッセージ既読テーブルを作成するマイグレーション
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
        Schema::create('message_reads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('message_id')->comment('メッセージID')
                ->constrained('messages')
                ->onDelete('cascade');
            $table->foreignId('user_id')->comment('ユーザーID')
                ->constrained('users')
                ->onDelete('cascade');
            $table->timestamp('read_at')->useCurrent()->comment('既読日時');
            $table->timestamps();

            // 同じメッセージを同じユーザーが複数回既読にすることを防ぐ
            $table->unique(['message_id', 'user_id']);
            
            // パフォーマンス向上のためのインデックス
            $table->index(['message_id', 'user_id']);
        });
    }

    /**
     * マイグレーションを巻き戻す
     * 
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('message_reads');
    }
}; 