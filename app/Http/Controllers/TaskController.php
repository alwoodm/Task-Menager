<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Pobierz tylko zadania zalogowanego użytkownika
        $tasks = Auth::user()->tasks()->orderBy('created_at', 'desc')->get();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $user = Auth::user();
        $user->tasks()->create([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority ?? 2, // Default to medium priority
            'is_completed' => false, 
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task has been successfully added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        // Sprawdź, czy zalogowany użytkownik jest właścicielem zadania
        if (Auth::id() !== $task->user_id) {
            abort(403); // Zwróć błąd 403 Forbidden, jeśli nie jest właścicielem
        }
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        // Sprawdź, czy zalogowany użytkownik jest właścicielem zadania
        if (Auth::id() !== $task->user_id) {
            abort(403);
        }
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|integer|min:1|max:3',
        ]);

        // Set is_completed to false if not provided in the request
        $is_completed = $request->has('is_completed') ? true : false;

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'is_completed' => $is_completed,
            'priority' => $request->priority,
        ]);

        return redirect()->route('tasks.index')
            ->with('success', 'Task has been successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        // Check if the logged-in user is the owner of the task
        if (Auth::id() !== $task->user_id) {
            abort(403);
        }

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task has been successfully deleted.');
    }

    /**
     * Mark the specified resource as complete.
     */
    public function complete(Task $task)
    {
        // Check if the logged-in user is the owner of the task
        if (Auth::id() !== $task->user_id) {
            abort(403);
        }

        $task->update(['is_completed' => !$task->is_completed]);

        $message = $task->is_completed ? 'Task marked as completed.' : 'Task marked as incomplete.';

        return redirect()->route('tasks.index')->with('success', $message);
    }
}