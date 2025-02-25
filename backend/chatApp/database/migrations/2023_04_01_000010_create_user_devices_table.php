<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * ユーザーデバイステーブルを作成するマイグレーション
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
        Schema::create('user_devices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->comment('ユーザーID')
                ->constrained('users')
                ->onDelete('cascade');
            $table->string('device_token')->comment('FCMトークンなど');
            $table->string('device_type', 20)->comment('デバイスタイプ (android, ios, web)');
            $table->timestamps();
            
            // 同じデバイストークンは一度しか登録できない
            $table->unique('device_token');
        });
    }

    /**
     * マイグレーションを巻き戻す
     * 
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('user_devices');
    }
}; 