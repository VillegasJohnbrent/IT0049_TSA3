<?php
namespace App\Http\Controllers;
use App\Models\Task;
use App\Models\User;
use Illuminate\View\View;
class DashboardController
{
    public function index(): View
    {
        $tasks = Task::forToday()->orderBy('id')->get();
        return view('welcome', ['title' => 'Welcome', 'tasks' => $tasks,
            'today' => today(), 'completed' => $tasks->where('status', 'completed')->count()]);
    }
    public function tasks(): View
    {
        return view('tasks', ['title' => 'Task List', 'tasks' => Task::orderBy('task_date')->orderBy('id')->get()]);
    }
    public function profile(): View
    {
        return view('profile', ['title' => 'Profile', 'user' => User::orderBy('id')->first()]);
    }
    public function about(): View
    {
        return view('about', ['title' => 'About']);
    }
}
