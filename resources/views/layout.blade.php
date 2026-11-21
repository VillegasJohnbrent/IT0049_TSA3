<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Tasks for Today Management System">
    <title>{{ $title }} | Tasks for Today</title>
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
</head>
<body>
<header class="topbar">
    <a class="brand" href="{{ route('welcome') }}"><span class="brand-mark">✓</span> Tasks for Today</a>
    <span class="course">IT0049 · Web System Technologies</span>
</header>
<div class="shell">
    <aside>
        <p class="eyebrow">WORKSPACE</p>
        <nav aria-label="Main navigation">
            @foreach (['welcome' => 'Welcome', 'tasks' => 'Task List', 'profile' => 'Profile', 'about' => 'About'] as $name => $label)
                <a class="nav-item {{ request()->routeIs($name) ? 'selected' : '' }}" @if(request()->routeIs($name)) aria-current="page" @endif href="{{ route($name) }}">{{ $label }}</a>
            @endforeach
        </nav>
        <div class="sidebar-note">A clearer view of<br>what needs doing.</div>
    </aside>
    <main id="main">@yield('content')</main>
</div>
<footer>Tasks for Today Management System <span>Laravel · IT0049 TSA3</span></footer>
</body>
</html>
