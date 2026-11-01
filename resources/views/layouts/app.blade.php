<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>

    <!-- Bootstrap 5 CSS loaded from CDN (no npm/build needed) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Simple professional blue + white theme */
        body { background-color: #f4f7fb; }
        .navbar-brand { font-weight: 700; letter-spacing: .3px; }
        .card-count { border-left: 5px solid #0d6efd; }
        .table thead { background-color: #0d6efd; color: #fff; }
        footer { color: #6c757d; font-size: .85rem; }
    </style>
</head>
<body>

    <!-- Top navigation bar -->
    <nav class="navbar navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('tasks.index') }}">&#128221; {{ config('app.name') }}</a>
            <a href="{{ route('tasks.create') }}" class="btn btn-light btn-sm fw-semibold">
                + Add New Task
            </a>
        </div>
    </nav>

    <!-- Main page content goes here -->
    <div class="container py-4">

        <!-- Success message (shown after add / edit / delete) -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <footer class="text-center py-4">
        To-Do List Management System &middot; Laravel + MySQL (KTU S7 Web Development Project)
    </footer>

    <!-- Bootstrap 5 JS (needed for the alert close button) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
