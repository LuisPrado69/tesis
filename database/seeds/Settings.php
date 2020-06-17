<?php


use Illuminate\Database\Seeder;
use Carbon\Carbon;

class Settings extends Seeder
{
    /**
     * Run the Settings seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = new \App\Models\System\Setting;
        $model::truncate();

        $model->create([
            'key' => 'ui_menu_styles',
            'value' => [
                'color' => '#256ba7',
                'active_color' => '#004179',
                'text_color' => '#FFFFFF'
            ],
            'description' => 'Estilos del menú lateral izquierdo'
        ]);

        $model->create([
            'key' => 'ui_logos',
            'value' => [
                'login_logo' => 'assets/images/logo_sloncorp_login.png',
                'menu_logo' => 'assets/images/logo_sloncorp.jpg'
            ],
            'description' => 'Ruta de los logos del proyecto'
        ]);

        $model->create([
            'key' => 'ui_project_labels',
            'value' => [
                'system_name' => trans('app.labels.system_name'),
                'system_slogan' => trans('app.labels.system_slogan'),
                'footer' => trans('app.labels.footer')
            ],
            'description' => 'Etiquetas generales del proyecto'
        ]);

    }
}