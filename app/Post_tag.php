<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Post_tag extends Model
{
    public function save(array $options = [])
    {
        $query = "SELECT count(id) as count_tags FROM tag WHERE id = ? ";
        $models = DB::select($query, [$this->id]);
        dd($models); exit;
        foreach ($models as $model) {
         //   dd($model);
            $query = "UPDATE tag SET weight = ? WHERE id = ? ";
            DB::update($query, [$model->count_tags, $model->id]);
        }

        parent::save();
    }


}
