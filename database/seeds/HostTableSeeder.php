<?php

use Illuminate\Database\Seeder;

class HostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Host::class, 100)->create();
    }
}
