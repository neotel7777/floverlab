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
{

}
