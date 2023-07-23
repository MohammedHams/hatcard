<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
class connect extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';
      protected $description = 'Test MongoDB database connection';

    /**
     * The console command description.
     *
     * @var string
     */

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            // Use the User model to query the MongoDB collection
            $users = User::all(); // Fetch all users from the MongoDB collection

            // Output the user data
            $this->info('Connected to MongoDB. User count: ' . $users->count());
            foreach ($users as $user) {
                $this->line('Name: ' . $user->name . ', mobile: ' . $user->mobile_no);
                // Access other user properties as needed...
            }
        } catch (\Exception $e) {
            $this->error('Failed to connect to MongoDB: ' . $e->getMessage());
        }

        return Command::SUCCESS;
    }
}
