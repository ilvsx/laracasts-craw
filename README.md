## 安装

克隆该项目

```php
git clone https://github.com/ilvsx/laracasts-craw.git
```

安装相关库
```php
composer install
```


## 配置
编辑 `app/config.php`

- cookie：复制你的 cookie 到这里
- save_path: 设定视频保存的文件目录，必须保证 php 对该目录有写的权限
- proxy：代理设定，可以加快视频解析速度，如果不用代理，设为空即可。默认的 `socks5h://127.0.0.1:1080` 是 `Shadowsocks` 的默认客户端代理地址

## 使用
编辑 `app/craw.php`，下面是样例：

#### 获取视频链接
```php
echo new VideoLink($uri);
```
#### 批量解析
```php
foreach ($uris as $uri) {
   echo new VideoLink($uri);
}
```
#### 通过 axel 下载视频
```php
new CommandLineDown(new VideoLink($uri));
```

#### 通过 PHP 的 curl 库下载
```php
new CurlDown(new VideoLink($uri));
```

最后执行`php app/craw.php`
