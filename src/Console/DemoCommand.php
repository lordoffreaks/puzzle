<?php

namespace Puzzle\Console;

use Jigsaw\Jigsaw\Filesystem;
use Jigsaw\Jigsaw\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DemoCommand extends Command
{
    private $files;
    private $base;

    public function __construct(Filesystem $files)
    {
        $this->files = $files;
        $this->base = getcwd();
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('demo')
            ->setDescription('Scaffold a new DEMO Puzzle project.')
            ->addArgument(
                'name',
                InputArgument::OPTIONAL,
                'Where should we initialize this project?'
            );
    }

    protected function fire()
    {
        if ($base = $this->input->getArgument('name')) {
            $this->base .= '/' . $base;
        }

        $this->scaffoldSite();

        $this->info('Site initialized successfully!');
    }

    private function scaffoldSite()
    {
        $this->files->copyDirectory(__DIR__ . '/../../demo', $this->base);
        $this->files->copyDirectory(__DIR__ . '/../../includes', $this->base . '/includes');
    }
}
