<?php

namespace App\Observers;

use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Models\Post;

class PostObserver
{
    /**
     * Handle the post "created" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function created(Post $post)
    {
        $query = "SELECT tag_id, count(tag_id) as count_tags FROM post_tag WHERE post_id = ? ";
        $models = DB::select($query, [$post->id]);
        foreach ($models as $model) {
            $query = "UPDATE tags SET weight = ? WHERE id = ? ";
            DB::update($query, [$model->count_tags, $model->tag_id]);
        }
    }

    /**
     * Handle the post "updated" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function updated(Post $post)
    {
        $query = "SELECT tag_id, count(tag_id) as count_tags FROM post_tag WHERE post_id = ? ";
        $models = DB::select($query, [$post->id]);
        foreach ($models as $model) {
            $query = "UPDATE tags SET weight = ? WHERE id = ? ";
            DB::update($query, [$model->count_tags, $model->tag_id]);
        }
    }

    /**
     * Handle the post "deleted" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function deleted(Post $post)
    {
        $query = "SELECT tag_id, count(tag_id) as count_tags FROM post_tag WHERE post_id = ? ";
        $models = DB::select($query, [$post->id]);
        foreach ($models as $model) {
            $query = "UPDATE tags SET weight = ? WHERE id = ? ";
            DB::update($query, [$model->count_tags, $model->tag_id]);
        }
    }

    /**
     * Handle the post "restored" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function restored(Post $post)
    {
        //
    }

    /**
     * Handle the post "force deleted" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function forceDeleted(Post $post)
    {
        //
    }
}
