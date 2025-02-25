<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * メッセージ添付ファイルテーブルを作成するマイグレーション
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
        Schema::create('message_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('message_id')->comment('メッセージID')
                ->constrained('messages')
                ->onDelete('cascade');
            $table->string('file_path')->comment('ファイルパス');
            $table->string('file_name')->comment('元のファイル名');
            $table->integer('file_size')->comment('ファイルサイズ（バイト）');
            $table->string('file_type', 50)->comment('MIMEタイプ');
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
        Schema::dropIfExists('message_attachments');
    }
}; 