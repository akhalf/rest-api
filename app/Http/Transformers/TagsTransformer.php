<?php


namespace App\Http\Transformers;


class TagsTransformer extends Transformer
{

    public function transfrom($item)
    {
        return [
            'name' => $item['name']
        ];
    }
}
