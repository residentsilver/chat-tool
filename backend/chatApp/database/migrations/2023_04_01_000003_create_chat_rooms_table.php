<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * チャットルームテーブルを作成するマイグレーション
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
        Schema::create('chat_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->comment('グループチャットの場合の名前');
            $table->enum('type', ['direct', 'group', 'public'])->comment('チャットルームのタイプ');
            $table->text('description')->nullable()->comment('ルームの説明');
            $table->foreignId('creator_id')->comment('作成者のユーザーID')
                ->constrained('users')
                ->onDelete('cascade');
            $table->boolean('is_private')->default(true)->comment('プライベートかどうか');
            $table->timestamps();
        });
    }

    /**
     * マイグレーションを巻き戻す
     * 
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_rooms');
    }
}; 