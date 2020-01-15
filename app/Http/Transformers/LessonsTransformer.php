<?php


namespace App\Http\Transformers;


class LessonsTransformer extends Transformer
{

    public function transfrom($item)
    {
        return [
            'title' => $item['title'],
            'body' => $item['body'],
            'active' => (boolean)$item['is_ready'],
        ];
    }
}
