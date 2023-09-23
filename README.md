# tufspot_develop
share develop repository
開発用リポジトリ、デプロイ用は別でsrc/tufspot配下のみ

## developをプルしてエラーがでたら
- src/tufspotにて`$composer update`と`$npm update`
- コンテナにて php artisan migrate:fresh --seed
- 下部のキャッシュ削除コマンド

## 環境構築
- 新たにdevelopをCloneする時は、元々のtufspotのDockerコンテナ、イメージを削除してからやらないと重複してエラーになる（db/dateが空であること）
- Clone
- .env.example をコピーして.envを作成
  - DB_HOSTからDB_PASSWORDまでを以下に書き換え
```
DB_HOST=tufspot_db
DB_PORT=3306
DB_DATABASE=tufspot_db
DB_USERNAME=tufspot_user
DB_PASSWORD=tufspot_pass
```
- src/tufspotにて`$composer install`と`$npm install`
- tufspot_developにて`$docker-compose build`と`$docker-compose up`
- src/tufspotにてコンテナアクセス`$docker-compose exec app bash`
  - `cd tufspot`にて`chmod 777 -R storage/`と`php artisan key:generate`と`php artisan migrate:fresh --seed`(テストデータ挿入)
  - MySqlエラーでて、Dockerキャッシュが関係しているかも、https://ytakeuchi.jp/?p=617、https://qiita.com/j1403239/items/3748bb06e83d21dba966
  - 接続エラー https://stackoverflow.com/questions/54030469/host-x-is-not-allowed-to-connect-to-this-mysql-server
  - もしくは下記キャッシュ削除
  - （おそらく今後のmerge移行で、アイキャッチ画像のシンボリックリンク対応も必要になる）
- コンテナ外、src/tufspotにて`$npm run dev`でログイン機能構築
- localhostにアクセス
  - test@example.com
  - testtest
- /adminで記事管理画面

## VSCodeフォーマッター
保存時の自動フォーマッター動作
.php: returnの下の改行させない。インデント揃える
.blade: インデント揃える
.js: 不要な改行させない。インデント揃える
.css: インデント揃える

拡張機能
- prittier
  - 名前: Prettier - Code formatter
  - ID: esbenp.prettier-vscode
  - 説明: Code formatter using prettier
  - バージョン: 10.1.0
  - パブリッシャー: Prettier
  - VS Marketplace リンク: https://marketplace.visualstudio.com/items?itemName=esbenp.prettier-vscode
- intelephense
  - 名前: PHP Intelephense
  - ID: bmewburn.vscode-intelephense-client
  - 説明: PHP code intelligence for Visual Studio Code
  - バージョン: 1.9.5
  - パブリッシャー: Ben Mewburn
  - VS Marketplace リンク: https://marketplace.visualstudio.com/items?itemName=bmewburn.vscode-intelephense-client
- bladeformmater
  - 名前: Laravel Blade formatter
  - ID: shufo.vscode-blade-formatter
  - 説明: Laravel Blade formatter for VSCode
  - バージョン: 0.23.1
  - パブリッシャー: Shuhei Hayashibara
  - VS Marketplace リンク: https://marketplace.visualstudio.com/items?itemName=shufo.vscode-blade-formatter

フォーマッター設定
setting.json
```
  // vscodeデフォルト
  "[css]": {
    "editor.defaultFormatter": "vscode.css-language-features"
  },

  // prittier
  "prettier.printWidth": 5000,
  "[javascript]": {
    "editor.defaultFormatter": "esbenp.prettier-vscode",
  },

  // intelephense
  "[php]": {
    "editor.defaultFormatter": "bmewburn.vscode-intelephense-client"
  },
  "intelephense.diagnostics.undefinedClassConstants": false,
  "intelephense.diagnostics.undefinedConstants": false,
  "intelephense.diagnostics.undefinedFunctions": false,
  "intelephense.diagnostics.undefinedProperties": false,
  "intelephense.diagnostics.undefinedMethods": false,
  "intelephense.diagnostics.undefinedTypes": false,

  // bladeformmater
  "bladeFormatter.format.wrapLineLength": 1200,
  "[blade]":{
      "editor.defaultFormatter": "shufo.vscode-blade-formatter"
  },
  "blade.format.enable": true,
```
## 参考コマンド
Laravelキャッシュ削除コマンド
```
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## 運用
- main, developへの直pushは禁止。必ず他ブランチからPRで、確認依頼後にmerge
- ブランチは`feature/fixCss` 等でdvelopブランチから切る
- commitは `fix: タイポ修正` 等 [prefix](https://qiita.com/konatsu_p/items/dfe199ebe3a7d2010b3e)をつける
  - できるなら修正の塊ごとにcommitがあるとありがたい。
- PR名はissueと同じ名前
  - develop向けにする  
