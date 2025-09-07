<?php

namespace App\Widgets;

use App\Models\Tag;
use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Facades\DB;

class TagWidget extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'max_count' => 50
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $query = "SELECT * FROM tags ORDER BY RAND() LIMIT ? ";
        $models = DB::select($query, [$this->config['max_count']]);

        return view('widgets.tag_widget', [
            'config' => $this->config,
            'models' => $models,
        ]);
    }
}
