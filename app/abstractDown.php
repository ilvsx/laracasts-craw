<?php
namespace App;

abstract class abstractDown
{
    /** @var string  */
    public $url;

    /** @var array  */
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

    abstract public function doDown();

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
