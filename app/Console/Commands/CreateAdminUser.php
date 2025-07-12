<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-admin-user';

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
        if (!$user = User::where('email', $this->argument('email'))->first()) {
        return $this->error('User not found!');
    }

    $user->update(['is_admin' => true]);
    $this->info("User {$user->email} is now an admin");
    }
}
