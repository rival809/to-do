<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TodoController extends Controller
{
    use AuthorizesRequests; // <- tambahkan trait ini

    public function index()
    {
        $todos = Todo::where('user_id', auth()->id())->latest()->get();
        return view('todos.index', compact('todos'));
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required']);
        Todo::create([
            'title' => $request->title,
            'user_id' => auth()->id()
        ]);
        return redirect()->back()->with('success', 'Todo added!');
    }

    public function update(Request $request, Todo $todo)
    {
        $this->authorize('update', $todo);
        $todo->update(['is_done' => $request->is_done ? true : false]);
        return redirect()->back();
    }

    public function destroy(Todo $todo)
    {
        $this->authorize('delete', $todo);
        $todo->delete();
        return redirect()->back();
    }
}
