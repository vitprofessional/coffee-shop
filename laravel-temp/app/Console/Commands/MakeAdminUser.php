<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class MakeAdminUser extends Command
{
    protected $signature = 'make:admin {--email=} {--password=}';

    protected $description = 'Create an admin user for Filament access';

    public function handle(): int
    {
        $email = $this->option('email') ?: $this->ask('Email for admin user');
        $password = $this->option('password') ?: $this->secret('Password (will be hashed)');

        if (! $email || ! $password) {
            $this->error('Email and password are required');
            return self::FAILURE;
        }

        $user = User::updateOrCreate(
            ['email' => $email],
            ['name' => 'Admin', 'password' => $password, 'is_admin' => true]
        );

        $this->info('Admin user created/updated: ' . $user->email);
        return self::SUCCESS;
    }
}
