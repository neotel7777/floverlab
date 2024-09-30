<?php

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
