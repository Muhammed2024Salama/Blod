<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;


class MakeInterfaceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:interface {name : The name of the interface}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new interface file';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');
        $filesystem = app(Filesystem::class);

        // Define the path for the interface file
        $path = app_path("Interfaces/{$name}.php");

        // Check if the file already exists
        if ($filesystem->exists($path)) {
            $this->error("Interface {$name} already exists!");
            return Command::FAILURE;
        }

        // Create the directory if it doesn't exist
        $filesystem->ensureDirectoryExists(app_path('Interfaces'));

        // Define the content for the interface file
        $stub = <<<PHP
        <?php

        namespace App\Interfaces;

        interface {$name}
        {
            //
        }
        PHP;

        // Write the content to the new interface file
        $filesystem->put($path, $stub);

        $this->info("Interface {$name} created successfully!");
        return Command::SUCCESS;
    }
}
