<?php
namespace Database\Seeders;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            // Re-running the seeder does not duplicate or overwrite existing records.
            if (! User::exists()) {
                User::create(['username' => 'demo_user', 'full_name' => 'Alex Santos', 'email' => 'alex.santos@example.com']);
            }
            if (Task::exists()) { return; }
            $today = today();
            foreach ([
                ['Review project requirements', 'completed', -1],
                ['Design the database schema', 'completed', -1],
                ['Prepare the interface layout', 'completed', -1],
                ['Build the daily task dashboard', 'completed', 0],
                ['Check task filtering by date', 'in progress', 0],
                ['Review the demo user profile', 'pending', 0],
                ['Complete project documentation', 'pending', 0],
                ['Upload source files to GitHub', 'pending', 1],
                ['Verify the hosted application', 'pending', 1],
            ] as [$title, $status, $offset]) {
                Task::create(['title' => $title, 'status' => $status, 'task_date' => $today->copy()->addDays($offset)->toDateString()]);
            }
        });
    }
}
