<?php

namespace App\Widgets;

use App\Post;
use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Facades\DB;

class ArchiveWidget extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //

     /*    $query = DB::table('posts')->select('created_at', DB::raw('MONTH(created_at)'.' as month'), DB::raw('YEAR (created_at)'. ' as year'))
                 ->where('status', "'PUBLISHED'")
                 ->groupBy(['year', 'month'])
                 ->orderBy('year', 'desc')
                 ->orderBy('month', 'desc')
                 ->limit(24);*/
        $query = "SELECT MAX(created_at) as created_at, MONTH(created_at) as `month`, YEAR (created_at) as `year`
				FROM posts
				WHERE status = 'PUBLISHED'
				GROUP BY `year`, `month`				
				ORDER BY `year` desc, `month` desc
				LIMIT ? ";


        $models = DB::select($query, [24]);
//        dd($query->toSql()); exit;
      //       $models = $query->get();
//        dd($models); exit;
//        $models = Post::getArchived(24);

        return view('widgets.archive_widget', [
            'config' => $this->config,
            'models' => $models,
        ]);
    }
}
