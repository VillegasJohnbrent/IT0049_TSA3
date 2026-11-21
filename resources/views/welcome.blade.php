@extends('layout')
@section('content')
<div class="page-heading">
    <div><p class="eyebrow">YOUR DAILY OVERVIEW</p><h1>Welcome to your day.</h1><p class="muted">Focus on the tasks scheduled for today.</p></div>
    <span class="date-chip">{{ $today->format('D, M j, Y') }}</span>
</div>
<div class="stats">
    <div class="stat"><span>Today's tasks</span><strong>{{ $tasks->count() }}</strong></div>
    <div class="stat"><span>Completed today</span><strong>{{ $completed }}</strong></div>
    <div class="stat"><span>Still to do today</span><strong>{{ $tasks->count() - $completed }}</strong></div>
</div>
<section class="card">
    <div class="card-heading"><div><h2>Today's tasks</h2><p class="muted">Scheduled for {{ $today->format('F j, Y') }} · Philippine time</p></div><a class="button" href="{{ route('tasks') }}">View all tasks →</a></div>
    @include('partials.task_table', ['emptyMessage' => 'No tasks are scheduled for today.'])
</section>
@endsection
