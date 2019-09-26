<?php

namespace App\Http\Controllers;

use App\Todolist;
use Illuminate\Http\Request;
use Auth;

class VueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tasks = Todolist::all();
        return response()->json([
            'tasks'=>$tasks
        ], 200);
    }

    public function button()
    {
        return [
            'text' => 'Button guna axios',
            'type' => 'submit'
        ];
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
        //

        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $task = new Todolist();
        $task->title = $request->title;
        $task->Description = $request->description;
        $task->user_id = Auth::user()->id;
        $task->save();

        return response()->json([
            'task' => $task,
            'message' => 'Task created successfully'
        ]);
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
        Todolist::find($request->id)->update($request->all());
        return response()->json([
            'message' => 'Updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Todolist::find($id)->delete();
        return response()->json([
            'task' => $task,
            'message' => 'task has been Deleted!'
        ]);
        //

    }
}
