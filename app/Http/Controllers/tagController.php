<?php

namespace App\Http\Controllers;

use App\Http\Transformers\TagsTransformer;
use App\Lesson;
use App\Tag;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class tagController extends ApiController
{
    protected $tagsTransformer;

    public function __construct(TagsTransformer $tagsTransformer)
    {
        $this->tagsTransformer = $tagsTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($lesson_id = null)
    {
        try {
            $tags = $lesson_id ? Lesson::findOrFail($lesson_id)->tags : Tag::all();
            return response([
                'data' => $this->tagsTransformer->transformCollection($tags->toArray())
            ]);
        }
        catch (ModelNotFoundException $e){
            return $this->respondNotFound();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


}
