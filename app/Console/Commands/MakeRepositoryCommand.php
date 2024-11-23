<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;


class MakeRepositoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name : The name of the repository}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository class';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');
        $filesystem = app(Filesystem::class);

        // Define paths
        $repositoryPath = app_path("Repositories/{$name}.php");
        $interfacePath = app_path("Repositories/{$name}Interface.php");

        // Check if files already exist
        if ($filesystem->exists($repositoryPath) || $filesystem->exists($interfacePath)) {
            $this->error("Repository or interface for {$name} already exists!");
            return Command::FAILURE;
        }

        // Ensure directories exist
        $filesystem->ensureDirectoryExists(app_path('Repositories'));
        $filesystem->ensureDirectoryExists(app_path('Repositories'));

        // Create repository file
        $repositoryStub = <<<PHP
        <?php

        namespace App\Repositories;

        use App\Repositories\\{$name}Interface;

        class {$name} implements {$name}Interface
        {
            //
        }
        PHP;
        $filesystem->put($repositoryPath, $repositoryStub);

        // Create interface file
        $interfaceStub = <<<PHP
        <?php

        namespace App\Repositories;

        interface {$name}Interface
        {
            //
        }
        PHP;
        $filesystem->put($interfacePath, $interfaceStub);

        $this->info("Repository and interface for {$name} created successfully!");
        return Command::SUCCESS;
    }
}
