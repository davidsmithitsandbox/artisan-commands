<?php

namespace Opal\ArtisanCommands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeDir extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:dir {path} {--i}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Makes a new Directory';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $Filesystem = new Filesystem;
        $path       = $this->argument('path');

        // Interactive option
        if ($this->option('i')) {
            $path = $this->ask('Path to Directory');
        }

        if ($Filesystem->isDirectory($path)) {
            $this->info('Directory already exists: ' . $path);

            return $this;
        }

        $Filesystem->ensureDirectoryExists($path, 0755, true);
        $this->info('Directory created: ' . $path);

        return $this;
    }
}
