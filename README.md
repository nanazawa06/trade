<h1 align="center">GoodsTrade</h1>

## 制作背景
グッズを交換できるアプリ
アニメやvtuberの推し活をする中で、くじ引きやガチャなどで同じグッズが被ったり欲しいものが手に入らないことがある。その際twitterでトレードを行ったり、フリマアプリで売買を行うことになる。特にtwitterでのトレードでは、暗黙の了解のようなルールがあり入りづらいと感じる。あらかじめ分かりやすいフォーマットが定まっていたほうが便利だと考えた。またtwitterでは取引相手をどこまで信頼できるかもわからない。個人的には推しのエゴサに引っ掛かってしまうこともありうるので利用しづらい。既になにかアプリがあるのか調べてみてもそれらしいサイト、アプリがないことがわかった。そのため自分でグッズトレードアプリを作成しようと考えた。

## 概要
ユーザーは写真とともに欲しいグッズ、譲りたいグッズを投稿できる。トレードを行う際には、出品の詳細画面にあるトレードリクエストフォームを利用して画像と欲しいグッズ、譲りたいグッズ、メッセージを出品者に送ることができる。出品者がそのリクエストを承諾すれば取引が始まる。取引画面でチャットで発送先など交換しトレードを行う。取引終了時にはお互いに相手を評価する。評価の平均値を星の数で表示することで、ユーザーも安心して取引を行うことができる。また直接会って取引したい場合に所在地をもとに検索できる。

## デモ
<span><img src="https://github.com/nanazawa06/trade/assets/135312995/938220e9-5cb9-4264-8f0f-4e537a382bc5" width="500"><br></span>
<span><img src="https://github.com/nanazawa06/trade/assets/135312995/45f5b8fe-f5df-4fce-9c12-2403485a61e3" width="500"><br></span>
<img src="https://github.com/nanazawa06/trade/assets/135312995/bd63e202-b217-493b-a8cd-cb9b56320901" width="500"><br>
<img src="https://github.com/nanazawa06/trade/assets/135312995/5f89dbc3-36cc-4618-8084-2630289e83e6" width="500"><br>
<img src="https://github.com/nanazawa06/trade/assets/135312995/2508e55f-98ce-4560-9c3b-5d5f38fdae6c" width="500"><br>
<img src="https://github.com/nanazawa06/trade/assets/135312995/fb1ad5d7-124d-4db3-b9b3-59031b7c08f2" width="500"><br>

## ER図
![GoodsTrade_ER](https://github.com/nanazawa06/trade/assets/135312995/9d76f5dc-a2ee-4197-a13b-f6113dca6cfb)
テーブル概要
- users：登録したユーザー情報を保存
- areas：ユーザーの所在地を都道府県で保存
- posts：ユーザーの出品
- reviews：取引終了後の相互評価
- likes：ユーザーは出品に対していいねを送れ、自身のいいね一覧を見れる
- images：postsテーブルとproposalsテーブルの画像を保存するポリモーフィックリレーション
- gives：出品に含まれる譲るグッズ名を保存
- wants：出品に含まれる欲しいグッズ名を保存
- states：出品物の状態
- proposals：トレードリクエスト情報
- chats：postsテーブルとproposalsテーブルのチャットを保存するポリモーフィックリレーション

## 機能
- CRUD
- ログイン機能＆Googleログイン
- 出品機能
- 検索機能
- リアルタイムチャット機能
- ユーザー評価機能
- いいね機能
- ユーザープロフィールの編集、閲覧

## 開発環境
<b>言語：</b><br>
- PHP (8.0.2)
- HTML 
- CSS(SCSS)
- TailwindCss
- JavaScript
- jQuery
- laravel/breeze (1.19)
- laravel/socialite (5.8)

<b>環境：</b><br>
- Laravel(9)
- AWS(EC2＋Cloud9)
- MySQL(MariaDB)
- Github

<b>デプロイ：</b><br>
- Heroku

<b>API：</b><br>
- Cloudinary
- Google API
- Pusher

## 今後の予定
- 画像投稿機能のアップデート（編集ができるように）
- レイアウトの更新
- 決済機能
- フォロー機能
- ページの読み込み速度の向上
