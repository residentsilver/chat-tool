import { useState, useEffect } from 'react';
import apiClient from '../api/axios';

/**
 * バックエンドAPIとの接続をテストするコンポーネント
 * 
 * マウント時に自動的にAPIのpingエンドポイントにリクエストを送信し、
 * レスポンスを表示します。また、手動でAPIをテストするボタンも提供します。
 * 
 * CORS対応のために修正を行いました。
 */
function ApiTest() {
  const [response, setResponse] = useState<any>(null);
  const [loading, setLoading] = useState<boolean>(false);
  const [error, setError] = useState<string | null>(null);
  const [endpoint, setEndpoint] = useState<string>('/ping-alternative');

  // APIをテストする関数
  const testApi = async () => {
    setLoading(true);
    setError(null);
    
    try {
      console.log(`Testing API endpoint: ${endpoint}`);
      const result = await apiClient.get(endpoint);
      setResponse(result.data);
    } catch (err: any) {
      setError(err.message || 'APIリクエストに失敗しました');
      console.error('API Error:', err);
    } finally {
      setLoading(false);
    }
  };

  // エンドポイントを切り替え
  const toggleEndpoint = () => {
    const newEndpoint = endpoint === '/ping' ? '/ping-alternative' : '/ping';
    setEndpoint(newEndpoint);
  };

  // コンポーネントマウント時に自動的にAPIをテスト
  useEffect(() => {
    testApi();
  }, [endpoint]);

  return (
    <div className="api-test p-4 bg-gray-100 rounded-lg">
      <h2 className="text-xl font-bold mb-4">Laravel API 接続テスト</h2>
      
      <div className="mb-4">
        <p className="text-sm text-gray-600 mb-2">現在のエンドポイント: <code>{endpoint}</code></p>
        <button
          onClick={toggleEndpoint}
          className="bg-gray-500 hover:bg-gray-700 text-white font-bold py-1 px-2 rounded text-sm mr-2"
        >
          エンドポイント切替
        </button>
      </div>
      
      {loading && <p className="text-blue-500">APIリクエスト中...</p>}
      
      {error && (
        <div className="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
          <strong>エラー:</strong> {error}
        </div>
      )}
      
      {response && (
        <div className="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
          <h3 className="font-bold">成功！</h3>
          <p>メッセージ: {response.message}</p>
          <p>ステータス: {response.status}</p>
          <p>時間: {response.time}</p>
        </div>
      )}
      
      <button
        onClick={testApi}
        disabled={loading}
        className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
      >
        {loading ? 'テスト中...' : 'APIを再テスト'}
      </button>
    </div>
  );
}

export default ApiTest; 