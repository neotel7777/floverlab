<?php
use Modules\Page\Entities\Page;
function getTranslation($item,$name,$locale){
    foreach($item->translations as $value){
        if($value->locale == $locale){
            return $value->$name;
        }
    }
    return '';
}
function clearPhone($string){
    return str_replace([' ',"-","_"],"",$string);
}

function price_format($price){

    return number_format($price,2,'.',' ');
}
function getBaseImage($files){

    foreach ($files as $file){
        if($file->pivot->zone =="base_image"){
            return [
                'filename'  => $file->filename,
                'id'        => $file->id,
                'path'      => $file->path
            ];
        }
        return false;
    }
}
function setVeiwed($product_id)
{
    $viewed = request()->session()->get('viewed');
    $viewed[$product_id] = $product_id;
    request()->session()->put('viewed',$viewed);

}
function transformText($text){
    $new  = explode("\r\n\r\n",$text);
    $result = [];
    foreach ($new as $item){
        if($item!='') {
            $item =  str_replace("\r\n","<br>",$item);
            $result[] = "<p>" . $item . "</p>";
        }
    }
    return implode($result);
}

function getCategoriesIdsbyTree($parent_id = Null, $startId = 0){
    static $ids=[];
    if(empty($ids) && $startId != 0){
        $ids[] = $startId;
    }
    if(!empty($startId)){
        $category = \Modules\Category\Entities\Category::find($startId);

        $parent_id = $category->parent_id;
    }
    $categories = \Modules\Category\Entities\Category::where('parent_id',$parent_id)->where('is_active',true)->where("in_product",true)->get();
    //dd($categories);
    if(!empty($categories)){
        foreach ($categories as $category){
            $ids[] = $category->id;
            getCategoriesIdsbyTree($category->id);
        }
    }
    return $ids;
}
function getMedias($products){
    if(empty($products)) return false();
    foreach ($products as &$product){
        $product->medias = $product->media;
    }
    return $products;
};

function getPageUrl($page_id)
{
    return Page::urlForPage($page_id);
}

function make_checkout_variants()
{
    $variants = trans('storefront::checkout.check_data');
    $result = [];
    foreach ($variants as $ind=>$variant){

        $result[$ind] =[
            'title' => setting('checkout_data_variants_title'.$ind),
            'description' => setting('checkout_data_variants_description'.$ind),
            'hint' => setting('checkout_data_variants_'.$ind),
        ];
    }

    return $result;
}
function make_checkout_actions()
{
    $actions = trans('storefront::checkout.check_actions');

    $result = [];
    foreach ($actions as $ind=>$action){

        $result[$ind] =[
            'title' => setting('checkout_data_actions_title'.$ind),
        ];
    }

    return $result;
}
function make_checkout_blocks()
{
    $blocks = trans('storefront::checkout.check_success_blocks');
    $result = [];
    foreach ($blocks as $ind=>$block){

        $result[$ind] =[
            'title' => setting('checkout_success_blocks_title'.$ind),
            'description' => setting('checkout_success_blocks_description'.$ind),
        ];
    }

    return $result;
}
function getLocale($locale)
{
    $locales = [
        'ru' => "ru_MD",
        'ro' => "ro_RO",
        'en' => "en_GB"
    ];
    return (!empty($locales[$locale])) ? $locales[$locale] : $locale;
}
function getLocaleData($data,$full=false)
{
    list($day,$mouth,$year) = explode(".",$data);
    $mouths = [
        'ru' => [
          'Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь' ,'Декабрь',
        ],
        'ro' => [
            'Ianuarie', 'Februarie', 'Martie', 'Aprilie', 'Mai', 'Iunie', 'Iulie', 'August', 'Septembrie', 'Octombrie', 'Noiembrie', 'Decembrie'
        ],
        'en' => [
            'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'
        ],
    ];
    if($full) {
        return "$day, {$mouths[locale()][$mouth-1]} $year";
    } else {
        return "{$mouths[locale()][$mouth-1]} $year";
    }
}
