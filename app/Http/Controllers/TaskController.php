<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskFilterRequest;
use App\Http\Requests\TaskRequest;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index(TaskFilterRequest $request)
    {
        /** @var App\Models\User */
        $user = auth()->user();

        $query = Task::where('user_id', $user->id);

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $tasks = $query->simplePaginate(10);

        return response()->json($tasks);
    }

    public function store(TaskRequest $request)
    {
        /** @var App\Models\User */
        $user = auth()->user();
        $fields = $this->getTaskFields($request);
        $fields['user_id'] = $user->id;
        $task = Task::create($fields);

        return response()->json($task->fresh(), 201);
    }

    public function show(Task $task)
    {
        return response()->json($task);
    }

    public function update(TaskRequest $request, Task $task)
    {
        $fields = $this->getTaskFields($request);
        $task->update($fields);

        return response()->json($task->fresh());
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json($task);
    }

    public function updateStatus(Request $request, Task $task)
    {
        $request->validate([
            'status' => 'required|boolean',
        ]);

        $task->update([
            'status' => $request->status,
            'due_date' => $request->status ? now() : null,
        ]);

        return response()->json($task);
    }

    public function stats()
    {
        /** @var App\Models\User */
        $user = auth()->user();

        $totalTasks = Task::where('user_id', $user->id)->count();
        $completedTasks = Task::where('user_id', $user->id)->where('status', true)->count();

        return response()->json([
            'total' => $totalTasks,
            'completed' => $completedTasks
        ]);
    }

    private function getTaskFields(TaskRequest $request): array
    {
        return $request->only(['title', 'description', 'status', 'due_date']);
    }
}
