# twitter-cloneの環境構築

### Dockerをインストール
[こちら](https://docs.docker.com/desktop/install/mac-install/)からDocker Desktop on Macをインストールします。
※ M1MacやM2Macだったら、``Docker Desktop for Mac with Apple silicon``の方をインストールします。

インストールできたら、Docker Desktop on Macを起動します。
### 環境構築

```bash
 $ forkして自分のアカウントのリポジトリにコピーします.
    github上でforkボタンを押して、フォークしてください。　
 $ git clone git@github.com:[自分のアカウント名]/twitter-clone.git
 $ cd twitter
 $ cp .env.example .env
```

_Docker で環境を立ち上げる_

```bash
  // docker-compose.ymlファイルのある階層に移動します。
  $ docker-compose build
  $ docker-compose up -d
```

_色々インストールする_
```
  $ docker exec -it twitter-clone-app-1 /bin/bash
  $ composer install
  $ npm install
```

これで、一通りの環境が立ち上がります。

[http://localhost:8083/](http://localhost:80883)でLaravelが立ち上がります。

docker container は次の 3 つが立ち上がります。

| コンテナ名            | メモ                                                                                                  |
| --------------------- | ----------------------------------------------------------------------------------------------------- |
| twitter-clone-app-1 | アプリケーションのコンテナです。<br>コンテナに入れば php artisan コマンドが使えます。 |
| twitter-clone-db-1| Mysql のインスタンス。<br> コンテナに入ればMysqlコマンドを使えます。                                             |
| twitter-clone-nginx-1 | Nginx のインスタンス。      |


### Dockerのコマンド集

| コマンド                | 説明                                                                                                  |
| --------------------- | ----------------------------------------------------------------------------------------------------- |
| docker-compose build  | 各コンテナのDockerfileに従ってDocker イメージがビルドされます。                                                |
| docker-compose up -d  | 各コンテナを起動するコマンドです。                                                                          |
| docker-compose down   | コンテナを停止するコマンドです。                                                                            |
| docker exec -it twitter-clone-app-1 /bin/bash   | appコンテナに入る                                                               |