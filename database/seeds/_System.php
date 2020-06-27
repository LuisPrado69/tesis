<?php

use Illuminate\Database\Seeder;

class _System extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            Acl::class,
            Menu::class,
            Settings::class,
            Catalogs::class
        ]);
    }
}
