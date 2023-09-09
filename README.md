# tufspot_develop
share develop repository
開発用リポジトリ、デプロイ用は別でsrc/tufspot配下のみ

## 環境構築
- Clone
- .env.example をコピーして.envを作成
- src/tufspotにて`$composer install`
- tufspot_developにて`$docker-compose build`と`$docker-compose up`
- src/tufspotにてコンテナアクセス`$docker-compose exec app bash`
  - `cd tufspot`にて `chmod 777 -R storage/`と`php artisan key:generate` 
- localhostにアクセス

## 運用
- ブランチは`feature/fixCss` 等でdvelopブランチから切る
- commitは `fix: タイポ修正` 等 [prefix](https://qiita.com/konatsu_p/items/dfe199ebe3a7d2010b3e)をつける
  - できるなら修正の塊ごとにcommitがあるとありがたい。
- PR名はissueと同じ名前
  - develop向けにする  
