<?php

namespace Puzzle\Console;

use TightenCo\Jigsaw\Filesystem;
use TightenCo\Jigsaw\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class InitCommand extends Command
{
    private $files;
    private $base;
    private $sites;

    public function __construct(Filesystem $files)
    {
        $this->files = $files;
        $this->base = getcwd();
        $this->sites = dirname(dirname(__DIR__)) . '/sites';

        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('init')
            ->setDescription('Scaffold a new Puzzle project.')
            ->addArgument(
                'name',
                InputArgument::REQUIRED,
                'What project should we initialize?'
            )
            ->addArgument(
                'destination',
                InputArgument::OPTIONAL,
                'Where should we initialize this project?'
            );
    }

    protected function fire()
    {
        if ($base = $this->input->getArgument('destination')) {
            $this->base .= '/' . $base;
        }

        $name = $this->input->getArgument('name');
        $site = $this->sites . '/' . $name;

        if (file_exists($site) && is_dir($site)) {
            $this->scaffoldSite($name);
            $this->info('Site initialized successfully!');
        }
        else {
            $this->error("The site $name doesn't exist.");
        }

    }

    private function scaffoldSite($name)
    {
        $this->files->copyDirectory($this->sites . '/' . $name, $this->base);
        $this->files->copyDirectory($this->sites . '/' . $name  . '/includes', $this->base . '/includes');
    }
}
