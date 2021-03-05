<?php

namespace Database\Seeders;

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
        $this->call(RolSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ProductoSeeder::class);
        $this->call(TipoSeeder::class);
        $this->call(DetalleSeeder::class);
        $this->call(ReservaSeeder::class);

    }
}
