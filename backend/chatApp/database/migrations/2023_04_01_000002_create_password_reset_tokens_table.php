<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * パスワードリセットトークンテーブルを作成するマイグレーション
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
        // テーブルが存在しない場合のみ作成する
        if (!Schema::hasTable('password_reset_tokens')) {
            Schema::create('password_reset_tokens', function (Blueprint $table) {
                $table->string('email')->primary();
                $table->string('token');
                $table->timestamp('created_at')->nullable();
            });
        }
    }

    /**
     * マイグレーションを巻き戻す
     * 
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('password_reset_tokens');
    }
};