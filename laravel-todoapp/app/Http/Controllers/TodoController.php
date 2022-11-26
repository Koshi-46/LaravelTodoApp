<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\Genre;
use App\Http\Requests\TodoRequest;


class TodoController extends Controller
{
    //
    public function index()
    {
        $todos = Todo::all();
        $genres = Genre::all();
        return view('index', ['todos' => $todos, 'genres' => $genres]);
    }

    public function store(TodoRequest $request)
    {
        //
        $todo = $request->all();
        Todo::create($todo);
        return redirect('/todo');
    }


    public function update(TodoRequest $request)
    {
        $todo = Todo::find($request->id);
        $todo->content = $request->content;
        $todo->genre_id = $request->genre_id;
        $todo->save();
        return redirect('/todo');
    }

    public function delete(Request $request)
    {
        $todo = Todo::find($request->id);
        $todo->delete();
        return redirect('/todo');
    }

    // public function find()
    // {
    //     $genres = Genre::all();
    //     $todos = [];
    //     $todos = Todo::all();
    //     return view('todos.search', ['todos' => $todos, 'genres' => $genres]);
    // }

    public function search(Request $request)
    {
        // $genres = Genre::all();
        // $keyword = $request->input('content');
        // $genre_id = $request['genre_id'];
        // $todos = Todo::doSearch($keyword, $genre_id);
        // return view('todos.search', ['todos' => $todos, 'genres' => $genres]);

        $search = $request->input('content');
        $searching = $request->input('genre_id');

        $todo = Todo::query();
        $genres = Genre::all();


        if ($search !== null) {
            $todo->where('content', 'like', '%' . $search . '%');
        };
        if ($searching !== null) {
            $todo->where('genre_id', $searching);
        };

        $todos = $todo->get();

        return view('index', ['todos' => $todos, 'genres' => $genres]);
    }
}
