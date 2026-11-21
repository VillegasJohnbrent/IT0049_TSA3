@extends('layout')
@section('content')
<div class="page-heading"><div><p class="eyebrow">YOUR WORKSPACE ACCOUNT</p><h1>Profile</h1><p class="muted">The demo user registered in this system.</p></div></div>
@if ($user)
<section class="card profile-card">
    <div class="profile-header"><span class="avatar">{{ strtoupper(substr($user->username, 0, 1)) }}</span><div><h2>{{ $user->full_name }}</h2><p class="muted"><span>@</span>{{ $user->username }}</p></div><span class="badge completed">Demo account</span></div>
    <dl class="details"><div><dt>User ID</dt><dd>{{ $user->id }}</dd></div><div><dt>Username</dt><dd>{{ $user->username }}</dd></div><div><dt>Full name</dt><dd>{{ $user->full_name }}</dd></div><div><dt>Email address</dt><dd>{{ $user->email }}</dd></div><div><dt>Created at</dt><dd>{{ $user->created_at?->format('F j, Y · g:i A') ?? '—' }}</dd></div></dl>
</section>
@else
<section class="card empty">No demo user is available.</section>
@endif
@endsection
