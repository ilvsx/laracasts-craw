<?php
namespace App;

require __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;

class CommandLineDown extends abstractDown
{

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

    public function getDownOrder()
    {
        $builder = new ProcessBuilder();
        $builder->setPrefix('axel');

        return $builder->setArguments([
            '-a',
            '-n 8',
            '-o' . $this->getFIleName(),
            $this->url,
        ])->getProcess()->getCommandLine();
    }

}
