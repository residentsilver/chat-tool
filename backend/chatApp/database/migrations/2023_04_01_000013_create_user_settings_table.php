<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * ユーザー設定テーブルを作成するマイグレーション
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
        Schema::create('user_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->comment('ユーザーID')
                ->constrained('users')
                ->onDelete('cascade');
            $table->string('key', 50)->comment('設定キー');
            $table->text('value')->comment('設定値');
            $table->timestamps();
            
            // 同じユーザーの同じ設定キーは一つのみ
            $table->unique(['user_id', 'key']);
        });
    }

    /**
     * マイグレーションを巻き戻す
     * 
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('user_settings');
    }
}; 