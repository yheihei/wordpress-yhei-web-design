# 本テーマについて
本テーマは  
https://ja.wordpress.org/themes/draft-portfolio/  
の子テーマです。  
デザイナーのポートフォリオに特化したテーマをさらにカスタマイズして見やすくしています。

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

## ユニットテスト実施方法

### ローカル開発環境の用意
ローカル開発環境として Vagrant の `vccw-team/xenial64` Boxを使用しています。  
導入方法は参考リンクをご参照ください。  
参考: [【VCCW】WordPressのローカル開発環境を作ってみた！【Windows10】](https://cunelwork.co.jp/blog/web/vccw-local-windows/)

### テスト環境構築
```
$ cd <your wordpress root>/wp-content/themes/draft-portfolio_child
$ wp scaffold theme-tests --dir=<your wordpress root>/wp-content/themes/draft-portfolio_child
Warning: File already exists.
<your wordpress root>/wp-content/themes/draft-portfolio_child/tests/bootstrap.php
Skip this file, or replace it with scaffolding?[s/r]: s
Skipping

Success: Created test files.

$ ./init_test.sh 
Dropping the database is potentially a very bad thing to do.
Any data stored in the database will be destroyed.

Do you really want to drop the 'wordpress_test' database [y/N] y
```

### ユニットテストの実行
```
$ phpunit --testdox
Installing...
Running as single site... To run multisite, use -c tests/phpunit/multisite.xml
Not running ajax tests. To execute these, use --group ajax.
Not running ms-files tests. To execute these, use --group ms-files.
Not running external-http tests. To execute these, use --group external-http.
PHPUnit 5.6.0 by Sebastian Bergmann and contributors.

カテゴリーページで記事ではなく子カテゴリー一覧を表示する設定を追加する
 [x] 対象のカテゴリーを管理画面から指定できること
 [x] 対象のカテゴリーを管理画面から複数指定できること
 [x] 設定したカテゴリーの直近の子カテゴリーが取得できること
 [x] 設定したカテゴリーの直近の子カテゴリーが複数取得できること
 [x] 現在のページが設定したカテゴリーページであるか判定できる

トップページにBlogカテゴリーの記事を3つ表示する
 [x] スラグがblogsのカテゴリーを持つ投稿を全て取得できること
 [x] 取得した投稿のカテゴリーが blogカテゴリーであること
 [x] 取得した投稿のカテゴリーが blogの子カテゴリーであること
```


