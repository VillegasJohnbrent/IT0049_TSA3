<div class="table-wrap">
<table>
    <thead><tr><th scope="col">ID</th><th scope="col">Task</th><th scope="col">Status</th><th scope="col">Scheduled date</th><th scope="col">Created</th></tr></thead>
    <tbody>
    @forelse ($tasks as $task)
        <tr>
            <td class="muted">#{{ $task->id }}</td>
            <td class="task-title">{{ $task->title }}</td>
            <td><span class="badge {{ ['pending' => 'pending', 'in progress' => 'progress', 'completed' => 'completed'][$task->status] ?? 'pending' }}">{{ ucfirst($task->status) }}</span></td>
            <td class="nowrap">{{ $task->task_date->format('M j, Y') }}</td>
            <td class="nowrap muted">{{ $task->created_at?->format('M j, Y · g:i A') ?? '—' }}</td>
        </tr>
    @empty
        <tr><td colspan="5" class="empty">{{ $emptyMessage }}</td></tr>
    @endforelse
    </tbody>
</table>
</div>
