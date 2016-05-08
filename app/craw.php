<?php
namespace App;

require __DIR__ . '/../vendor/autoload.php';

date_default_timezone_set('PRC');
set_time_limit(0);
//$uri = 'https://laracasts.com/series/charting-and-you/episodes/2';

for ($i = 5; $i <= 6; $i++) {
    $uri = 'https://laracasts.com/series/do-you-react/episodes/' . $i;
    new Down(new VideoLink($uri));
}

