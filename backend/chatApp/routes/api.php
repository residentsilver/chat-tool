<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| ここでアプリケーションのAPIルートを登録できます。これらのルートは
| RouteServiceProviderによってロードされ、「api」ミドルウェアグループに
| 割り当てられます。素晴らしいAPIを構築しましょう！
|
*/

// CORSを有効にするためのミドルウェア
Route::middleware(['cors'])->group(function () {
    Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
        return $request->user();
    });

    // テスト用の公開APIエンドポイント
    Route::get('/ping', function () {
        return response()->json([
            'message' => 'pong',
            'status' => 'success',
            'time' => now()->toDateTimeString(),
        ]);
    });
});

// 代替方法：個別にCORSヘッダーを設定
Route::get('/ping-alternative', function () {
    return response()->json([
        'message' => 'pong',
        'status' => 'success',
        'time' => now()->toDateTimeString(),
    ])->header('Access-Control-Allow-Origin', '*')
      ->header('Access-Control-Allow-Methods', 'GET, POST, OPTIONS')
      ->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, Authorization, X-Request-With');
});

// OPTIONSリクエストに対する応答を追加
Route::options('/{any}', function () {
    return response()->json(['status' => 'success'], 200)
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, Authorization, X-Requested-With, X-XSRF-TOKEN');
})->where('any', '.*'); 