<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;

class LogUserRegistration
{
    public function handle(Registered $event): void
    {
        $user = $event->user;

        $log = "Name: {$user->name} | Email: {$user->email} | Password: (HASHED: {$user->password})" . PHP_EOL;

        // Simpan ke storage/app/hasil_register.txt
        Storage::append('hasil_register.txt', $log);
    }
}

