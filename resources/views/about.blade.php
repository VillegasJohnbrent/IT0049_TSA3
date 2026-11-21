@extends('layout')
@section('content')
<div class="page-heading"><div><p class="eyebrow">ABOUT THE PROJECT</p><h1>A simple plan for every day.</h1><p class="muted">Tasks for Today Management System</p></div></div>
<section class="card about-card">
    <span class="project-tag">TECHNICAL SUMMATIVE ASSESSMENT 3</span>
    <h2>Keep today's work in focus.</h2>
    <p>View today's tasks, browse the full task list, and check the user profile.</p>
    <dl class="details"><div><dt>Developed by</dt><dd>{{ config('developer.name') }}</dd></div><div><dt>Section</dt><dd>{{ config('developer.section') }}</dd></div><div><dt>Course</dt><dd>IT0049 — Web System Technologies</dd></div><div><dt>Built with</dt><dd>Laravel, Eloquent, Blade, PHP, SQL, HTML, and CSS</dd></div></dl>
</section>
@endsection
