@extends('layout')
@section('content')
<div class="page-heading"><div><p class="eyebrow">THE COMPLETE PICTURE</p><h1>Task List</h1><p class="muted">Every task, ordered by scheduled date from earliest to latest.</p></div><span class="date-chip">{{ $tasks->count() }} tasks</span></div>
<section class="card">
    <div class="card-heading"><h2>All scheduled tasks</h2><span class="muted">All dates</span></div>
    @include('partials.task_table', ['emptyMessage' => 'No tasks have been added yet.'])
</section>
@endsection
