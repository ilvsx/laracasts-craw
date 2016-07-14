<?php
namespace App;

return [
    'cookie'    => 'laravel_session=eyJpdiI6ImFuWEZOTXlMcVNkNXhyQ0hhWEx2elE9PSIsInZhbHVlIjoiR0MzblJmRk5VT2pCc3FtWkpHa3lJMXE3ZEFmMHFac3hiU0pVMFNrOHM4NHJxZ0ZHTzVcL1lyYmxjWmxPemMrSnN1UU1Vc3l6aTdjSVBXV1JQaWN5RDRnPT0iLCJtYWMiOiI2YjUzODQ5MjJlZDgyNDQ1OGFlNjU0Y2U5ZjhlNWFiYTIxYjUzYzZkN2FhYTA3NzU4ZTVhZDM3MTNlMGFkZDg1In0%3D; expires=Thu, 14-Jul-2016 15:37:09 GMT; Max-Age=7200; path=/; HttpOnly',
    // 存储目录必须保证 php 对该目录有写权限
    'save_path' => '/Users/sakuya/Code/laracasts-craw/videos',
    // 代理设置。 如果没有代理留空即可
    'proxy'     => 'socks5h://127.0.0.1:1080',
];
