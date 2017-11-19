<?php

namespace App\Http\Controllers;

use App\Todo;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('todo.index');
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
        $todos = auth()->user()->todos()->create([
            'name' => $request->name,
            'category' => $request->category,
        ]);

        return response()->success($todos->only('id', 'name', 'category'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        $todo->update(['status' => 2]);

        return response()->success(['updated' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();

        return response()->success(['deleted' => true]);
    }

    public function showByDate($date)
    {
        $todos = auth()->user()
            ->todos()
            ->where('created_at', '>=', (new Carbon($date))->startOfDay())
            ->where('created_at', '<=', (new Carbon($date))->endOfDay())
            ->get();

        return response()->success([
            'todos' =>$todos
        ]);
    }
}
