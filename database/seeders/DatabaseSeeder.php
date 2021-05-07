<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $user = new User();

        $user->name = 'Felipe';
        $user->phone = '3239169230';
        $user->email = 'felipe@felipe.com';
        $user->country = 'Colombia';
        $user->city = 'Bogota';
        $user->role = 'Administrador';
        $user->establishment_name = 'plasticos felipe';
        $user->password = Hash::make('felipe24');
        $user->save();
        
    
    }
}
