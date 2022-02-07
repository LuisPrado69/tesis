<?php

namespace App\Http\Controllers\Auth;

use App\Repositories\Repository\Configuration\SettingRepository;
use App\Repositories\Repository\Admin\UserRepository;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Mail\PasswordRecoveryMail;
use Illuminate\Http\Request;
use App\Models\System\User;

class ForgotPasswordController extends Controller
{

    /**
     * @var SettingRepository
     */
    protected $settingRepository;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * ForgotPasswordController constructor.
     *
     * @param SettingRepository $settingRepository
     * @param UserRepository $userRepository
     */
    public function __construct(
        SettingRepository $settingRepository,
        UserRepository $userRepository
    )
    {
        $this->settingRepository = $settingRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Download apk
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse|void
     */
    public function downloadApp()
    {
        $path = storage_path() . '/app/miseventos-app-release.apk';
        if (file_exists($path)) {
            return Response::download($path);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendEmail(Request $request) {
        try {
            $user = User::where('email', $request->email)->first();
            if(isset($user) ){
                $data['enabled'] = true;
                $data['password'] = str_random(8);
                $data['changed_password'] = false;
                $this->userRepository->updateFromArray($data, $user);
                // send email
                Mail::to($user->email)->send(new PasswordRecoveryMail($user, $data['password']));
                return redirect()->route('login')
                    ->withErrors([
                        'email' => trans('auth.email_sended'),
                    ])->withInput();
            }
        } catch (\Throwable $e) {
            defaultCatchHandler($e);
        }
    }

    /**
     * Check if email exists
     *
     * @param Request $request
     * @return string
     */
    public function checkEmail(Request $request)
    {
        $result = $this->userRepository->exists(['email' => strtolower($request->email)]);
        return json_encode($result);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRecoveryForm() {
        $logos = $this->settingRepository->findByKey('ui_logos');
        $labels = $this->settingRepository->findByKey('ui_project_labels');
        return view('auth.passwords.reset', [
            'logos' => $logos->value,
            'labels' => $labels->value
        ]);
    }
}
