<?php

namespace App\Http\Controllers;

use App\Todolist;
use Illuminate\Http\Request;
use Auth;

class TodolistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // dd(Auth::user()->todolist);
        $todolists = Todolist::with('user.client')->paginate(15);
        // dd($todolists->first()->user->client->first()->name);
        // dd($todolists);

        return view('todolists.index',compact('todolists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('todolists.create');
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
        // $todolist = new Todolist();
        // $todolist->title = $request -> title;
        // $todolist->description = $request -> description;
        // $todolist->user_id = Auth::user()->id;
        // $todolist->save();

        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        Todolist::create($input);

        // return redirect('/todolist/create');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Todolist  $todolist
     * @return \Illuminate\Http\Response
     */
    public function show(Todolist $todolist)
    {
        //
        return view('todolists.show', compact('todolist'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Todolist  $todolist
     * @return \Illuminate\Http\Response
     */
    public function edit(Todolist $todolist)
    {
        //
        return view('todolists.edit', compact('todolist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Todolist  $todolist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todolist $todolist)
    {
        //
        $todolist->update($request->all());
        return redirect('/todolist');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todolist  $todolist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todolist $todolist)
    {
        //
        $todolist->delete();
        return redirect('/todolist');
    }

    public function delete(Request $request)
    {
        Todolist::destroy($request->id);
        return redirect('/todolist');
    }
}
