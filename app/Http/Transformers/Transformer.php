<?php


namespace App\Http\Transformers;


abstract class Transformer
{
    public function transformCollection($items){
        return array_map([$this, 'transfrom'], $items);
    }

    public abstract function transfrom($item);
}
