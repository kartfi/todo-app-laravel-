@extends('layouts.app')

@section('title', 'My To-Do List')

@section('content')

    <!-- ===== Summary count cards ===== -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card card-count shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted mb-1">Total Tasks</h6>
                    <h3 class="mb-0 text-primary">{{ $totalTasks }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-count shadow-sm" style="border-left-color:#dc3545;">
                <div class="card-body">
                    <h6 class="text-muted mb-1">Pending Tasks</h6>
                    <h3 class="mb-0 text-danger">{{ $pendingTasks }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-count shadow-sm" style="border-left-color:#198754;">
                <div class="card-body">
                    <h6 class="text-muted mb-1">Completed Tasks</h6>
                    <h3 class="mb-0 text-success">{{ $completedTasks }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== Filter buttons: All / Pending / Completed ===== -->
    <div class="mb-3">
        <a href="{{ route('tasks.index') }}"
           class="btn btn-sm {{ $filter == 'all' ? 'btn-primary' : 'btn-outline-primary' }}">All Tasks</a>
        <a href="{{ route('tasks.index', ['status' => 'pending']) }}"
           class="btn btn-sm {{ $filter == 'pending' ? 'btn-danger' : 'btn-outline-danger' }}">Pending</a>
        <a href="{{ route('tasks.index', ['status' => 'completed']) }}"
           class="btn btn-sm {{ $filter == 'completed' ? 'btn-success' : 'btn-outline-success' }}">Completed</a>
    </div>

    <!-- ===== Task table ===== -->
    <div class="card shadow-sm">
        <div class="card-body">
            @if (count($tasks) > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Completed?</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td>{{ $task->id }}</td>
                                    <td class="fw-semibold">{{ $task->title }}</td>
                                    <td>{{ Str::limit($task->description, 60) ?: '-' }}</td>
                                    <td>
                                        @if ($task->status)
                                            <span class="badge bg-success">Completed</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @endif
                                    </td>
                                    <td>{{ $task->created_at->format('d M Y, h:i A') }}</td>

                                    <!-- Mark completed / undo using a checkbox that submits a form -->
                                    <td>
                                        <form action="{{ route('tasks.toggle', $task->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="checkbox" class="form-check-input"
                                                   onchange="this.form.submit()"
                                                   title="Tick to mark completed, untick to mark pending"
                                                   {{ $task->status ? 'checked' : '' }}>
                                        </form>
                                    </td>

                                    <!-- Edit + Delete actions -->
                                    <td class="text-end">
                                        <a href="{{ route('tasks.edit', $task->id) }}"
                                           class="btn btn-sm btn-outline-primary">Edit</a>

                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete this task?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <!-- Shown when there are no tasks yet -->
                <div class="text-center py-5 text-muted">
                    <h5>No tasks found.</h5>
                    <p>Click <strong>+ Add New Task</strong> to create your first task.</p>
                    <a href="{{ route('tasks.create') }}" class="btn btn-primary">+ Add New Task</a>
                </div>
            @endif
        </div>
    </div>

@endsection
