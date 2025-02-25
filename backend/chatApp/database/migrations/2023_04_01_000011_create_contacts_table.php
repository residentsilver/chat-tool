<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * コンタクト（友達）テーブルを作成するマイグレーション
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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->comment('ユーザーID（申請者）')
                ->constrained('users')
                ->onDelete('cascade');
            $table->foreignId('contact_id')->comment('コンタクトユーザーID（申請先）')
                ->constrained('users', 'id')
                ->onDelete('cascade');
            $table->enum('status', ['pending', 'accepted', 'blocked'])->comment('ステータス');
            $table->timestamps();
            
            // 同じユーザー同士のコンタクト関係は一つのみ
            $table->unique(['user_id', 'contact_id']);
        });
    }

    /**
     * マイグレーションを巻き戻す
     * 
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
}; 