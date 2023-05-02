# Docker を使った開発環境構築

## 0. 環境構築に必要なツール

- Docker Desktop がインストールされている事が必要です。
- 作業はコマンドラインから行います。

## 1. 環境設定

- `env.example` を `.env` にコピーします。

```sh
cp .env.example .env
```

## 2. 各種コンテナの起動

以下を実行します。

```
docker compose up -d
```

その上で以下を実行します。

```
docker compose run --rm php composer install
docker compose run --rm php php artisan key:generate
```

成功すれば以下のメッセージがターミナルに表示されます。

```
Application key set successfully.
```

DB などの各種イメージのダウンロードが行われ、その後起動します。完了するまで数分かかるので待ちます。

### 確認: アプリ

この時点で http://localhost からアクセスする事が可能です。ただし DB の設定をしていないので、システムのログインはできません。

### 確認: データベース

この時点で http://localhost:4040 から phpMyAdmin にアクセスできます。

## 3. DB の初期化

データベースを登録

```
CREATE DATABASE IF NOT EXISTS データベース名
```

※ .env ファイルを書き換える

```
DB_DATABASE=データベース名
```

以下を実行します。

```
docker compose exec php php artisan migrate
```

## 4. vue 等の install

```
docker-compose exec node bash -c "npm install & npm run dev"
```

※以下は実行しなくてよい
docker-compose exec node npm install vue@next vue-loader@next @vue/compiler-sfc

## 5. ユーザ登録およびログイン

http://localhost/register から ユーザを登録します。

その後、以下の作業を行なってください。

- 登録したらログアウトをして、登録した情報でログイン

ログインが完了したら環境構築は完了です。

### 6. 終了

以下を実行するとコンテナが終了します。

```
docker compose down
```

再度起動したい時は以下を実行します。

```
docker compose up -d
```

# 備考　（モジュールを修正した際に実行）

モジュールの最新化

```
docker-compose exec php bash -c "
php artisan cache:clear &&
php artisan config:clear &&
php artisan config:cache &&
php artisan route:clear &&
php artisan view:clear &&
php artisan clear-compiled &&
php artisan optimize &&
composer dump-autoload &&
rm -f bootstrap/cache/config.php"
```

コンパイル

```
docker-compose exec node bash -c "npm install & npm run dev"
```

以下エラーの対処法
"/var/www/storage/logs/laravel.log" could not be opened in append mode: failed to open stream: Permission denied

docker-compose exec php bash -c "chmod -R 777 storage bootstrap/cache"
