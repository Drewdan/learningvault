<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates an admin';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
    	$name = $this->ask('Enter the admin name');
        $email = $this->ask('Insert the admin email address');
        $password = $this->ask('Choose a password');

        User::create([
        	'name' => $name,
        	'email' => $email,
	        'password' => Hash::make($password),
        ])
            ->assignRole('admin');

        $this->info('The admin account has been added');
    }
}
