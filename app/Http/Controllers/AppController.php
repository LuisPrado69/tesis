<?php

namespace App\Http\Controllers;

use App\Repositories\Repository\Configuration\SettingRepository;
use App\Repositories\Repository\System\NotificationRepository;
use App\Repositories\Repository\System\ShortcutRepository;
use Illuminate\Http\Response;
use Throwable;

/**
 * Class AppController
 * @package App\Http\Controllers
 */
class AppController extends Controller
{

    /**
     * @var SettingRepository
     */
    protected $settingRepository;

    /**
     * @var NotificationRepository
     */
    protected $notificationRepository;

    /**
     * @var ShortcutRepository
     */
    protected $shortcutRepository;

    /**
     * Create a new AppController instance.
     *
     * @param SettingRepository $settingRepository
     * @param NotificationRepository $notificationRepository
     * @param ShortcutRepository $shortcutRepository
     */
    public function __construct(
        SettingRepository $settingRepository,
        NotificationRepository $notificationRepository,
        ShortcutRepository $shortcutRepository
    ) {
        $this->middleware('auth');
        $this->settingRepository = $settingRepository;
        $this->notificationRepository = $notificationRepository;
        $this->shortcutRepository = $shortcutRepository;
    }

    /**
     * Render app index
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        try {
            $notifications = $this->notificationRepository->getLastNNotifications(currentUser()->id);
            $shortcuts = $this->shortcutRepository->findByUserId(currentUser()->id, 10);
            $menuStyles = $this->settingRepository->findByKey('ui_menu_styles');
            $logos = $this->settingRepository->findByKey('ui_logos');
            $labels = $this->settingRepository->findByKey('ui_project_labels');
            return view('layout.index', [
                'notifications' => $notifications,
                'shortcuts' => $shortcuts,
                'menuStyles' => $menuStyles->value,
                'logos' => $logos->value,
                'labels' => $labels->value
            ]);
        } catch (Throwable $e) {
            return view('layout.index', [
                'notifications' => [],
                'shortcuts' => []
            ]);
        }
    }

    /**
     * Render app dashboard
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dashboard()
    {
        try {
            $response['view'] = view('dashboard')->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Render view for unauthorized action
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function unauthorized()
    {
        try {
            $response = [
                'view' => view('errors.403')->render(),
                'message' => [
                    'type' => 'warning',
                    'text' => trans('app.messages.warning.unauthorized'),
                    'title' => trans('app.labels.deny')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * @return string
     * @throws Throwable
     */
    public function confirmedEmail()
    {
        return view('business.products.email.confirmed_data')->render();
    }
}