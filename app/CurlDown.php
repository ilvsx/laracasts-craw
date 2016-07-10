<?php
namespace App;

require __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;

class CurlDown implements InterfaceDown
{

    public $url;

    private $config;


    public function __construct($url)
    {
        if (! $url) {
            return;
        }
        $this->url    = trim($url);
        $this->config = require 'config.php';
        echo 'start down...' . PHP_EOL;
        $this->doDown();
    }


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


    public function getSavePath()
    {
        if (! file_exists($this->config['save_path'])) {
            mkdir($this->config['save_path']);
        }
        return $this->config['save_path'];
    }


    public function getFIleName()
    {
        $p = parse_url($this->url)['query'];
        parse_str($p, $t);

        return trim($t['filename']);
    }

}
