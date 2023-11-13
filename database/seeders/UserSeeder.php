<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $count = $this->command->ask('How many user generate',10);
        User::factory()->state(['name'=>'arkarlin','email'=>'arkarlin@gmail.com','password'=>bcrypt('arkarlin'),'isAdmin'=>true])->create();
        User::factory($count)->create();
    }
}
