<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * CORSミドルウェア
 * 
 * クロスオリジンリソース共有のためのヘッダーを設定します。
 * フロントエンドアプリケーションからのリクエストをLaravelバックエンドが
 * 受け入れるために必要なCORSヘッダーを追加します。
 * OPTIONSリクエスト（プリフライトリクエスト）も適切に処理します。
 */
class Cors
{
    /**
     * HTTPリクエストを処理します。
     * 
     * このミドルウェアでは、CORSヘッダーを設定します。
     * OPTIONSリクエストの場合は即座に200応答を返します。
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        // OPTIONSメソッドによるプリフライトリクエストを処理
        if ($request->isMethod('OPTIONS')) {
            $response = response()->json(['status' => 'success'], 200);
        } else {
            $response = $next($request);
        }
        
        // すべてのレスポンスにCORSヘッダーを追加
        $response->headers->set('Access-Control-Allow-Origin', '*'); // 本番環境では具体的なオリジンを指定する
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With, X-XSRF-TOKEN, Accept, Origin');
        $response->headers->set('Access-Control-Allow-Credentials', 'true');
        $response->headers->set('Access-Control-Max-Age', '86400'); // 24時間キャッシュ
        
        return $response;
    }
} 