<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cliente::factory(5)->create([
            'name' => fake()->name,
            'cpf' => fake()->cpf,
            'telefone' => '(11) ' . fake()->cellPhone,
        ]);
    }
}
