<?php

namespace App\Http\Controllers\Api\Todo;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{

    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json(Todo::all());
    }


    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validatedData = $request->validate([
            'title' => ['required|string'],
        ]);
        $todo = Todo::create($validatedData);
        return response()->json(['message' => 'Todo created successfully', 'data' => $todo], 201);
    }


    public function show(Todo $todo): \Illuminate\Http\JsonResponse
    {
        return response()->json(['data'=>$todo]);
    }


    public function update(Request $request, Todo $todo): \Illuminate\Http\JsonResponse
    {
        $validatedData = $request->validate([
            'title'=>['required|string']
        ]);
        $updatedTodo = $todo->update($validatedData);

        return response()->json(['data'=>$updatedTodo]);
    }


    public function destroy(Todo $todo): \Illuminate\Http\JsonResponse
    {
        $todo->delete();
        return response()->json('Todo Deleted Successfully.',202);
    }
}
