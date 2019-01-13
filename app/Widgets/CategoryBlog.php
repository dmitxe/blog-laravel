<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use TCG\Voyager\Models\Category;

class CategoryBlog extends AbstractWidget
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
        $models = Category::all();
        $arr_cat = [];
        foreach($models as $model) {
       //     var_dump($model->slug); exit;
            //Формируем массив, где ключами являются адишники на родительские категории
            if (is_null($model['parent_id'])) {
                $parent_id = 0;
            } else {
                $parent_id = $model['parent_id'];
            }
            if(empty($arr_cat[$parent_id])) {
                $arr_cat[$parent_id] = array();
            }
            $arr_cat[$parent_id][] = ['id' => $model['id'], 'slug' => $model['slug'], 'name' => $model['name']];
        }
        self::view_cat($s, $arr_cat,0);
   /*     echo '<pre>';
       print_r($arr_cat);
       echo '</pre>';
        $s = '';
        echo $s;
        exit;*/
        return view('widgets.category_blog', [
            'config' => $this->config,
          //  'models' => $models,
         //   'items' => $arr_cat,
            'result' => $s
        ]);
    }

//вывод каталога с помощью рекурсии
// https://webformyself.com/vyvod-mnogourovnevogo-menyu-s-neogranichennym-urovnem-vlozhennosti/
    public static function view_cat(&$res, $arr,$parent_id = 0) {

        //Условия выхода из рекурсии
        if(empty($arr[$parent_id])) {
            return;
        }
        if ($parent_id == 0) {
            $res .= '<div class="list-group list-group-root well">';
        } else {
            $res .= '<div class="list-group">';
        }
        //перебираем в цикле массив и выводим на экран
        for($i = 0; $i < count($arr[$parent_id]);$i++) {
            $res .= '<a class="list-group-item" href="/blog/category/'.$arr[$parent_id][$i]['slug'].'">'
                .$arr[$parent_id][$i]['name'].'</a>';
            //рекурсия - проверяем нет ли дочерних категорий
            self::view_cat($res, $arr,$arr[$parent_id][$i]['id']);
        //    $res .= '</div>';
        }
        $res .= '</div>';
   //     echo 'ddd'.$res;

    }
}
