<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class UserSeeder extends Seeder
{
    public $createAmount = 200000;
    public $chunkAmount = 5000;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ini_set('memory_limit','1024M');

        $userData = $this->createUsers();

        $this->importUsers($userData);


        // Outputs the amount of users in the database
        $importedUsers = User::count();
        $this->command->info("{$importedUsers} users found in the database");
    }

    public function createUsers()
    {
        // Start Progress bar for creating array of users
        $this->command->info("Creating array of {$this->createAmount} users");
        $this->command->getOutput()->progressStart($this->createAmount);

        for ($ii=0; $ii < $this->createAmount; $ii++) {
            $userData[] = User::factory()->raw();

            $this->command->getOutput()->progressAdvance();
        }

        // Finish Progress bar for creating array of users
        $this->command->getOutput()->progressFinish();

        return $userData;
    }

    public function importUsers($userData)
    {
        $chunks = array_chunk($userData, $this->chunkAmount);

        // Start Progress bar for importing array of users
        $this->command->info("Importing {$this->createAmount} users into the database split into chunks of {$this->chunkAmount}");
        $this->command->getOutput()->progressStart($this->createAmount);

        foreach ($chunks as $chunk) {
            // This will not trigger any model events (observers)
            User::insert($chunk);

            $this->command->getOutput()->progressAdvance($this->chunkAmount);
        }

        // Finish Progress bar for importing array of users
        $this->command->getOutput()->progressFinish();

        // Clean up
        unset($chunks, $chunk, $userData);
    }
}
