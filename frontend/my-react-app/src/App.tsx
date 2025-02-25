import ApiTest from './components/ApiTest';
import './App.css';

/**
 * Reactアプリケーションのメインコンポーネント
 * 
 * Laravel APIとの接続をテストするコンポーネントを表示します。
 */
function App() {
  return (
    <div className="min-h-screen bg-gray-50 flex flex-col items-center justify-center p-4">
      <header className="mb-8 text-center">
        <h1 className="text-3xl font-bold text-gray-800 mb-2">
          Laravel + React チャットアプリ
        </h1>
        <p className="text-gray-600">
          Docker環境で構築されたLaravelバックエンドとReactフロントエンドの連携テスト
        </p>
      </header>
      
      <main className="w-full max-w-xl">
        <ApiTest />
      </main>
      
      <footer className="mt-8 text-center text-gray-500 text-sm">
        &copy; {new Date().getFullYear()} チャットアプリ - Dockerで構築されたフルスタック環境
      </footer>
    </div>
  );
}

export default App;
