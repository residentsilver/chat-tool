import axios from 'axios';

/**
 * バックエンドAPIとの通信に使用するAxiosインスタンス
 * 
 * 環境変数からAPIのベースURLを取得し、デフォルトのヘッダーを設定します。
 * CORS問題を解決するため、今回のテストではwithCredentialsをfalseに設定しています。
 * 実際の認証機能を使用する場合は、true に戻す必要があります。
 */
const apiClient = axios.create({
  baseURL: import.meta.env.VITE_API_BASE_URL || 'http://localhost:8000/api',
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
    'X-Requested-With': 'XMLHttpRequest',
  },
  // CORS問題を解決するため、テスト時はfalseに設定
  // 認証機能を使用する場合はtrueに戻す
  withCredentials: false,
});

export default apiClient; 