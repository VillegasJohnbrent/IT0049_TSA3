<?php
namespace Tests\Feature;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;
class DashboardTest extends TestCase
{
    use RefreshDatabase;
    protected function setUp(): void
    {
        parent::setUp();
        Carbon::setTestNow(Carbon::parse('2026-11-21 00:30:00', 'Asia/Manila'));
    }
    protected function tearDown(): void
    {
        Carbon::setTestNow();
        parent::tearDown();
    }
    public function test_seed_has_nine_tasks_three_dates_and_one_user(): void
    {
        $this->seed();
        $this->assertDatabaseCount('tasks', 9);
        $this->assertDatabaseCount('users', 1);
        $this->assertSame(3, Task::pluck('task_date')->unique()->count());
        $this->assertSame(4, Task::forToday()->count());
        $this->assertDatabaseHas('tasks', ['task_date' => '2026-11-20']);
        $this->assertDatabaseHas('tasks', ['task_date' => '2026-11-22']);
    }
    public function test_reseeding_does_not_duplicate_records(): void
    {
        $this->seed(); $this->seed();
        $this->assertDatabaseCount('tasks', 9);
        $this->assertDatabaseCount('users', 1);
    }
    public function test_welcome_filters_by_philippine_date_and_counts_statuses(): void
    {
        $this->seed();
        $this->get('/')->assertOk()
            ->assertSee('Build the daily task dashboard')
            ->assertDontSee('Review project requirements')
            ->assertDontSee('Upload source files to GitHub')
            ->assertViewHas('tasks', fn ($tasks) => $tasks->count() === 4 && $tasks->every(fn ($t) => $t->task_date->format('Y-m-d') === '2026-11-21'))
            ->assertViewHas('completed', 1);
    }
    public function test_today_filter_changes_at_midnight(): void
    {
        $this->seed();
        Carbon::setTestNow(Carbon::parse('2026-11-22 00:00:00', 'Asia/Manila'));
        $this->get('/')->assertOk()->assertViewHas('tasks', fn ($tasks) => $tasks->count() === 2)
            ->assertSee('Verify the hosted application')->assertDontSee('Check task filtering by date');
    }
    public function test_task_list_shows_all_records_in_date_order(): void
    {
        $this->seed();
        // Deliberately create an older record last to distinguish date order from ID order.
        Task::create(['title' => 'Earlier record inserted last', 'task_date' => '2026-11-19']);
        $this->get('/tasks')->assertOk()->assertViewHas('tasks', fn ($tasks) => $tasks->count() === 10)
            ->assertSeeInOrder(['Earlier record inserted last', 'Review project requirements', 'Build the daily task dashboard', 'Upload source files to GitHub']);
    }
    public function test_profile_displays_seeded_user(): void
    {
        $this->seed();
        $this->get('/profile')->assertOk()->assertSee('Alex Santos')->assertSee('demo_user')->assertSee('alex.santos@example.com');
    }
    public function test_about_displays_configured_developer(): void
    {
        config(['developer.name' => 'John', 'developer.section' => 'Test section']);
        $this->get('/about')->assertOk()->assertSee('John')->assertSee('Test section')->assertSee('ASSESSMENT 3');
    }
    public function test_empty_states(): void
    {
        $this->get('/')->assertOk()->assertSee('No tasks are scheduled for today.');
        $this->get('/tasks')->assertOk()->assertSee('No tasks have been added yet.');
        $this->get('/profile')->assertOk()->assertSee('No demo user is available.');
    }
    public function test_status_defaults_to_pending_and_timestamps_are_stored(): void
    {
        $task = Task::create(['title' => 'Default status', 'task_date' => today()])->fresh();
        $this->assertSame('pending', $task->status);
        $this->assertNotNull($task->created_at);
        $this->assertNotNull($task->updated_at);
    }
    public function test_usernames_are_unique(): void
    {
        $this->seed();
        $this->expectException(QueryException::class);
        User::create(['username' => 'demo_user', 'full_name' => 'Another User', 'email' => 'other@example.com']);
    }
    public function test_task_titles_are_html_escaped(): void
    {
        Task::create(['title' => '<script>alert(1)</script>', 'task_date' => today()]);
        $this->get('/')->assertOk()->assertSee('&lt;script&gt;alert(1)&lt;/script&gt;', false)
            ->assertDontSee('<script>alert(1)</script>', false);
    }
}
