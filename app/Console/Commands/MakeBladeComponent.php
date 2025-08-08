<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeBladeComponent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-blade-component {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
          $name = $this->argument('name');
        $filePath = resource_path("views/components/{$name}.blade.php");

        // Check if file already exists
        if (File::exists($filePath)) {
            $this->error("Component {$name} already exists.");
            return;
        }

        // Create the file
        File::put($filePath, "<!-- {$name} component -->");

        $this->info("Blade component {$name} created successfully.");
    }
}
