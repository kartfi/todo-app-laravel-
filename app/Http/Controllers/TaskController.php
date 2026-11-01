<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * READ - Show the list of tasks.
     * Supports filtering with ?status=pending or ?status=completed in the URL.
     */
    public function index(Request $request)
    {
        // Which list to show: all / pending / completed (default is "all")
        $filter = $request->query('status', 'all');

        // Get tasks from the database depending on the chosen filter
        if ($filter === 'pending') {
            $tasks = Task::where('status', 0)->latest()->get();
        } elseif ($filter === 'completed') {
            $tasks = Task::where('status', 1)->latest()->get();
        } else {
            $tasks = Task::latest()->get();
        }

        // Count tasks for the summary cards at the top of the page
        $totalTasks = Task::count();
        $pendingTasks = Task::where('status', 0)->count();
        $completedTasks = Task::where('status', 1)->count();

        // Pass the data to the Blade view "tasks.index"
        return view('tasks.index', compact(
            'tasks',
            'totalTasks',
            'pendingTasks',
            'completedTasks',
            'filter'
        ));
    }

    /**
     * CREATE - Show the empty "Add Task" form.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * CREATE - Save the new task to the database.
     */
    public function store(Request $request)
    {
        // Validate the incoming form data. If it fails, Laravel
        // automatically redirects back with error messages.
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|max:2000',
        ]);

        // Insert a new row. status starts at 0 (Pending).
        Task::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'status' => 0,
        ]);

        return redirect()->route('tasks.index')
            ->with('success', 'Task added successfully!');
    }

    /**
     * UPDATE - Show the edit form filled with the existing task.
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    /**
     * UPDATE - Save the edited task back to the database.
     */
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|max:2000',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')
            ->with('success', 'Task updated successfully!');
    }

    /**
     * DELETE - Remove a task from the database.
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Task deleted successfully!');
    }

    /**
     * TOGGLE - Flip a task between Pending (0) and Completed (1).
     */
    public function toggle($id)
    {
        $task = Task::findOrFail($id);

        // If it is completed (1) make it pending (0), and vice-versa.
        $task->status = $task->status ? 0 : 1;
        $task->save();

        return redirect()->back()
            ->with('success', 'Task status updated!');
    }
}
