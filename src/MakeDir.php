<?php

namespace Opal\ArtisanCommands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeDir extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:dir {path?} {--i}';
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
        $path = $this->argument('path');

        // Interactive option
        if ($path === null || $this->option('i')) {
            $path = $this->ask('Path to Directory');
        }

        if (File::isDirectory($path)) {
            $this->info('Directory already exists: ' . $path);

            return $this;
        }

        File::ensureDirectoryExists($path, 0755, true);
        $this->info('Directory created: ' . $path);

        return $this;
    }
}
