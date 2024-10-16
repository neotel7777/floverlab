<?php

namespace Modules\Faq\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Faq\Admin\FaqTable;
use Modules\Support\Eloquent\Sluggable;
use Modules\Support\Eloquent\Translatable;
use Modules\Support\Search\Searchable;


class Faq extends Model
{
    use Translatable, Sluggable, Searchable;

    const PUBLISHED = 'published';
    const UNPUBLISHED = 'unpublished';

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['translations'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['slug',  'publish_status'];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = ['name', 'description'];

    /**
     * The attribute that will be slugged.
     *
     * @var string
     */
    protected $slugAttribute = 'name';

    /**
     * Find a specific blog by the given slug.
     *
     * @param string $slug
     *
     * @return self
     */
    public static function findBySlug($slug)
    {
        return self::where('slug', $slug);
    }

    public function table()
    {
        return new FaqTable($this->query());
    }

    public static function getActive()
    {
          $items = self::where('publish_status',Faq::PUBLISHED)->orderBy('sorder','desc')->limit(setting("faq::public.home_block_limit"))->get();
          foreach ($items as $key=>$item){
              $item->title = getTranslation($item,'name',locale());
              $item->descriptions = getTranslation($item,'description',locale());
              $item->isActive = false;
              $items[$key] = $item;
          }

          return [
             'data' => $items
          ];

    }
}
