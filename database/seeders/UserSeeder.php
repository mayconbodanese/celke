<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!User::where('email', 'teste1@celke.com.br')->first()) {
            User::create([
                    'name' => 'Teste1',
                    'email' => 'teste1@celke.com.br',
                    'password' => Hash::make('123456a', ['rounds' => 12]),
                ]);
            if (!User::where('email', 'teste2@celke.com.br')->first()) {
                User::create([
                        'name' => 'Teste2',
                        'email' => 'teste2@celke.com.br',
                        'password' => Hash::make('123456a', ['rounds' => 12]),
                    ]);
            }
            if (!User::where('email', 'teste3@celke.com.br')->first()) {
                User::create([
                        'name' => 'Teste3',
                        'email' => 'teste3@celke.com.br',
                        'password' => Hash::make('123456a', ['rounds' => 12]),
                    ]);
            }
            if (!User::where('email', 'teste4@celke.com.br')->first()) {
                User::create([
                        'name' => 'Teste4',
                        'email' => 'teste4@celke.com.br',
                        'password' => Hash::make('123456a', ['rounds' => 12]),
                    ]);
            }
        }
    }
}
