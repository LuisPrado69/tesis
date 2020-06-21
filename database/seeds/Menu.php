<?php


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class Menu extends Seeder
{
    /**
     * Run the Menu seeds.
     *
     * @return void
     */
    public function run()
    {

        $model = new \App\Models\System\Menu;
        $model::truncate();

        // Administration
        $admin = $model->create([
            'label' => 'Administración',
            'slug' => NULL,
            'icon' => 'gear',
            'weight' => 100,
            'enabled' => 1
        ]);

        $model->create([
            'label' => 'Roles',
            'slug' => 'index.roles',
            'icon' => '',
            'weight' => 101,
            'enabled' => 1,
            'parent_id' => $admin->id
        ]);

        $model->create([
            'label' => 'Usuarios',
            'slug' => 'index.users',
            'icon' => '',
            'weight' => 102,
            'enabled' => 1,
            'parent_id' => $admin->id
        ]);

        // Catalogs
        $catalogs = $model->create([
            'label' => 'Catálogos',
            'slug' => null,
            'icon' => null,
            'weight' => 200,
            'enabled' => 1
        ]);

        $model->create([
            'label' => 'Categorias',
            'slug' => 'index.category.catalogs',
            'icon' => '',
            'weight' => 2001,
            'enabled' => 1,
            'parent_id' => $catalogs->id
        ]);

        // Catalogs
        $model->create([
            'label' => 'Eventos',
            'slug' => 'index.events',
            'icon' => null,
            'weight' => 300,
            'enabled' => 1
        ]);
    }
}