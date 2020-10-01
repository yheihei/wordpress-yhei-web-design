# 本テーマについて
本テーマは  
https://ja.wordpress.org/themes/draft-portfolio/  
の子テーマです。  
デザイナーのポートフォリオに特化したテーマをさらにカスタマイズして見やすくしています。

# デモ
https://yhei-web-design.com/

# インストール方法

## Draft Portfolioテーマのマスターをインストール
下記の2種類の方法があります  

* https://ja.wordpress.org/themes/draft-portfolio/ からダウンロードしてzipでアップロードする
* WordPress管理画面のテーマインストール画面から検索する


## 本子テーマのインストール

* テーマフォルダ内でgit cloneをする

```
$ cd <your wordpress root>/wp-content/themes/
$ git clone https://github.com/yheihei/wordpress-yhei-web-design.git draft-portfolio_child
```

* WordPress管理画面から本子テーマを有効化する

## トップページにポートフォリオ記事を表示する

トップページの一覧に表示されるポートフォリオ記事を設定します。  

![トップページにポートフォリオカテゴリーを表示する](https://github.com/yheihei/wordpress-yhei-web-design/blob/image/screenshot/top_page_work.jpg)

トップページには`portfolio`というスラグを持つポートフォリオ用のカテゴリーが付与された記事が一覧で表示されます。  
まずは、ポートフォリオ用のカテゴリーを作ってトップページに記事を表示してみます。

### slugがportfolioのカテゴリーを作成する

* 管理画面 -> 投稿 -> カテゴリー
* スラグが`portfoilo`のカテゴリーを作る  

![ポートフォリオカテゴリーを作る](https://github.com/yheihei/wordpress-yhei-web-design/blob/image/screenshot/category.png)

* 記事に↑のカテゴリーを付与する

![記事にポートフォリオカテゴリーを付与する](https://github.com/yheihei/wordpress-yhei-web-design/blob/image/screenshot/post_with_category.png)


## トップページにブログ記事を表示する

トップページの一覧に表示されるブログ記事を設定します。  

![トップページにブログ記事を表示する](https://github.com/yheihei/wordpress-yhei-web-design/blob/image/screenshot/blogs.jpg)

トップページには`blogs`というスラグを持つブログ用のカテゴリーが付与された記事が表示されます。  
ブログ用のカテゴリーを作ってトップページに記事を表示してみます。

### slugがblogsのカテゴリーを作成する

* 管理画面 -> 投稿 -> カテゴリー
* スラグが`blogs`のカテゴリーを作る  

![ブログカテゴリーを作る](https://github.com/yheihei/wordpress-yhei-web-design/blob/image/screenshot/blog_category.png)

* 記事に↑のカテゴリーを付与する

![記事にブログカテゴリーを付与する](https://github.com/yheihei/wordpress-yhei-web-design/blob/image/screenshot/blog_post.png)


## ユニットテスト実施方法

### ローカル開発環境の用意
ローカル開発環境として テスト環境が整ったDocker環境を使っています。  
導入方法は下記のDocker環境構築リポジトリをご参照ください。  
リポジトリ: [WordPress+WP-CLI+PHPUnit環境をDockerで動かす](https://github.com/yheihei/wp-docker-template)

### ユニットテストの実行
```
root@wordpress:/var/www/html/wp-content/themes/draft-portfolio_child# phpunit --testdox
Installing...
Running as single site... To run multisite, use -c tests/phpunit/multisite.xml
Not running ajax tests. To execute these, use --group ajax.
Not running ms-files tests. To execute these, use --group ms-files.
Not running external-http tests. To execute these, use --group external-http.
PHPUnit 7.5.9 by Sebastian Bergmann and contributors.

カテゴリーページで記事ではなく子カテゴリー一覧を表示する設定を追加する
 ✔ 対象のカテゴリーを管理画面から指定できること
 ✔ 対象のカテゴリーを管理画面から複数指定できること
 ✔ 設定したカテゴリーの直近の子カテゴリーが取得できること
 ✔ 設定したカテゴリーの直近の子カテゴリーが複数取得できること
 ✔ 現在のページが設定したカテゴリーページであるか判定できる
 ✔ 設定したカテゴリーページのアイキャッチが取得できる
 ✔ 設定したカテゴリーページのピックアップ画像が取得できる

Blogカテゴリーの記事を取得できること
 ✔ スラグがblogsのカテゴリーを持つ投稿を全て取得できること
 ✔ 取得した投稿のカテゴリーが blogカテゴリーであること
 ✔ 取得した投稿のカテゴリーが blogの子カテゴリーであること

Time: 3.56 seconds, Memory: 32.50 MB

OK (10 tests, 12 assertions)
```


