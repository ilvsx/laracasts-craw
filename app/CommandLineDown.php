<?php
namespace App;

require __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;

class CommandLineDown implements InterfaceDown
{

    public $url;

    private $config;


    public function __construct($url)
    {
        if (! $url) {
            return;
        }
        $this->url    = $url;
        $this->config = require 'config.php';
        echo 'start down...' . PHP_EOL;
        $this->doDown();
    }


    public function doDown()
    {
        $process = new Process($this->getDownOrder());
        $process->setWorkingDirectory($this->getSavePath());
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


    public function getDownOrder()
    {
        $builder = new ProcessBuilder();
        $builder->setPrefix('proxychains4');

        return $builder->setArguments([
            'axel',
            '-a',
            '-n 8',
            '-o ' . $this->getFIleName(),
            $this->url,
        ])->getProcess()->getCommandLine();
    }

}

