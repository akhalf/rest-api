<?php

namespace App\Http\Controllers;

use App\Events\LessonsWasDeleted;
use App\Http\Transformers\LessonsTransformer;
use App\Lesson;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class LessonController extends ApiController
{
    Protected $lessonsTransformer;
    public function __construct(LessonsTransformer $lessonsTransformer)
    {
        $this->lessonsTransformer = $lessonsTransformer;

        $this->middleware('auth.basic', ['only' => 'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = $request->limit < 30 ? $request->limit : 3;
        //
        //return Lesson::all();
        $lessons = Lesson::paginate($limit)->all();
        return Response::json([
            'date' => date('Y-m-d'),
            'data' => $this->lessonsTransformer->transformCollection($lessons),
            //'paginator' => Lesson::paginate()

        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (!$request->title || !$request->body){
            return $this->respondInvalidRequest();
        }
        else{
            Lesson::created([
                'title' => $request->title,
                'body' => $request->body,
                'is_ready' => $request->active,
            ]);
            return Response::json($request->title);
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
        $lesson = Lesson::find($id);
        if (! $lesson){
            return $this->respondNotFound();
        }
        else{
            return $this->respond([
                'lesson' => $this->lessonsTransformer->transfrom($lesson),
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lesson = Lesson::find($id);
        $lesson->delete();
        event(new LessonsWasDeleted($lesson));
        return $this->respond(['msg' => 'lesson deleted']);
    }
}
