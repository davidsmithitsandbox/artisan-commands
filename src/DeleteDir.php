<?php

namespace Opal\ArtisanCommands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class DeleteDir extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:dir {path} {--i}';
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
        $path = $this->argument('path');

        // Interactive option confirm true
        if ($this->option('i') && $this->confirmDelete($path)) {
            $this->deleteDirectory($path);

            return $this;
        }

        // Interactive option confirm false
        if ($this->option('i') && !$this->confirmDelete($path)) {
            $this->info('No action taken');

            return $this;
        }

        $this->deleteDirectory($path);

        return $this;
    }

    /**
     * Delete a directory and prints.
     *
     * @param $path
     *
     * @return DeleteDir
     */
    protected function deleteDirectory($path): self
    {
        if (File::deleteDirectory($path)) {
            $this->info("Directory Deleted: $path");

            return $this;
        }

        throw new \RuntimeException('File not deleted');
    }

    /**
     * Get confirmation to delete directory.
     *
     * @param $path
     *
     * @return bool
     */
    protected function confirmDelete($path): bool
    {
        if ($response = $this->confirm("Delete Directory: $path")) {
            return $response;
        }

        return false;
    }
}
