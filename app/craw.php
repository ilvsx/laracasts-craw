<?php
namespace App;

require __DIR__ . '/../vendor/autoload.php';

date_default_timezone_set('PRC');
set_time_limit(0);

$uri = 'https://laracasts.com/series/git-me-some-version-control/episodes/1';
echo new VideoLink($uri);

//for ($i = 5; $i <= 5; $i++) {
//    $uri = 'https://laracasts.com/series/do-you-react/episodes/' . $i;
//    echo new VideoLink($uri);
//}

