<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

class DisqusWidget extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'page_id' => ''
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        return view('widgets.disqus_widget', [
            'config' => $this->config,
        ]);
    }
}
