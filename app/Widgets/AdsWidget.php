<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

class AdsWidget extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    public $position = 'sidebar';

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //
        if ($this->config['position'] == 'sidebar') {
            $client = config('ads.sidebar.ad-client');
            $slot = config('ads.sidebar.ad-slot');
            return view('widgets.ads_widget_sidebar', [
                'config' => $this->config,
                'client' => $client,
                'slot' => $slot,
            ]);
        } else {
            $client = config('ads.bottom.ad-client');
            $slot = config('ads.bottom.ad-slot');
            return view('widgets.ads_widget_bottom', [
                'config' => $this->config,
                'client' => $client,
                'slot' => $slot,
            ]);
        }
    }
}
