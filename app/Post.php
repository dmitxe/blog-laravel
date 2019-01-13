<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Traits\Resizable;
use TCG\Voyager\Traits\Translatable;

class Post extends Model
{
    use Translatable,
        Resizable;

    protected $translatable = ['title', 'seo_title', 'excerpt', 'body', 'slug', 'meta_description', 'meta_keywords'];

    const PUBLISHED = 'PUBLISHED';

    protected $guarded = [];

    protected $ids = [];

    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
            // ... code here
        });

        self::created(function($model){
            // ... code here
        });

        self::updating(function($model){
        });

        self::updated(function($model){
            // ... code here
        });

        self::deleting(function($model){
            // ... code here
        });

        self::deleted(function($model){
            // ... code here
        });
    }

    public function save(array $options = [])
    {
        // If no author has been assigned, assign the current user's id as the author of the post
        if (!$this->author_id && Auth::user()) {
            $this->author_id = Auth::user()->id;
        }

        $query = "SELECT tag_id FROM post_tag WHERE post_id = ? GROUP BY tag_id ";
        $models = DB::select($query, [$this->id]);
        $ids_old = [];
        foreach ($models as $model) {
            $ids_old[] = $model->tag_id;
        }
        //       dd($ids_old);

   //     echo 'p_id='.$this->id;

    //    var_dump($ids_old);

        parent::save();

   /*     $query = "SELECT tag_id FROM post_tag WHERE post_id = ? GROUP BY tag_id ";
        $models = DB::select($query, [$this->id]);
        $ids_new = [];
        foreach ($models as $model) {
            $ids_new[] = $model->tag_id;
        }*/
        $ids_new = Request::input('post_belongstomany_tag_relationship',[]);
    //    var_dump($ids_new);

        $ids = array_unique(array_merge($ids_old, $ids_new));
   //     var_dump($ids);
     //   dd($ids);
        $s = implode(',',$ids);
    //    echo $s;

        $query = "SELECT tag_id, count(*) as count_tags FROM post_tag WHERE tag_id in ($s) GROUP BY tag_id ";
        $models = DB::select($query);
    //    dd($models);
   //     exit;
        foreach ($models as $model) {
            $weight = $model->count_tags;
            $is_update = false;
            if (in_array($model->tag_id,$ids_new) && !in_array($model->tag_id,$ids_old)) {
                $weight++;
                $is_update = true;
            } elseif (!in_array($model->tag_id,$ids_new) && in_array($model->tag_id,$ids_old)) {
                $weight--;
                $is_update = true;
            }
//            if ($is_update)
            $query = "UPDATE tags SET weight = ? WHERE id = ? ";
            DB::update($query, [$weight, $model->tag_id]);
        }
//        dd($models);
//        echo 'ssss'; exit;

    }

    public function authorId()
    {
        return $this->belongsTo(Voyager::modelClass('User'), 'author_id', 'id');
    }

    /**
     * Scope a query to only published scopes.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished(Builder $query)
    {
        return $query->where('status', '=', static::PUBLISHED);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'post_tag');
    }

    public static function getArchived($limit = 12)
    {
        $q = "SELECT created_at, MONTH(created_at) as month, YEAR (created_at) as year
				FROM ".self::tableName()." as p
				WHERE is_enabled = 1
				GROUP BY year, month				
				ORDER BY year desc, month desc
				LIMIT :limit";

   /*     $query = DB::table('posts')->select('created_at', 'MONTH(created_at) as month', 'YEAR (created_at) as year')
            ->where('status', '=', 'PUBLISHED')
            ->groupBy('year, month')
            ->orderBy('year desc, month desc')
            ->limit($limit);
        $res = $query->get();*/
   $res = null;

     //   $res =  Yii::$app->db->createCommand($q)
     //       ->bindValues(["limit"=>$limit])->queryAll();

        return ($res == null ? [] : $res);
    }


}
