<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ClearTemp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clear-temp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all file inside temp folder';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
    //    $this->cleanDirectory('/tmp/uploads/');
    }

    private function cleanDirectory($path, $recursive = false)
    {
        $storage = Storage::disk('public');
        foreach ($storage->files($path, $recursive) as $file) {
            $storage->delete($file);
        }
    }
}
