<?php

namespace MageTool\Console;

use Symfony\Component\Console\Application as BaseApplication;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;

use MageTool\MageTool;
use MageTool\Command;

class Application extends BaseApplication
{
    /**
     * {@inheritdoc}
     */
    public function __construct()
    {
        parent::__construct('MageTool', MageTool::VERSION);
    }

    /**
     * Initializes all the MageTool commands
     */
    protected function getDefaultCommands()
    {
        $commands = parent::getDefaultCommands();
        $commands[] = new Command\CacheClearCommand();
        $commands[] = new Command\CacheDisableCommand();
        $commands[] = new Command\CacheEnableCommand();
        $commands[] = new Command\CacheFlushCommand();
        $commands[] = new Command\CacheStatusCommand();

        return $commands;
    }
}