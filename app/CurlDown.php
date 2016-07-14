<?php
namespace App;

require __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;

class CurlDown extends abstractDown
{

    public function doDown()
    {
        $file_path   = $this->getSavePath() . '/' . $this->getFIleName();
        $file_handle = fopen($file_path, 'a+');
        $client      = new Client();
        $client->get($this->url, [
            'debug' => true,
            'curl'  => [
                CURLOPT_FILE        => $file_handle,
                CURLOPT_RESUME_FROM => filesize($file_path),
            ],
        ]);

    }

}
