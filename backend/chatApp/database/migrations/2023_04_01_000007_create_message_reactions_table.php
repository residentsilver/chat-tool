<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * メッセージリアクションテーブルを作成するマイグレーション
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
        Schema::create('message_reactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('message_id')->comment('メッセージID')
                ->constrained('messages')
                ->onDelete('cascade');
            $table->foreignId('user_id')->comment('ユーザーID')
                ->constrained('users')
                ->onDelete('cascade');
            $table->string('emoji', 50)->comment('絵文字コード');
            $table->timestamps();

            // 同じメッセージに同じユーザーが同じ絵文字を複数回リアクションできないようにする
            $table->unique(['message_id', 'user_id', 'emoji']);
        });
    }

    /**
     * マイグレーションを巻き戻す
     * 
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('message_reactions');
    }
}; 