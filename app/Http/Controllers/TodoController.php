<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use Illuminate\Support\Facades\Storage;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();
        return view('index', compact('todos'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $profileImage);
            $input['image'] = "$profileImage";
        }

        Todo::create($input);

        return redirect()->route('todos.index')
            ->with('success', 'Todo created successfully.');
    }

    public function edit(Todo $todo)
    {
        return view('edit', compact('todo'));
    }

    public function update(Request $request, Todo $todo)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            // Delete old image if exists
            if(file_exists(public_path('images/'.$todo->image))){
                unlink(public_path('images/'.$todo->image));
            }

            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $profileImage);
            $input['image'] = "$profileImage";
        } else {
            unset($input['image']);
        }

        $todo->update($input);

        return redirect()->route('todos.index')
            ->with('success', 'Todo updated successfully');
    }

    public function destroy(Todo $todo)
    {
        // Delete image from server
        if(file_exists(public_path('images/'.$todo->image))){
            unlink(public_path('images/'.$todo->image));
        }
        
        $todo->delete();

        return redirect()->route('todos.index')
            ->with('success', 'Todo deleted successfully');
    }
}
