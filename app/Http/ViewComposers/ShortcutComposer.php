<?php

namespace App\Http\ViewComposers;

use App\Models\System\Shortcut;
use App\Repositories\Repository\System\ShortcutRepository;
use Illuminate\View\View;

class ShortcutComposer
{
    /**
     * @var ShortcutRepository
     */
    protected $shortcutRepository;

    /**
     * @var Shortcut
     */
    protected $shortcut;

    /**
     * Create a new profile composer.
     * @param ShortcutRepository $shortcutRepository
     */
    public function __construct(ShortcutRepository $shortcutRepository)
    {
        $this->shortcutRepository = $shortcutRepository;
        $this->shortcut = new Shortcut();
    }

    private function isShortcutSaved($URL)
    {
        $shortcuts = $this->shortcutRepository->findByUserId(currentUser()->id);

        foreach ($shortcuts as $shortcut) {
            if ($shortcut->URL == $URL) {
                $this->shortcut = $shortcut;
                return true;
            }
        }
        return false;
    }

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $url = $view->offsetGet('URL');
        $defaultName = $view->offsetGet('default_name');

        $view->with('isShortcutSaved', $this->isShortcutSaved($url));
        $view->with('shortcut', $this->shortcut);
        $view->with('default_name', $defaultName);
    }
}