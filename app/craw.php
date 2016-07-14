<?php
namespace App;

require __DIR__ . '/../vendor/autoload.php';

date_default_timezone_set('PRC');
set_time_limit(0);

$uri = 'https://laracasts.com/series/learning-vue-step-by-step/episodes/14';



/**
 * 获取视频链接
 */

// echo new VideoLink($uri);

/**
 * 批量解析
 */
// foreach ($uris as $uri) {
//     echo new VideoLink($uri);
// }

/**
 * 通过 axel 下载视频
 */

// new CommandLineDown(new VideoLink($uri));

/**
 * 通过 PHP 的 curl 库下载
 */

// new CurlDown(new VideoLink($uri));
