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
    protected $signature = 'delete:dir {path?} {--i}';
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
        $path          = $this->argument('path') ?? $this->ask('Path to Directory:');
        $option        = $this->option('i');
        $argument_path = $this->argument('path');

        // Interactive option confirm true
        if (($option || $argument_path === null)) {
            $this->deleteDirectory($path, true);

            return $this;
        }

        $this->deleteDirectory($path);

        return $this;
    }

    /**
     * Delete a directory and prints.
     *
     * @param      $path
     * @param null $confirm
     *
     * @return DeleteDir
     */
    protected function deleteDirectory($path, $confirm = null)
    {
        $confirm_response = true;

        if ($confirm) {
            $confirm_response = $this->confirmDelete($path);
        }

        if ($confirm_response === false) {
            $this->info('No action taken');

            return false;
        }

        if ($confirm_response || $this->confirmDelete($path)) {
            File::deleteDirectory($path);
            $this->info("Directory Deleted: $path");

            return $this;
        }
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
