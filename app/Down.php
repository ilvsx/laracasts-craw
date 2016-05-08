<?php
namespace App;

require __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;

class Down
{

    public $url;

    private $config;


    function __construct($url)
    {
        if (! $url) {
            return;
        }
        $this->url    = $url;
        $this->config = require 'config.php';
        echo 'start down...' . PHP_EOL;
        $this->doDown();
    }


    function doDown()
    {
        $process = new Process($this->getDownOrder());
        $process->setWorkingDirectory($this->getDownPath());
        $process->setTimeout(0);

        try {
            $process->mustRun(function ($type, $buffer) {
                if (Process::ERR === $type) {
                    echo $buffer;
                } else {
                    echo $buffer;
                }
            });
        } catch (ProcessFailedException $e) {
            echo $e->getMessage();
        }
    }


    private function getDownPath()
    {
        if (! file_exists($this->config['down_path'])) {
            mkdir($this->config['down_path']);
        }
        return $this->config['down_path'];
    }


    function getDownFIleName()
    {
        $p = parse_url($this->url)['query'];
        parse_str($p, $t);

        return trim($t['filename']);
    }


    function getDownOrder()
    {
        $builder = new ProcessBuilder();
        $builder->setPrefix('proxychains4');

        return $builder->setArguments([
            'axel',
            '-a',
            '-n 8',
            '-o ' . $this->getDownFIleName(),
            $this->url,
        ])->getProcess()->getCommandLine();
    }

}

