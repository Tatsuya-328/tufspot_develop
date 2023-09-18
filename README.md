# tufspot_develop
share develop repository
開発用リポジトリ、デプロイ用は別でsrc/tufspot配下のみ

## 環境構築
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
  - `cd tufspot`にて`chmod 777 -R storage/`と`php artisan key:generate`と`php artisan migrate`
  - （おそらく今後のmerge移行で、アイキャッチ画像のシンボリックリンク対応も必要になる）
- `$npm run dev`でログイン機能構築
- localhostにアクセス

## 運用
- main, developへの直pushは禁止。必ず他ブランチからPRで、確認依頼後にmerge
- ブランチは`feature/fixCss` 等でdvelopブランチから切る
- commitは `fix: タイポ修正` 等 [prefix](https://qiita.com/konatsu_p/items/dfe199ebe3a7d2010b3e)をつける
  - できるなら修正の塊ごとにcommitがあるとありがたい。
- PR名はissueと同じ名前
  - develop向けにする  
