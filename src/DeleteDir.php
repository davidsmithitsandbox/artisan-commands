<?php

namespace Opal\ArtisanCommands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class DeleteDir extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:dir {path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes a directory';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $Filesystem = new Filesystem;
        $path = $this->argument('path');
        if($this->confirm("Delete Directory: $path"))
        {
            $Filesystem->deleteDirectory($path);
            $this->info("Directory Deleted: $path");
        }
    }
}
